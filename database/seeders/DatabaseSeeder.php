<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'adm@ucn.cl',
            'rut' => '123456789',
            'status' => 1,
            'rol' => 'Administrador',
            'password' => bcrypt("123456"),
        ]);
    }
}
