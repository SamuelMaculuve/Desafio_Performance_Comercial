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
            <div class="row row-sm mg-b-20">
                <div class="col-lg-6">
                    <p class="mg-b-10">Selecione o Cliente</p>
                    <select name="basic[]" multiple="multiple" class="3col active form-control">
                        @foreach ($clientes  as $cliente)
                        <option value="{{ $cliente->co_cliente }}">{{ $cliente->no_fantasia }}</option>
                        @endforeach
                    </select>
                </div><!-- col-4 -->
                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Data de Inicio</p>
                    <input class="form-control" type="date" name="date1">
                </div><!-- col-4 -->
                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Data de Fim</p>
                    <input class="form-control" type="date" name="date2">

                </div><!-- col-4 -->

            </div><!-- row input-->

            <!-- row btn submit -->
                @include('inc.btn_template')
            <!-- row btn submit -->
        </form>

    </div><!-- content-body -->

@endsection
