@section('title') {{'Listar fighters'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @if ($count_fighter <= 0)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem Fighters no banco de dados.') }}
          @elseif ($count_fighter == 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_fighter Fighter no banco de dados.") }}
          @elseif ($count_fighter > 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_fighter Fighters no banco de dados.") }}
          @endif
        </h2>
          @if (Session::has('success-store'))
            <x-success-store class="mb-4" :status="session('success-store')" />
          @elseif (Session::has('success-update'))
            <x-success-update class="mb-4" :status="session('success-update')" />
          @elseif (Session::has('success-destroy'))
            <x-success-destroy class="mb-4" :status="session('success-destroy')" />
          @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <nav class="navbar navbar-default">
                    <div class="container-fluid">
                      <a href="{{ url("add-fighter") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                    </div>
                  </nav>
                  <br>
                    <form action="{{ url('search-fighter') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Filtrar por nome">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th title="ID"> ID </th>
                            <th title="Nome"> Nome </th>
                            <th title="Arte Marcial"> Arte marcial </th>
                            <th title="Nacionalidade"> Nacionalidade </th>
                            <th title="Gênero"> Gênero </th>
                            <th title="Sangue"> Sangue </th>
                            <th title="Idade"> Idade </th>
                            <th title="Altura"> Altura </th>
                            <th title="Peso"> Peso </th>
                            <th title="Passaporte"> Passaporte </th>
                            <th title="Vitória"> Vitórias </th>
                            <th title="Derrotas"> Derrotas </th>
                            <th title="Ações"> Ações </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($fighter as $sf)
                            <tr>
                              <td title="{{ $sf->id }}"> {{ $sf->id }} </td>
                              <td title="{{ $sf->nome }}"> {{ $sf->nome }} </td>
                              <td title="{{ $sf->arte_marcial }}"> {{ $sf->arte_marcial }} </td>
                              <td title="{{ $sf->nacionalidade }}"> {{ $sf->nacionalidade }} </td>
                              <td title="{{ $sf->genero }}"> {{ $sf->genero }} </td>
                              <td title="{{ $sf->tipo_sangue }}"> {{ $sf->tipo_sangue }} </td>
                              <td title="{{ $sf->idade }} "> {{ $sf->idade }} </td>
                              <td title="{{ $sf->altura }} m"> {{ $sf->altura }} m </td>
                              <td title="{{ $sf->peso }} kg"> {{ $sf->peso }} kg </td>
                              <td title="{{ Str::mask($sf->passaporte,'*',2,-2) }}"> {{ Str::mask($sf->passaporte,'*',2,-2) }}</td>
                              <td title="{{ $sf->quantidade_vitorias == '' ? '0' : $sf->quantidade_vitorias }} "> {{ $sf->quantidade_vitorias == '' ? '0' : $sf->quantidade_vitorias }} </td>
                              <td title="{{ $sf->quantidade_derrotas == '' ? '0' : $sf->quantidade_derrotas }} "> {{ $sf->quantidade_derrotas == '' ? '0' : $sf->quantidade_derrotas }} </td>
                              <td>
                                <form action="{{ url("delete-fighter/$sf->id") }}" method="POST">
                                  <a href="{{ url("update-fighter/$sf->id") }}" class="btn btn-primary" title="Atualizar {{ $sf->nome }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                  @csrf @method('DELETE')
                                  <x-primary-button class="ml-3" title="Deletar {{ $sf->nome }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{ $fighter->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
