<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class ImageUploader
{
    private string $uploadDirectory;
    private string $publicPrefix;

    private array $allowed = [
        IMAGETYPE_JPEG => ['mime' => 'image/jpeg', 'extension' => 'jpg'],
        IMAGETYPE_PNG => ['mime' => 'image/png', 'extension' => 'png'],
        IMAGETYPE_WEBP => ['mime' => 'image/webp', 'extension' => 'webp'],
    ];

    public function __construct(?string $uploadDirectory = null, ?string $publicPrefix = null)
    {
        $this->uploadDirectory = rtrim(
            $uploadDirectory ?? (string) config('upload_directory'),
            DIRECTORY_SEPARATOR
        );
        $this->publicPrefix = trim(
            $publicPrefix ?? (string) config('upload_public_prefix'),
            '/'
        );
    }

    public function uploadOne(array $file): string
    {
        $this->validateUploadError($file);

        $tmp = (string) ($file['tmp_name'] ?? '');
        $size = (int) ($file['size'] ?? 0);
        if (!is_uploaded_file($tmp)) {
            throw new \RuntimeException('Invalid uploaded file.');
        }
        if ($size < 1 || $size > (int) config('max_image_bytes', 8388608)) {
            throw new \RuntimeException('Each image must be smaller than 8 MB.');
        }

        $imageInfo = @getimagesize($tmp);
        if ($imageInfo === false || empty($imageInfo[0]) || empty($imageInfo[1])) {
            throw new \RuntimeException('The uploaded file is not a valid image.');
        }
        if ($imageInfo[0] > 8000 || $imageInfo[1] > 8000) {
            throw new \RuntimeException('Image dimensions must not exceed 8000 × 8000 pixels.');
        }

        $imageType = (int) ($imageInfo[2] ?? 0);
        if (!isset($this->allowed[$imageType])) {
            throw new \RuntimeException('Only JPG, PNG, and WEBP images are allowed.');
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = (string) $finfo->file($tmp);
        if (!hash_equals($this->allowed[$imageType]['mime'], $detectedMime)) {
            throw new \RuntimeException('The image content does not match its file type.');
        }

        $subDirectory = date('Y/m');
        $targetDirectory = $this->uploadDirectory . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $subDirectory);
        if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0755, true) && !is_dir($targetDirectory)) {
            throw new \RuntimeException('Unable to create the image upload folder.');
        }

        $filename = bin2hex(random_bytes(20)) . '.' . $this->allowed[$imageType]['extension'];
        $destination = $targetDirectory . DIRECTORY_SEPARATOR . $filename;
        if (!move_uploaded_file($tmp, $destination)) {
            throw new \RuntimeException('Unable to save the uploaded image.');
        }
        @chmod($destination, 0644);

        return $this->publicPrefix . '/' . $subDirectory . '/' . $filename;
    }

    public function uploadMany(array $files): array
    {
        $normalized = $this->normalizeMultiple($files);
        if (count($normalized) > (int) config('max_gallery_images', 40)) {
            throw new \RuntimeException('You can upload a maximum of 40 gallery images per request.');
        }

        $uploaded = [];
        try {
            foreach ($normalized as $file) {
                if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
                    continue;
                }
                $uploaded[] = $this->uploadOne($file);
            }
        } catch (\Throwable $exception) {
            foreach ($uploaded as $path) {
                $this->delete($path);
            }
            throw $exception;
        }
        return $uploaded;
    }

    public function delete(string $relativePath): void
    {
        $prefix = $this->publicPrefix . '/';
        $normalized = str_replace('\\', '/', ltrim($relativePath, '/'));
        if (!str_starts_with($normalized, $prefix) || str_contains($normalized, '..')) {
            return;
        }

        $relativeInsideUpload = substr($normalized, strlen($prefix));
        $absolute = $this->uploadDirectory . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativeInsideUpload);
        $uploadRoot = realpath($this->uploadDirectory);
        $parent = realpath(dirname($absolute));
        if ($uploadRoot === false || $parent === false || !str_starts_with($parent, $uploadRoot)) {
            return;
        }
        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }

    private function validateUploadError(array $file): void
    {
        $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($error === UPLOAD_ERR_OK) {
            return;
        }
        $messages = [
            UPLOAD_ERR_INI_SIZE => 'The uploaded image exceeds the server upload limit.',
            UPLOAD_ERR_FORM_SIZE => 'The uploaded image exceeds the form limit.',
            UPLOAD_ERR_PARTIAL => 'The image upload was interrupted.',
            UPLOAD_ERR_NO_FILE => 'No image was selected.',
            UPLOAD_ERR_NO_TMP_DIR => 'The server temporary upload directory is missing.',
            UPLOAD_ERR_CANT_WRITE => 'The server could not write the uploaded image.',
            UPLOAD_ERR_EXTENSION => 'A server extension stopped the upload.',
        ];
        throw new \RuntimeException($messages[$error] ?? 'Unknown image upload error.');
    }

    private function normalizeMultiple(array $files): array
    {
        if (!isset($files['name']) || !is_array($files['name'])) {
            return [];
        }
        $normalized = [];
        foreach ($files['name'] as $index => $name) {
            $normalized[] = [
                'name' => $name,
                'type' => $files['type'][$index] ?? '',
                'tmp_name' => $files['tmp_name'][$index] ?? '',
                'error' => $files['error'][$index] ?? UPLOAD_ERR_NO_FILE,
                'size' => $files['size'][$index] ?? 0,
            ];
        }
        return $normalized;
    }
}
