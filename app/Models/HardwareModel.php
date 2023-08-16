<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HardwareModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'marca',
        'modelo',
        'no_serie',
        'mac',
        'tipo',
        'memoria_ram',
        'disco_duro',
        'procesador',
        'caracteristicas',
        'observaciones',
        'cat_hardware_id',
        'usuario_empresa_id',
        'created_at',
        'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'hardware';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function tipoHardware()
    {
        return $this->hasOne(CatHardware::class, 'id', 'cat_hardware_id');
    }

    public function usuario()
    {
        return $this->belongsTo(UsuariosEmpresasModel::class, 'id', 'usuario_empresa_id');
    }
}
