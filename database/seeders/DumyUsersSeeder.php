<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DumyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'anam',
                'email' => "kinganam20@gmail.com",
                'password' => bcrypt('123456678'),
                'alamat' => 'malang',
                'telp' => '082131',
                'image' => 'ada',
                'role' => 'admin'
            ],
            [
                'name' => 'aziz',
                'email' => "aziz@gmail.com",
                'password' => bcrypt('123456678'),
                'alamat' => 'malang',
                'telp' => '082131',
                'image' => 'ada',
                'role' => 'user'
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
