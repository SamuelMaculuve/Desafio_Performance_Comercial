@extends('layouts.base')
@php( $titulo = 'Grafico de Clientes')
@section('titulo',$titulo)
@section('conteudo')
<!-- content-left -->
@include('inc.content_left')
<!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    @include('inc.breadcrumb')
    <h2 class="az-content-title"> {{ $titulo }} </h2>
    @include('inc.error_msg')
    <form action="{{ route('con_desempenho_filtrar') }}" method="POST">
        @csrf
    @include('inc.campos_pesquisa_cliente')
    <!-- row btn submit -->
    @include('inc.btn_template')
    <!-- row btn submit -->
    </form>

    @if(!$resul_grafico->isEmpty())
        <div class="col-12 pt-5">
            <div class="chartjs-wrapper-demo"><canvas id="chartLine1"></canvas></div>
        </div>
    @else
        @include('inc.sem_resultado')
    @endif


</div><!-- content-body -->
<script>
window.onload = function () {
    /* LINE CHART */
    var grafico_clientes =  <?php echo $resul_grafico ?>;
    console.log("grafico_clientes->",grafico_clientes)
    var barChartData = {
        datasets: []
    };


    var ctx8 = document.getElementById('chartLine1');
    new Chart(ctx8, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

            datasets: grafico_clientes,
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false,
                labels: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 10,
                        max: 80
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero:true,
                        fontSize: 11
                    }
                }]
            }
        }
    });
}
</script>
@endsection
