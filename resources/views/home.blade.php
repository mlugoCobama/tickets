@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-8">
            <h1>Dashboard</h1>
        </div>
        <div class="col-4 form-inline float-right">
            @csrf
            <div class="form-group mb-2 mx-sm-3 float-right">
                <label for="cat_empresa_id" class="sr-only">Filtro Empresa:</label>
                <select name="cat_empresa_id" id="cat_empresa_id" class="form-control form-control-sm">
                    <option value="0">selecciona una empresa</option>
                    @foreach ($empresas as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group  mx-sm-3 mb-2 float-right">
                <button type="button" class="btn btn-primary btn-sm mx-sm-3" id="filtrar">
                    <i class="fa-solid fa-filter"></i>
                    Filtrar
                </button>
                <!--button type="button" class="btn btn-primary btn-sm" id="generarReporte">
                    <i class="fa-solid fa-file-pdf"></i>
                    Generar PDF
                </button-->
                <!--label for="fecha" class="sr-only">Fecha</label>
                <input type="date" class="form-control form-control-sm" id="fecha" placeholder="fecha"-->
            </div>
        </div>
    </div>

@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalCorreos }}</h3>
                    <p>Total de tickets</p>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-rectangle-list"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$totalResueltos}}</h3>
                    <p>Tickets resueltos</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$totalProceso}}</h3>
                    <p>Tickets trabajando</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalCorreos - ( $totalResueltos + $totalProceso ) }}</h3>
                    <p>Tickets sin asignar</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
            </div>
        </div>
    </div><!--div.row-->
    <div class="row">
        <section class="col-lg-6 ">
            <div class="card">
                <!--div class="card-header ">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Tickets por Estatus
                    </h3>
                    <div class="card-tools"></div>
                </div-->
                <div class="card-body">
                    <div id="ticketsEstatus" class="col" ></div>
                </div>
            </div>
            @if ($cat_empresa_id == 0)
                <div class="card">
                    <!--div class="card-header ">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Tickets por Empresa
                        </h3>
                        <div class="card-tools"></div>
                    </div-->
                    <div class="card-body">
                        <div id="ticketsEmpresa" class="col" ></div>
                    </div>
                </div>
            @endif
        </section>

        <section class="col-lg-6 ">
            <div class="card">
                <!--div class="card-header ">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Tickets por Tecnico
                    </h3>
                    <div class="card-tools"></div>
                </div-->
                <div class="card-body">
                    <div id="ticketsTecnico" class="col" ></div>
                </div>
            </div>
            <div class="card">
                <!--div class="card-header ">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Tickets por Area
                    </h3>
                    <div class="card-tools"></div>
                </div-->
                <div class="card-body">
                    <div id="ticketsArea" class="col" ></div>
                </div>
            </div>
        </section>
    </div>

@stop

@section('css')
    <!--link rel="stylesheet" href="/css/admin_custom.css"-->
@stop

@section('js')

