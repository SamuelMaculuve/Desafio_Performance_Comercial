@extends('layouts.baseExtra')
@php( $titulo = 'Pizza de Consultores')
@section('titulo',$titulo)
@section('conteudo')
<!-- content-left -->
@include('inc.content_left')
<!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    @include('inc.breadcrumb')
    <h2 class="az-content-title"> {{ $titulo }}</h2>
    @include('inc.error_msg')
    <!-- form de pesquisa -->
        @include('inc.form_consultores')
    <!-- form de pesquisa -->
    @if(!$resul_pizza->isEmpty())
        <div class="col-12 pt-5">
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        </div>
    @else
       @include('inc.sem_resultado')
    @endif

    <div class="ht-40"></div>

</div><!-- content-body -->
<script>

//    $resul_grafico = json_encode($this->consultor_graf($request)[null]);
//
//    dd($this->consultor_graf($request)[null]);
    {{--var resul_pizza1 =  <?php echo json_encode($resul_pizza) ?>;--}}
    // Recebe os valores passados pela view, e com isso criar o grafico PIE
    var resul_pizza =  <?php echo $resul_pizza ?>;
        console.log("resul_pizza->",resul_pizza)

    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            exportEnabled: true,
            animationEnabled: true,
            title:{
                text: ""
            },
            legend:{


            },
            data: [{
                type: "pie",
                toolTipContent: "{name}: <strong>{y}%</strong>",
                indexLabel: "{name} - {y}%",
                dataPoints: resul_pizza
            }]
        });
        chart.render();
    }

</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>

</style>
@endsection
