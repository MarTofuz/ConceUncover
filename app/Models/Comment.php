<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = ['content','comment_id','sucursal_id', 'tienda_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hijo()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
}
