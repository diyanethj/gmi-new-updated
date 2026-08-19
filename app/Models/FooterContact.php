<?php
declare(strict_types=1);

namespace Gmg\Events\Models;

use PDO;

final class FooterContact
{
    public function __construct(private readonly PDO $db)
    {
    }

    public function get(): array
    {
        $statement = $this->db->query(
            'SELECT id, address, phone, email, office_hours,
                    linkedin_url, facebook_url, instagram_url, tiktok_url, youtube_url,
                    updated_by, created_at, updated_at
             FROM footer_contact_settings
             WHERE id = 1
             LIMIT 1'
        );

        $row = $statement->fetch();

        return is_array($row) ? $row : $this->defaults();
    }

    public function update(array $data, int $adminId): void
    {
        $statement = $this->db->prepare(
            'UPDATE footer_contact_settings
             SET address = :address,
                 phone = :phone,
                 email = :email,
                 office_hours = :office_hours,
                 linkedin_url = :linkedin_url,
                 facebook_url = :facebook_url,
                 instagram_url = :instagram_url,
                 tiktok_url = :tiktok_url,
                 youtube_url = :youtube_url,
                 updated_by = :updated_by,
                 updated_at = NOW()
             WHERE id = 1'
        );

        $statement->execute([
            ':address' => $data['address'],
            ':phone' => $data['phone'],
            ':email' => $data['email'],
            ':office_hours' => $data['office_hours'],
            ':linkedin_url' => $data['linkedin_url'] !== '' ? $data['linkedin_url'] : null,
            ':facebook_url' => $data['facebook_url'] !== '' ? $data['facebook_url'] : null,
            ':instagram_url' => $data['instagram_url'] !== '' ? $data['instagram_url'] : null,
            ':tiktok_url' => $data['tiktok_url'] !== '' ? $data['tiktok_url'] : null,
            ':youtube_url' => $data['youtube_url'] !== '' ? $data['youtube_url'] : null,
            ':updated_by' => $adminId,
        ]);
    }

    private function defaults(): array
    {
        return [
            'id' => 1,
            'address' => '292 R. A. De Mel Mawatha, Colombo, Sri Lanka',
            'phone' => '+94 11 2 345 678',
            'email' => 'info@gmigroup.lk',
            'office_hours' => 'Mon - Fri: 8:30 AM - 5:30 PM',
            'linkedin_url' => null,
            'facebook_url' => null,
            'instagram_url' => null,
            'tiktok_url' => null,
            'youtube_url' => null,
            'updated_by' => null,
            'created_at' => null,
            'updated_at' => null,
        ];
    }
}