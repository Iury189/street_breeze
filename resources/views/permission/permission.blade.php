@section('title') {{'Listar permissões'}} @endsection

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($count_permissions <= 0)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem permissões no banco de dados.') }}
        @elseif ($count_permissions == 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_permissions permissão no banco de dados.") }}
        @elseif ($count_permissions > 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_permissions permissões no banco de dados.") }}
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
                      @role('Admin')
                        <a href="{{ url("add-permission") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Adicionar permissão</a>
                      @endrole
                      <a href="{{ url("trash-permission") }}" class="btn btn-danger"><i class="fa fa-dumpster"></i>&nbsp;Lixeira</a>
                    </div>
                </nav>
                <br>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th title="Nome"> Nome </th>
                          @role('Admin')
                            <th title="Ações"> Ações </th>
                          @endrole
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($permissions as $p)
                          <tr>
                            <td title="{{ $p->name }}"> {{ $p->name }} </td>
                            @role('Admin')
                                <td>
                                    <form action="{{ url("delete-permission/$p->id") }}" method="POST">
                                        <a href="{{ url("update-permission/$p->id") }}" class="btn btn-primary" title="Atualizar {{ $p->name }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                        @csrf @method('DELETE')
                                        <x-primary-button class="ml-3" title="Deletar {{ $p->name }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                                    </form>
                                </td>
                            @endrole
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  {{ $permissions->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
