<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> Procesos que no han realizado actualización documental </h3>
                </div>
                <div class="panel-body">
                    <?php if (!empty($sinsolicitud)) {
                        foreach ($sinsolicitud as $value) : ?>
                            <div class="col-md-4">
                                <span class="badge bg-light-blue"> <?= $value->NombreProceso ?> </span>
                                <span class="badge bg-deep-orange"> <?= $value->Iniciales ?> </span>
                            </div>
                    <?php
                        endforeach;
                    } else {
                        echo  "<div class='alert alert-info'>En el periodo comprendido <strong>" . $_REQUEST['desde'] . "</strong> hasta <strong>" . $_REQUEST['hasta'] . "</strong> ningun proceso ha dejado de realizar solicitudes</div>";
                    }; ?>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div id="doc_pro" style="width: 100%;height:400px;"></div>
                            </div>
                            <?php if ($solicitudes) {  ?>
                                <div class="col-md-4">
                                    <div class="table-responsive">
                                        <table id="" class="table bg-blue table-bordered table-condensed" style="width: min-content;">
                                            <thead>
                                                <tr>
                                                    <th>Información</th>
                                                    <th>Solicitud</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaBody01">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php }
                            if ($promrespuesta) {  ?>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="body">                                           
                                            <div class="row">                                              
                                           <div class="col-md-4">
                                                <table class="table bg-blue table-bordered table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>Información</th>
                                                            <th>Promedio de (Días)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaBody1">
                                                        <!-- Aquí se generará la tabla de datos dinámicamente -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-8">
                                                <div id="graficoPastel" style="width: 100%; height: 400px;"></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php  }
                            if ($solicitudesxproceso) { ?>
                                <div class="col-md-8">
                                    <div class="body">
                                        <div class="card">
                                            <div id="sinsolitudes" style="width: 100%; height: 400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];

    var myChart = echarts.init(document.getElementById('doc_pro'));
    var datos = <?= $solicitudes ?>
    // Agrupa los datos por TipoSolicitud
    // Datos reorganizados para agrupar por TipoSolicitud
    var datosAgrupados = {};

    datos.forEach(function(item) {
        if (!datosAgrupados[item.TipoSolicitud]) {
            datosAgrupados[item.TipoSolicitud] = {};
        }
        datosAgrupados[item.TipoSolicitud][item.TipoDocumento] = parseInt(item.cantidad);
    });

    var series = [];

    // Crea una serie para cada TipoSolicitud
    for (var tipoSolicitud in datosAgrupados) {
        var data = [];

        for (var tipoDocumento in datosAgrupados[tipoSolicitud]) {
            data.push({
                name: tipoDocumento,
                value: datosAgrupados[tipoSolicitud][tipoDocumento]
            });
        }

        series.push({
            name: tipoSolicitud,
            type: 'bar',
            data: data,
            itemStyle: {
                // Hacer las barras redondeadas
                barBorderRadius: [5, 5, 0, 0]
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
            label: {
                show: true,
                position: 'top',
                valueAnimation: true
            }
        });
    }

    // Configura las opciones del gráfico
    var option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            },
            formatter: function(params) {
                var tip = params[0].name + '<br>';
                params.forEach(function(param) {
                    tip += param.seriesName + ' (' + param.data.name + '): ' + param.data.value + '<br>';
                });
                return tip;
            }
        },
        legend: {
            data: Object.keys(datosAgrupados)
        },
        xAxis: {
            type: 'category',
            data: Object.keys(datosAgrupados[Object.keys(datosAgrupados)[0]])
        },
        yAxis: {},
        series: series,

    };

    // Dibuja el gráfico
    myChart.setOption(option);
