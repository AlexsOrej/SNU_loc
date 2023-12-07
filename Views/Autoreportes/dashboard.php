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
                    <div class="text">TOTAL DE EVENTOS</div>
                    <div class="number " data-from="0" data-to="<?php echo $solicitudes->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $eventos->total ?> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">EN TRAMITE</div>
                    <div class="number " data-from="0" data-to="<?php echo $vacias->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $entramite->total ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">EN REVISIÓN</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo $si->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $enrevision->total ?></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">block</i>
                </div>
                <div class="content">
                    <div class="text">APROBADAS</div>
                    <div class="number count-to" data-from="0" data-to="<?php echo $rev->total ?>" data-speed="1000" data-fresh-interval="20">
                        <?php echo $enaprobacion->total ?></div>
                </div>
            </div>
        </div>

        <!-- :::::::::::::::::::::::GRAFICO 1 EVENTOS * PROCESO::::::::::::::::::::::::::::: -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- Prepare a DOM with a defined width and height for ECharts -->
                    <div id="doc_pro" style="width: 100%; height: 400px;"></div>
                    <script>
                        // Convierte los datos a un objeto de JavaScript
                        const dataDoc = <?= json_encode($procesos) ?>;
                        // Lista de colores para las barras
                        var colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6'];

                        // Preparar datos para el gráfico
                        var xAxisData = dataDoc.map(item => item.Iniciales);
                        var seriesData = dataDoc.map(item => item.cantidad);
                        var total = <?= $eventos->total ?>

                        // seriesData.reduce((a, b) => a + b, 0);
                        var percentageData = seriesData.map(item => ((item / total) * 100).toFixed(2));

                        // Inicializa el gráfico
                        const doc_pro_ = echarts.init(document.getElementById('doc_pro'));

                        // Configura la opción del gráfico
                        option = {
                            title: {
                                text: 'Eventos por proceso',
                                subtext: 'Muestra la cantidad eventos por proceso',
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                },
                                formatter: function(params) {
                                    var dataIndex = params[0].dataIndex;
                                    var value = params[0].value;
                                    var percentage = params[1].value;
                                    return 'Cantidad: ' + value + '<br>' + 'Porcentaje: ' + percentage + '%';
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
                                type: 'category',
                                data: xAxisData
                            },
                            yAxis: [{
                                type: 'value',
                                name: 'Cantidad',
                                min: 0
                            }, {
                                type: 'value',
                                name: 'Porcentaje',
                                min: 0,
                                max: 100,
                                axisLabel: {
                                    formatter: '{value} %'
                                }
                            }],
                            series: [{
                                name: 'Cantidad',
                                type: 'bar',
                                data: seriesData,
                                itemStyle: {
                                    color: function(params) {
                                        return colors[params.dataIndex % colors.length];
                                    }
                                }
                            }, {
                                name: 'Porcentaje',
                                type: 'line',
                                yAxisIndex: 1,
                                data: percentageData,
                                smooth: true,
                                label: {
                                    show: true,
                                    formatter: '{c}%',
                                    position: 'top'
                                }
                            }]
                        };

                        // Renderiza el gráfico
                        doc_pro_.setOption(option, true);
                        doc_pro_.resize();
                    </script>
                </div>
            </div>
        </div>
        <!-- :::::::::::::::::::::::GRAFICO 2::::::::::::::::::::::::::::: -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- Prepare a DOM with a defined width and height for ECharts -->
                    <div id="main0" style="width: 100%; height: 400px;"></div>
                    <script>
                        // Datos obtenidos de la consulta
                        var datacat = <?= json_encode($categoriaEventos) ?>;

                        // Preparar datos para el gráfico
                        var legendData = datacat.map(item => item.nombreevento);
                        var seriesData = datacat.map(item => ({
                            name: item.nombreevento,
                            value: item.cantidad,
                            percent: ((item.cantidad / getTotalCount(datacat)) * 100).toFixed(2) + '%'
                        }));

                        // Función para obtener el total de la cantidad
                        function getTotalCount(datacat) {
                            var totalCount = 0;
                            datacat.forEach(item => {
                                totalCount += item.cantidad;
                            });
                            return totalCount;
                        }

                        // Crear instancia del gráfico
                        var chart = echarts.init(document.getElementById('main0'));

                        // Configurar opciones del gráfico
                        var options = {
                            title: {
                                text: 'Cantidad de Eventos por categoría',
                                subtext: 'Muestra la cantidad y porcentaje de eventos categoría',
                                left: 'center',
                            },
                            tooltip: {
                                trigger: 'item',
                                formatter: '{b}: {c} ({d}%)'
                            },
                            legend: {
                                orient: 'horizontal',
                                bottom: 'bottom',
                                data: legendData
                            },
                            series: [{
                                type: 'pie',
                                radius: '50%',
                                center: ['50%', '60%'],
                                selectedMode: 'single',
                                data: seriesData,
                                label: {
                                    formatter: '{b}: {c} ({d}%)'
                                }
                            }]
                        };

                        // Renderizar gráfico
                        chart.setOption(options);
                    </script>
                </div>
            </div>
        </div>
        <!-- :::::::::::::::::::::::GRAFICO 3::::::::::::::::::::::::::::: -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading bg-white">
                    <h3 class="panel-title " style="padding-top: 5px;">Incidentes Registrados</h3>
                </div>
                <div class="panel-body" style="max-height: 400px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Incidente</th>
                                    <th><span class="glyphicon glyphicon-transfer"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($eventoIncidente as $value) : ?>
                                    <? $porcentaje =  ($value->cantidad / $eventos->total) * 100;
                                    $numero_entero = floor($porcentaje);

                                    switch (true) {
                                        case $numero_entero > 10:
                                            $bg = "bg-red";
                                            break;
                                        case $numero_entero >  5 & $numero_entero <  10:
                                            $bg = "bg-orange";
                                            break;
                                        default:
                                            $bg = "bg-green";
                                            break;
                                    }

                                    ?>
                                    <tr data-toggle="tooltip" data-placement="top" data-original-title="<?= $value->cantidad . '-Incidente : ' . $numero_entero . '%' ?>">
                                        <td class="<?= $bg ?>"><?= $value->cantidad ?></td>
                                        <td><?= utf8_encode($value->tipoIncidente)  ?><span class="label <?= $bg ?> pull-right"><?= $value->sigla ?></span></td>
                                        <td class="font-bold col-orange">
                                            <div class="progress">
                                                <div class="progress-bar <?= $bg ?>" role="progressbar" title="<?= $numero_entero ?>%" aria-valuenow="<?= $eventos->total ?>" aria-valuemin="1" aria-valuemax="<?= $eventos->total ?>" style="width: <?= $numero_entero ?>%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- #END# CPU Usage -->