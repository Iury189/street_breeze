<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @if ($count_classe <= 0)
            {{ __('Não existem Classes no banco de dados.') }}
          @elseif ($count_classe == 1)
            {{ __("Existe apenas $count_classe classe no banco de dados.") }}
          @elseif ($count_classe > 1)
            {{ __("Existem $count_classe classes no banco de dados.") }}
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
                      <a href="{{ url("add-classe") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                    </div>
                  </nav>
                  <br>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th title="ID">ID</th>
                            <th title="Fighter">Fighter</th>
                            <th title="Master">Master</th>
                            <th title="Ação(ões)">Ação(ões)</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($classe as $cl)
                            <tr>
                              <td title="{{ $cl->id }}"> {{ $cl->id }} </td>
                              <td title="{{ $cl->id_fighter == $cl->fighter->id ? $cl->fighter->nome : '' }}"> {{ $cl->id_fighter == $cl->fighter->id ? $cl->fighter->nome : '' }} </td>
                              <td title="{{ $cl->id_master == $cl->master->id ? $cl->master->nome : '' }}"> {{ $cl->id_master == $cl->master->id ? $cl->master->nome : '' }} </td>
                              <td>
                                <form action="{{ url("delete-classe/$cl->id") }}" method="POST">
                                  <a href="{{ url("update-classe/$cl->id") }}" class="btn btn-primary" title="Atualizar {{ $cl->id }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                  @csrf @method('DELETE')
                                  <x-primary-button class="ml-3" title="Deletar {{ $cl->id }}"> {{ __('Deletar') }} </x-primary-button>  
                                </form>
                              </td>  
                            </tr>   
                          @endforeach
                        </tbody>
                      </table>
                    {{ $classe->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>