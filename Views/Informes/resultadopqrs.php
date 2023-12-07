<style>
    table {
        width: min-content;
        width: 100%;
        border-collapse: collapse;
        border-radius: 14px;
    }

    th,
    td {
        /* text-align: center; */
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
<section>
    <div class="card">
        <div class="body">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-8 aling-left">
                        <div id="tiempoRespuesta" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="col-md-4">
                        <div id="tblTiempoRespuesta" class="aling-center"></div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <div id="grafico-pie" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div id="tablaDatosContainer2" class="aling-center"></div>
                    </div>

                </div>

                <div class="col md-12">
                    <div class="col-md-8">
                        <div id="grafico-pie2" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div id="tablaDatosContainer3" class=""></div>
                        <table class="table table-bordered bg-blue table-hover" id="tablaDatos3">
                            <thead>
                                <tr>
                                    <th>Segmento</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se generan las filas de la tabla con JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Datos para el gráfico
    var datos = <?php echo $datosJson; ?>;

    // Preparar datos para el gráfico
    var tiposSolicitud = datos.map(function(item) {
        return item.TipoSolicitud;
    });
    var promediosTiempo = datos.map(function(item) {
        return item.PromedioTiempoRespuestaEnDias;
    });

    // Configurar el gráfico
    var grafico = echarts.init(document.getElementById('tiempoRespuesta'));
    var opciones = {
        title: {
            text: 'Promedio de Tiempo de Respuesta',
            left: 'center'
        },

        xAxis: {
            type: 'category',
            data: tiposSolicitud
        },
        yAxis: {
            type: 'value',
            name: 'Días'
        },
        series: [{
            name: 'Promedio de Tiempo',
            type: 'bar',
            data: promediosTiempo,
            label: {
                show: true,
                position: 'top',
                valueAnimation: true
            },
            itemStyle: {
                borderRadius: 15,
                borderColor: '#fff',
                borderWidth: 3
            },
        }]
    };

    // Mostrar el gráfico
    grafico.setOption(opciones);

    // Obtén una referencia al elemento contenedor de la tabla
    var tablaContainer = document.getElementById('tblTiempoRespuesta');

    // Crea la tabla y sus elementos
    var tabla = document.createElement('table');
    tabla.id = 'tablaDatos';
    tabla.className = 'table table-bordered bg-blue table-hover';

    // Crea la fila de encabezado
    var encabezado = document.createElement('thead');
    var encabezadoFila = document.createElement('tr');
    encabezadoFila.innerHTML = '<th> Solicitud</th><th>Dias</th>';
    encabezado.appendChild(encabezadoFila);
    tabla.appendChild(encabezado);

    // Crea las filas de datos
    var cuerpo = document.createElement('tbody');
    datos.forEach(function(item) {
        var fila = document.createElement('tr');
        fila.innerHTML = '<td>' + item.TipoSolicitud + '</td><td>' + item.PromedioTiempoRespuestaEnDias + '</td>';
        cuerpo.appendChild(fila);
    });
    tabla.appendChild(cuerpo);

    // Agrega la tabla al contenedor
    tablaContainer.appendChild(tabla);
</script>
<script>
    // Datos de ejemplo (reemplaza con los datos reales obtenidos de la consulta)
    var datos = <?= $segmentacionJson ?>

    // Extraer los nombres de segmento y la cantidad de PQRS
    var nombresSegmento = datos.map(function(item) {
        return item.Segmento;
    });
    var cantidadPQRS = datos.map(function(item) {
        return item.CantidadPQRS;
    });

    // Configuración del gráfico pie
    var graficoPie = echarts.init(document.getElementById('grafico-pie'));
    var opcionesPie = {
        title: {
            text: 'PQRS por Segmento',
            x: 'center',
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)',
        },

        legend: {           
            left: 'left',
            data: nombresSegmento,
            top: 'bottom',
           
        },
        series: [{
            name: 'Cantidad de PQRS',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderRadius: 10
            },
            data: datos.map(function(item) {
                return {
                    value: item.CantidadPQRS,
                    name: item.Segmento,
                };
            }),
        }, ],
    };
    // Mostrar el gráfico pie
    graficoPie.setOption(opcionesPie);
