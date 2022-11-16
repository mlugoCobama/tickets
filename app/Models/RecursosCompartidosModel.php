<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecursosCompartidosModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'unidad',
        'ruta',
        'observaciones',
        'usuario_empresa_id',
        'created_at',
        'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'recurso_compartidos';
}
