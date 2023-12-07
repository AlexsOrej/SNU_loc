<head>
    <meta charset="utf-8" />
    <title>Inventario/recursos fisicos</title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
</head>
<div class="block-header">
    <?php
    $mantPla = $mantPlaneado->planeadas;
    $mantCum = $mantSinEjecutar->ejecutadas;
    $mantEjec = $mantCumplido->cumplidas;
    $valor0[] = $grafico->ObtenerPorcentaje($mantPlaneado->planeadas, $mantPlaneado->planeadas);
    $valor[] = $grafico->ObtenerPorcentaje($mantCumplido->cumplidas, $mantPlaneado->planeadas);
    $valor1[] = $grafico->ObtenerPorcentaje($mantSinEjecutar->ejecutadas, $mantPlaneado->planeadas);
    ?>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">devices_other</i>
            </div>
            <div class="content">
                <div class="text">Activos Registrados</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                    <?php echo $totaProductos->total ?></div>
            </div>
        </div>
    </div>
    <?php foreach ($productos as $value) : ?>
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="info-box hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons col-orange">query_stats</i>
                </div>
                <div class="content">
                    <div class="text"><?php echo $value->estado ?> </div>
                    <div class="number"><?php echo $value->cantidad ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box hover-zoom-effect">
            <div class="icon">
                <i class="material-icons col-orange">build_circle</i>
            </div>
            <div class="content">
                <div class="text">Mantenimientos sin ejecución </div>
                <div class="number"><?= $mantPendientes->sinManteniento ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box hover-zoom-effect bg-pink">
            <div class="icon">
                <i class="material-icons col-orange">view_in_ar</i>
            </div>
            <div class="content">
                <div class="text">Activos en prestamo</div>
                <div class="number"><?= $prestamos->total_prestamos ?></div>
            </div>
        </div>
    </div>
    <!-- FIN primer BLOQUE-->
