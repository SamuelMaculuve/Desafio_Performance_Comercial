@extends('layouts.baseExtra')

@section('conteudo')
    <!-- content-left -->
    @include('inc.content_left')
    <!-- content-left -->
    <div class="az-content-body pd-lg-l-40 d-flex flex-column">
        @include('inc.breadcrumb')
        <h2 class="az-content-title">Por Cliente</h2>

        <form action="{{ route('con_desempenho_filtrar') }}" method="POST">
            @csrf
            @include('inc.campos_pesquisa_cliente')
            <!-- row btn submit -->
            @include('inc.btn_template')
            <!-- row btn submit -->
        </form>

    </div><!-- content-body -->

@endsection
