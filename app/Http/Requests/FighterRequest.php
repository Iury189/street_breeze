<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PassportNumberRule;
use App\Rules\StreetFighterURLRule;

class FighterRequest extends FormRequest
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
            'nome' => 'required|max:30',
            'arte_marcial' => 'required|max:50',
            'nacionalidade' => ['required','max:30','exists:nacionalidades,descricao'],
            'genero' => ['required', Rule::in(['Masculino','Feminino'])],
            'tipo_sangue' => ['required','max:3','exists:tipos_sanguineos,descricao'],
            'idade' => 'required|integer|min:18|max:65',
            'altura' => 'required|numeric|min:1.50|max:2.50',
            'peso' => 'required|numeric|min:50.00|max:150.00',
            'passaporte' => ['required','size:8',
            Rule::unique('fighters','passaporte')->ignore($this->id),
            Rule::unique('masters','passaporte')->ignore($this->id),
            new PassportNumberRule],
            'url_sf' => [new StreetFighterURLRule,
            Rule::unique('fighters','url_sf')->ignore($this->id),
            Rule::unique('masters','url_sf')->ignore($this->id)],
        ];
    }
    // Customizing messages
    public function messages()
    {
        return [
            'nome.required' => 'É obrigatório definir o nome do Fighter.',
            'nome.max' => 'O nome do Fighter deve conter no máximo 30 caracteres.',
            'arte_marcial.required' => 'É obrigatório definir a arte marcial do Fighter.',
            'arte_marcial.max' => 'A arte marcial do Fighter deve conter no máximo 50 caracteres.',
            'nacionalidade.required' => 'É obrigatório definir a nacionalidade do Fighter.',
            'nacionalidade.max' => 'A nacionalidade do Fighter deve conter no máximo 30 caracteres.',
            'nacionalidade.exists' => 'A nacionalidade do Fighter precisa ser uma das opções disponíveis.',
            'genero.required' => 'É obrigatório definir o gênero do Fighter.',
            'genero.in' => 'O gênero do Fighter precisa ser Masculino ou Feminino.',
            'tipo_sangue.required' => 'É obrigatório definir o tipo sanguíneo do Fighter.',
            'tipo_sangue.max' => 'O tipo sanguíneo do Fighter deve conter no máximo 3 caracteres.',
            'tipo_sangue.exists' => 'Tipo sanguíneo desconhecido, escolha uma das opções disponíveis.',
            'idade.required' => 'É obrigatório definir a idade do Fighter.',
            'idade.integer' => 'A idade do Fighter precisa ser um valor inteiro.',
            'idade.min' => 'A idade mínima do Fighter precisa ser de 18 anos.',
            'idade.max' => 'A idade máxima do Fighter precisa ser de 65 anos.',
            'altura.required' => 'É obrigatório definir a altura do Fighter.',
            'altura.numeric' => 'A altura do Fighter precisa ser um valor numérico.',
            'altura.min' => 'A altura mínima do Fighter deve ser de 1.50 m.',
            'altura.max' => 'A altura máxima do Fighter deve ser de 2.50 m.',
            'peso.required' => 'É obrigatório definir o peso do Fighter.',
            'peso.numeric' => 'O peso do Fighter precisa ser um valor numérico.',
            'peso.min' => 'O peso mínimo do Fighter deve ser de 50.00 kg.',
            'peso.max' => 'O peso máximo do Fighter deve ser de 150.00 kg.',
            'passaporte.required' => 'É obrigatório definir o passaporte do Fighter.',
            'passaporte.size' => 'O número de passaporte do Fighter deve conter 8 caracteres.',
            'passaporte.unique' => 'Esse número de passaporte já está registrado, não é aceito valores repetidos de passaporte.',
            'url_sf.unique' => 'URL já existente, não é aceito repetições.'
        ];
    }
}
