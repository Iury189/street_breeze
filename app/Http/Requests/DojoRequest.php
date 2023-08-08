<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DojoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fighter_id' => 'required|integer|exists:fighters,id',
            'master_id' => 'required|integer|exists:masters,id',
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'fighter_id.required' => 'É obrigatório definir o Fighter.',
            'fighter_id.integer' => 'O ID do Fighter precisa ser um valor inteiro.',
            'fighter_id.exists' => 'O ID do Fighter precisa existir no banco de dados.',
            'master_id.required' => 'É obrigatório definir o Master.',
            'master_id.integer' => 'O ID do Master precisa ser um valor inteiro.',
            'master_id.exists' => 'O ID do Master precisa existir no banco de dados.',
        ];
    }
}
