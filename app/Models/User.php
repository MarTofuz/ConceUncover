<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'phone', 'address', 'email', 'password'];

    // Corregir el método notify
    public function notify($instance)
    {
        $this->notify($instance); // Utiliza $this->notify($instance) para notificar
    }
}
