<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreosModel extends Model
{
    /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'id_mensaje', 'asunto', 'enviado', 'mensaje', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'correos';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function ticket()
    {
        return $this->hasOne(TicketsModel::class, 'correo_id', 'id');
    }
}
