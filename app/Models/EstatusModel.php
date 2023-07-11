<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombres', 'activo', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'estatus';
    /**
     * Funcion para obtener solo los registros activos
     */
    public function scopeActivo($query)
    {
        return $query->where('activo', 1);
    }

}
