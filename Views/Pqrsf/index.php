<?php //print_r($graByEst);
foreach ($graByEst as $value) {
    $estado[] = ucwords($value->estado);
    $total[] = $value->total;
}
?>
<style>
    .card-bg {
        border-radius: 8px;
        background-color: #FFFFFF;
        box-shadow: none;        
    }

    
    */ .color {
        color: black;
    }

    .outter {
        width: 100%;
        height: 80%;
        border-radius: 14px;
        background-color: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
        /* Ajusta el valor según sea necesario */
    }

    .inner {
        width: 100%;
        height: 100%;
        border-radius: 12px;
        background-color: #ECEFF1;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .estado-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        /* Ajusta el margen según tus preferencias */
    }

    .estado-row label {
        margin-right: 10px;
        /* Espaciado entre el label y las estrellas */
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-12">
                    <label>Filtro Estado</label>
                    <div class="form-line">
                        <select name="estado" id="estado" class="form-control" required="required">
                            <option value="">Seleccionar</option>
                            <option value="abierto">Abierta</option>
                            <option value="asignado">Asignado</option>
                            <option value="revision">Revisión</option>
                            <option value="cerrado">Cerrado</option>
                            <option value="todo">Todos</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Filtro Tipo</label>
                    <div class="form-line">
                        <select name="tipo" id="tipo" class="form-control" required="required">
                            <option value="">Seleccionar</option>
                            <option value="informacion">Información</option>
                            <option value="soporte">Soporte</option>
                            <option value="felicitacion">Felicitacion</option>
                            <option value="sugerencia">Sugerencia</option>
                            <option value="reclamo">Reclamo</option>
                            <option value="queja">Queja</option>
                            <option value="peticion">Petición</option>
                            <option value="todo">Todos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-body">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <th width="20%"></th>
                                <th width="80%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($graBytipo as $value) : ?>
                                <tr>
                                    <td><span class="label bg-green"><?= ucwords($value->tipo_peticion) ?></span><span class="label bg-cyan"><?= $value->total . ' de ' . $totalBytipo->sumtotal ?></span></td>
                                    <td style="color:black;">
                                        <div class="progress" style="height:20px;">
                                            <div class="progress-bar bg-deep-orange" role="progressbar" aria-valuenow="<?= $value->total ?>" aria-valuemin="0" aria-valuemax="13" style="width:<?= $i = $porcentaje->ObtenerPorcentaje($value->total, $totalBytipo->sumtotal) ?>%"> <span class="color"><?= $i ?>% </span< /div>
                                            </div>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 ">
        <div class="panel panel-default">
            <div class="panel-body card-bg">
                <div class="col-md-4">
                    <div class="col-md-12 outter">
                        <div class="inner">
                            <div id="grafico" style="width: 200px; height: 130px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 outter">
                        <div class="inner">
                            <? if ($totalsatisfacion) : ?>
                                <div id="grafico0" style="width: 200px; height: 130px;"></div>
                            <? else : ?>
                                SIN REGISTROS
                            <? endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12 outter text-center">
                        <div class="inner">
                            <p>
                                Promedio de asignación <br>
                                <label class="badge bg-blue"><?= number_format($promedioasignacion->tiempo_creacion_asignacion, 1); ?></label>
                                Dias
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12 outter text-center">
                        <div class="inner">
                            <p> Promedio de respuesta <br>
                                <label class="badge bg-blue"><?= number_format($promediorespuesta->tiempo_asignacion_resolucion, 1); ?></label>
                                Dias
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="resultado"></div>
    </div>
    <script>
        $('#estado').on('change', function() {
            var estado = document.getElementById("estado").value
            $.ajax({
                type: "POST",
                url: '?c=pqrsf&a=estados',
                data: {
                    estado: estado
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });
        });
        $('#tipo').on('change', function() {
            var tipo = document.getElementById("tipo").value

            $.ajax({
                type: "POST",
                url: '?c=pqrsf&a=tipo',
                data: {
                    tipo: tipo
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });

        });
        $('#respuesta').on('click', function() {
            var tipo = document.getElementById("respuesta").value

            $.ajax({
                type: "POST",
                url: '?c=pqrsf&a=tipo',
                data: {
                    tipo: tipo
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });

        });
    </script>

    <script>
        function generarNuevoColor() {
            var simbolos, color;
            simbolos = "0123456789ABCDEF";
            color = "#";

            for (var i = 0; i < 6; i++) {
                color = color + simbolos[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        const ctx = document.getElementById('myChart').getContext('2d');
        const estado = <?= json_encode($estado) ?>;
        const total = <?= json_encode($total) ?>;
        var colors = [ '#F44336','#E57373', '#4DB6AC', '#4CAF50'];

        const myChart = new Chart(ctx, {
            type: 'bar',
            plugins: [ChartDataLabels],
            data: {
                labels: estado,
                datasets: [{
                    label: '# Pqrsf',
                    data: total,
                    backgroundColor: colors,                    
                    borderColor: '#ffffff',
                    borderWidth: 0,
                    borderRadius: 10,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'PQRSF RECIBIDOS'
                    },
                    labels: {
                        display: true,
                    },
                    datalabels: {
                        color: '#FFF',
                        align: 'center',
                        font: {
                            size: 10,
                            weight: 'bold',
                        },
                        textShadowBlur: 3,
                        textShadowColor: '#4d4b4b',
                        formatter: function(value, context) {
                            return value + ' ';
                        },

                    },
                },

            }
        });
    </script>

    <script>
        // Datos obtenidos de la consulta
        var datos = <?= json_encode($totalporcategoria) ?>

        var grafico = echarts.init(document.getElementById('grafico'));

        // Configura las opciones del gráfico
        var opciones = {
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
            },
            title: {
                text: 'Segmentación',
                botton: 20,
                left: "center",
                // top: "center",
                textStyle: {
                    fontSize: 14,

                }

            },
            // legend: {
            //     orient: 'vertical',
            //     left: 'left',
            //     data: datos.map(item => item.segmento)
            // },
            series: [{
                name: 'Total PQRSF por segmento',
                type: 'pie',
                radius: '55%',
                center: ['50%', '60%'],
                data: datos.map(item => ({
                    name: item.segmento,
                    value: item.total_pqrsf
                })),
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        // Aplica las opciones al gráfico y muestra
        grafico.setOption(opciones);
    </script>

    <script>
        // Datos obtenidos de la consulta SQL (puedes cargar estos datos desde tu servidor)
        var datos = <?= json_encode($totalsatisfacion) ?>

        // Inicializa el gráfico
        var grafico = echarts.init(document.getElementById('grafico0'));

        // Configura las opciones del gráfico
        var opciones = {
            title: {
                text: 'Satisfación del Cliente',
                subtext: "",
                left: "center",
                // top: "center",
                textStyle: {
                    fontSize: 14,

                },
                botton: 20,


            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b} : {c} ({d}%)'
            },
            // legend: {
            //     orient: 'vertical',
            //     left: 'left',
            //     data: datos.map(item => item.estado_cliente)
            // },
            series: [{
                name: 'Satisfaccion',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                data: datos.map(item => ({
                    name: item.estado_cliente,
                    value: item.total_satisfacciones
                })),
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 20,
                        fontWeight: 'bold'
                    }
                }
            }]
        };

        // Aplica las opciones al gráfico y muestra
        grafico.setOption(opciones);
    </script>