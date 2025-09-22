<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Désactiver les contraintes de clé étrangère temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminUsers = [
            [
                'name' => 'PADONOU Ariel',
                'email' => 'padonouariel01@gmail.com',
                'password' => Hash::make('AdminAriel01'),
                'role' => 'admin',
                'num_passport' => 'AB123456',
                'status' => 1,
                'img_passport' => 'passport_admin1.jpg',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'OGOUBI Olayimika Mouktadirou',
                'email' => 'mouktadirou@mail.ru ',
                'password' => Hash::make('AdminOla02'),
                'role' => 'admin',
                'num_passport' => 'CD789012',
                'status' => 1,
                'img_passport' => 'passport_admin2.jpg',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User 3',
                'email' => 'supervisor@exchangerub.com',
                'password' => Hash::make('supervisor123'),
                'role' => 'admin',
                'num_passport' => 'EF345678',
                'status' => 1,
                'img_passport' => 'passport_admin3.jpg',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('users')->insert($adminUsers);

        $this->command->info('3 utilisateurs administrateurs créés avec succès!');
        $this->command->info('Email: padonouariel01@gmail.com | Mot de passe: AdminAriel01');
        $this->command->info('Email: mouktadirou@mail.ru | Mot de passe: AdminOla02');
        $this->command->info('Email: supervisor@exchangerub.com | Mot de passe: supervisor123');
    }
}