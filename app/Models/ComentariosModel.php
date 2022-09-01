<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosModel extends Model
{
   /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'comentario', 'user_id', 'ticket_id', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'comentarios';
    /*
    |--------------------------------------------------------------------------
    | RELACIONES DE BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'id', 'ticke_id');
    }
}
