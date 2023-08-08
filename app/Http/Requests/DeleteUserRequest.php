<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteUserRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPasswordRule],
            'confirm_current_password' => ['required', 'same:current_password'],
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'current_password.required' => 'É obrigatório inserir sua senha atual para confirmar sua exclusão do sistema.',
            'confirm_current_password.required' => 'É obrigatório inserir a confirmação da senha atual para confirmar sua exclusão do sistema.',
            'confirm_current_password.same' => 'Os campos de "Senha atual" e "Confirmar senha atual" devem ser iguais.',
        ];
    }
}
