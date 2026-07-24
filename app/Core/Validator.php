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
}
