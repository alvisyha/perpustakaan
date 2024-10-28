<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('123456'),
            'role'  => 'admin'
        ]);

        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@perpustakaan.com',
        //     'password' => Hash::make('123456'),
        //     'role'  => 'admin'
        // ]);
    }
}