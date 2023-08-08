<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPasswordRule;
use App\Rules\NoSpacesPasswordRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => ['required', Password::defaults(), new NoSpacesPasswordRule],
            'confirm_new_password' => 'required|same:new_password',
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'current_password.required' => 'É obrigatório inserir sua senha atual.',
            'new_password.required' => 'É obrigatório inserir sua nova senha.',
            'new_password.min' => 'A nova senha deve conter no mínimo 8 caracteres.',
            'confirm_new_password.required' => 'É obrigatório inserir a confirmação de sua nova senha.',
            'confirm_new_password.same' => 'Os campos de "Nova senha" e "Confirmar nova senha" devem ser iguais.',
        ];
    }
}
