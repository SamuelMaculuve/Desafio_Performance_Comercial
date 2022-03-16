@extends('layouts.baseExtra')
@php( $titulo = 'Relatório de Clientes')
@section('titulo',$titulo)
@section('conteudo')
    <!-- content-left -->
      @include('inc.content_left')
    <!-- content-left -->
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
        @include('inc.breadcrumb')
        <h2 class="az-content-title">{{ $titulo }}</h2>
        @include('inc.error_msg')
        <form action="{{ route('con_desempenho_filtrar') }}" method="POST">
        @csrf
        @include('inc.campos_pesquisa_cliente')
        <!-- row btn submit -->
        @include('inc.btn_template')
        <!-- row btn submit -->
        </form>
        <div class="col-12 mt-5">
            @forelse ($relatorio_clientes as $nome_cliente => $relatorio_cliente)
                <table class="table pt-5">
                    @php( $count_por_cliente = 0)
                    <tr>
                        <th colspan="3">{{ $nome_cliente }}</th>
                    </tr>
                    <p>
                        <a class = "btn btn-info" data-toggle = "collapse"
                           href = "#{{ trim($nome_cliente) }}" role = "button" aria-expanded = "false"
                           aria-controls = "{{ $nome_cliente }}">{{ trim($nome_cliente) }}</a>
                    </p>
                    <div class = "collapse" id = "{{ trim($nome_cliente) }}">
                    @foreach ($relatorio_cliente as $rel_cliente)
                            <div class = "card card-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                veniam, quis nostrud exercitation.
                                <tr>
                                    <td>{{ $lista_mes[intval($rel_cliente->num_mes)] }}</td>
                                    <td>R$  {{ $rel_cliente->sums }}</td>
                                </tr>
                            </div>


                        @php($count_por_cliente = $count_por_cliente + $rel_cliente->sums)
                    @endforeach
                    </div>
                    <tr>
                        <th colspan="3">R$ {{ $count_por_cliente }}</th>
                    </tr>
                    @empty
                        @include('inc.sem_resultado')
                </table>
            @endforelse

        </div>


    </div>


    </div><!-- content-body -->

@endsection
