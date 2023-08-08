<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm_password',
                'confirm_password' => 'required',
                'roles' => 'required|exists:roles,name',
            ],
            'PATCH' => [
                'roles' => 'required|exists:roles,name',
            ],
        };
    }

    // Customizing messages
    public function messages()
    {
        return match ($this->method()) {
            'POST' => [
                'name.required' => 'É obrigatório definir o nome do usuário.',
                'email.required' => 'É obrigatório o e-mail do usuário.',
                'email.email' => 'Insira um e-mail válido.',
                'email.unique' => 'Essa e-mail já existe, escolha um novo.',
                'password.required' => 'É obrigatório definir a senha do usuário.',
                'confirm_password.required' => 'É obrigatório definir a confirmação da senha do usuário.',
                'password.same' => 'O campo "Senha e confirmar senha" precisam ser idênticos.',
                'roles.required' => 'É obrigatório definir o papel do usuário.',
                'roles.exists' => 'Papel desconhecido, escolha uma das opções disponíveis.'
            ],
            'PATCH' => [
                'roles.required' => 'É obrigatório definir o papel do usuário.',
                'roles.exists' => 'Papel desconhecido, escolha uma das opções disponíveis.'
            ],
        };
    }
}
