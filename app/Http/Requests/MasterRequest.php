<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Genero;

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
            'nacionalidade' => 'required|max:30',
            'genero' => ['required', new Enum(Genero::class)],
            'altura' => 'required|numeric|min:1.50|max:2.00',
            'peso' => 'required|numeric|min:60.00|max:150.00',
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
            'genero.required' => 'É obrigatório definir o gênero do Master.',
            'genero' => 'O gênero do Master precisa ser Masculino ou Feminino.',
            'altura.required' => 'É obrigatório definir a altura do Master.',
            'altura.numeric' => 'A altura do Master precisa ser um valor numérico.',
            'altura.min' => 'A altura mínima do Master deve ser de 1.50 m.',
            'altura.max' => 'A altura máxima do Master deve ser de 2.00 m',
            'peso.required' => 'É obrigatório definir o peso do Master.',
            'peso.numeric' => 'O peso do Master precisa ser um valor numérico.',
            'peso.min' => 'O peso mínimo do Master deve ser de 60.00 kg.',
            'peso.max' => 'O peso máximo do Master deve ser de 150.00 kg.',
        ];
    }
}