<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class Validator
{
    public static function event(array $input, bool $creating): array
    {
        $errors = [];
        $name = trim((string) ($input['name'] ?? ''));
        $company = trim((string) ($input['company'] ?? ''));
        $description = trim((string) ($input['description'] ?? ''));
        $date = trim((string) ($input['event_date'] ?? ''));
        $time = trim((string) ($input['event_time'] ?? ''));
        $status = (string) ($input['status'] ?? 'published');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if ($name === '' || text_length($name) > 200) {
            $errors['name'][] = 'Event name is required and must be 200 characters or fewer.';
        }
        if ($company === '' || text_length($company) > 160) {
            $errors['company'][] = 'Company is required and must be 160 characters or fewer.';
        }
        if ($description === '' || text_length($description) > 50000) {
            $errors['description'][] = 'Description is required and must be 50,000 characters or fewer.';
        }
        $dateObject = \DateTimeImmutable::createFromFormat('Y-m-d', $date);
        if (!$dateObject || $dateObject->format('Y-m-d') !== $date) {
            $errors['event_date'][] = 'Enter a valid event date.';
        }
        if (text_length($time) > 100) {
            $errors['event_time'][] = 'Event time must be 100 characters or fewer.';
        }
        if (!in_array($status, ['draft', 'published'], true)) {
            $errors['status'][] = 'Invalid event status.';
        }
        if ($sortOrder !== '' && (!ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999)) {
            $errors['sort_order'][] = 'Custom order must be a number from 1 to 9999 or left blank.';
        }
        if ($creating && empty($_FILES['main_image']['name'])) {
            $errors['main_image'][] = 'A main image is required.';
        }

        return $errors;
    }

    public static function admin(array $input): array
    {
        $errors = [];
        $username = trim((string) ($input['username'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $confirm = (string) ($input['password_confirmation'] ?? '');
        $role = (string) ($input['role'] ?? 'admin');

        if (!preg_match('/^[A-Za-z0-9._-]{3,50}$/', $username)) {
            $errors['username'][] = 'Username must be 3-50 characters and use only letters, numbers, dots, underscores, or hyphens.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || text_length($email) > 190) {
            $errors['email'][] = 'Enter a valid email address.';
        }
        if (strlen($password) < 12 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors['password'][] = 'Password must be at least 12 characters and include uppercase, lowercase, a number, and a symbol.';
        }
        if ($password !== $confirm) {
            $errors['password_confirmation'][] = 'Password confirmation does not match.';
        }
        if (!in_array($role, ['admin', 'super_admin'], true)) {
            $errors['role'][] = 'Invalid admin role.';
        }

        return $errors;
    }

    public static function partner(array $input, bool $creating): array
    {
        $errors = [];
        $name = trim((string) ($input['name'] ?? ''));
        $altText = trim((string) ($input['alt_text'] ?? ''));
        $websiteUrl = trim((string) ($input['website_url'] ?? ''));
        $status = (string) ($input['status'] ?? 'active');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if ($name === '' || text_length($name) > 160) {
            $errors['name'][] = 'Partner name is required and must be 160 characters or fewer.';
        }
        if (text_length($altText) > 190) {
            $errors['alt_text'][] = 'Alternative text must be 190 characters or fewer.';
        }
        if ($websiteUrl !== '') {
            $validUrl = filter_var($websiteUrl, FILTER_VALIDATE_URL);
            $scheme = text_lower((string) parse_url($websiteUrl, PHP_URL_SCHEME));
            if ($validUrl === false || !in_array($scheme, ['http', 'https'], true) || text_length($websiteUrl) > 500) {
                $errors['website_url'][] = 'Enter a valid HTTP or HTTPS website URL.';
            }
        }
        if (!in_array($status, ['active', 'inactive'], true)) {
            $errors['status'][] = 'Invalid partner status.';
        }
        if ($sortOrder !== '' && (!ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999)) {
            $errors['sort_order'][] = 'Display order must be a number from 1 to 9999.';
        }
        if ($creating && empty($_FILES['partner_image']['name'])) {
            $errors['partner_image'][] = 'A partner logo image is required.';
        }

        return $errors;
    }



    public static function websiteCompany(array $input, bool $creating): array
    {
        $errors = [];
        $companyName = trim((string) ($input['company_name'] ?? ''));
        $websiteUrl = trim((string) ($input['website_url'] ?? ''));
        $status = (string) ($input['status'] ?? 'active');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if ($companyName === '' || text_length($companyName) > 180) {
            $errors['company_name'][] = 'Company name is required and must be 180 characters or fewer.';
        }
        if ($websiteUrl !== '') {
            $isExternal = filter_var($websiteUrl, FILTER_VALIDATE_URL) !== false
                && in_array(text_lower((string) parse_url($websiteUrl, PHP_URL_SCHEME)), ['http', 'https'], true);
            $isInternal = preg_match('/^[A-Za-z0-9._~!$&\'()*+,;=:@%\/-]+(?:\?[A-Za-z0-9._~!$&\'()*+,;=:@%\/?-]*)?$/', $websiteUrl) === 1
                && !str_starts_with($websiteUrl, '//')
                && !str_contains($websiteUrl, '..');
            if ((!$isExternal && !$isInternal) || text_length($websiteUrl) > 500) {
                $errors['website_url'][] = 'Enter a valid HTTP/HTTPS URL or a safe internal page path.';
            }
        }
        if (!in_array($status, ['active', 'inactive'], true)) {
            $errors['status'][] = 'Invalid company status.';
        }
        if ($sortOrder === '' || !ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999) {
            $errors['sort_order'][] = 'Display order must be a number from 1 to 9999.';
        }
        if ($creating && empty($_FILES['company_image']['name'])) {
            $errors['company_image'][] = 'A company image is required.';
        }
        return $errors;
    }

    public static function aboutMember(array $input, bool $creating): array
    {
        $errors = [];
        $type = (string) ($input['member_type'] ?? '');
        $name = trim((string) ($input['name'] ?? ''));
        $position = trim((string) ($input['position'] ?? ''));
        $status = (string) ($input['status'] ?? 'active');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if (!in_array($type, ['director', 'management'], true)) {
            $errors['member_type'][] = 'Invalid About page section.';
        }
        if ($name === '' || text_length($name) > 160) {
            $errors['name'][] = 'Name is required and must be 160 characters or fewer.';
        }
        if ($position === '' || text_length($position) > 255) {
            $errors['position'][] = 'Position is required and must be 255 characters or fewer.';
        }
        if (!in_array($status, ['active', 'inactive'], true)) {
            $errors['status'][] = 'Invalid status.';
        }
        if ($sortOrder !== '' && (!ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999)) {
            $errors['sort_order'][] = 'Display order must be a number from 1 to 9999.';
        }
        if ($creating && empty($_FILES['member_image']['name'])) {
            $errors['member_image'][] = 'A member image is required.';
        }

        return $errors;
    }

    public static function aboutTeam(array $input, bool $creating): array
    {
        $errors = [];
        $companyName = trim((string) ($input['company_name'] ?? ''));
        $status = (string) ($input['status'] ?? 'active');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if ($companyName === '' || text_length($companyName) > 180) {
            $errors['company_name'][] = 'Company name is required and must be 180 characters or fewer.';
        }
        if (!in_array($status, ['active', 'inactive'], true)) {
            $errors['status'][] = 'Invalid status.';
        }
        if ($sortOrder !== '' && (!ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999)) {
            $errors['sort_order'][] = 'Display order must be a number from 1 to 9999.';
        }
        if ($creating && empty($_FILES['team_image']['name'])) {
            $errors['team_image'][] = 'A company team image is required.';
        }

        return $errors;
    }

    public static function adminUpdate(array $input, bool $passwordRequired = false): array
    {
        $errors = [];
        $username = trim((string) ($input['username'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $password = (string) ($input['password'] ?? '');
        $confirm = (string) ($input['password_confirmation'] ?? '');
        $role = (string) ($input['role'] ?? 'admin');
        $isActive = (string) ($input['is_active'] ?? '1');

        if (!preg_match('/^[A-Za-z0-9._-]{3,50}$/', $username)) {
            $errors['username'][] = 'Username must be 3-50 characters and use only letters, numbers, dots, underscores, or hyphens.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || text_length($email) > 190) {
            $errors['email'][] = 'Enter a valid email address.';
        }
        if ($passwordRequired || $password !== '') {
            if (strlen($password) < 12 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
                $errors['password'][] = 'Password must be at least 12 characters and include uppercase, lowercase, a number, and a symbol.';
            }
            if ($password !== $confirm) {
                $errors['password_confirmation'][] = 'Password confirmation does not match.';
            }
        }
        if (!in_array($role, ['admin', 'super_admin'], true)) {
            $errors['role'][] = 'Invalid admin role.';
        }
        if (!in_array($isActive, ['0', '1'], true)) {
            $errors['is_active'][] = 'Invalid account status.';
        }
        return $errors;
    }

    public static function vacancy(array $input): array
    {
        $errors = [];
        $company = (string) ($input['company'] ?? '');
        $companyName = trim((string) ($input['company_name'] ?? ''));
        $position = trim((string) ($input['position'] ?? ''));
        $responsibilities = trim((string) ($input['responsibilities'] ?? ''));
        $qualifications = trim((string) ($input['qualifications'] ?? ''));
        $status = (string) ($input['status'] ?? 'active');
        $sortOrder = trim((string) ($input['sort_order'] ?? ''));

        if (!in_array($company, ['GMG', 'GMS'], true)) {
            $errors['company'][] = 'Select GMG or GMS.';
        }
        if ($companyName === '' || text_length($companyName) > 180) {
            $errors['company_name'][] = 'Company name is required and must be 180 characters or fewer.';
        }
        if ($position === '' || text_length($position) > 180) {
            $errors['position'][] = 'Position is required and must be 180 characters or fewer.';
        }
        if ($responsibilities === '' || text_length($responsibilities) > 30000) {
            $errors['responsibilities'][] = 'Responsibilities are required and must be 30,000 characters or fewer.';
        }
        if ($qualifications === '' || text_length($qualifications) > 30000) {
            $errors['qualifications'][] = 'Qualifications are required and must be 30,000 characters or fewer.';
        }
        if (!in_array($status, ['active', 'inactive'], true)) {
            $errors['status'][] = 'Invalid vacancy status.';
        }
        if ($sortOrder === '' || !ctype_digit($sortOrder) || (int) $sortOrder < 1 || (int) $sortOrder > 9999) {
            $errors['sort_order'][] = 'Display order must be a number from 1 to 9999.';
        }
        return $errors;
    }

    public static function application(array $input): array
    {
        $errors = [];
        $vacancyId = trim((string) ($input['vacancy_id'] ?? ''));
        $name = trim((string) ($input['applicant_name'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $phone = trim((string) ($input['phone'] ?? ''));

        if ($vacancyId === '' || !ctype_digit($vacancyId) || (int) $vacancyId < 1) {
            $errors['vacancy_id'][] = 'Select a valid vacancy.';
        }
        if ($name === '' || text_length($name) > 160) {
            $errors['applicant_name'][] = 'Name is required and must be 160 characters or fewer.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || text_length($email) > 190) {
            $errors['email'][] = 'Enter a valid email address.';
        }
        if ($phone === '' || text_length($phone) > 40 || !preg_match('/^[0-9+()\-\s.]{7,40}$/', $phone)) {
            $errors['phone'][] = 'Enter a valid phone number.';
        }
        if (empty($_FILES['cv_file']['name'])) {
            $errors['cv_file'][] = 'Please upload your CV.';
        }
        return $errors;
    }

}
