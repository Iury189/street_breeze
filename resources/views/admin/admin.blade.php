@section('title') {{'Listar usuários'}} @endsection

<x-app-layout>
  <x-slot name="header"> </x-slot>
  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <nav class="navbar navbar-default">
                </nav>
                <br>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th title="ID"> ID </th>
                          <th title="Nome"> Nome </th>
                          <th title="Nível de acesso"> Nível de acesso </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($user as $u)
                          <tr>
                            <td title="{{ $u->id }}"> {{ $u->id }} </td>
                            <td title="{{ $u->name }}"> {{ $u->name }} </td>
                            <td title="{{ $u->role == 0 ? "User" : "Administrator" }}"> {{ $u->role == 0 ? "User" : "Administrator" }} </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  {{ $user->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
