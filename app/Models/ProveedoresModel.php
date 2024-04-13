<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedoresModel extends Model
{
    use HasFactory;
     /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'id', 'nombre', 'contacto', 'telefono', 'localidad', 'condiciones', 'servicios'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'proveedores';

}