</script>
<script type="text/javascript">
    // Datos para el gráfico de pastel (debes obtenerlos de tu base de datos)
    var datos = <?php echo $promrespuesta; ?>;

    // Obtener los tipos de documento y tiempos promedio
    var tiposDocumento = datos.map(function(item) {
        return item.TipoDocumento;
    });
    var tiemposPromedio = datos.map(function(item) {
        return item.TiempoPromedioRespuestaEnDias;
    });

    // Configurar el gráfico de pastel
    var graficoPastel = echarts.init(document.getElementById('graficoPastel'));
    // Configurar el gráfico de pastel como un medio donut

    // Configurar el gráfico de pastel como un Half Doughnut Chart
    var opcionesHalfDoughnut = {
        title: {
            text: 'Promedio de Respuesta',
            subtext: 'Por tipo de información',
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c} Días ({d}%)'
        },
        legend: {
            orient: 'horizontal',
            bottom: '5%',
            data: tiposDocumento
        },
        series: [{
            name: 'Tiempos Promedio',
            type: 'pie',
            radius: ['40%', '70%'], // Configurar los radios para un medio donut
            center: ['50%', '50%'], // Ajustar el centro del gráfico
            startAngle: 180,

            data: datos.map(function(item) {
                return {
                    name: item.TipoDocumento,
                    value: item.TiempoPromedioRespuestaEnDias
                };
            }),
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            label: {
                show: false // Ocultar etiquetas en el gráfico
            },
            labelLine: {
                show: false // Ocultar líneas de etiqueta en el gráfico
            }
        }]
    };

    // Mostrar el gráfico de pastel como un Half Doughnut Chart
    graficoPastel.setOption(opcionesHalfDoughnut);


    // Crear la tabla de datos dinámicamente
    var tablaBody = document.getElementById("tablaBody1");
    datos.forEach(function(dato) {
        var fila = document.createElement("tr");
        var celdaTipoDocumento = document.createElement("td");
        var celdaTiempoPromedio = document.createElement("td");

        celdaTipoDocumento.textContent = dato.TipoDocumento.charAt(0).toUpperCase() + dato.TipoDocumento.slice(1);
        celdaTiempoPromedio.textContent = dato.TiempoPromedioRespuestaEnDias;

        fila.appendChild(celdaTipoDocumento);
        fila.appendChild(celdaTiempoPromedio);

        tablaBody.appendChild(fila);
    });
</script>

<script type="text/javascript">
    // Datos de ejemplo (reemplaza con tus datos reales)
    var datos = <?php echo $solicitudesxproceso; ?>;

    // Obtener los tipos de documento y tiempos promedio
    var proceso = datos.map(function(item) {
        return item.Proceso;
    });
    var valor = datos.map(function(item) {
        return item.cantidad;
    });

    // Crear instancia de gráfico ECharts
    var grafico = echarts.init(document.getElementById('sinsolitudes'));

    // Configurar opciones del gráfico
    var opciones = {
        title: {
            text: 'Procesos con solicitudes',
            subtext: '',
            left: 'center',
        },
        tooltip: {
            trigger: 'item'
        },

        legend: {
            bottom: '5%',
            orient: 'horizontal',
        },

        calculable: true,
        xAxis: {
            type: 'category',
            data: proceso
        },
        yAxis: {
            type: 'value',
            name: ''
        },
        series: [{
            name: function(params) {
                return proceso[params.dataIndex]
            },
            data: valor,
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
            label: {
                show: true,
                position: 'inside'
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
        }]
    };

    // Establecer opciones en el gráfico
    grafico.setOption(opciones);
</script>

<script>
    // Datos en formato JSON
    var datos = <?= $solicitudes ?>;

    // Organizar los datos por TipoDocumento
    var datosAgrupados = {};

    datos.forEach(function(dato) {
        if (!datosAgrupados[dato.TipoDocumento]) {
            datosAgrupados[dato.TipoDocumento] = [];
        }
        datosAgrupados[dato.TipoDocumento].push(dato);
    });

    // Referencia al tbody de la tabla
    var tablaBody = document.getElementById("tablaBody01");

    // Itera sobre los datos agrupados y crea filas en la tabla
    for (var tipoDocumento in datosAgrupados) {
        var primeraFila = true;

        datosAgrupados[tipoDocumento].forEach(function(dato) {
            var fila = document.createElement("tr");
            var celdaTipoDocumento = document.createElement("td");
            var celdaTipoSolicitud = document.createElement("td");
            var celdaCantidad = document.createElement("td");

            celdaTipoSolicitud.textContent = dato.TipoSolicitud.charAt(0).toUpperCase() + dato.TipoSolicitud.slice(1);
            celdaCantidad.textContent = dato.cantidad;

            if (primeraFila) {
                celdaTipoDocumento.textContent = tipoDocumento.charAt(0).toUpperCase() + tipoDocumento.slice(1);
                celdaTipoDocumento.setAttribute("rowspan", datosAgrupados[tipoDocumento].length);
                primeraFila = false;
            } else {
                celdaTipoDocumento.style.display = "none"; // Oculta las celdas repetidas
            }

            fila.appendChild(celdaTipoDocumento);
            fila.appendChild(celdaTipoSolicitud);
            fila.appendChild(celdaCantidad);

            tablaBody.appendChild(fila);
        });
    }
</script>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 14px;
    }

    th,
    td {
        text-align: center;
        padding: 5px;
        /* border-bottom: 1px solid #ddd; */
    }

    td:first-letter {
        text-transform: uppercase;
    }

    tr:hover {
        background-color: #f5f5f5;
        color: black;
    }
    
</style>