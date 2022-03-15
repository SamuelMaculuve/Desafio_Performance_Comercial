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

        <table class="table">
            @foreach ($relatorio_clientes as $nome_cliente => $relatorio_cliente)
                @php( $count_por_cliente = 0)
                <tr>
                    <th colspan="3">{{ $nome_cliente }}</th>
                </tr>
                @foreach ($relatorio_cliente as $rel_cliente)
                    <tr>
                        <td>{{ $rel_cliente->num_mes }}</td>
                        <td>{{ $rel_cliente->sums }}</td>
                    </tr>
                    @php($count_por_cliente = $count_por_cliente + $rel_cliente->sums)
                @endforeach
                <tr>
                    <th colspan="3">{{ $count_por_cliente }}</th>
                </tr>
            @endforeach
        </table>

    </div><!-- content-body -->

@endsection
