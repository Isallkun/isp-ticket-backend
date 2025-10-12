<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'cs@isp.com'],
            [
                'name' => 'CS Team',
                'password' => bcrypt('password'),
                'role' => 'CS',
            ]
        );

        User::firstOrCreate(
            ['email' => 'noc@isp.com'],
            [
                'name' => 'NOC Agent',
                'password' => bcrypt('password'),
                'role' => 'NOC',
            ]
        );
    }
}
