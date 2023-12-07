<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Talento Humano</title>
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
                    <div class="text">Empleados</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                        <?= $totalpersonal ?>
                    </div>
                </div>
            </div>
        </div>       
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="text-center">
                    <div class="text col-md-12">
                        <div class="content">
                            <div class="text">SEXO</div>
                            <?
                            echo '<span class="label label-success">Masculino: ' . $PorSexom->masculino . '</span>';
                            echo '<span class="label label-success">Femenino: ' . $PorSexof->femenino . '</span>';
                            ?>
                        </div>
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
                    <div class="text">Promedio de Edad</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= number_format($PromedioEdad, 2) ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Total dias con ausencias</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?= $DiasAusencia->total_dias_ausente ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <div class="col-md-12">
        <div class="row">
            <? if ($totalpersonal == 0) : ?>
            <? else : ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!-- Prepare a DOM with a defined width and height for ECharts -->
                            <div id="main" style="width: 100%; height: 400px;"></div>
                            <script>
                                // Convierte los datos a un objeto de JavaScript
                                const data = <?= json_encode($PorEstratoYEducacion) ?>;
                                // Lista de colores para las barras
                                var colors = ['#5793f3', '#d14a61', '#675bba'];
                                // Extrae los valores de los datos para la configuración de ECharts
                                const xAxisData = data.map(item => item.nivel_educativo);
                                const yAxisData = data.map(item => item.Cantidad);
                                // Calcula el total de las cantidades
                                const total = yAxisData.reduce((a, b) => a + b);
                                // Convierte los valores en porcentajes
                                const yAxisDataPorcentaje = yAxisData.map(valor => (valor / <?= $totalpersonal ?> * 100).toFixed(2));
                                // Inicializa el gráfico
                                const chart = echarts.init(document.getElementById('main'));
                                // Configura la opción del gráfico
                                option = {
                                    title: {
                                        name: 'Formación Academica',
                                        text: 'Formación ',
                                        subtext: 'Academica',
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
                                            magicType: {
                                                show: true,
                                                type: ['line', 'bar']
                                            },
                                            restore: {
                                                show: true
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
                                    yAxis: {},
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
                            <div id="main2" style="width: 100%;height:400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('main2');
                                var myChart = echarts.init(chartDom);
                                var option;
                                option = {
                                    title: {
                                        text: 'Novedades',
                                        subtext: 'Muestra la cantidad de novedades registradas',
                                        left: 'center',
                                    },
                                    tooltip: {
                                        trigger: 'item',
                                        formatter: '{a} <br/>{b}: {c} ({d}%)'
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?php echo json_encode($aus); ?>, // agregar las leyendas correspondientes a los datos
                                    },
                                    series: [{
                                        name: 'Tipo de Novedad',
                                        type: 'pie',
                                        radius: '50%',
                                        roseType: 'area',
                                        itemStyle: {
                                            borderRadius: 4
                                        },
                                        data: <?php echo json_encode($aus); ?>,
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
                            <div id="estado_civil" style="width: 100%; height: 400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('estado_civil');
                                var estcivil = echarts.init(chartDom);
                                const est_civil = <?= json_encode($PorEstadoCivil) ?>;
                                // Lista de colores para las barras
                                var colors = ['#5793f3', '#d14a61', '#675bba'];
                                // Extrae los valores de los datos para la configuración de ECharts
                                const xData = est_civil.map(item => item.count);
                                const yData = est_civil.map(item => item.estado_civil);
                                var option;
                                option = {
                                    xAxis: {
                                        type: 'category',
                                        data: yData
                                    },
                                    title: {
                                        name: 'Estado Civil',
                                        text: 'Estado ',
                                        subtext: 'Civil',
                                        left: 'center'
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'cross',
                                            crossStyle: {
                                                color: '#999'
                                            }
                                        },
                                        formatter: function(params) {
                                            return params[0].name + '<br />Total: ' + params[0].data + ' (' + yAxisDataPorcentaje[params[0].dataIndex] + '%)';
                                        }
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?= json_encode($PorEstadoCivil) ?>, // agregar las leyendas correspondientes a los datos
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
                                            restore: {
                                                show: true
                                            },
                                            saveAsImage: {
                                                show: true
                                            }
                                        }
                                    },
                                    calculable: true,
                                    yAxis: {},
                                    series: [{
                                        data: xData,
                                        type: 'bar',
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
                                        },

                                        emphasis: {
                                            focus: 'series'
                                        },
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
                                        }
                                    }]
                                };
                                option && estcivil.setOption(option);
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="estrato" style="width: 100%; height: 400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('estrato');
                                var estratosocial = echarts.init(chartDom);
                                const estrat = <?= json_encode($PorEstratoSocial) ?>;
                                // Lista de colores para las barras
                                var colors = ['#9E0894', '#E8C63F', '#EA76E3', '#75EBDD', '#059E8D'];
                                // Extrae los valores de los datos para la configuración de ECharts
                                const xcData = estrat.map(item => item.total);
                                const ycData = estrat.map(item => item.estrato);

                                var option;
                                option = {
                                    xAxis: {
                                        type: 'category',
                                        data: ycData
                                    },
                                    title: {
                                        name: 'Estrato',
                                        text: 'Estrato',
                                        subtext: 'Socio Economico',
                                        left: 'center'
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        formatter: function(params) {
                                            return params[0].name + '<br />Total: ' + params[0].data + ' (' + yAxisDataPorcentaje[params[0].dataIndex] + '%)';
                                        }
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?= json_encode($PorEstratoSocial) ?>, // agregar las leyendas correspondientes a los datos
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
                                            restore: {
                                                show: true
                                            },
                                            saveAsImage: {
                                                show: true
                                            }
                                        }
                                    },
                                    yAxis: {},
                                    series: [{
                                        data: xcData,
                                        type: 'bar',

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
                                                barBorderRadius: [10, 20, 0, 0],
                                            }
                                        }
                                    }]
                                };
                                option && estratosocial.setOption(option);
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="ausxmes" style="width: 100%;height:400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('ausxmes');
                                var myChart2 = echarts.init(chartDom);
                                var option;
                                option = {
                                    title: {
                                        text: 'Ausencias Por Mes',
                                        subtext: 'Meses con novedades registradas',
                                        left: 'center',
                                    },
                                    tooltip: {
                                        trigger: 'item',
                                        formatter: '{a} <br/>{b}: {c} ({d}%)'
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?php echo json_encode($ausxmes); ?>, // agregar las leyendas correspondientes a los datos
                                    },
                                    series: [{
                                        name: 'Tipo de Novedad',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        data: <?php echo json_encode($ausxmes); ?>,
                                        avoidLabelOverlap: false,
                                        itemStyle: {
                                            borderRadius: 10,
                                            borderColor: '#fff',
                                            borderWidth: 2
                                        },
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },

                                        labelLine: {
                                            show: false
                                        },

                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: 40,
                                                fontWeight: 'bold'
                                            }
                                        },
                                    }]
                                };
                                option && myChart2.setOption(option);
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="tipo_ausencia_id" style="width: 100%;height:400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('tipo_ausencia_id');
                                var myChart0 = echarts.init(chartDom);
                                var option;
                                option = {
                                    title: {
                                        text: 'Dias de Ausencia',
                                        subtext: 'muestra la cantidad x tipo de Novedad',
                                        left: 'center',
                                    },
                                    tooltip: {
                                        trigger: 'item',
                                        formatter: '{a} <br/>{b}: {c} ({d}%)'
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?php echo json_encode($ausxtipo); ?>, // agregar las leyendas correspondientes a los datos
                                    },
                                    series: [{
                                        name: 'Tipo de Novedad',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        // adjust the start angle                                  
                                        label: {
                                            show: true,
                                            formatter(param) {
                                                // correct the percentage
                                                return param.name + ' (' + param.percent * 2 + '%)';
                                            }
                                        },
                                        data: <?php echo json_encode($ausxtipo); ?>,
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
                            <div id="pordiagnostico" style="width: 100%;height:400px;"></div>
                            <script type="text/javascript">
                                // Initialize the echarts instance based on the prepared dom
                                var chartDom = document.getElementById('pordiagnostico');
                                var myChart0 = echarts.init(chartDom);
                                var option;
                                option = {
                                    title: {
                                        text: 'Ausencias X diagnosticos',
                                        subtext: 'muestra la cantidad ausencias por cada diagnostico',
                                        left: 'center',
                                    },
                                    tooltip: {
                                        trigger: 'item',
                                        formatter: '{a} <br/>{b}: {c} ({d}%)'
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: "bottom",
                                        data: <?php echo json_encode($ausxmes); ?>, // agregar las leyendas correspondientes a los datos
                                    },
                                    series: [{
                                        name: 'Tipo de Novedad',
                                        type: 'pie',
                                        radius: '50%',
                                        data: <?php echo json_encode($ausxmes); ?>,
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
            <? endif; ?>
        </div>
    </div>
</body>

</html>