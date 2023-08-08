@section('title') {{"Criar papel"}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Criar papel
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("role") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar</a>
                        </div>
                    </nav>
                    <br>
                    <form action="{{ url("add-role") }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Papel:')" />
                            <x-text-input id="name" class="block mt-1 w-full @error('name') is-invalid @enderror" :value="old('name')" type="text" name="name" autofocus />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="name" :value="__('Permissões:')" />
                            <x-select id="permissions" class="block w-full @error('permissions') is-invalid @enderror" name="permissions[]" autofocus multiple>
                                @foreach($permissions as $p)
                                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                                @endforeach
                            </x-select>
                            @error('permissions')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-plus"></i>&nbsp;{{ __('Cadastrar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
