<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = ['name', 'address', 'description', 'assistant', 'schedule', 'location', 'tienda_id'];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }
}