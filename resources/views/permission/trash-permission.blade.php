@section('title') {{'Lixeira de permissões'}} @endsection

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Lixeira de permissões
    </h2>
  </x-slot>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <a href="{{ url("permission") }}" class="btn btn-secondary float-end"><i class="fa fa-arrow-left"></i>&nbsp;Retornar</a>
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
                                    <form action="{{ url("delete-permission-trash/$p->id") }}" method="POST">
                                        <a href="{{ url("restore-permission-trash/$p->id") }}" class="btn btn-primary" title="Restaurar {{ $p->name }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
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
