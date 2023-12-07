<!DOCTYPE html>
<html>
<?
// print_r($AccionxProcesos); 
?>
<head>
    <meta charset="utf-8" />
    <title>Indicadores</title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
</head>
<body>
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">Indicadores</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                        <?= $total ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">Cumplidos(6 meses)</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                        <?= $cumplidos ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">No Cumplidos(6 meses)</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= $total - $cumplidos ?></div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Total dias con ausencias</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">
                        <?= $DiasAusencia->total_dias_ausente ?>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="xproceso" style="width: 100%;height:400px;"></div>
                <script type="text/javascript">
                    // Initialize the echarts instance based on the prepared dom
                    var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];
                    var chartDom = document.getElementById('xproceso');
                    var myChart = echarts.init(chartDom);
                    var option;
                    option = {
                        title: {
                            text: 'Por Procesos',
                            subtext: 'Muestra la cantidad de indicadores por procesos',
                            left: 'center',
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: '{a} <br/>{b}: {c} ({d}%)'
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                mark: {
                                    show: true
                                },
                                dataView: {
                                    show: true,
                                    readOnly: false
                                },
                                saveAsImage: {
                                    show: true
                                }
                            }
                        },
                        legend: {
                            orient: 'horizontal',
                            top: "bottom",
                            data: <?php echo json_encode($xprocesos); ?>, // agregar las leyendas correspondientes a los datos
                        },
                        series: [{
                            name: 'Por Procesos',
                            type: 'pie',
                            radius: ['10%', '60%'],
                            roseType: 'area',
                            itemStyle: {
                                borderRadius: 5,
                                color: function(params) {
                                    return colors[params.dataIndex % colors.length];
                                },
                            },
                            data: <?php echo json_encode($xprocesos); ?>,
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }]
                    };
                    option && myChart.setOption(option);
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
                    const data = <?= json_encode($metaxprocesos) ?>;
                    // Lista de colores para las barras
                    // var colors = ['#e6b4e5','#a3a8e2','#2b91c8',  '#5793f3', '#d14a61', '#675bba','#ff8feb','#ffbf90','#d6f8ca','#ff95aa','#f6e5a6'];
                    // Extrae los valores de los datos para la configuración de ECharts
                    const xAxisData = data.map(item => item.Iniciales);
                    const yAxisData = data.map(item => item.cantidad_indicadores_alcanzaron_meta);
                    // Calcula el total de las cantidades
                    const total = yAxisData.reduce((a, b) => a + b);
                    // Convierte los valores en porcentajes
                    const yAxisDataPorcentaje = yAxisData.map(valor => (valor / <?= $total ?> * 100).toFixed(2));
                    // Inicializa el gráfico
                    const chart = echarts.init(document.getElementById('main'));
                    // Configura la opción del gráfico
                    option = {
                        title: {
                            name: 'Metas Por proceso',
                            text: 'Cumplimiento',
                            subtext: 'Muestra el Cumplimiento de metas por proceso',
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
                            left: 'left'

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
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '3%',
                            containLabel: true
                        },
                        calculable: true,
                        xAxis: {
                            data: xAxisData
                        },                        
                        yAxis: {},
                        series: [{
                            type: 'bar',
                            data: yAxisData,
                            markLine: {
                                data: [{
                                    type: 'average',
                                    name: 'Avg'
                                }]
                            },
                            label: {
                                show: true,
                                position: 'inside'
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
                        }],
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
                <div id="accions" style="width: 100%;height:400px;"></div>
                <script type="text/javascript">
                    // Initialize the echarts instance based on the prepared dom
                    var chartDom = document.getElementById('accions');
                    var myChart0 = echarts.init(chartDom);
                    var option;
                    option = {
                        title: {
                            text: 'Acciones',
                            subtext: 'Muestra la cantidad de indicadores sin acciones',
                            left: 'center',
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: '{a} <br/>{b}: {c} ({d}%)'
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
                        legend: {
                            orient: 'horizontal',
                            bottom: "bottom",
                            data: <?php echo json_encode($axprocesos); ?>, // agregar las leyendas correspondientes a los datos
                        },
                        series: [{
                            name: 'Proceso',
                            type: 'pie',
                            radius: ['30%', '50%'],
                            // adjust the start angle                                  
                            label: {
                                show: true,
                                formatter(param) {
                                    // correct the percentage
                                    return param.name + ' (' + param.percent * 2 + '%)';
                                }
                            },
                            data: <?php echo json_encode($axprocesos); ?>,
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