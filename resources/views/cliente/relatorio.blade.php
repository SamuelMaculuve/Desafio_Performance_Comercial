@extends('layouts.baseExtra')
@php( $titulo = 'Relatório de Cliente')
@section('titulo',$titulo)
@section('conteudo')
    <!-- content-left -->
      @include('inc.content_left')
    <!-- content-left -->
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
        @include('inc.breadcrumb')
        <h2 class="az-content-title">{{ $titulo }}</h2>
        @include('inc.error_msg')
        <!-- form de pesquisa -->
            @include('inc.form_cliente')
        <!-- form de pesquisa -->
        <table class="table">
            @foreach ($relatorio_clientes as $nome_cliente => $relatorio_cliente)
                @php( $count_por_cliente = 0)
                <tr>
                    <th colspan="3"><span class="text-bold">Nome : </span>
                        {{ $nome_cliente }}</th>
                </tr>
                @foreach ($relatorio_cliente as $rel_cliente)
                    <tr>
                        <td>{{ $lista_mes[intval($rel_cliente->num_mes)] }}</td>
                        <td> R$ {{ number_format($rel_cliente->sums , 2, '.', '') }}</td>
                    </tr>
                    @php($count_por_cliente = $count_por_cliente + $rel_cliente->sums)
                @endforeach
                <tr>
                    <th colspan="3">
                        <span class="text-bold"> Total : </span>
                        R$ {{ number_format($count_por_cliente, 2, '.', '') }}</th>
                </tr>
            @endforeach
        </table>

    </div><!-- content-body -->

@endsection
