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

        <table class="table">
            @forelse ($relatorio_clientes as $nome_cliente => $relatorio_cliente)
                @php( $count_por_cliente = 0)
                <tr>
                    <th colspan="3">{{ $nome_cliente }}</th>
                </tr>
                @foreach ($relatorio_cliente as $rel_cliente)
                    <tr>
                        <td>{{ $rel_cliente->num_mes }}</td>
{{--                        $lista_mes[intval(substr($rel_consultor->num_mes,0,2))] }} 20{{$rel_consultor->ano }}--}}
                        <td>{{ $rel_cliente->sums }}</td>
                    </tr>
                    @php($count_por_cliente = $count_por_cliente + $rel_cliente->sums)
                @endforeach
                <tr>
                    <th colspan="3">{{ $count_por_cliente }}</th>
                </tr>
            @empty
                @include('inc.sem_resultado')
            @endforelse
        </table>

    </div><!-- content-body -->

@endsection
