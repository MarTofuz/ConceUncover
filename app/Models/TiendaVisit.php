<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiendaVisit extends Model
{
    use HasFactory;

    protected $table = 'tienda_visits';

    protected $fillable = ['user_id', 'tienda_id', 'visit_count', 'is_user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tienda()
    {
        return $this->belongsTo(Tienda::class);
    }
}
