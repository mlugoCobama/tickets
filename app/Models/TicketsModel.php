<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'correo_id', 'quien_asigna', 'asignado_a', 'cat_empresa_id', 'fecha_asignacion', 'area_id', 'status', 'solucion', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'tickets';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function area()
    {
        return $this->hasOne(AreasModel::class, 'id', 'area_id');
    }

    public function quien_asigna()
    {
        return $this->hasOne(User::class, 'id', 'quien_asigna');
    }

    public function asignado_a()
    {
        return $this->hasOne(User::class, 'id', 'asignado_a');
    }

    public function comentarios()
    {
        return $this->hasMany(ComentariosModel::class, 'ticket_id', 'id')->orderBy('created_at', 'desc');
    }

}
