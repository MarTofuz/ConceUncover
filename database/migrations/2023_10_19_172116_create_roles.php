<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Intentar encontrar el usuario con ID 1
        $user = User::find(1);

        if ($user) {
            // El usuario se encontró, asignar el rol
            $role1 = Role::where('name', 'admin')->first();
            $user->assignRole($role1);
        } else {
            // El usuario no se encontró, ejecutar seeders
            Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);

            // Volver a intentar encontrar el usuario
            $user = User::find(1);

            if ($user) {
                // Si el usuario se encontró después de ejecutar los seeders, asignar el rol
                $role1 = Role::where('name', 'admin')->first();
                $user->assignRole($role1);
            } else {
                // Manejar el caso en el que el usuario sigue sin encontrarse
                // Esto podría incluir registros de error o excepciones.
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Puedes revertir la asignación del rol en caso de un "down".
        $user = User::find(1);
        if ($user) {
            $role1 = Role::where('name', 'admin')->first();
            $user->removeRole($role1);
        }
    }
};

