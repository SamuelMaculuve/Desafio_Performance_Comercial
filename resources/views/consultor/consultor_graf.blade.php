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
    <p id="p1">Hello World!</p>

    <!-- form de pesquisa -->
    @include('inc.error_msg')
    <!-- form de pesquisa -->
        @include('inc.form_consultores')
    <!-- form de pesquisa -->
    <!-- form de pesquisa -->
    {{ $resul_grafico }}
    <div class="col-12 pt-5">
        <br/><!-- Just so that JSFiddle's Result label doesn't overlap the Chart -->
        <div id="chartContainer" style="height: 360px; width: 100%;"></div>
        <div id="showData" align="center"></div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div><!-- content-body -->

<script>
    var resul_grafico =  <?php echo $resul_grafico ?>;
    window.onload = function () {
        arrayData1 = resul_grafico['0' + 1];
        console.log("resul/**************====_pizza",arrayData1)
        const resul_graficoStr = JSON.stringify(arrayData1, (key, value) => {
            // Check if key matches the string "w" or "mob"
            if (key === "w" ) {
                return undefined;
            }
            if (key === "x" ) {
                // console.log(value,'valeu-----------')
                return new Date(value);
            }
            // else return the value itself
            return value;
        });

        console.log("depois--------",resul_graficoStr);
        // resul_graficoStr.birth = new Date(resul_graficoStr.x);
        console.log("depois-----v2---",resul_graficoStr.x);

        // if (arrayData1['value'] === 'w') {
        //     unset(arrayData1[$key]);
        // }
        // document.getElementById("p1").innerHTML = JSON.stringify(arrayData1)

        // for (let i = 1; i < resul_graficoStr.length; i++) {
        //
        //     console.log("eee->", resul_graficoStr[i])
        // }
        ////////// GRAFICO
        // var date = new Date('2007-01-02');
        // console.log("date===>",date);
        // console.log("new Date(2014, 08, 01)->",new Date(2014, 08, 01))
        var chart = new CanvasJS.Chart("chartContainer", {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

            title: {
                text: "House Median Price"
            },
            axisX: {
                valueFormatString: "MMM YYYY"
            },
            axisY2: {
                title: "Median List Price",
                prefix: "$",
                suffix: "K"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "top",
                horizontalAlign: "center",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                type:"line",
                axisYType: "secondary",
                name: "San Fransisco",
                showInLegend: true,
                markerSize: 0,
                yValueFormatString: "$#,###k",
                dataPoints: [
                    { x: new Date(2014, 00, 01), y: 850 },
                    { x: new Date(2014, 01, 01), y: 889 },
                    { x: new Date(2014, 02, 01), y: 890 },
                    { x: new Date(2014, 03, 01), y: 899 },
                    { x: new Date(2014, 04, 01), y: 903 },
                    { x: new Date(2014, 05, 01), y: 925 },
                    { x: new Date(2014, 06, 01), y: 899 },
                    { x: new Date(2014, 07, 01), y: 875 },
                    { x: new Date(2014, 08, 01), y: 927 },
        { x: new Date(2014, 09, 01), y: 949 },
        { x: new Date(2014, 10, 01), y: 946 },
        { x: new Date(2014, 11, 01), y: 927 },
        { x: new Date(2015, 00, 01), y: 950 },
        { x: new Date(2015, 01, 01), y: 998 },
        { x: new Date(2015, 02, 01), y: 998 },
        { x: new Date(2015, 03, 01), y: 1050 },
        { x: new Date(2015, 04, 01), y: 1050 },
        { x: new Date(2015, 05, 01), y: 999 },
        { x: new Date(2015, 06, 01), y: 998 },
        { x: new Date(2015, 07, 01), y: 998 },
        { x: new Date(2015, 08, 01), y: 1050 },
        { x: new Date(2015, 09, 01), y: 1070 },
        { x: new Date(2015, 10, 01), y: 1050 },
        { x: new Date(2015, 11, 01), y: 1050 },
        { x: new Date(2016, 00, 01), y: 995 },
        { x: new Date(2016, 01, 01), y: 1090 },
        { x: new Date(2016, 02, 01), y: 1100 },
        { x: new Date(2016, 03, 01), y: 1150 },
        { x: new Date(2016, 04, 01), y: 1150 },
        { x: new Date(2016, 05, 01), y: 1150 },
        { x: new Date(2016, 06, 01), y: 1100 },
        { x: new Date(2016, 07, 01), y: 1100 },
        { x: new Date(2016, 08, 01), y: 1150 },
        { x: new Date(2016, 09, 01), y: 1170 },
        { x: new Date(2016, 10, 01), y: 1150 },
        { x: new Date(2016, 11, 01), y: 1150 },
        { x: new Date(2017, 00, 01), y: 1150 },
        { x: new Date(2017, 01, 01), y: 1200 },
        { x: new Date(2017, 02, 01), y: 1200 },
        { x: new Date(2017, 03, 01), y: 1200 },
        { x: new Date(2017, 04, 01), y: 1190 },
    ]
    },
        {
            type: "line",
                axisYType: "secondary",
            name: "Manhattan",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "$#,###k",
            dataPoints: [
            { x: new Date(2014, 00, 01), y: 1200 },
            { x: new Date(2014, 01, 01), y: 1200 },
            { x: new Date(2014, 02, 01), y: 1190 },
            { x: new Date(2014, 03, 01), y: 1180 },
            { x: new Date(2014, 04, 01), y: 1250 },
            { x: new Date(2014, 05, 01), y: 1270 },
            { x: new Date(2014, 06, 01), y: 1300 },
            { x: new Date(2014, 07, 01), y: 1300 },
            { x: new Date(2014, 08, 01), y: 1358 },
            { x: new Date(2014, 09, 01), y: 1410 },
            { x: new Date(2014, 10, 01), y: 1480 },
            { x: new Date(2014, 11, 01), y: 1500 },
            { x: new Date(2015, 00, 01), y: 1500 },
            { x: new Date(2015, 01, 01), y: 1550 },
            { x: new Date(2015, 02, 01), y: 1550 },
            { x: new Date(2015, 03, 01), y: 1590 },
            { x: new Date(2015, 04, 01), y: 1600 },
            { x: new Date(2015, 05, 01), y: 1590 },
            { x: new Date(2015, 06, 01), y: 1590 },
            { x: new Date(2015, 07, 01), y: 1620 },
            { x: new Date(2015, 08, 01), y: 1670 },
            { x: new Date(2015, 09, 01), y: 1720 },
            { x: new Date(2015, 10, 01), y: 1750 },
            { x: new Date(2015, 11, 01), y: 1820 },
            { x: new Date(2016, 00, 01), y: 2000 },
            { x: new Date(2016, 01, 01), y: 1920 },
            { x: new Date(2016, 02, 01), y: 1750 },
            { x: new Date(2016, 03, 01), y: 1850 },
            { x: new Date(2016, 04, 01), y: 1750 },
            { x: new Date(2016, 05, 01), y: 1730 },
            { x: new Date(2016, 06, 01), y: 1700 },
            { x: new Date(2016, 07, 01), y: 1730 },
            { x: new Date(2016, 08, 01), y: 1720 },
            { x: new Date(2016, 09, 01), y: 1740 },
            { x: new Date(2016, 10, 01), y: 1750 },
            { x: new Date(2016, 11, 01), y: 1750 },
            { x: new Date(2017, 00, 01), y: 1750 },
            { x: new Date(2017, 01, 01), y: 1770 },
            { x: new Date(2017, 02, 01), y: 1750 },
            { x: new Date(2017, 03, 01), y: 1750 },
            { x: new Date(2017, 04, 01), y: 1730 },
        ]
        },
        {
            type: "line",
                axisYType: "secondary",
            name: "Seatle",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "$#,###k",
            dataPoints: [
            { x: new Date(2014, 00, 01), y: 409 },
            { x: new Date(2014, 01, 01), y: 415 },
            { x: new Date(2014, 02, 01), y: 419 },
            { x: new Date(2014, 03, 01), y: 429 },
            { x: new Date(2014, 04, 01), y: 429 },
            { x: new Date(2014, 05, 01), y: 450 },
            { x: new Date(2014, 06, 01), y: 450 },
            { x: new Date(2014, 07, 01), y: 445 },
            { x: new Date(2014, 08, 01), y: 450 },
            { x: new Date(2014, 09, 01), y: 450 },
            { x: new Date(2014, 10, 01), y: 440 },
            { x: new Date(2014, 11, 01), y: 429 },
            { x: new Date(2015, 00, 01), y: 435 },
            { x: new Date(2015, 01, 01), y: 450 },
            { x: new Date(2015, 02, 01), y: 475 },
            { x: new Date(2015, 03, 01), y: 475 },
            { x: new Date(2015, 04, 01), y: 475 },
            { x: new Date(2015, 05, 01), y: 489 },
            { x: new Date(2015, 06, 01), y: 495 },
            { x: new Date(2015, 07, 01), y: 495 },
            { x: new Date(2015, 08, 01), y: 500 },
            { x: new Date(2015, 09, 01), y: 508 },
            { x: new Date(2015, 10, 01), y: 520 },
            { x: new Date(2015, 11, 01), y: 525 },
            { x: new Date(2016, 00, 01), y: 525 },
            { x: new Date(2016, 01, 01), y: 529 },
            { x: new Date(2016, 02, 01), y: 549 },
            { x: new Date(2016, 03, 01), y: 550 },
            { x: new Date(2016, 04, 01), y: 568 },
            { x: new Date(2016, 05, 01), y: 575 },
            { x: new Date(2016, 06, 01), y: 579 },
            { x: new Date(2016, 07, 01), y: 575 },
            { x: new Date(2016, 08, 01), y: 585 },
            { x: new Date(2016, 09, 01), y: 589 },
            { x: new Date(2016, 10, 01), y: 595 },
            { x: new Date(2016, 11, 01), y: 595 },
            { x: new Date(2017, 00, 01), y: 595 },
            { x: new Date(2017, 01, 01), y: 600 },
            { x: new Date(2017, 02, 01), y: 624 },
            { x: new Date(2017, 03, 01), y: 635 },
            { x: new Date(2017, 04, 01), y: 650 },
        ]
        },
        {
            type: "line",
                axisYType: "secondary",
            name: "Los Angeles",
            showInLegend: true,
            markerSize: 0,
            yValueFormatString: "$#,###k",
            dataPoints: [
            { x: new Date(2014, 00, 01), y: 529 },
            { x: new Date(2014, 01, 01), y: 540 },
            { x: new Date(2014, 02, 01), y: 539 },
            { x: new Date(2014, 03, 01), y: 565 },
            { x: new Date(2014, 04, 01), y: 575 },
            { x: new Date(2014, 05, 01), y: 579 },
            { x: new Date(2014, 06, 01), y: 589 },
            { x: new Date(2014, 07, 01), y: 579 },
            { x: new Date(2014, 08, 01), y: 579 },
            { x: new Date(2014, 09, 01), y: 579 },
            { x: new Date(2014, 10, 01), y: 569 },
            { x: new Date(2014, 11, 01), y: 525 },
            { x: new Date(2015, 00, 01), y: 535 },
            { x: new Date(2015, 01, 01), y: 575 },
            { x: new Date(2015, 02, 01), y: 599 },
            { x: new Date(2015, 03, 01), y: 619 },
            { x: new Date(2015, 04, 01), y: 639 },
            { x: new Date(2015, 05, 01), y: 648 },
            { x: new Date(2015, 06, 01), y: 640 },
            { x: new Date(2015, 07, 01), y: 645 },
            { x: new Date(2015, 08, 01), y: 648 },
            { x: new Date(2015, 09, 01), y: 649 },
            { x: new Date(2015, 10, 01), y: 649 },
            { x: new Date(2015, 11, 01), y: 649 },
            { x: new Date(2016, 00, 01), y: 650 },
            { x: new Date(2016, 01, 01), y: 665 },
            { x: new Date(2016, 02, 01), y: 675 },
            { x: new Date(2016, 03, 01), y: 695 },
            { x: new Date(2016, 04, 01), y: 690 },
            { x: new Date(2016, 05, 01), y: 699 },
            { x: new Date(2016, 06, 01), y: 699 },
            { x: new Date(2016, 07, 01), y: 699 },
            { x: new Date(2016, 08, 01), y: 699 },
            { x: new Date(2016, 09, 01), y: 699 },
            { x: new Date(2016, 10, 01), y: 709 },
            { x: new Date(2016, 11, 01), y: 699 },
            { x: new Date(2017, 00, 01), y: 700 },
            { x: new Date(2017, 01, 01), y: 700 },
            { x: new Date(2017, 02, 01), y: 724 },
            { x: new Date(2017, 03, 01), y: 739 },
            { x: new Date(2017, 04, 01), y: 749 },
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
