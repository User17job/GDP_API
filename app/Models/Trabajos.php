<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
   

class Trabajos extends Model
{
    use HasFactory;
    protected $table = 'trabajos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'herramientas',
        'imagen_url',
        'link',
        'name',
        'description',
    ];
}
