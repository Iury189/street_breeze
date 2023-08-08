@section('title') {{'Cadastrar dojô'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar dojô') }}
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
                    <form action="{{ url('add-dojo') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="fighter_id" :value="__('Fighter:')" />
                            <x-select id="fighter_id" class="block mt-1 w-full @error('fighter_id') is-invalid @enderror" name="fighter_id" autofocus>
                                @if ($fighter->isEmpty())
                                    <option>{{ __('Sem registros de Fighters') }}</option>
                                @else
                                    <option {{ old('fighter_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha o fighter') }}</option>
                                        @foreach($fighter as $f)
                                            <option {{ old('fighter_id') == $f->id ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->nome }}</option>
                                        @endforeach
                                @endif
                            </x-select>
                            @error('fighter_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="master_id" :value="__('Master:')" />
                            <x-select id="master_id" class="block mt-1 w-full @error('master_id') is-invalid @enderror" name="master_id" autofocus>
                                @if ($master->isEmpty())
                                    <option>{{ __('Sem registros de Masters') }}</option>
                                @else
                                    <option {{ old('master_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha o master') }}</option>
                                        @foreach($master as $m)
                                            <option {{ old('master_id') == $m->id ? 'selected' : '' }} value="{{ $m->id }}">{{ $m->nome }}</option>
                                        @endforeach
                                @endif
                            </x-select>
                            @error('master_id')
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
