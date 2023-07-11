<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosEmpresasModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'titular',
        'area',
        'puesto',
        'ucoip',
        'usuario_as',
        'ip',
        'extension',
        'movil',
        'activo',
        'cat_empresa_id',
        'created_at',
        'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'usuarios_empresas';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function empresa()
    {
        return $this->hasOne(CatEmpresas::class, 'id', 'cat_empresa_id');
    }

    public function hardware()
    {
        return $this->hasMany(HardwareModel::class, 'usuario_empresa_id', 'id');
    }

    public function software()
    {
        return $this->hasMany(SoftwareModel::class, 'usuario_empresa_id', 'id');
    }

    public function recursoCompartido()
    {
        return $this->hasMany(RecursosCompartidosModel::class, 'usuario_empresa_id', 'id');
    }
}
