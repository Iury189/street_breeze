@section('title') {{"Atualizar $master->nome"}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atualizar ')}} {{ $master->nome }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("master") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </div>
                    </nav>
                    <br>
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ url("update-master/$master->id") }}" method="POST">
                        @csrf @method('PATCH')
                        <div>
                            <x-input-label for="nome" :value="__('Nome:')" />
                            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" value="{{ $master->nome }}" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="arte_marcial" :value="__('Arte marcial:')" />
                            <x-text-input id="arte_marcial" class="block mt-1 w-full" type="text" name="arte_marcial" value="{{ $master->arte_marcial }}" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="nacionalidade" :value="__('Nacionalidade:')" />
                            <x-select id="nacionalidade" class="block w-full" name="nacionalidade" autofocus>
                                <option {{ $master->nacionalidade == '' ? 'selected' : ''}} value="">{{ __('Escolha a nacionalidade') }}</option>
                                <option {{ $master->nacionalidade == 'Alemanha' ? 'selected' : '' }} value="Alemanha">Alemanha</option>
                                <option {{ $master->nacionalidade == 'Argentina' ? 'selected' : '' }} value="Argentina">Argentina</option>
                                <option {{ $master->nacionalidade == 'Austr??lia' ? 'selected' : '' }} value="Austr??lia">Austr??lia</option>
                                <option {{ $master->nacionalidade == 'Brasil' ? 'selected' : '' }} value="Brasil">Brasil</option>
                                <option {{ $master->nacionalidade == 'Canad??' ? 'selected' : '' }} value="Canad??">Canad??</option>
                                <option {{ $master->nacionalidade == 'China' ? 'selected' : '' }} value="China">China</option>
                                <option {{ $master->nacionalidade == 'Cor??ia do Sul' ? 'selected' : '' }} value="Cor??ia do Sul">Cor??ia do Sul</option>
                                <option {{ $master->nacionalidade == 'Dinamarca' ? 'selected' : '' }} value="Dinamarca">Dinamarca</option>
                                <option {{ $master->nacionalidade == 'Egito' ? 'selected' : '' }} value="Egito">Egito</option>
                                <option {{ $master->nacionalidade == 'Espanha' ? 'selected' : '' }} value="Espanha">Espanha</option>
                                <option {{ $master->nacionalidade == 'Esc??cia' ? 'selected' : '' }} value="Esc??cia">Esc??cia</option>
                                <option {{ $master->nacionalidade == 'EUA' ? 'selected' : '' }} value="EUA">EUA</option>
                                <option {{ $master->nacionalidade == 'Fran??a' ? 'selected' : '' }} value="Fran??a">Fran??a</option>
                                <option {{ $master->nacionalidade == 'Gr??cia' ? 'selected' : '' }} value="Gr??cia">Gr??cia</option>
                                <option {{ $master->nacionalidade == 'Hungria' ? 'selected' : '' }} value="Hungria">Hungria</option>
                                <option {{ $master->nacionalidade == '??ndia' ? 'selected' : '' }} value="??ndia">??ndia</option>
                                <option {{ $master->nacionalidade == 'Inglaterra' ? 'selected' : '' }} value="Inglaterra">Inglaterra</option>
                                <option {{ $master->nacionalidade == 'It??lia' ? 'selected' : '' }} value="It??lia">It??lia</option>
                                <option {{ $master->nacionalidade == 'Jamaica' ? 'selected' : '' }} value="Jamaica">Jamaica</option>
                                <option {{ $master->nacionalidade == 'Jap??o' ? 'selected' : '' }} value="Jap??o">Jap??o</option>
                                <option {{ $master->nacionalidade == 'M??xico' ? 'selected' : '' }} value="M??xico">M??xico</option>
                                <option {{ $master->nacionalidade == 'Qu??nia' ? 'selected' : '' }} value="Qu??nia">Qu??nia</option>
                                <option {{ $master->nacionalidade == 'R??ssia' ? 'selected' : '' }} value="R??ssia">R??ssia</option>
                                <option {{ $master->nacionalidade == 'Su????a' ? 'selected' : '' }} value="Su????a">Su????a</option>
                                <option {{ $master->nacionalidade == 'Su??cia' ? 'selected' : '' }} value="Su??cia">Su??cia</option>
                                <option {{ $master->nacionalidade == 'Tail??ndia' ? 'selected' : '' }} value="Tail??ndia">Tail??ndia</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="genero" :value="__('G??nero:')" />
                            <x-select id="genero" class="block w-full" name="genero" autofocus>
                                <option {{ $master->genero == '' ? 'selected' : ''}} value="">{{ __('Escolha o g??nero') }}</option>
                                <option {{ $master->genero == 'Masculino' ? 'selected' : ''}} value="Masculino">Masculino</option>
                                <option {{ $master->genero == 'Feminino' ? 'selected' : ''}} value="Feminino">Feminino</option>
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="idade" :value="__('Idade:')" />
                            <x-text-input id="idade" class="block mt-1 w-full" type="text" name="idade"  value="{{ $master->idade }}" autofocus onkeypress="$(this).mask('00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="altura" :value="__('Altura:')" />
                            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" value="{{ $master->altura }}" autofocus onkeypress="$(this).mask('0.00');"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="peso" :value="__('Peso:')" />
                            <x-text-input id="peso" class="block mt-1 w-full" type="text" name="peso" value="{{ $master->peso }}" autofocus onkeypress="$(this).mask('000.00', {reverse: true});"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="passaporte" :value="__('Passaporte:')" />
                            <x-text-input id="passaporte" class="block mt-1 w-full" type="text" name="passaporte" class="uppercase" value="{{ $master->passaporte }}" autofocus onkeypress="$(this).mask('SS000000')"/>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="url_sf" :value="__('URL Street Fighter:')" />
                            <x-text-input id="url_sf" class="block mt-1 w-full" type="url" name="url_sf" value="{{ $master->url_sf }}" autofocus placeholder="Formato permitidos: https://www.street-fighter.com/ ou https://street-fighter.com/"/>
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
