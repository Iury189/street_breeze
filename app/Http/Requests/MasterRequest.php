<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MasterRequest extends FormRequest
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
            'nome' => 'required|max:30',
            'arte_marcial' => 'required|max:50',
            'nacionalidade' => ['required','max:30', Rule::in([
                'Alemanha','Argentina','Brasil','Canadá','China','Coréia do Sul','Egito',
                'Espanha','Estados Unidos da América','França','Grécia','Índia','Inglaterra',
                'Itália','Jamaica','Japão','México','Quênia','Rússia','Tailândia'])
            ],
            'genero' => ['required', Rule::in(['Masculino','Feminino'])],
            'idade' => 'required|integer|min:18|max:65',
            'altura' => 'required|numeric|min:1.50|max:2.50',
            'peso' => 'required|numeric|min:50.00|max:150.00',
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'nome.required' => 'É obrigatório definir o nome do Master.',
            'nome.max' => 'O nome do Master deve conter no máximo 30 caracteres.',
            'arte_marcial.required' => 'É obrigatório definir a arte marcial do Master.',
            'arte_marcial.max' => 'A arte marcial do Master deve conter no máximo 50 caracteres.',
            'nacionalidade.required' => 'É obrigatório definir a nacionalidade do Master.',
            'nacionalidade.max' => 'A nacionalidade do Master deve conter no máximo 30 caracteres.',
            'nacionalidade.in' => 'A nacionalidade precisa ser uma das opções existentes abaixo.',
            'genero.required' => 'É obrigatório definir o gênero do Master.',
            'genero.in' => 'O gênero do Master precisa ser Masculino ou Feminino.',
            'idade.required' => 'É obrigatório definir a idade do Master.',
            'idade.integer' => 'A idade do Master precisa ser um valor inteiro.',
            'idade.min' => 'A idade mínima do Master precisa ser de 18 anos.',
            'idade.max' => 'A idade máxima do Master precisa ser de 65 anos.',
            'altura.required' => 'É obrigatório definir a altura do Master.',
            'altura.numeric' => 'A altura do Master precisa ser um valor numérico.',
            'altura.min' => 'A altura mínima do Master deve ser de 1.50 m.',
            'altura.max' => 'A altura máxima do Master deve ser de 2.50 m.',
            'peso.required' => 'É obrigatório definir o peso do Master.',
            'peso.numeric' => 'O peso do Master precisa ser um valor numérico.',
            'peso.min' => 'O peso mínimo do Master deve ser de 50.00 kg.',
            'peso.max' => 'O peso máximo do Master deve ser de 150.00 kg.',
        ];
    }
}