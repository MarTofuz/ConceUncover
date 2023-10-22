<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Crear el usuario "admin"
        DB::table('users')->insert([
            'name' => 'admin',
            'phone' => '954535443',
            'address' => 'Oficina ConceUncover',
            'email' => 'masterconceuncover@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Govi1234'),
            'remember_token' => Str::random(10),
            'current_team_id' => null,
            'profile_photo_path' => 'ruta/a/una/foto/de/ejemplo.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Crear el rol de administrador si no existe
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        // Obtener el usuario "admin" por su correo electrónico
        $adminUser = DB::table('users')->where('email', 'masterconceuncover@gmail.com')->first();

        // Obtener el rol "admin"
        $adminRole = Role::where('name', 'admin')->first();

        // Asignar el rol de administrador al usuario "admin"
        if ($adminUser && $adminRole) {
            DB::table('model_has_roles')->insert([
                'role_id' => $adminRole->id,
                'model_type' => 'App\\Models\\User',
                'model_id' => $adminUser->id,
            ]);
        }

        // Puedes agregar más registros de usuarios aquí si lo deseas.
    }
}
