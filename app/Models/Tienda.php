<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tiendas';

    protected $fillable = ['name', 'address', 'description', 'assistant', 'schedule', 'location', 'user_id'];

    public function propietario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'tienda_id');
    }
}
