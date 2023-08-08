@section('title') {{"Delete "}} {{ Str::words(Auth::user()->name, 1, '') }} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Excluir ')}} {{ Str::words(Auth::user()->name, 1, '') }}
        </h2>
        @if (Session::has('success-update-password'))
            <x-success-store class="mb-4" :status="session('success-update-password')" />
        @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                          <a href="{{ url("dashboard") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar dashboard</a>
                        </div>
                    </nav>
                    <br>
                    <form action="{{ url("delete-user") }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="current_password" :value="__('Senha atual:')" />
                            <x-text-input id="current_password" class="block mt-1 w-full @error('current_password') is-invalid @enderror" type="password" name="current_password" autofocus />
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="confirm_current_password" :value="__('Confirmar senha atual:')" />
                            <x-text-input id="confirm_current_password" class="block mt-1 w-full @error('confirm_current_password') is-invalid @enderror" type="password" name="confirm_current_password" autofocus />
                            @error('confirm_current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-trash"></i>&nbsp;{{ __('Excluir') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
