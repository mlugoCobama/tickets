<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatHardware extends Model
{
    use HasFactory;
     /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'tipo', 'icono', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'cat_hardware';
}
