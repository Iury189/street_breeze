@section('title') {{"Atualizar $fighter->nome"}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar ')}} {{ $fighter->nome }}
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
                                <option {{ $fighter->nacionalidade == 'Austr??lia' ? 'selected' : '' }} value="Austr??lia">Austr??lia</option>
                                <option {{ $fighter->nacionalidade == 'Brasil' ? 'selected' : '' }} value="Brasil">Brasil</option>
                                <option {{ $fighter->nacionalidade == 'Canad??' ? 'selected' : '' }} value="Canad??">Canad??</option>
                                <option {{ $fighter->nacionalidade == 'China' ? 'selected' : '' }} value="China">China</option>
                                <option {{ $fighter->nacionalidade == 'Cor??ia do Sul' ? 'selected' : '' }} value="Cor??ia do Sul">Cor??ia do Sul</option>
                                <option {{ $fighter->nacionalidade == 'Dinamarca' ? 'selected' : '' }} value="Dinamarca">Dinamarca</option>
                                <option {{ $fighter->nacionalidade == 'Egito' ? 'selected' : '' }} value="Egito">Egito</option>
                                <option {{ $fighter->nacionalidade == 'Esc??cia' ? 'selected' : '' }} value="Esc??cia">Esc??cia</option>
                                <option {{ $fighter->nacionalidade == 'Espanha' ? 'selected' : '' }} value="Espanha">Espanha</option>
                                <option {{ $fighter->nacionalidade == 'EUA' ? 'selected' : '' }} value="EUA">EUA</option>
                                <option {{ $fighter->nacionalidade == 'Fran??a' ? 'selected' : '' }} value="Fran??a">Fran??a</option>
                                <option {{ $fighter->nacionalidade == 'Gr??cia' ? 'selected' : '' }} value="Gr??cia">Gr??cia</option>
                                <option {{ $fighter->nacionalidade == 'Hungria' ? 'selected' : '' }} value="Hungria">Hungria</option>
                                <option {{ $fighter->nacionalidade == '??ndia' ? 'selected' : '' }} value="??ndia">??ndia</option>
                                <option {{ $fighter->nacionalidade == 'Inglaterra' ? 'selected' : '' }} value="Inglaterra">Inglaterra</option>
                                <option {{ $fighter->nacionalidade == 'It??lia' ? 'selected' : '' }} value="It??lia">It??lia</option>
                                <option {{ $fighter->nacionalidade == 'Jamaica' ? 'selected' : '' }} value="Jamaica">Jamaica</option>
                                <option {{ $fighter->nacionalidade == 'Jap??o' ? 'selected' : '' }} value="Jap??o">Jap??o</option>
                                <option {{ $fighter->nacionalidade == 'M??xico' ? 'selected' : '' }} value="M??xico">M??xico</option>
                                <option {{ $fighter->nacionalidade == 'Qu??nia' ? 'selected' : '' }} value="Qu??nia">Qu??nia</option>
                                <option {{ $fighter->nacionalidade == 'R??ssia' ? 'selected' : '' }} value="R??ssia">R??ssia</option>
                                <option {{ $fighter->nacionalidade == 'Su????a' ? 'selected' : '' }} value="Su????a">Su????a</option>
                                <option {{ $fighter->nacionalidade == 'Su??cia' ? 'selected' : '' }} value="Su??cia">Su??cia</option>
                                <option {{ $fighter->nacionalidade == 'Tail??ndia' ? 'selected' : '' }} value="Tail??ndia">Tail??ndia</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="genero" :value="__('G??nero:')" />
                            <x-select id="genero" class="block w-full" name="genero" autofocus>
                                <option {{ $fighter->genero == '' ? 'selected' : ''}} value="">{{ __('Escolha o g??nero') }}</option>
                                <option {{ $fighter->genero == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
                                <option {{ $fighter->genero == 'Feminino' ? 'selected' : ''}} value="Feminino">Feminino</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="idade" :value="__('Idade:')" />
                            <x-text-input id="idade" class="block mt-1 w-full" type="text" name="idade" value="{{ $fighter->idade }}" autofocus onkeypress="$(this).mask('00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="altura" :value="__('Altura:')" />
                            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" value="{{ $fighter->altura }}" autofocus onkeypress="$(this).mask('0.00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="peso" :value="__('Peso:')" />
                            <x-text-input id="peso" class="block mt-1 w-full" type="text" name="peso" value="{{ $fighter->peso }}" autofocus onkeypress="$(this).mask('000.00', {reverse: true});"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="passaporte" :value="__('Passaporte:')" />
                            <x-text-input id="passaporte" class="block mt-1 w-full" type="text" name="passaporte" class="uppercase" value="{{ $fighter->passaporte }}" autofocus onkeypress="$(this).mask('SS000000')"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="url_sf" :value="__('URL Street Fighter:')" />
                            <x-text-input id="url_sf" class="block mt-1 w-full" type="url" name="url_sf" value="{{ $fighter->url_sf }}" autofocus placeholder="Formato permitidos: https://www.street-fighter.com/ ou https://street-fighter.com/"/>
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-arrows-rotate"></i>&nbsp; {{ __('Atualizar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
