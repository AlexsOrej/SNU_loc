<!--  fin EventosByProceso -->
<style>
    .contenedor {
        width: 80%;
        height: auto;
        align-content: center;
    }

    /*Aplicamos la propiedad object-fit cover, ajustar su tamaño y no perder la proporcion de nuestra imagen*/
    .img0 {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    /* 
    .panel {
        background-color: rgb(210 207 207 / 16%);
        box-shadow: 1px;

    } */
</style>

<head>
    <meta charset="utf-8" />
    <title>Documental</title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
</head>
<div class="body">
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTALES</div>
                    <div class="number " data-from="0" data-to="<?php echo $solicitudes->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $solicitudes->total ?> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">SIN TRATAR</div>
                    <div class="number " data-from="0" data-to="<?php echo $vacias->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo ($vacias->total) + ($rev->total) ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">APROBADAS</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo $si->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $si->total ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">block</i>
                </div>
                <div class="content">
                    <div class="text">RECHAZADAS</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo $rev->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $no->total ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- Prepare a DOM with a defined width and height for ECharts -->
                    <div id="doc_pro" style="width: 100%; height: 400px;"></div>
                    <script>
                        // Convierte los datos a un objeto de JavaScript
                        const dataDoc = <?= json_encode($docbyProceso) ?>;
                        // Lista de colores para las barras
                        var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];

                        const procesos = dataDoc.map(item => item.Iniciales);
                        const documentos = dataDoc.map(item => item.NumDocumentos);
                        const formatos = dataDoc.map(item => item.NumFormatos);
                        const doc_ext = dataDoc.map(item => item.NumSGCExternos);
                        // Inicializa el gráfico
                        const doc_pro_ = echarts.init(document.getElementById('doc_pro'));
                        // Configura la opción del gráfico
                        option = {
                            title: {
                                text: 'Cambios por proceso',
                                subtext: 'Muestra la cantidad de info documentada por proceso',
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: "bottom",
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                containLabel: true

                            },
                            xAxis: {
                                type: 'value',
                                boundaryGap: [0, 0.01]
                            },
                            yAxis: {
                                type: 'category',
                                data: procesos
                            },
                            series: [{
                                    name: 'Documentos',
                                    type: 'bar',
                                    data: documentos,
                                    itemStyle: {
                                        color: colors[3]
                                    }

                                },
                                {
                                    name: 'Formatos',
                                    type: 'bar',
                                    data: formatos,
                                    itemStyle: {
                                        color: colors[4]
                                    },


                                },
                                {
                                    name: 'Externos',
                                    type: 'bar',
                                    data: doc_ext,
                                    itemStyle: {
                                        color: colors[5]
                                    },


                                }
                            ]
                        };
                        // Renderiza el gráfico
                        doc_pro_.setOption(option, true);
                        doc_pro_.resize();
                    </script>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- Prepare a DOM with a defined width and height for ECharts -->
                    <div id="main0" style="width: 100%; height: 400px;"></div>
                    <script>
                        // Convierte los datos a un objeto de JavaScript
                        const data0 = <?= json_encode($solbymesdoc) ?>;

                        // Lista de colores para las barras
                        var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];
                        // Extrae los valores de los datos para la configuración de ECharts
                        const xAxisData0 = data0.map(item => item.MesSolicitud);
                        const yAxisData0 = data0.map(item => item.NumSolicitudes);

                        // Calcula el total de las cantidades
                        const total0 = yAxisData0.reduce((a, b) => a + b);
                        // Convierte los valores en porcentajes
                        const yAxisDataPorcentaje0 = yAxisData0.map(valor => (valor / <?= $solicitudes->total ?> * 100).toFixed(2));
                        // Inicializa el gráfico
                        const chart0 = echarts.init(document.getElementById('main0'));
                        // Configura la opción del gráfico
                        option = {
                            title: {
                                name: 'Solicitudes',
                                text: 'Solicitudes de Documentos',
                                subtext: 'Solicitudes de ultimo semestre',
                                left: 'center'
                            },
                            tooltip: {
                                trigger: 'axis',
                                formatter: function(params) {
                                    return params[0].name + '<br />Total: ' + params[0].data + ' (' + yAxisDataPorcentaje0[params[0].dataIndex] + '%)';
                                }
                            },
                            legend: {
                                orient: 'vertical',
                                left: 'left',

                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    dataView: {
                                        show: true,
                                        readOnly: false
                                    },

                                    saveAsImage: {
                                        show: true
                                    }
                                }
                            },
                            calculable: true,
                            xAxis: {
                                data: xAxisData0
                            },
                            yAxis: {

                            },
                            series: [{
                                type: 'bar',
                                data: yAxisData0,
                                markPoint: {
                                    data: [{
                                            type: 'max',
                                            name: 'Max'
                                        },
                                        {
                                            type: 'min',
                                            name: 'Min'
                                        }
                                    ]
                                },
                                markLine: {
                                    data: [{
                                        type: 'average',
                                        name: 'Avg'
                                    }]
                                },
                                showBackground: true,
                                backgroundStyle: {
                                    color: 'rgba(180, 180, 180, 0.2)'
                                },
                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length];
                                        },
                                        colorStops: [{
                                            offset: 0,
                                            color: 'rgba(80, 141, 255, 0.8)'
                                        }, {
                                            offset: 1,
                                            color: 'rgba(80, 141, 255, 0)'
                                        }],
                                        barBorderRadius: [10, 10, 0, 0],
                                    }
                                }
                            }, ],
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 5,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            },
                        };
                        // Renderiza el gráfico
                        option && chart0.setOption(option, true);
                        chart0.resize();
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="porproceso" style="width: 100%;height:400px;"></div>
                    <script type="text/javascript">
                        // Initialize the echarts instance based on the prepared dom
                        var chartDom = document.getElementById('porproceso');
                        var myChart0 = echarts.init(chartDom);
                        var option;
                        option = {
                            title: {
                                text: 'Solicitudes por proceso',
                                subtext: 'Muestra la cantidad solicitudes por cada proceso',
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: '{a} <br/>{b}: {c} ({d}%)'
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: "bottom",
                                data: <?php echo json_encode($spx); ?>, // agregar las leyendas correspondientes a los datos
                            },
                            series: [{
                                name: 'Proceso',
                                type: 'pie',
                                radius: '50%',
                                data: <?php echo json_encode($spx); ?>,
                                emphasis: {
                                    itemStyle: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }]
                        };
                        option && myChart0.setOption(option);
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- Prepare a DOM with a defined width and height for ECharts -->
                    <div id="main" style="width: 100%; height: 400px;"></div>
                    <script>
                        // Convierte los datos a un objeto de JavaScript
                        const data = <?= json_encode($solbymesform) ?>;
                        // Lista de colores para las barras
                        var colors = ['#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#ff95aa', '#f6e5a6'];
                        // Extrae los valores de los datos para la configuración de ECharts
                        const xAxisData = data.map(item => item.MesSolicitud);
                        const yAxisData = data.map(item => item.NumSolicitudes);
                        const tipo = data.map(item => item.Tipo);
                        // Calcula el total de las cantidades
                        const total = yAxisData.reduce((a, b) => a + b);
                        // Convierte los valores en porcentajes
                        const yAxisDataPorcentaje = yAxisData.map(valor => (valor / <?= $solicitudes->total ?> * 100).toFixed(2));
                        // Inicializa el gráfico
                        const chart = echarts.init(document.getElementById('main'));
                        // Configura la opción del gráfico
                        option = {
                            title: {
                                name: 'Solicitudes',
                                text: 'Solicitudes de formatos',
                                subtext: 'Solicitudes de ultimo semestre',
                                left: 'center'
                            },
                            tooltip: {
                                trigger: 'axis',
                                formatter: function(params) {
                                    return params[0].name + '<br />Total: ' + params[0].data + ' (' + yAxisDataPorcentaje[params[0].dataIndex] + '%)';
                                }
                            },
                            legend: {
                                orient: 'vertical',
                                left: 'left',

                            },
                            toolbox: {
                                show: true,
                                feature: {
                                    dataView: {
                                        show: true,
                                        readOnly: false
                                    },

                                    saveAsImage: {
                                        show: true
                                    }
                                }
                            },
                            calculable: true,
                            xAxis: {
                                data: xAxisData
                            },
                            yAxis: {

                            },
                            series: [{
                                type: 'bar',
                                data: yAxisData,
                                markPoint: {
                                    data: [{
                                            type: 'max',
                                            name: 'Max'
                                        },
                                        {
                                            type: 'min',
                                            name: 'Min'
                                        }
                                    ]
                                },
                                markLine: {
                                    data: [{
                                        type: 'average',
                                        name: 'Avg'
                                    }]
                                },
                                showBackground: true,
                                backgroundStyle: {
                                    color: 'rgba(180, 180, 180, 0.2)'
                                },
                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length];
                                        },
                                        colorStops: [{
                                            offset: 0,
                                            color: 'rgba(80, 141, 255, 0.8)'
                                        }, {
                                            offset: 1,
                                            color: 'rgba(80, 141, 255, 0)'
                                        }],
                                        barBorderRadius: [10, 10, 0, 0],
                                    }
                                }
                            }, ],
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 5,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            },
                        };
                        // Renderiza el gráfico
                        option && chart.setOption(option, true);
                        chart.resize();
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="autoreporte" style="width: 100%;height:400px;"></div>
                    <script type="text/javascript">
                        // Initialize the echarts instance based on the prepared dom
                        var chartDom0 = document.getElementById('autoreporte');
                        var myChart01 = echarts.init(chartDom0);
                        var option;
                        option = {
                            title: {
                                text: 'Eventos por clasificación',
                                subtext: 'Muestra la cantidad Eventos por tipo',
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: '{a} <br/>{b}: {c} ({d}%)'
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: "bottom",
                                data: <?php echo json_encode($abp); ?>, // agregar las leyendas correspondientes a los datos
                            },
                            series: [{
                                name: 'Clasificación del evento',
                                type: 'pie',
                                radius: ['30%', '50%'],
                                center: ['50%', '50%'],

                                itemStyle: {
                                    borderRadius: 10,
                                    borderColor: '#fff',
                                    borderWidth: 2
                                },
                                label: {
                                    show: true,
                                    formatter(param) {
                                        // correct the percentage
                                        return param.name + ' (' + param.percent + '%)';
                                    }
                                },
                                data: <?php echo json_encode($abp); ?>,
                                emphasis: {
                                    itemStyle: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                                    }
                                }
                            }]
                        };
                        option && myChart01.setOption(option);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->