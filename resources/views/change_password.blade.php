@section('title') {{'Change password'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alterar senha de ')}} {{ Str::words(Auth::user()->name, 1, '') }}
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
                    <form action="{{ url("update-password") }}" method="POST">
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
                            <x-input-label for="new_password" :value="__('Nova senha:')" />
                            <x-text-input id="new_password" class="block mt-1 w-full @error('new_password') is-invalid @enderror" type="password" name="new_password" autofocus />
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="confirm_new_password" :value="__('Confirmar nova senha:')" />
                            <x-text-input id="confirm_new_password" class="block mt-1 w-full @error('confirm_new_password') is-invalid @enderror" type="password" name="confirm_new_password" autofocus />
                            @error('confirm_new_password')
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
