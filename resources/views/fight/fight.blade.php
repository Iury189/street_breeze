@section('title') {{'Lutas'}} @endsection

<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($count_fight <= 0)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __('não existem registros de lutas no banco de dados.') }}
        @elseif ($count_fight == 1)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existe apenas $count_fight registro de lutas no banco de dados.") }}
        @elseif ($count_fight > 1)
          {{ Str::words(Auth::user()->name, 1, '') }}, {{ __("existem $count_fight registros de lutas no banco de dados.") }}
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
                    <a href="{{ url("add-fight") }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                  </div>
                </nav>
                <br>
                  <table class="table table-hover">
                      <thead>
                        <tr>
                          <th title="ID"> ID </th>
                          <th title="Fighter Nº 1"> Fighter Nº 1 </th>
                          <th title="Master Nº 2"> Fighter Nº 2 </th>
                          <th title="Vencedor(a)"> Vencedor(a) </th>
                          <th title="Ações"> Ações </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($fight as $f)
                          <tr>
                            <td title="{{ $f->id }}"> {{ $f->id }} </td>
                            <td title="{{ $f->fighter1_id == $f->fighter1->id ? $f->fighter1->nome : ''}}"> {{ $f->fighter1_id == $f->fighter1->id ? $f->fighter1->nome : '' }} </td>
                            <td title="{{ $f->fighter2_id == $f->fighter2->id ? $f->fighter2->nome : ''}}"> {{ $f->fighter2_id == $f->fighter2->id ? $f->fighter2->nome : '' }} </td>
                            <td title="{{ ($f->vencedor == $f->fighter1_id) ? $f->fighter1->nome : ($f->vencedor == $f->fighter2_id ? $f->fighter2->nome : '') }} "> {{ ($f->vencedor == $f->fighter1_id) ? $f->fighter1->nome : ($f->vencedor == $f->fighter2_id ? $f->fighter2->nome : '') }} </td>
                            <td>
                              <form action="{{ url("delete-fight/$f->id") }}" method="POST">
                                @csrf @method('DELETE')
                                <x-primary-button class="ml-3" title="Deletar luta Nº {{ $f->id }}"><i class="fa fa-trash"></i>&nbsp;{{ __('Deletar') }} </x-primary-button>
                                <a href="{{ url("pdf-fight/$f->id") }}" title="Exportar para PDF luta Nº {{ $f->id }}" class="btn btn-primary"><i class="fa fa-file-pdf"></i>&nbsp;PDF</a>
                                <a href="{{ url("excel-fight/$f->id") }}" title="Exportar para excel luta Nº {{ $f->id }}" class="btn btn-primary"><i class="fa fa-file-excel"></i>&nbsp;Excel</a>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  {{ $fight->links() }}
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