</script>
<script>
    var datosAgrupados = {};

    try {
        var myChart = echarts.init(document.getElementById('grafico-pie2'));
        var datos01 = <?= $segtipoJson ?>;

        if (Array.isArray(datos01)) {
            datos01.forEach(function(item) {
                if (!datosAgrupados[item.tipo]) {
                    datosAgrupados[item.tipo] = {
                        segmentos: {},
                        total: 0
                    };
                }
                if (!datosAgrupados[item.tipo].segmentos[item.Segmento]) {
                    datosAgrupados[item.tipo].segmentos[item.Segmento] = parseInt(item.CantidadPQRS);
                } else {
                    // Si el segmento ya existe, incrementa la cantidad existente
                    datosAgrupados[item.tipo].segmentos[item.Segmento] += parseInt(item.CantidadPQRS);
                }
                datosAgrupados[item.tipo].total += parseInt(item.CantidadPQRS);
            });

            var tiposSolicitud = Object.keys(datosAgrupados);
            var seriesData = [];

            tiposSolicitud.forEach(function(tipo) {
                seriesData.push({
                    name: tipo,
                    value: datosAgrupados[tipo].total
                });
            });

            var option = {
                tooltip: {
                    trigger: 'item',
                    formatter: function(params) {
                        var tipo = params.name;
                        var cantidadTotal = datosAgrupados[tipo].total;
                        var segmentosTooltip = Object.keys(datosAgrupados[tipo].segmentos)
                            .filter(segmento => datosAgrupados[tipo].segmentos[segmento] > 0)
                            .map(segmento => segmento + ': ' + datosAgrupados[tipo].segmentos[segmento])
                            .join('<br/>');

                        return tipo + '<br/>' + 'Cantidad Total: ' + cantidadTotal + '<br/>' + segmentosTooltip;
                    }
                },
                legend: {
                    orient: 'vertical',
                    left: 10,
                    data: tiposSolicitud
                },
                series: [{
                    name: 'Cantidad PQRS',
                    type: 'pie',
                    radius: [50, 80],
                    center: ['50%', '50%'],
                    roseType: 'area',
                    itemStyle: {
                        borderRadius: 8
                    },
                    data: seriesData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }]
            };

            myChart.setOption(option);
        } else {
            console.error('Error: los datos no son un array.');
        }
    } catch (error) {
        console.error('Error al analizar el JSON: ' + error.message);
    }
</script>


















<!-- TABLAS -->
<script>
    // Obtén una referencia al elemento contenedor de la tabla
    var tablaContainer = document.getElementById('tablaDatosContainer2');

    // Crea la tabla y sus elementos
    var tabla = document.createElement('table');
    tabla.id = 'tablaDatos';
    tabla.className = 'table table-bordered bg-blue table-hover';

    // Crea la fila de encabezado
    var encabezado = document.createElement('thead');
    var encabezadoFila = document.createElement('tr');
    encabezadoFila.innerHTML = '<th> Segmento</th><th>Cantidad</th>';
    encabezado.appendChild(encabezadoFila);
    tabla.appendChild(encabezado);

    // Crea las filas de datos
    var cuerpo = document.createElement('tbody');
    datos.forEach(function(item) {
        var fila = document.createElement('tr');
        fila.innerHTML = '<td>' + item.Segmento + '</td><td>' + item.CantidadPQRS + '</td>';
        cuerpo.appendChild(fila);
    });
    tabla.appendChild(cuerpo);
    // Agrega la tabla al contenedor
    tablaContainer.appendChild(tabla);
</script>
<script>
    // Datos proporcionados en formato JSON
    var datos = <?= $segtipoJson ?>

    // Obtener la referencia de la tabla
    var tabla = document.getElementById("tablaDatos3");

    // Generar las filas de la tabla con los datos proporcionados
    datos.forEach(function(item) {
        var fila = tabla.insertRow();
        var celdaSegmento = fila.insertCell(0);
        var celdaTipo = fila.insertCell(1);
        var celdaCantidad = fila.insertCell(2);

        // Asignar los valores a las celdas
        celdaSegmento.textContent = item.Segmento;
        celdaTipo.textContent = item.tipo;
        celdaCantidad.textContent = item.CantidadPQRS;
    });
</script>
<!-- TABLAS -->