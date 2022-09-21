<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar Fighter') }}
        </h2>
    </x-slot>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("index") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </div>
                    </nav>
                    <br>
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ url("update-fighter/$fighter->id") }}" method="POST">
                        @csrf @method('PATCH')
                        <div>
                            <x-input-label for="nome" :value="__('Nome:')" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" value="{{ $fighter->nome }}" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="arte_marcial" :value="__('Arte marcial:')" />
                            <x-text-input id="arte_marcial" class="block mt-1 w-full" type="text" name="arte_marcial" value="{{ $fighter->arte_marcial }}" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="nacionalidade" :value="__('Nacionalidade:')" />
                            <x-select id="nacionalidade" class="block w-full" name="nacionalidade" autofocus>
                                <option {{ $fighter->nacionalidade == '' ? 'selected' : ''}} value="">{{ __('Escolha a nacionalidade') }}</option>
                                <option {{ $fighter->nacionalidade == 'Alemanha' ? 'selected' : '' }} value="Alemanha">Alemanha</option>
                                <option {{ $fighter->nacionalidade == 'Argentina' ? 'selected' : '' }} value="Argentina">Argentina</option>
                                <option {{ $fighter->nacionalidade == 'Brasil' ? 'selected' : '' }} value="Brasil">Brasil</option>
                                <option {{ $fighter->nacionalidade == 'Canadá' ? 'selected' : '' }} value="Canadá">Canadá</option>
                                <option {{ $fighter->nacionalidade == 'China' ? 'selected' : '' }} value="China">China</option>
                                <option {{ $fighter->nacionalidade == 'Coréia do Sul' ? 'selected' : '' }} value="Coréia do Sul">Coréia do Sul</option>
                                <option {{ $fighter->nacionalidade == 'Egito' ? 'selected' : '' }} value="Egito">Egito</option>
                                <option {{ $fighter->nacionalidade == 'Espanha' ? 'selected' : '' }} value="Espanha">Espanha</option>
                                <option {{ $fighter->nacionalidade == 'Estados Unidos' ? 'selected' : '' }} value="Estados Unidos">Estados Unidos</option>
                                <option {{ $fighter->nacionalidade == 'França' ? 'selected' : '' }} value="França">França</option>
                                <option {{ $fighter->nacionalidade == 'Índia' ? 'selected' : '' }} value="Índia">Índia</option>
                                <option {{ $fighter->nacionalidade == 'Inglaterra' ? 'selected' : '' }} value="Inglaterra">Inglaterra</option>
                                <option {{ $fighter->nacionalidade == 'Itália' ? 'selected' : '' }} value="Itália">Itália</option>
                                <option {{ $fighter->nacionalidade == 'Jamaica' ? 'selected' : '' }} value="Jamaica">Jamaica</option>
                                <option {{ $fighter->nacionalidade == 'Japão' ? 'selected' : '' }} value="Japão">Japão</option>
                                <option {{ $fighter->nacionalidade == 'México' ? 'selected' : '' }} value="México">México</option>
                                <option {{ $fighter->nacionalidade == 'Quênia' ? 'selected' : '' }} value="Quênia">Quênia</option>
                                <option {{ $fighter->nacionalidade == 'Rússia' ? 'selected' : '' }} value="Rússia">Rússia</option>
                                <option {{ $fighter->nacionalidade == 'Tailândia' ? 'selected' : '' }} value="Tailândia">Tailândia</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="genero" :value="__('Gênero:')" />
                            <x-select id="genero" class="block w-full" name="genero" autofocus>
                                <option {{ $fighter->genero->value == '' ? 'selected' : ''}} value="">{{ __('Escolha o gênero') }}</option>
                                <option {{ $fighter->genero->value == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
                                <option {{ $fighter->genero->value == 'Feminino' ? 'selected' : ''}} value="Feminino">Feminino</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="altura" :value="__('Altura:')" />
                            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" value="{{ $fighter->altura }}" autofocus onkeypress="$(this).mask('0.00', {reverse: true});"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="peso" :value="__('Peso:')" />
                            <x-text-input id="peso" class="block mt-1 w-full" type="text" name="peso" value="{{ $fighter->peso }}" autofocus onkeypress="$(this).mask('000.00', {reverse: true});"/>
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"> {{ __('Atualizar') }} </x-primary-button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>