<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'version',
        'licencia',
        'observaciones',
        'cat_software_id',
        'usuario_empresa_id',
        'created_at',
        'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'software';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function tipoSoftware()
    {
        return $this->hasOne(CatSoftware::class, 'id', 'cat_software_id');
    }
}
