<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("This tool can only be used from the command line.\n");
}

require dirname(__DIR__) . '/bootstrap.php';

use Gmg\Events\Core\Database;
use Gmg\Events\Core\Validator;
use Gmg\Events\Models\Admin;

$username = trim((string) ($argv[1] ?? ''));
$email = text_lower(trim((string) ($argv[2] ?? '')));
$password = (string) ($argv[3] ?? '');
$role = (string) ($argv[4] ?? 'super_admin');

if ($username === '' || $email === '' || $password === '') {
    fwrite(STDERR, "Usage: php tools/create_admin.php <username> <email> <password> [super_admin|admin]\n");
    exit(1);
}

$data = [
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'password_confirmation' => $password,
    'role' => $role,
];
$errors = Validator::admin($data);
if ($errors !== []) {
    foreach ($errors as $fieldErrors) {
        foreach ($fieldErrors as $message) {
            fwrite(STDERR, $message . PHP_EOL);
        }
    }
    exit(1);
}

$model = new Admin(Database::connection());
if ($model->existsByUsernameOrEmail($username, $email)) {
    fwrite(STDERR, "An administrator with that username or email already exists.\n");
    exit(1);
}

$id = $model->create($data, null);
fwrite(STDOUT, "Administrator created successfully. ID: {$id}\n");
