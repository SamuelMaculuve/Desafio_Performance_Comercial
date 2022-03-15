@extends('layouts.baseExtra')
@php( $titulo = 'Por Consultor')
@section('titulo',$titulo)

@section('conteudo')
<!-- content-left -->
@include('inc.content_left')
<!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    @include('inc.breadcrumb')
    <h2 class="az-content-title"> {{ $titulo }}</h2>

        <form action="{{ route('con_desempenho_sub') }}" method="POST">
            @csrf
            <div class="row row-sm mg-b-20">
                <div class="col-lg-6">
                    <p class="mg-b-10">Selecione o Consultor</p>
                    <select name="consultores[]" multiple="multiple" class="3col active form-control">
                        @foreach ($consultores as $consultor)
                        <option value="{{ $consultor->co_usuario }}">{{ $consultor->no_usuario }}</option>
                        @endforeach
                    </select>
                </div><!-- col-4 -->
                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10 text-bold">Data de Inicio</p>
                    <input class="form-control"  type="month" id="datePicker" required
                           min="2003-01" value="{{ $date_inicio}}" name="date_inicio" >
                </div><!-- col-4 -->
                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                    <p class="mg-b-10">Data de Fim</p>
                    <input class="form-control"  type="month" required
                           min="2003-01" value="{{ $date_fim }}" name="date_fim">

                </div><!-- col-4 -->
            </div><!-- row input-->

            <!-- row btn submit -->
                @include('inc.btn_template')
            <!-- row btn submit -->
        </form>

    </div><!-- content-body -->
<script>
    console.log("Bla*****2020************")

    $(document).ready(function() {
        console.log("Bla*****************")
        console.log("Bla*******||||**********")
        console.log("Bla*****************")
        let now = new Date();
        let today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
        console.log(today);
        $('#datePicker').val(today);
    });
</script>
@endsection
