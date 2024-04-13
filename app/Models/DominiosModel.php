<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DominiosModel extends Model
{
    use HasFactory;
         /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'id', 'nombre', 'costo', 'fecha_contratacion', 'fecha_renovacion', 'estado', 'tipo'
    ];

    protected $dates = ['fecha_contratacion', 'fecha_renovacion'];
    /**
     * Nombre de la tabla
     */
    protected $table = 'dominios';
}
