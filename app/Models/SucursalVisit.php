<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalVisit extends Model
{
    use HasFactory;

    protected $table = 'sucursal_visits';

    protected $fillable = ['user_id', 'sucursal_id', 'visit_count', 'is_user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
