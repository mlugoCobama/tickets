<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'cat_empresa_id' => 'required',
            'asignadoA' => 'required',
            'area' => 'required',
            'estatus' => 'required',
            'comentario' => 'required',
        ];
    }

    public function attributes()
    {
        return[
            'cat_empresa_id' => 'Empresa',
            'asignadoA' => 'Asignado a',
            'area' => 'Area',
            'estatus' => 'Estatus',
            'comentario' => 'Comentario',
        ];
    }
}
