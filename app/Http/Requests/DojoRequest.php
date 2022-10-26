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
            'fighter_id' => 'required|integer|exists:fighters,id|unique:fighters,id',
            'master_id' => 'required|integer|exists:masters,id',
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'fighter_id.required' => 'É obrigatório definir o Fighter.',
            'fighter_id.integer' => 'O ID do Fighter precisa ser um valor inteiro.',
            'fighter_id.exists' => 'O ID do Fighter precisa existir no banco de dados.',
            'fighter_id.unique' => 'Esse Fighter já está sendo treinado por outro Master.',
            'master_id.required' => 'É obrigatório definir o Master.',
            'master_id.integer' => 'O ID do Master precisa ser um valor inteiro.',
            'master_id.exists' => 'O ID do Master precisa existir no banco de dados.',
        ];
    }
}