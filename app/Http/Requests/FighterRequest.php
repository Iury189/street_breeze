<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FighterRequest extends FormRequest
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
            'genero' => ['required', Rule::in(['Masculino', 'Feminino'])],
            'altura' => 'required|numeric|min:1.50|max:2.50',
            'peso' => 'required|numeric|min:50.00|max:150.00',
        ];
    }
    // Mensagens personalizadas
    public function messages()
    {
        return [
            'nome.required' => 'É obrigatório definir o nome do Fighter.',
            'nome.max' => 'O nome do Fighter deve conter no máximo 30 caracteres.',
            'arte_marcial.required' => 'É obrigatório definir a arte marcial do Fighter.',
            'arte_marcial.max' => 'A arte marcial do Fighter deve conter no máximo 50 caracteres.',
            'nacionalidade.required' => 'É obrigatório definir a nacionalidade do Fighter.',
            'nacionalidade.max' => 'A nacionalidade do Fighter deve conter no máximo 30 caracteres.',
            'nacionalidade.in' => 'A nacionalidade precisa ser uma das opções existentes abaixo.',
            'genero.required' => 'É obrigatório definir o gênero do Fighter.',
            'genero.in' => 'O gênero do Fighter precisa ser Masculino ou Feminino.',
            'altura.required' => 'É obrigatório definir a altura do Fighter.',
            'altura.numeric' => 'A altura do Fighter precisa ser um valor numérico.',
            'altura.min' => 'A altura mínima do Fighter deve ser de 1.50 m.',
            'altura.max' => 'A altura máxima do Fighter deve ser de 2.50 m.',
            'peso.required' => 'É obrigatório definir o peso do Fighter.',
            'peso.numeric' => 'O peso do Fighter precisa ser um valor numérico.',
            'peso.min' => 'O peso mínimo do Fighter deve ser de 50.00 kg.',
            'peso.max' => 'O peso máximo do Fighter deve ser de 150.00 kg.',
        ];
    }
}