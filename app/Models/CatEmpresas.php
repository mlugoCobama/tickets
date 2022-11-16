<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatEmpresas extends Model
{
    use HasFactory;
    use HasFactory;
     /**
     * Campos que pueden ser modificados
     */
    protected $fillable = [
        'nombre', 'created_at', 'updated_at'
    ];
    /**
     * Nombre de la tabla
     */
    protected $table = 'cat_empresas';
}
