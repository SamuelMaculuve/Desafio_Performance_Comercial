@extends('layouts.baseExtra')
@php( $titulo = 'Relatório de Consultores')
@section('titulo',$titulo)
@section('conteudo')
    <!-- content-left -->
    @include('inc.content_left')
    <!-- content-left -->
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
        @include('inc.breadcrumb')
        <h2 class="az-content-title">{{ $titulo }} </h2>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('con_desempenho_sub') }}" method="POST">
            @csrf
            <!-- campos de pesquisa -->
            @include('inc.campos_pesquisa')
            <!-- campos de pesquisa -->
        @include('inc.btn_template')
        <!-- row btn submit -->
        </form>

        @forelse ($rel_consultores as $nome_usuario => $relatorio_consultores)
            @php( $saldo_receita_líquida = 0)
            @php( $saldo_custo_fixo = 0)
            @php( $saldo_lucro = 0)
            @php( $saldo_comissao = 0)
        <table class="table table-bordered mg-b-0 mt-3" >
            <tbody>
            <tr bgcolor="#efefef">
                <td colspan="5"><span class="style3">{{ $nome_usuario }}</span> </td>
            </tr>
            <tr bgcolor="#fafafa">
                <td nowrap=""><div align="center"><strong>Período</strong></div></td>
                <td><div align="center"><strong>Receita Líquida </strong></div></td>
                <td><div align="center"><strong>Custo Fixo </strong></div></td>
                <td><div align="center"><strong>Comissão</strong></div></td>
                <td><div align="center"><strong>Lucro</strong></div></td>
            </tr>
            @foreach ($relatorio_consultores as $rel_consultor)
                @php( $lucro = $rel_consultor->receita_líquida - ($rel_consultor->custo_fixo+$rel_consultor->comissao))
            <tr bgcolor="#fafafa">
                <td nowrap="">{{ $lista_mes[intval(substr($rel_consultor->num_mes,0,2))] }} 20{{$rel_consultor->ano }}</td>
                <td><div align="right"> R$ {{ $rel_consultor->receita_líquida }}</div></td>
                <td><div align="right"> R$ {{ $rel_consultor->custo_fixo }} </div></td>
                <td><div align="right"> R$ {{ $rel_consultor->comissao}}</div></td>
                <td>
                    <div align="right">
                        @if($lucro < 0)
                        <font color="#FF0000"> {{ $lucro }}</font>
                        @else
                            <font > {{ $lucro }}</font>
                        @endif

                    </div>
                </td>
            </tr>

            @php($saldo_receita_líquida = $saldo_receita_líquida + $rel_consultor->receita_líquida)
            @php($saldo_custo_fixo = $saldo_custo_fixo + $rel_consultor->custo_fixo )
            @php($saldo_lucro = $saldo_lucro + $lucro )
            @php($saldo_comissao = $saldo_comissao + $rel_consultor->comissao )
            @endforeach
            <tr bgcolor="#fafafa">
                <td nowrap=""><div align="center"><strong>Saldo</strong></div></td>
                <td><div align="center"><strong>R$ {{ $saldo_receita_líquida }}</strong></div></td>
                <td><div align="center"><strong>R$ {{ $saldo_custo_fixo }} </strong></div></td>
                <td><div align="center"><strong>R$ {{ $saldo_comissao }}</strong></div></td>
                <td><div align="center"><strong>R$ {{ $saldo_lucro }}</strong></div></td>
            </tr>
            </tbody>

        </table>
        @empty
            @include('inc.sem_resultado')
        @endforelse
    </div><!-- content-body -->

@endsection
