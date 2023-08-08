@section('title') {{'Listar papéis'}} @endsection

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($count_roles <= 0)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem papéis no banco de dados.') }}
        @elseif ($count_roles == 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_roles papel no banco de dados.") }}
        @elseif ($count_roles > 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_roles papéis no banco de dados.") }}
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
                        <a href="{{ url("add-role") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Adicionar papel</a>
                      @endrole
                      <a href="{{ url("trash-role") }}" class="btn btn-danger"><i class="fa fa-dumpster"></i>&nbsp;Lixeira</a>
                    </div>
                  </nav>
                <br>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th title="Nome"> Nome </th>
                          <th title="Permissões"> Permissões </th>
                          @role('Admin')
                            <th title="Ações"> Ações </th>
                          @endrole
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $r)
                          <tr>
                            <td title="{{ $r->name }}"> {{ $r->name }} </td>
                            <td>
                                @foreach($r->permissions->pluck('name') as $r2)
                                    <span class="badge rounded-pill bg-dark" title="{{ $r2 }}">{{ $r2 }}</span>
                                @endforeach
                            </td>
                            @role('Admin')
                                <td>
                                    <form action="{{ url("delete-role/$r->id") }}" method="POST">
                                        <a href="{{ url("update-role/$r->id") }}" class="btn btn-primary" title="Atualizar {{ $r->name }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                        @csrf @method('DELETE')
                                        <x-primary-button class="ml-3" title="Deletar {{ $r->name }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                                    </form>
                                </td>
                            @endrole
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  {{ $roles->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
