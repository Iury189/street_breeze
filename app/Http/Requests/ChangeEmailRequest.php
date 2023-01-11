<?php

namespace App\Http\Requests;

use App\Rules\MatchOldEmailRule;
use App\Rules\SameEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
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
            'current_email' => ['required','email',new MatchOldEmailRule,new SameEmailRule],
            'new_email' => ['required','email'],
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'current_email.required' => 'É obrigatório inserir o e-mail atual.',
            'current_email.email' => 'O e-mail atual deve conter um formato correto.',
            'new_email.required' => 'É obrigatório inserir o novo e-mail',
            'new_email.email' => 'O novo e-mail deve conter um formato adequado.'
        ];
    }
}
