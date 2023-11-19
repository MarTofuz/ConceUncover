<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = ['name', 'address', 'description', 'assistant', 'schedule', 'location', 'visits', 'status', 'tienda_id'];

    public function tienda()
    {
        return $this->belongsTo(Tienda::class, 'tienda_id');
    }
    public function productos()
    {
        return $this->hasMany(Product::class, 'sucursal_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'sucursal_id');
    }

    public function sucursal_visits()
    {
        return $this->hasMany(SucursalVisit::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorite::class);
    }
}
