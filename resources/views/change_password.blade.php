@section('title') {{'Change Password'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role == 0)
                {{ __('Alterar senha de ')}} {{ Str::words(Auth::user()->name, 1, '') }} (User).
            @else
                {{ __('Alterar senha de ')}} {{ Str::words(Auth::user()->name, 1, '') }} (Administrador).
            @endif
        </h2>
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
                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                    <form action="#" method="POST">
                        @csrf 
                        <div>
                            <x-input-label for="old_password" :value="__('Senha antiga:')" />
                            <x-text-input id="old_password" class="block mt-1 w-full" type="password" name="old_password" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="new_password" :value="__('Nova senha:')" />
                            <x-text-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-input-label for="confirm_new_password" :value="__('Confirmar nova senha:')" />
                            <x-text-input id="confirm_new_password" class="block mt-1 w-full" type="text" name="confirm_new_password" autofocus />
                        </div>
                        <br>
                        <div>
                            <x-primary-button class="ml-3"><i class="fa fa-plus"></i>&nbsp; {{ __('Cadastrar') }} </x-primary-button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>