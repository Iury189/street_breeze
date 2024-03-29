@section('title') {{'Cadastrar Fighter'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Fighter') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("fighter") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </div>
                    </nav>
                    <br>
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ url('add-fighter') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="nome" :value="__('Nome:')" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="arte_marcial" :value="__('Arte marcial:')" />
                            <x-text-input id="arte_marcial" class="block mt-1 w-full" type="text" name="arte_marcial" :value="old('arte_marcial')" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="nacionalidade" :value="__('Nacionalidade:')" />
                            <x-select id="nacionalidade" class="block w-full" name="nacionalidade" autofocus>
                                <option {{ old('nacionalidade') == '' ? 'selected' : '' }} value="">{{ __('Escolha a nacionalidade') }}</option>
                                <option {{ old('nacionalidade') == 'Alemanha' ? 'selected' : '' }} value="Alemanha">Alemanha</option>
                                <option {{ old('nacionalidade') == 'Argentina' ? 'selected' : '' }} value="Argentina">Argentina</option>
                                <option {{ old('nacionalidade') == 'Austrália' ? 'selected' : '' }} value="Austrália">Austrália</option>
                                <option {{ old('nacionalidade') == 'Brasil' ? 'selected' : '' }} value="Brasil">Brasil</option>
                                <option {{ old('nacionalidade') == 'Canadá' ? 'selected' : '' }} value="Canadá">Canadá</option>
                                <option {{ old('nacionalidade') == 'China' ? 'selected' : '' }} value="China">China</option>
                                <option {{ old('nacionalidade') == 'Coréia do Sul' ? 'selected' : '' }} value="Coréia do Sul">Coréia do Sul</option>
                                <option {{ old('nacionalidade') == 'Dinamarca' ? 'selected' : '' }} value="Dinamarca">Dinamarca</option>
                                <option {{ old('nacionalidade') == 'Egito' ? 'selected' : '' }} value="Egito">Egito</option>
                                <option {{ old('nacionalidade') == 'Escócia' ? 'selected' : '' }} value="Escócia">Escócia</option>
                                <option {{ old('nacionalidade') == 'Espanha' ? 'selected' : '' }} value="Espanha">Espanha</option>
                                <option {{ old('nacionalidade') == 'EUA' ? 'selected' : '' }} value="EUA">EUA</option>
                                <option {{ old('nacionalidade') == 'França' ? 'selected' : '' }} value="França">França</option>
                                <option {{ old('nacionalidade') == 'Grécia' ? 'selected' : '' }} value="Grécia">Grécia</option>
                                <option {{ old('nacionalidade') == 'Hungria' ? 'selected' : '' }} value="Hungria">Hungria</option>
                                <option {{ old('nacionalidade') == 'Índia' ? 'selected' : '' }} value="Índia">Índia</option>
                                <option {{ old('nacionalidade') == 'Inglaterra' ? 'selected' : '' }} value="Inglaterra">Inglaterra</option>
                                <option {{ old('nacionalidade') == 'Itália' ? 'selected' : '' }} value="Itália">Itália</option>
                                <option {{ old('nacionalidade') == 'Jamaica' ? 'selected' : '' }} value="Jamaica">Jamaica</option>
                                <option {{ old('nacionalidade') == 'Japão' ? 'selected' : '' }} value="Japão">Japão</option>
                                <option {{ old('nacionalidade') == 'México' ? 'selected' : '' }} value="México">México</option>
                                <option {{ old('nacionalidade') == 'Quênia' ? 'selected' : '' }} value="Quênia">Quênia</option>
                                <option {{ old('nacionalidade') == 'Rússia' ? 'selected' : '' }} value="Rússia">Rússia</option>
                                <option {{ old('nacionalidade') == 'Suíça' ? 'selected' : '' }} value="Suíça">Suíça</option>
                                <option {{ old('nacionalidade') == 'Suécia' ? 'selected' : '' }} value="Suécia">Suécia</option>
                                <option {{ old('nacionalidade') == 'Tailândia' ? 'selected' : '' }} value="Tailândia">Tailândia</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="genero" :value="__('Gênero:')" />
                            <x-select id="genero" class="block w-full" name="genero" autofocus>
                                <option {{ old('genero') == '' ? 'selected' : '' }} value="">{{ __('Escolha o gênero') }}</option>
                                <option {{ old('genero') == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                <option {{ old('genero') == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="idade" :value="__('Idade:')" />
                            <x-text-input id="idade" class="block mt-1 w-full" type="text" name="idade" :value="old('idade')" autofocus onkeypress="$(this).mask('00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="altura" :value="__('Altura:')" />
                            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" :value="old('altura')" autofocus onkeypress="$(this).mask('0.00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="peso" :value="__('Peso:')" />
                            <x-text-input id="peso" class="block mt-1 w-full" type="text" name="peso" :value="old('peso')" autofocus onkeypress="$(this).mask('000.00', {reverse: true});"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="passaporte" :value="__('Passaporte:')" />
                            <x-text-input id="passaporte" class="block mt-1 w-full" type="text" name="passaporte" class="uppercase" :value="old('passaporte')" autofocus onkeypress="$(this).mask('SS000000')"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="url_sf" :value="__('URL Street Fighter:')" />
                            <x-text-input id="url_sf" class="block mt-1 w-full" type="url" name="url_sf" :value="old('url_sf')" autofocus placeholder="Formato permitidos: https://www.street-fighter.com/ ou https://street-fighter.com/"/>
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-plus"></i>&nbsp; {{ __('Cadastrar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
