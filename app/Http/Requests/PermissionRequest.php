<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|min:4|unique:permissions,name,NULL,idColumn COLLATE utf8_general_ci'
            ],
            'PATCH' => [
                'name' => 'required|min:4|unique:permissions,name,NULL,idColumn COLLATE utf8_general_ci'
            ],
        };
    }
    // Customizing messages
    public function messages()
    {
        return match ($this->method()) {
            'POST' => [
                'name.required' => 'É obrigatório definir o nome da permissão.',
                'name.min' => 'A permissão deve conter no mínimo 4 letras.',
                'name.unique' => 'Essa permissão já existe, crie uma nova.',
            ],
            'PATCH' => [
                'name.required' => 'É obrigatório definir o nome da permissão.',
                'name.min' => 'A permissão deve conter no mínimo 4 letras.',
                'name.unique' => 'Essa permissão já existe, crie uma nova.',
            ],
        };
    }
}
