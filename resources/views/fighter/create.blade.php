@section('title') {{'Cadastrar fighter'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar fighter') }}
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
                    <form action="{{ url('add-fighter') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="nome" :value="__('Nome:')" />
                            <x-text-input id="nome" class="block mt-1 w-full @error('nome') is-invalid @enderror" type="text" name="nome" :value="old('nome')" autofocus />
                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="arte_marcial" :value="__('Arte marcial:')" />
                            <x-text-input id="arte_marcial" class="block mt-1 w-full @error('arte_marcial') is-invalid @enderror" type="text" name="arte_marcial" :value="old('arte_marcial')" autofocus />
                            @error('arte_marcial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="nacionalidade" :value="__('Nacionalidade:')" />
                            <x-select id="nacionalidade" class="block w-full @error('nacionalidade') is-invalid @enderror" name="nacionalidade" autofocus>
                                <option {{ old('nacionalidade') == '' ? 'selected' : '' }} value="">{{ __('Escolha a nacionalidade') }}</option>
                                @foreach($nacionalidade as $n)
                                    <option {{ old('nacionalidade') == $n->descricao ? 'selected' : '' }} value="{{ $n->descricao }}">{{ $n->descricao }}</option>
                                @endforeach
                            </x-select>
                            @error('nacionalidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="genero" :value="__('Gênero:')" />
                            <x-select id="genero" class="block w-full @error('genero') is-invalid @enderror" name="genero" autofocus>
                                <option {{ old('genero') == '' ? 'selected' : '' }} value="">{{ __('Escolha o gênero') }}</option>
                                <option {{ old('genero') == 'Masculino' ? 'selected' : '' }} value="Masculino">Masculino</option>
                                <option {{ old('genero') == 'Feminino' ? 'selected' : '' }} value="Feminino">Feminino</option>
                            </x-select>
                            @error('genero')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="tipo_sangue" :value="__('Sangue:')" />
                            <x-select id="tipo_sangue" class="block w-full @error('tipo_sangue') is-invalid @enderror" name="tipo_sangue" autofocus>
                                <option {{ old('tipo_sangue') == '' ? 'selected' : '' }} value="">{{ __('Escolha o tipo sanguíneo') }}</option>
                                @foreach($tipo_sanguineo as $ts)
                                    <option {{ old('tipo_sangue') == $ts->descricao ? 'selected' : '' }} value="{{ $ts->descricao }}">{{ $ts->descricao }}</option>
                                @endforeach
                            </x-select>
                            @error('tipo_sangue')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="idade" :value="__('Idade:')" />
                            <x-text-input id="idade" class="block mt-1 w-full @error('idade') is-invalid @enderror" type="text" name="idade" :value="old('idade')" autofocus onkeypress="$(this).mask('00');"/>
                            @error('idade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="altura" :value="__('Altura:')" />
                            <x-text-input id="altura" class="block mt-1 w-full @error('altura') is-invalid @enderror" type="text" name="altura" :value="old('altura')" autofocus onkeypress="$(this).mask('0.00');"/>
                            @error('altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="peso" :value="__('Peso:')" />
                            <x-text-input id="peso" class="block mt-1 w-full @error('peso') is-invalid @enderror" type="text" name="peso" :value="old('peso')" autofocus onkeypress="$(this).mask('000.00', {reverse: true});"/>
                            @error('peso')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="passaporte" :value="__('Passaporte:')" />
                            <x-text-input id="passaporte" class="block mt-1 w-full @error('passaporte') is-invalid @enderror" type="text" name="passaporte" class="uppercase" :value="old('passaporte')" autofocus onkeypress="$(this).mask('SS000000')"/>
                            @error('passaporte')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="url_sf" :value="__('URL Street Fighter:')" />
                            <x-text-input id="url_sf" class="block mt-1 w-full @error('url_sf') is-invalid @enderror" type="url" name="url_sf" :value="old('url_sf')" autofocus placeholder="Formato permitidos: https://www.street-fighter.com/example ou https://street-fighter.com/example"/>
                            @error('url_sf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-plus"></i>&nbsp;{{ __('Cadastrar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
