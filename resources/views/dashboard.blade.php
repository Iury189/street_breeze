@section('title') {{'Dashboard'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role == 0)
                {{ __('Hello, ')}} {{ Str::words(Auth::user()->name, 1, '') }} (User).
            @else
                {{ __('Hello, ')}} {{ Str::words(Auth::user()->name, 1, '') }} (Administrador).
            @endif
        </h2>
    </x-slot>
    <div class="py-12">   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Pequena aplicação utilizando Laravel Breeze.')}}    
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>