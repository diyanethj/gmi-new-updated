<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class CvUploader
{
    public function upload(array $file): array
    {
        $this->validateError($file);

        $tmp = (string) ($file['tmp_name'] ?? '');
        $size = (int) ($file['size'] ?? 0);
        $original = trim((string) ($file['name'] ?? 'cv'));

        if (!is_uploaded_file($tmp)) {
            throw new \RuntimeException('Invalid CV upload.');
        }
        if ($size < 1 || $size > (int) config('max_cv_bytes', 5242880)) {
            throw new \RuntimeException('The CV must be smaller than 5 MB.');
        }

        $safeOriginal = text_substr(basename(str_replace('\\', '/', $original)), 0, 255);
        $originalExtension = text_lower((string) pathinfo($safeOriginal, PATHINFO_EXTENSION));
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = (string) $finfo->file($tmp);
        $signature = (string) file_get_contents($tmp, false, null, 0, 8);

        [$extension, $storedMime] = $this->validateContent(
            $tmp,
            $originalExtension,
            $detectedMime,
            $signature
        );

        $directory = rtrim((string) config('cv_upload_directory'), DIRECTORY_SEPARATOR);
        $prefix = trim((string) config('cv_upload_public_prefix'), '/');
        $subDirectory = date('Y/m');
        $targetDirectory = $directory . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $subDirectory);

        if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0755, true) && !is_dir($targetDirectory)) {
            throw new \RuntimeException('Unable to create the CV upload folder.');
        }

        $filename = bin2hex(random_bytes(24)) . '.' . $extension;
        $destination = $targetDirectory . DIRECTORY_SEPARATOR . $filename;
        if (!move_uploaded_file($tmp, $destination)) {
            throw new \RuntimeException('Unable to save the CV file.');
        }
        @chmod($destination, 0640);

        return [
            'path' => $prefix . '/' . $subDirectory . '/' . $filename,
            'original_name' => $safeOriginal,
            'mime' => $storedMime,
            'size' => $size,
        ];
    }

    public function absolutePath(string $relativePath): ?string
    {
        $prefix = trim((string) config('cv_upload_public_prefix'), '/') . '/';
        $normalized = str_replace('\\', '/', ltrim($relativePath, '/'));
        if (!str_starts_with($normalized, $prefix) || str_contains($normalized, '..')) {
            return null;
        }

        $inside = substr($normalized, strlen($prefix));
        $root = rtrim((string) config('cv_upload_directory'), DIRECTORY_SEPARATOR);
        $absolute = $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $inside);
        $realRoot = realpath($root);
        $realFile = realpath($absolute);

        if ($realRoot === false || $realFile === false || !str_starts_with($realFile, $realRoot) || !is_file($realFile)) {
            return null;
        }
        return $realFile;
    }

    public function delete(string $relativePath): void
    {
        $path = $this->absolutePath($relativePath);
        if ($path !== null) {
            @unlink($path);
        }
    }

    /** @return array{0:string,1:string} */
    private function validateContent(string $tmp, string $extension, string $mime, string $signature): array
    {
        if ($extension === 'pdf'
            && $mime === 'application/pdf'
            && str_starts_with($signature, '%PDF-')) {
            return ['pdf', 'application/pdf'];
        }

        $oleSignature = "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1";
        if ($extension === 'doc'
            && hash_equals($oleSignature, $signature)
            && in_array($mime, [
                'application/msword',
                'application/x-ole-storage',
                'application/vnd.ms-office',
                'application/octet-stream',
            ], true)) {
            return ['doc', 'application/msword'];
        }

        if ($extension === 'docx'
            && in_array($mime, [
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/zip',
                'application/x-zip',
                'application/x-zip-compressed',
                'application/octet-stream',
            ], true)
            && $this->isWordDocumentArchive($tmp)) {
            return ['docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        }

        throw new \RuntimeException('Only valid PDF, DOC, and DOCX CV files are allowed.');
    }

    private function isWordDocumentArchive(string $path): bool
    {
        if (!class_exists(\ZipArchive::class)) {
            return false;
        }

        $archive = new \ZipArchive();
        if ($archive->open($path) !== true) {
            return false;
        }
        $valid = $archive->locateName('[Content_Types].xml') !== false
            && $archive->locateName('word/document.xml') !== false;
        $archive->close();
        return $valid;
    }

    private function validateError(array $file): void
    {
        $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($error === UPLOAD_ERR_OK) {
            return;
        }

        $messages = [
            UPLOAD_ERR_INI_SIZE => 'The CV exceeds the server upload limit.',
            UPLOAD_ERR_FORM_SIZE => 'The CV exceeds the form upload limit.',
            UPLOAD_ERR_PARTIAL => 'The CV upload was interrupted.',
            UPLOAD_ERR_NO_FILE => 'Please select a CV file.',
            UPLOAD_ERR_NO_TMP_DIR => 'The server temporary upload folder is missing.',
            UPLOAD_ERR_CANT_WRITE => 'The server could not save the CV.',
            UPLOAD_ERR_EXTENSION => 'A server extension stopped the CV upload.',
        ];
        throw new \RuntimeException($messages[$error] ?? 'Unknown CV upload error.');
    }
}
