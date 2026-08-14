<?php
declare(strict_types=1);

namespace Gmg\Events\Core;

final class Permission
{
    /** @return array<string,array<string,string>> */
    public static function groups(): array
    {
        return [
            'Events' => [
                'events.view' => 'View events',
                'events.create' => 'Create events',
                'events.edit' => 'Edit events',
                'events.delete' => 'Delete events',
                'events.order' => 'Change event order',
            ],
            'Homepage' => [
                'counters.view' => 'View homepage counters',
                'counters.edit' => 'Edit homepage counters',
                'partners.view' => 'View business partners',
                'partners.create' => 'Create business partners',
                'partners.edit' => 'Edit business partners',
                'partners.delete' => 'Delete business partners',
                'partners.order' => 'Change business partner order',
            ],
            'Companies Page' => [
                'companies.view' => 'View companies',
                'companies.create' => 'Create companies',
                'companies.edit' => 'Edit companies',
                'companies.delete' => 'Delete companies',
                'companies.order' => 'Change company order',
            ],
            'Board of Directors' => [
                'about.directors.view' => 'View directors',
                'about.directors.create' => 'Create directors',
                'about.directors.edit' => 'Edit directors',
                'about.directors.delete' => 'Delete directors',
                'about.directors.order' => 'Change director order',
            ],
            'Management Team' => [
                'about.management.view' => 'View management team',
                'about.management.create' => 'Create management members',
                'about.management.edit' => 'Edit management members',
                'about.management.delete' => 'Delete management members',
                'about.management.order' => 'Change management order',
            ],
            'Our Teams' => [
                'about.teams.view' => 'View company teams',
                'about.teams.create' => 'Create company teams',
                'about.teams.edit' => 'Edit company teams',
                'about.teams.delete' => 'Delete company teams',
                'about.teams.order' => 'Change company team order',
            ],
            'Career Vacancies' => [
                'careers.vacancies.view' => 'View vacancies',
                'careers.vacancies.create' => 'Create vacancies',
                'careers.vacancies.edit' => 'Edit vacancies',
                'careers.vacancies.delete' => 'Delete vacancies',
                'careers.vacancies.order' => 'Change vacancy order',
            ],
            'Career Applications' => [
                'careers.applications.view' => 'View applications',
                'careers.applications.download' => 'Download CV files',
                'careers.applications.delete' => 'Delete applications',
            ],
            'Administrators' => [
                'admins.view' => 'View administrators',
                'admins.create' => 'Create administrators',
                'admins.edit' => 'Edit administrators',
                'admins.delete' => 'Delete administrators',
                'admins.permissions' => 'Assign administrator permissions',
            ],
        ];
    }

    /** @return array<string,string> */
    public static function all(): array
    {
        $all = [];
        foreach (self::groups() as $permissions) {
            $all += $permissions;
        }
        return $all;
    }

    /** @return list<string> */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    /** @param array<int|string,mixed> $permissions @return list<string> */
    public static function sanitize(array $permissions): array
    {
        $allowed = array_flip(self::keys());
        $clean = [];
        foreach ($permissions as $permission) {
            $key = (string) $permission;
            if (isset($allowed[$key])) {
                $clean[] = $key;
            }
        }
        return array_values(array_unique($clean));
    }
}
