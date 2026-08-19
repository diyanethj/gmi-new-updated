<?php
declare(strict_types=1);

namespace Gmg\Events\Controllers\Admin;

use Gmg\Events\Core\AuditLogger;
use Gmg\Events\Core\Auth;
use Gmg\Events\Core\Controller;
use Gmg\Events\Core\Csrf;
use Gmg\Events\Core\Database;
use Gmg\Events\Models\FooterContact;
use Throwable;

final class FooterContactController extends Controller
{
    private FooterContact $footerContact;

    public function __construct()
    {
        $this->footerContact = new FooterContact(Database::connection());
    }

    public function index(): void
    {
        Auth::requirePermission('footer_contact.view');

        $this->render(
            'admin/footer-contact/index',
            ['contact' => $this->footerContact->get()],
            'admin/layouts/app'
        );
    }

    public function update(): void
    {
        Auth::requirePermission('footer_contact.edit');
        Csrf::requireValid();

        $data = [
            'address' => trim((string) ($_POST['address'] ?? '')),
            'phone' => trim((string) ($_POST['phone'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
            'office_hours' => trim((string) ($_POST['office_hours'] ?? '')),
            'linkedin_url' => trim((string) ($_POST['linkedin_url'] ?? '')),
            'facebook_url' => trim((string) ($_POST['facebook_url'] ?? '')),
            'instagram_url' => trim((string) ($_POST['instagram_url'] ?? '')),
            'tiktok_url' => trim((string) ($_POST['tiktok_url'] ?? '')),
            'youtube_url' => trim((string) ($_POST['youtube_url'] ?? '')),
        ];

        if ($data['address'] === '' || strlen($data['address']) > 500) {
            $this->fail('Please enter a valid address (maximum 500 characters).');
        }

        if ($data['phone'] === '' || strlen($data['phone']) > 80) {
            $this->fail('Please enter a valid phone number (maximum 80 characters).');
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) || strlen($data['email']) > 190) {
            $this->fail('Please enter a valid email address.');
        }

        if ($data['office_hours'] === '' || strlen($data['office_hours']) > 190) {
            $this->fail('Please enter valid office hours (maximum 190 characters).');
        }

        foreach (['linkedin_url', 'facebook_url', 'instagram_url', 'tiktok_url', 'youtube_url'] as $field) {
            if (!$this->validOptionalHttpUrl($data[$field])) {
                $this->fail('Social media links must be valid http:// or https:// URLs.');
            }
        }

        try {
            $this->footerContact->update($data, (int) Auth::id());
            AuditLogger::log('update', 'footer_contact_settings', 1, [
                'fields' => array_keys($data),
            ]);
            flash('success', 'Footer contact details updated successfully.');
        } catch (Throwable $exception) {
            error_log('Footer contact update failed: ' . $exception->getMessage());
            flash('error', 'The footer contact details could not be updated.');
        }

        redirect(admin_url('footer-contact'));
    }

    private function validOptionalHttpUrl(string $url): bool
    {
        if ($url === '') {
            return true;
        }

        if (strlen($url) > 500 || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));
        return in_array($scheme, ['http', 'https'], true);
    }

    private function fail(string $message): never
    {
        flash('error', $message);
        redirect(admin_url('footer-contact'));
    }
}