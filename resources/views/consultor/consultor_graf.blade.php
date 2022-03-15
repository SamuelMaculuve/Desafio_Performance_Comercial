@extends('layouts.base')
@php( $titulo = 'Relatório de Consultores')
@section('titulo',$titulo)
@section('conteudo')
<!-- content-left -->
@include('inc.content_left')
<!-- content-left -->
<div class="az-content-body pd-lg-l-40 d-flex flex-column">
    @include('inc.breadcrumb')
    <h2 class="az-content-title"> {{ $titulo }}</h2>
    <!-- form de pesquisa -->
    @include('inc.error_msg')
    <form action="{{ route('con_desempenho_sub') }}" method="POST">
    @csrf
    <!-- campos de pesquisa -->
    @include('inc.campos_pesquisa')
    <!-- campos de pesquisa -->
    @include('inc.btn_template')
    <!-- row btn submit -->
    </form>
    <!-- form de pesquisa -->
    @if(!$resul_grafico->isEmpty())
        <div class="col-12 mt-5">
            <div class="ht-200 ht-lg-250"><canvas id="chartBar1"></canvas></div>
        </div>
    @else
        @include('inc.sem_resultado')
    @endif

</div><!-- content-body -->
<script>
window.onload = function () {
var ctx1 = document.getElementById('chartBar1').getContext('2d');
new Chart(ctx1,
    {
        type: 'bar',
        data: {
            datasets: [{
                // label: 'Bar Dataset',

                data: [10, 20, 30, 50,10, 20, 30, 50,10, 20, 30, 50],
                backgroundColor: "#FF9881",
                showInLegend: true,
                // este conjunto de dados é desenhado abaixo
                order: 2
            },
            {
                // label: 'Line Dataset',
                data: [10, 10, 10, 10,20, 10, 10, 10,10, 10, 10, 10],
                type: 'line',
                borderColor: "#FF312D",
                // este conjunto de dados é desenhado no topo
                order: 1
            }],
            labels: ['Jan','Fev', 'Mar', 'Abr', 'Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                position: 'right',
                labels: {
                    display: true,
                    color: 'rgb(255, 99, 132)'
                }
            },

            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        max: 80
                    }
                }],
                xAxes: [{
                    barPercentage: 0.6,
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11
                    }
                }]
            }
        }

    });
}
</script>
@endsection
