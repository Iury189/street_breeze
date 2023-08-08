<?php

namespace App\Http\Requests;

use App\Rules\MatchOldEmailRule;
use App\Rules\MatchOldPasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangeEmailRequest extends FormRequest
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
            'current_email' => ['required', 'email', 'max:255', new MatchOldEmailRule],
            'new_email' => ['required', 'email', 'max:255'],
            'current_password' => ['required', new MatchOldPasswordRule],
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'current_email.required' => 'É obrigatório inserir o e-mail atual.',
            'current_email.email' => 'O e-mail atual deve conter um formato correto.',
            'current_email.max' => 'O e-mail atual do usuário deve conter no máximo 255 caracteres.',
            'new_email.required' => 'É obrigatório inserir o novo e-mail',
            'new_email.email' => 'O novo e-mail deve conter um formato adequado.',
            'new_email.max' => 'O novo e-mail do usuário deve conter no máximo 255 caracteres.',
            'current_password.required' => 'É obrigatório inserir sua senha atual para validar a ação.',
        ];
    }
}
