<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ADMIN',
            'phone' => '954535443',
            'address' => 'Oficina ConceUncover',
            'email' => 'masterconceuncover@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Govi1234'),
            'remember_token' => Str::random(10),
            'current_team_id' => null, // Puedes establecer el valor que desees
            'profile_photo_path' => 'ruta/a/una/foto/de/ejemplo.jpg', // Puedes establecer una ruta de imagen de ejemplo
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Puedes agregar más registros aquí si lo deseas.
    }
}
