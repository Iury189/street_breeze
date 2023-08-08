@section('title') {{'Change e-mail'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alterar e-mail de ')}} {{ Str::words(Auth::user()->name, 1, '') }}
        </h2>
    </h2>
        @if (Session::has('success-update-email'))
            <x-success-store class="mb-4" :status="session('success-update-email')" />
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
                    <form action="{{ url("update-email") }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="current_email" :value="__('E-mail atual:')" />
                            <x-text-input id="current_email" class="block mt-1 w-full @error('current_email') is-invalid @enderror" type="email" name="current_email" autofocus value="{{ Auth::user()->email}}"/>
                            @error('current_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <x-input-label for="new_email" :value="__('Novo e-mail:')" />
                            <x-text-input id="new_email" class="block mt-1 w-full @error('new_email') is-invalid @enderror" type="email" name="new_email" autofocus />
                            @error('new_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br>
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
                            <x-primary-button class="ml-3"><i class="fa fa-arrows-rotate"></i>&nbsp;{{ __('Atualizar') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
