<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @if ($count_fighters <= 0)
            {{ __('Não existem Fighters no BD.') }}
          @elseif ($count_fighters == 1)
            {{ __("Existe apenas $count_fighters Fighter no BD.") }}
          @elseif ($count_fighters > 1)
            {{ __("Existem $count_fighters Fighters no BD.") }}
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
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th title="ID">ID</th>
                            <th title="Nome">Nome</th>
                            <th title="Arte Marcial">Arte Marcial</th>
                            <th title="Nacionalidade">Nacionalidade</th>
                            <th title="Gênero">Gênero</th>
                            <th title="Altura">Altura</th>
                            <th title="Peso">Peso</th>
                            <th title="Ação(ões)">Ação(ões)</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($fighter as $sf)
                            <tr>
                              <td title="{{ $sf->id }}"> {{ $sf->id }} </td>
                              <td title="{{ $sf->nome }}"> {{ $sf->nome}} </td>  
                              <td title="{{ $sf->arte_marcial }}"> {{ $sf->arte_marcial }} </td>  
                              <td title="{{ $sf->nacionalidade }}"> {{ $sf->nacionalidade }} </td>  
                              <td title="{{ $sf->genero->value }}"> {{ $sf->genero->value }} </td>
                              <td title="{{ $sf->altura }} m"> {{ $sf->altura }} m</td>  
                              <td title="{{ $sf->peso }} kg"> {{ $sf->peso }} kg</td>
                              <td>
                                    <form action="{{ url("delete-fighter/$sf->id") }}" method="POST">
                                      <a href="{{ url("update-fighter/$sf->id") }}" class="btn btn-primary" title="Atualizar {{ $sf->nome }}"><i class="fa fa-edit"></i>&nbsp;Atualizar</a>
                                      @csrf @method('DELETE')
                                      <x-primary-button class="ml-3" title="Deletar {{ $sf->nome }}"> {{ __('Deletar') }} </x-primary-button>  
                                    </form>
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