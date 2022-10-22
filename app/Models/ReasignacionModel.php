<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReasignacionModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'solicitante_id', 'comentario', 'asignado_id', 'area_id', 'ticket_id', 'estatus_id', 'confirmado', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'reasignacion';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function solicitante()
    {
        return $this->hasOne(User::class, 'id', 'solicitante_id');
    }

    public function asignado_a()
    {
        return $this->hasOne(User::class, 'id', 'asignado_id');
    }

}
