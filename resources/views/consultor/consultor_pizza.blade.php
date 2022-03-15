@extends('layouts.base')
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
    <form action="{{ route('con_desempenho_sub') }}" method="POST">
    @csrf
    <!-- campos de pesquisa -->
    @include('inc.campos_pesquisa')
    <!-- campos de pesquisa -->
    @include('inc.btn_template')
    <!-- row btn submit -->
    </form>
    <!-- form de pesquisa -->
    @if(!$resul_pizza->isEmpty())
        <div class="col-12">
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        </div>
    @else
       @include('inc.sem_resultado')
    @endif

    <div class="ht-40"></div>

</div><!-- content-body -->
<script>
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
    button {
        display: none !important;
    }
    .canvasjs-chart-credit {
         display: none !important;
     }

</style>
@endsection
