@section('title') {{'Cadastrar luta'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar luta') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("fight") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </div>
                    </nav>
                    <br>
                    <form action="{{ url('add-fight') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="fighter1_id" :value="__('Fighter Nº 1:')" />
                            <x-select id="fighter1_id" class="block mt-1 w-full @error('fighter1_id') is-invalid @enderror" name="fighter1_id" autofocus>
                                @if ($fighter->isEmpty())
                                    <option>{{ __('Sem registros de Fighters') }}</option>
                                @else
                                    <option {{ old('fighter1_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha o Fighter') }}</option>
                                    @foreach($fighter as $f)
                                        <option {{ old('fighter1_id') == $f->id ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->nome }}</option>
                                    @endforeach
                                @endif
                            </x-select>
                            @error('fighter1_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="fighter2_id" :value="__('Fighter Nº 2:')" />
                            <x-select id="fighter2_id" class="block mt-1 w-full @error('fighter2_id') is-invalid @enderror" name="fighter2_id" autofocus>
                                @if ($fighter->isEmpty())
                                    <option>{{ __('Sem registros de Masters') }}</option>
                                @else
                                    <option {{ old('fighter2_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha o Fighter') }}</option>
                                    @foreach($fighter as $f)
                                        <option {{ old('fighter2_id') == $f->id ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->nome }}</option>
                                    @endforeach
                                @endif
                            </x-select>
                            @error('fighter2_id')
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let fighter1Select = document.getElementById('fighter1_id');
                            let fighter2Select = document.getElementById('fighter2_id');

                            fighter1Select.addEventListener('change', function() {
                                let selectedOption = fighter1Select.options[fighter1Select.selectedIndex];
                                let fighter2Options = fighter2Select.options;

                                for (let i = 0; i < fighter2Options.length; i++) {
                                    if (fighter2Options[i].value === selectedOption.value) {
                                        fighter2Options[i].style.display = 'none';
                                    } else {
                                        fighter2Options[i].style.display = 'block';
                                    }
                                }
                            });

                            fighter2Select.addEventListener('change', function() {
                                let selectedOption = fighter2Select.options[fighter2Select.selectedIndex];
                                let fighter1Options = fighter1Select.options;

                                for (let i = 0; i < fighter1Options.length; i++) {
                                    if (fighter1Options[i].value === selectedOption.value) {
                                        fighter1Options[i].style.display = 'none';
                                    } else {
                                        fighter1Options[i].style.display = 'block';
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
