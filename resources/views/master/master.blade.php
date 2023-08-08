@section('title') {{'Listar masters'}} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          @if ($count_master <= 0)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem Masters no banco de dados.') }}
          @elseif ($count_master == 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_master Master no banco de dados.") }}
          @elseif ($count_master > 1)
            {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_master Masters no banco de dados.") }}
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
                      <a href="{{ url("add-master") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                    </div>
                  </nav>
                  <br>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th title="ID"> ID </th>
                            <th title="Nome"> Nome </th>
                            <th title="Arte Marcial"> Arte Marcial </th>
                            <th title="Nacionalidade"> Nacionalidade </th>
                            <th title="Gênero"> Gênero </th>
                            <th title="Sangue"> Sangue </th>
                            <th title="Idade"> Idade </th>
                            <th title="Altura"> Altura </th>
                            <th title="Peso"> Peso </th>
                            <th title="Passaporte"> Passaporte </th>
                            <th title="Ações"> Ações </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($master as $msf)
                            <tr>
                              <td title="{{ $msf->id }}"> {{ $msf->id }} </td>
                              <td title="{{ $msf->nome }}"> {{ $msf->nome }} </td>
                              <td title="{{ $msf->arte_marcial }}"> {{ $msf->arte_marcial }} </td>
                              <td title="{{ $msf->nacionalidade }}"> {{ $msf->nacionalidade }} </td>
                              <td title="{{ $msf->genero }}"> {{ $msf->genero }} </td>
                              <td title="{{ $msf->tipo_sangue }}"> {{ $msf->tipo_sangue }} </td>
                              <td title="{{ $msf->idade }} "> {{ $msf->idade }} </td>
                              <td title="{{ $msf->altura }} m"> {{ $msf->altura }} m </td>
                              <td title="{{ $msf->peso }} kg"> {{ $msf->peso }} kg </td>
                              <td title="{{ Str::mask($msf->passaporte,'*',2,-2) }}"> {{ Str::mask($msf->passaporte,'*',2,-2) }}</td>
                              <td>
                                <form action="{{ url("delete-master/$msf->id") }}" method="POST">
                                  <a href="{{ url("update-master/$msf->id") }}" class="btn btn-primary" title="Atualizar {{ $msf->nome }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                  @csrf @method('DELETE')
                                  <x-primary-button class="ml-3" title="Deletar {{ $msf->nome }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    {{ $master->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
