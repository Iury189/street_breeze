<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'current_password.required' => 'É obrigatório inserir sua senha atual.',
            'new_password.required' => 'É obrigatório inserir sua nova senha.',
            'confirm_new_password.required' => 'É obrigatório inserir a confirmação sua nova senha.',
            'confirm_new_password.same' => 'Os campos de "Nova senha" e "Confirmar nova senha" devem ser iguais.',
        ];
    }

}
