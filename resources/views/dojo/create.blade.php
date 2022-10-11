<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Dojô') }}
        </h2>
    </x-slot>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("dojo") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </div>
                    </nav>
                    <br>
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ url('add-dojo') }}" method="POST">
                        @csrf 
                        <div>
                            <x-input-label for="id_fighter" :value="__('Fighter:')" />
                            <x-select id="id_fighter" class="block w-full" name="id_fighter" autofocus>
                                <option {{ old('id_fighter') == '' ? 'selected' : '' }} value="">{{ __('Escolha o fighter') }}</option>
                                @foreach($fighter as $f)
                                    <option {{ old('id_fighter') == $f->id ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="id_master" :value="__('Master:')" />
                            <x-select id="id_master" class="block w-full" name="id_master" autofocus>
                                <option {{ old('id_master') == '' ? 'selected' : '' }} value="">{{ __('Escolha o master') }}</option>
                                @foreach($master as $m)
                                    <option {{ old('id_master') == $m->id ? 'selected' : '' }} value="{{ $m->id }}">{{ $m->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"> {{ __('Cadastrar') }} </x-primary-button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>