<script src="https://kit.fontawesome.com/7fe718abe6.js" crossorigin="anonymous"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>

    /**
     * Evento para generar reporte
     */
    $(document).on("click", "#filtrar", function(e) {

         e.preventDefault();

        //let currentURL = window.location.href;
        let currentURL = '{{ env('APP_URL') }}';
        let idEmpresa =  $("#cat_empresa_id").val();

         window.location.href = currentURL+"/home/"+idEmpresa;

    });

    /* INICIO GRAFICA TICKETS POR TECNICO */
    const graficaTecnico = Highcharts.chart('ticketsTecnico', {
        chart: {
            type: 'column',
            marginRight: 50
        },
        title: {
            text: 'Tickets por Tecnico'
        },
        subtitle: {
            text: ''
        },

        xAxis: {
            categories: [
                @foreach ($ticketsTecnico as $item)
                '{{$item->name}}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tickets'
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Tickets',
            data: [
                @foreach ($ticketsTecnico as $item)
                {{$item->total}},
                @endforeach
            ]

        }]
    });
    /* FIN GRAFICA TICKETS POR TECNICO */
    /* INICIO GRAFICA TICKETS POR AREA */
    const graficaArea = Highcharts.chart('ticketsArea', {
        chart: {
            type: 'column',
            marginRight: 50
        },
        title: {
            text: 'Tickets por Area'
        },
        subtitle: {
            text: ''
        },

        xAxis: {
            categories: [
                @foreach ($ticketsAreas as $item)
                '{{$item->nombre}}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tickets'
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Tickets',
            data: [
                @foreach ($ticketsAreas as $item)
                {{$item->total}},
                @endforeach
            ]

        }]
    });
    /* FIN GRAFICA TICKETS POR AREA */
    /* INICIO GRAFICA TICKETS POR ESTATUS */
    const graficaEstatus = Highcharts.chart('ticketsEstatus', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Tickets por Estatus'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Tickets',
            colorByPoint: true,
            data: [
                @foreach ($ticketsEstatus as $item)
                    {
                        name: '{{$item->nombre}}',
                        y: {{$item->total}}
                    },
                @endforeach
            ]
        }]
    });
    /* FIN GRAFICA TICKETS POR ESTATUS */
    /* INICIO GRAFICA TICKETS POR EMPRESAS */
    const graficaEmpresa = Highcharts.chart('ticketsEmpresa', {
        chart: {
            type: 'column',
            marginRight: 50
        },
        title: {
            text: 'Tickets por Empresa'
        },
        subtitle: {
            text: ''
        },

        xAxis: {
            categories: [
                @foreach ($ticketsEmpresas as $item)
                '{{$item->nombre}}',
                @endforeach
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Tickets'
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Tickets',
            data: [
                @foreach ($ticketsEmpresas as $item)
                {{$item->total}},
                @endforeach
            ]

        }]
    });
    /* FIN GRAFICA TICKETS POR EMPRESAS */
    Highcharts.getSVG = function (charts) {
        let top = 0;
        let width = 0;

        const groups = charts.map(chart => {
            let svg = chart.getSVG();
            // Get width/height of SVG for export
            const svgWidth = +svg.match(
                /^<svg[^>]*width\s*=\s*\"?(\d+)\"?[^>]*>/
            )[1];
            const svgHeight = +svg.match(
                /^<svg[^>]*height\s*=\s*\"?(\d+)\"?[^>]*>/
            )[1];

            svg = svg
                .replace(
                    '<svg',
                    '<g transform="translate(0,' + top + ')" '
                )
                .replace('</svg>', '</g>');

            top += svgHeight;
            width = Math.max(width, svgWidth);

            return svg;
        }).join('');

        return `<svg height="${top}" width="${width}" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
                ${groups}
            </svg>`;
    };

    Highcharts.exportCharts = function (charts, options) {

        // Merge the options
        options = Highcharts.merge(Highcharts.getOptions().exporting, options);

        // Post to export server
        Highcharts.post(options.url, {
            filename: options.filename || 'chart',
            type: options.type,
            width: options.width,
            svg: Highcharts.getSVG(charts)
        });
    };


    /**
     * Evento para generar reporte
     */
    $(document).on("click", "#generarReporte", function(e) {

        e.preventDefault();

        let currentURL = window.location.href;
        let cat_empresa_id = $("#cat_empresa_id").val();
        let SVGTecnico = btoa(unescape(encodeURIComponent( graficaTecnico.getSVG() )));

        base64ImageValue = btoa(unescape(encodeURIComponent(SVGTecnico)));
        console.log(base64ImageValue);

        let SVGArea    = Highcharts.getSVG([graficaArea]);
        let SVGEmpresa = Highcharts.getSVG([graficaEmpresa]);
        let SVGEstatus = Highcharts.getSVG([graficaEstatus]);
        let _token = $("input[name=_token]").val();



        $.post( currentURL+"/reporte_tickets", {
            cat_empresa_id: cat_empresa_id,
            SVGTecnico: SVGTecnico,
            SVGArea: SVGArea,
            SVGEmpresa: SVGEmpresa,
            SVGEstatus: SVGEstatus,
            _token: _token
        }, function(data, textStatus, xhr) {
            /*
            var blob = new Blob([data]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "reporte_tickets.pdf";
                link.click();
            */
        });
        //window.location.href = currentURL+"/home/"+idEmpresa;

    });


</script>


@stop
