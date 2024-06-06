<?php

namespace Modules\AdminManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use modules\AdminManagement\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($admins as $admin) {
            if (!Admin::where('email', $admin['email'])->exists()) {
                Admin::create($admin);
            }
        }
    }
}
