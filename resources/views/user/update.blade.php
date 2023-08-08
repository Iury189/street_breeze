@section('title') {{"Atualizar "}} {{ Str::words(Auth::user()->name, 1, '') }} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{"Atualizar "}} {{ Str::words(Auth::user()->name, 1, '') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("user") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar</a>
                        </div>
                    </nav>
                    <br>
                    <form action="{{ url("update-user/$user->id") }}" method="POST">
                        @csrf @method('PATCH')
                        <div>
                            <x-input-label for="roles" :value="__('Papel:')" />
                            <x-select id="roles" class="block w-full @error('roles') is-invalid @enderror" name="roles[]" autofocus multiple>
                                @foreach($roles as $role)
                                    <option {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select>
                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-arrows-rotate"></i>&nbsp;{{ __('Atualizar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
