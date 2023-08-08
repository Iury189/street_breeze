@section('title') {{'Listar dojôs'}} @endsection

<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($count_dojo <= 0)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem registros de treinamento no banco de dados.') }}
        @elseif ($count_dojo == 1)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_dojo registro de treinamento no banco de dados.") }}
        @elseif ($count_dojo > 1)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_dojo registros de treinamento no banco de dados.") }}
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
                    <a href="{{ url("add-dojo") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                  </div>
                </nav>
                <br>
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th title="ID"> ID </th>
                          <th title="Fighter"> Fighter </th>
                          <th title="Master"> Master </th>
                          <th title="Ações"> Ações </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($dojo as $d)
                          <tr>
                            <td title="{{ $d->id }}"> {{ $d->id }} </td>
                            <td title="{{ $d->fighter_id == $d->fighter->id ? $d->fighter->nome : '' }}"> {{ $d->fighter_id == $d->fighter->id ? $d->fighter->nome : '' }} </td>
                            <td title="{{ $d->master_id == $d->master->id ? $d->master->nome : '' }}"> {{ $d->master_id == $d->master->id ? $d->master->nome : '' }} </td>
                            <td>
                              <form action="{{ url("delete-dojo/$d->id") }}" method="POST">
                                <a href="{{ url("update-dojo/$d->id") }}" class="btn btn-primary" title="Atualizar {{ $d->nome }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                @csrf @method('DELETE')
                                <x-primary-button class="ml-3" title="Deletar {{ $d->nome }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  {{ $dojo->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
