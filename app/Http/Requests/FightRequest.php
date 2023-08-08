<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FightRequest extends FormRequest
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
            'fighter1_id' => 'required|integer|exists:fighters,id',
            'fighter2_id' => 'required|integer|exists:fighters,id',
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'fighter1_id.required' => 'É obrigatório definir o Fighter Nº 1.',
            'fighter1_id.integer' => 'O ID do Fighter Nº 1 precisa ser um valor inteiro.',
            'fighter1_id.exists' => 'O ID do Fighter Nº 1 precisa existir no banco de dados.',
            'fighter2_id.required' => 'É obrigatório definir o Fighter Nº 2.',
            'fighter2_id.integer' => 'O ID do Fighter Nº 2 precisa ser um valor inteiro.',
            'fighter2_id.exists' => 'O ID do Fighter Nº 2 precisa existir no banco de dados.',
        ];
    }

}
