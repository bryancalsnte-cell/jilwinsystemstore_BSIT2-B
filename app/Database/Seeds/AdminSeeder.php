<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        // Check if the admin user already exists
        $admin = $builder->where('email', 'admin')->get()->getRow();

        if (!$admin) {
            $data = [
                'email'      => 'admin',
                'password'   => password_hash('admin', PASSWORD_DEFAULT),
                'role'       => 'Admin',
                'status'     => 'Active',
                'name'       => 'Administrator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $builder->insert($data);
            echo "Admin user created successfully.\n";
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
