<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DojoRequest extends FormRequest
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
            'id_fighter' => 'required|integer|exists:fighter,id',
            'id_master' => 'required|integer|exists:master,id',
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'id_fighter.required' => 'É obrigatório definir o Fighter.',
            'id_fighter.integer' => 'O ID do Fighter precisa ser um valor inteiro.',
            'id_fighter.exists' => 'O ID do Fighter precisa existir no banco de dados.',
            'id_master.required' => 'É obrigatório definir o Master.',
            'id_master.integer' => 'O ID do do Master precisa ser um valor inteiro.',
            'id_master.exists' => 'O ID do Master precisa existir no banco de dados.',
        ];
    }
}