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
        @foreach ($rel_consultores as $nome_usuario => $relatorio_consultores)
            @php( $saldo_receita_líquida = 0)
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
            <tr bgcolor="#fafafa">
                <td nowrap="">{{ $lista_mes[intval(substr($rel_consultor->num_mes,0,2))] }} 20{{$rel_consultor->ano }}</td>
                <td><div align="right"> R$ {{ $rel_consultor->receita_líquida }}</div></td>
                <td><div align="right">- R$ 2.000,00</div></td>
                <td><div align="right"> R$ {{ $rel_consultor->comissao}}</div></td>
                <td><div align="right"><font color="#FF0000">- R$ 1.500,00</font></div></td>
            </tr>
            @php($saldo_receita_líquida = $saldo_receita_líquida + $rel_consultor->receita_líquida)
            @endforeach
            <tr bgcolor="#fafafa">
                <td nowrap=""><div align="center"><strong>Saldo</strong></div></td>
                <td><div align="center"><strong>R$ {{ $saldo_receita_líquida }}</strong></div></td>
                <td><div align="center"><strong>R$ Custo Fixo </strong></div></td>
                <td><div align="center"><strong>R$ Comissão</strong></div></td>
                <td><div align="center"><strong>R$ Lucro</strong></div></td>
            </tr>
            </tbody>

        </table>
        @endforeach
    </div><!-- content-body -->

@endsection