</div>
</div>
<div class="row clearfix">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="doc_pro" style="width: 100%; height: 400px;"></div>
                <script>
                    var chartDom = document.getElementById('doc_pro');
                    var myChart = echarts.init(chartDom);
                    const estadoActivos = <?= json_encode($estadoActivos) ?>;
                    const totalActivos = <?= json_encode($totalActivos) ?>;
                    const colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];
                    option = {
                        title: {
                            text: 'Productos x estado',
                            subtext: 'Muestra la cantidad item por estado',
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
                        xAxis: {
                            type: 'category',
                            data: estadoActivos
                        },
                        yAxis: {
                            type: 'value'
                        },
                        series: [{
                            data: totalActivos,
                            type: 'bar',
                            itemStyle: {
                                color: colors[0]
                            },
                            itemStyle: {
                                normal: {
                                    type: 'linear',
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length];
                                    },
                                },
                            },

                        }],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 5,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },
                    };
                    option && myChart.setOption(option);
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="abs" style="width: 100%; height: 400px;"></div>
                <script>
                    var abs = document.getElementById('abs');
                    var myChartabs = echarts.init(abs);
                    option = {
                        legend: {
                            top: 'bottom'
                        },
                        title: {
                            text: 'Productos x sede',
                            subtext: 'Muestra la cantidad item por sede',
                            left: 'center',
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: '{a} <br/>{b}: {c} ({d}%)'
                        },
                        legend: {
                            orient: 'horizontal',
                            bottom: "bottom",
                            data: <?php echo json_encode($abs); ?>, // agregar las leyendas correspondientes a los datos
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
                        series: [{
                            name: 'Datos sede',
                            type: 'pie',
                            radius: [5, 100],
                            center: ['50%', '50%'],
                            roseType: 'area',
                            itemStyle: {
                                borderRadius: 4
                            },
                            data: <?php echo json_encode($abs); ?>,
                        }]
                    };
                    option && myChartabs.setOption(option);
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="doc_Mant" style="width: 100%; height: 400px;"></div>
                <?
                // Calcular los porcentajes

                @$planeados_porcentaje = round(($mantenimientos['Planeados'] / $mantenimientos['total']) * 100, 2);
                @$ejecucion_porcentaje = round(($mantenimientos['Ejecutados'] / $mantenimientos['total']) * 100, 2);
                @$verificacion_porcentaje = round(($mantenimientos['Verificados'] / $mantenimientos['total']) * 100, 2);
                ?>
                <script>
                    var chartMant = document.getElementById('doc_Mant');
                    var myChartMant = echarts.init(chartMant);
                    option = {
                        title: {
                            text: 'Estado del Mantenimiento',
                            subtext: 'Muestra el estado del mantenimiento',
                            left: 'center',
                        },
                        tooltip: {
                            trigger: 'axis',
                            formatter: function(params) {
                                if (params.length > 1) {
                                    const value = params[0].data;
                                    const percentage = params[1].data;
                                    return `${value} (${percentage}%)`;
                                } else {
                                    const value = params[0].data;
                                    const percentage = (value / <?php echo $mantenimientos['total'] ?>) * 100;
                                    return `${value} (${percentage.toFixed(2)}%)`;
                                }
                            }
                        },
                        legend: {
                            orient: 'horizontal',
                            bottom: "bottom",
                        },
                        xAxis: {
                            type: 'category',
                            data: ['Planeados', 'Ejecutados', 'Verificados']

                        },
                        yAxis: {},

                        series: [{

                            data: [
                                <?php echo $mantenimientos['Planeados'] ?>,
                                <?php echo $mantenimientos['Ejecutados']  ?>,
                                <?php echo $mantenimientos['Verificados'] ?>
                            ],
                            type: 'bar',
                            yAxisIndex: 0,

                            itemStyle: {
                                color: function(params) {
                                    return colors[params.dataIndex % colors.length + 2];
                                },
                            },
                            itemStyle: {
                                normal: {
                                    type: 'linear',
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length + 2];
                                    },
                                },
                            },
                        }],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 5,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },
                    };
                    option && myChartMant.setOption(option);
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="rot_01" style="width: 100%; height: 400px;"></div>
                <script>
                    var chartMant01 = document.getElementById('rot_01');
                    var myChartRot1 = echarts.init(chartMant01);

                    var data0 = <?php echo json_encode($dataRotaUbiMov); ?>;

                    var categories = data0.map(function(item) {
                        return item.nombre;
                    });

                    var entradas = data0.map(function(item) {
                        return item.entradas;
                    });

                    var salidas = data0.map(function(item) {
                        return item.salidas;
                    });
                    option = {
                        title: {
                            text: 'Movimiento Inventario Rotativo',
                            subtext: 'Muestra las ubicaciones con  movimiento de insumos ',
                            left: 'center',
                        },
                        tooltip: {
                            trigger: 'axis',
                        },
                        legend: {
                            orient: 'horizontal',
                            bottom: "bottom",
                        },
                        xAxis: {
                            type: 'category',
                            data: categories

                        },
                        yAxis: {
                            type: 'value'
                        },

                        series: [{
                                name: 'Entradas',
                                data: entradas,
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
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length + 1];
                                    },
                                },
                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length + 0];
                                        },
                                    },
                                },
                            },
                            {
                                name: 'Salidas',
                                data: salidas,
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
                                showBackground: true,
                                backgroundStyle: {
                                    color: 'rgba(220, 220, 220, 0.8)'
                                },
                                itemStyle: {
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length + 0];
                                    },
                                },
                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length + 3];
                                        },
                                    },
                                },
                            },


                        ],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 5,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },
                    };
                    option && myChartRot1.setOption(option);
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">

                <div id="rot_02" style="width: 100%; height: 400px;"></div>
                <script>
                    var chartMant02 = document.getElementById('rot_02');
                    var myChartRot2 = echarts.init(chartMant02);
                    var data02 = <?php echo json_encode($datosRotaGasto); ?>;
                    var anios = [];
                    var meses = [];
                    var ingresos = [];
                    var egresos = [];
                    for (var i = 0; i < data02.length; i++) {
                        anios.push(data02[i].anio);
                        meses.push(data02[i].mes);
                        ingresos.push(data02[i].total_ingresos);
                        egresos.push(data02[i].total_egresos);
                    }
                    option = {
                        title: {
                            text: 'Consumo Promedio Mensual',
                            subtext: 'Muestra el flujo de dinero en el tiempo ',
                            left: "center",
                            top: "top",
                        },
                        tooltip: {
                            trigger: 'axis',
                        },
                        legend: {
                            data: ['Ingresos', 'Egresos'],
                            bottom: "top",
                        },
                        grid: {
                            left: '3%',
                            right: '4%',
                            bottom: '10%',
                            containLabel: true
                        },
                        xAxis: {
                            data: meses.map(function(mes) {
                                return mes + '-' + anios[0];
                            }),
                            boundaryGap: false,
                        },
                        yAxis: {
                            type: 'value',
                        },

                        series: [{
                                name: 'Ingresos',
                                data: ingresos,
                                type: 'line',
                                stack: 'Total',
                                // smooth: true,
                                areaStyle: {},
                                emphasis: {
                                    focus: 'series'
                                },
                                // label: {
                                //     show: true,
                                //     position: 'top'
                                // },

                                itemStyle: {
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length + 1];
                                    },
                                },
                            },
                            {
                                name: 'Egresos',
                                data: egresos,
                                type: 'bar',
                                type: 'line',
                                stack: 'Total',
                                // smooth: true,
                                areaStyle: {},
                                emphasis: {
                                    focus: 'series'
                                },
                                // label: {
                                //     show: true,
                                //     position: 'top'
                                // },

                                showBackground: true,
                                backgroundStyle: {
                                    color: 'rgba(220, 220, 220, 0.8)'
                                },

                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length + 3];
                                        },
                                    },
                                },
                            },


                        ],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 5,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },
                    };
                    option && myChartRot2.setOption(option);
                </script>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <?
                //  print_r($datosRotainsumos);                
                //  $datosRotainsumos =json_encode($datosRotainsumos); 
                ?>
                <div id="rot_03" style="width: 100%; height: 400px;"></div>
                <script>
                    var chartMant03 = document.getElementById('rot_03');
                    var myChartRot3 = echarts.init(chartMant03);
                    var insumos = <?= json_encode($datosRotainsumos); ?>;
                    var nombres = [];
                    var cantidades = [];
                    var stock_min = [];
                    var stock_max = [];

                    insumos.forEach(function(insumo) {
                        nombres.push(insumo.nombre);
                        cantidades.push(insumo.cantidad_actual);
                        stock_min.push(insumo.stock_min);
                        stock_max.push(insumo.stock_max);
                    });
                    option = {
                        title: {
                            text: 'Estado del Stock',
                            subtext: 'Muestra los insumos que esta bajo el stock ',
                            left: "center",
                            top: "top",
                        },
                        tooltip: {
                            trigger: 'axis',
                        },
                        legend: {
                            data: ['Cantidad actual', 'Stock mínimo', 'Stock máximo'],
                            bottom: "top",
                        },
                        grid: {
                            left: '1%',
                            right: '1%',
                            bottom: '8%',
                            containLabel: true
                        },
                        yAxis: {
                            type: 'value',
                        },
                        xAxis: {
                            data: nombres,
                            boundaryGap: true,
                            axisLabel: {
                                interval: 0,
                                rotate: 0
                            },
                            splitLine: {
                                show: true
                            }
                        },

                        series: [{
                                name: 'Cantidad actual',
                                data: cantidades,
                                type: 'bar',
                                // stack: 'Total',
                                // smooth: true,
                                // areaStyle: {},
                                // emphasis: {
                                //     focus: 'series'
                                // },
                                // label: {
                                //     show: true,
                                //     position: 'top'
                                // },

                                itemStyle: {
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length + 1];
                                    },
                                },
                            },
                            {
                                name: 'Stock mínimo',
                                data: stock_min,
                                type: 'bar',
                                // stack: 'Total',
                                // smooth: true,
                                // areaStyle: {},
                                // emphasis: {
                                //     focus: 'series'
                                // },
                                // label: {
                                //     show: true,
                                //     position: 'top'
                                // },

                                showBackground: true,
                                backgroundStyle: {
                                    color: 'rgba(220, 220, 220, 0.8)'
                                },

                                itemStyle: {
                                    normal: {
                                        type: 'linear',
                                        color: function(params) {
                                            return colors[params.dataIndex % colors.length + 3];
                                        },
                                    },
                                },
                            },
                            // {
                            //     name: 'Stock máximo',
                            //     data: stock_max,
                            //     type: 'bar',
                            //     // type: 'line',
                            //     // stack: 'Total',
                            //     // smooth: true,
                            //     // areaStyle: {},
                            //     // emphasis: {
                            //     //     focus: 'series'
                            //     // },
                            //     // label: {
                            //     //     show: true,
                            //     //     position: 'top'
                            //     // },

                            //     showBackground: true,
                            //     backgroundStyle: {
                            //         color: 'rgba(220, 220, 220, 0.8)'
                            //     },

                            //     itemStyle: {
                            //         normal: {
                            //             type: 'linear',
                            //             color: function(params) {
                            //                 return colors[params.dataIndex % colors.length + 3];
                            //             },
                            //         },
                            //     },
                            // },

                        ],
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 5,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        },
                    };
                    option && myChartRot3.setOption(option);
                </script>
            </div>
        </div>
    </div>
</div>