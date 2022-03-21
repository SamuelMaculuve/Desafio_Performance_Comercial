@extends('layouts.baseExtra')
@php( $titulo = 'Grafico de Consultores')
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
    <!-- form de pesquisa -->
        @include('inc.form_consultores')
    <!-- form de pesquisa -->

    <div class="col-12 pt-5">
        <br/><!-- Just so that JSFiddle's Result label doesn't overlap the Chart -->
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        <div id="showData" align="center"></div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div><!-- content-body -->

<script>
window.onload = function () {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title:{
            text: ""
        },
        axisX:{
            valueFormatString: "DD MMM",
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            }
        },
        axisY: {
            title: "",
            includeZero: true,
            crosshair: {
                enabled: true
            }
        },
        toolTip:{
            shared:true
        },
        legend:{
            cursor:"pointer",
            verticalAlign: "bottom",
            horizontalAlign: "left",
            dockInsidePlotArea: true,
            itemclick: toogleDataSeries
        },
        data: [{
            type: "line",
            showInLegend: true,
            name: "Total Visit",
            markerType: "square",
            xValueFormatString: "DD MMM, YYYY",
            color: "#F08080",
            dataPoints: [
                { x: new Date(2017, 0, 3), y: 650 },
                { x: new Date(2017, 0, 4), y: 700 },
                { x: new Date(2017, 0, 5), y: 710 },
                { x: new Date(2017, 0, 6), y: 658 },
                { x: new Date(2017, 0, 7), y: 734 },
                { x: new Date(2017, 0, 8), y: 963 },
                { x: new Date(2017, 0, 9), y: 847 },
                { x: new Date(2017, 0, 10), y: 853 },
                { x: new Date(2017, 0, 11), y: 869 },
                { x: new Date(2017, 0, 12), y: 943 },
                { x: new Date(2017, 0, 13), y: 970 },
                { x: new Date(2017, 0, 14), y: 869 },
                { x: new Date(2017, 0, 15), y: 890 },
                { x: new Date(2017, 0, 16), y: 930 }
            ]
        },
            {
                type: "line",
                showInLegend: true,
                name: "Unique Visit",
                lineDashType: "dash",
                dataPoints: [
                    { x: new Date(2017, 0, 3), y: 510 },
                    { x: new Date(2017, 0, 4), y: 560 },
                    { x: new Date(2017, 0, 5), y: 540 },
                    { x: new Date(2017, 0, 6), y: 558 },
                    { x: new Date(2017, 0, 7), y: 544 },
                    { x: new Date(2017, 0, 8), y: 693 },
                    { x: new Date(2017, 0, 9), y: 657 },
                    { x: new Date(2017, 0, 10), y: 663 },
                    { x: new Date(2017, 0, 11), y: 639 },
                    { x: new Date(2017, 0, 12), y: 673 },
                    { x: new Date(2017, 0, 13), y: 660 },
                    { x: new Date(2017, 0, 14), y: 562 },
                    { x: new Date(2017, 0, 15), y: 643 },
                    { x: new Date(2017, 0, 16), y: 570 }
                ]
            }]
    });
    chart.render();

    function toogleDataSeries(e){
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else{
            e.dataSeries.visible = true;
        }
        chart.render();
    }
}
</script>
@endsection
