<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    //CAMPOS NECESARIOS PARA AÑADIR REGISTROS EN MASA
    protected $fillable = ['name', 'email', 'password'];
    
    //CAMPOS VISIBLES DEL MODELO
    protected $visible = ['name', 'email'];

    //CAMPOS OCULTOS DEL MODELO
    protected $hidden = ['id', 'password'];

    //CAMPOS Y VALORES POR DEFECTO
    protected $attributes = [
        'password' => null,
        'email' => null,
        'name' => null,
    ];
}
