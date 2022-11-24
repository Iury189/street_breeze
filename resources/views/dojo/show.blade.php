@section('title') {{"Visualizar dojô Nº $dojo->id"}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Visualizar dojô Nº $dojo->id") }}
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
                    <form action="#" method="POST">
                        <div>
                            <x-input-label for="fighter_id" :value="__('Fighter:')" />
                            <x-select disabled id="fighter_id" class="block w-full" name="fighter_id" autofocus>
                                <option {{ $dojo->fighter_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o fighter') }}</option>
                                @foreach($fighter as $f)
                                    <option {{ $dojo->fighter_id == $f->id ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <br>
                        <div>
                            <x-input-label for="master_id" :value="__('Master:')" />
                            <x-select disabled id="master_id" class="block w-full" name="master_id" autofocus>
                                <option {{ $dojo->master_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o master') }}</option>
                                @foreach($master as $m)
                                    <option {{ $dojo->master_id == $m->id ? 'selected' : '' }} value="{{ $m->id }}">{{ $m->nome }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <br>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>