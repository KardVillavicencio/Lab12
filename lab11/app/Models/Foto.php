<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class);
    }

    /*RELACION INGRESDA*/
    public function Comentarios(){
        return $this->hasMany(Comentario::class);
    }
}
