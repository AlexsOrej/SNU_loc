<head>
    <meta charset="utf-8" />
    <title>Ver Indicador</title>
    <!-- Include the ECharts file you just downloaded -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.0/dist/echarts.min.js"></script>
</head>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Ficha del Indicador</h4>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>Fuente del recurso</th>
                            <th>Interpretación</th>
                            <th>Periodicidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($indicador as $indicadors) : ?><?php endforeach; ?>
                        <tr>
                            <td><?php echo ucwords($indicador->definicion) ?></td>
                            <td><?php echo ucwords($indicador->interpretacion)  ?>&nbsp;</td>
                            <td><?php echo ucwords($indicador->periodicidad) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4 class="title">Datos del Indicador
                    <a href="?c=indicadors&a=datos&id=<?= $_REQUEST['indicador_id'] ?>" class="neu  pull-right"><i class="glyphicon glyphicon-plus"> </i> Registrar</a>
                </h4>
            </div>
            <div class="body">
                <table id="datos" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha Aplicación</th>
                            <th>Datos</th>
                            <th>Resultado</th>
                            <th>Meta</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($datos as $value) : ?>
                            <tr>
                                <td style="width:30%;"> <?php echo $value->fecha_aplicacion ?></td>
                                <td> <?php echo str_replace(" ", "-", $value->expresion); ?>&nbsp;</td>
                                <td> <?php echo number_format($value->resultado, 2) ?></td>
                                <td> <?php echo $value->comparativo . '' . $value->valor ?></td>
                                <td>
                                    <?php
                                    $dato_id = $value->datoid;
                                    $meta = $value->resultado . '' . $value->comparativo . '' . $value->valor;
                                    if ($meta) : ?>
                                        <a href="<?php echo '?c=acciones&a=add&id=' . $value->datoid . '&ind_id=' . $_REQUEST['indicador_id'] ?>"><i title="Plan de acción" class="glyphicon glyphicon-paperclip"></i></a>
                                    <?php else : ?>

                                    <?php endif; ?>
                                    <a href="?c=indicadors&a=datos&dato_id=<?= $value->datoid ?>&id=<?= $_REQUEST['indicador_id'] ?>" type="button" title="Editar Dato">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <? if ($_SESSION['rol'] == 'root') : ?>
                                        <a onclick="Borrar('<?= $value->datoid ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                                    <? endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Historial de metas
                    <a href="?c=indicadors&a=meta&indicador_id=<?= $_REQUEST['indicador_id'] ?>" class="neu  pull-right"><i class="glyphicon glyphicon-plus"> </i>Registrar Meta</a>
                </h4>
            </div>
            <div class="body">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Meta</th>
                            <th>Fecha</th>
                            <th>Menu</th>
                        </tr>
                    <tbody>
                        </thead>
                        <?php
                        foreach ($metas as $value) : ?>
                            <tr>
                                <td><?php echo $value->comparativo ?></td>
                                <td><?php echo $value->valor ?></td>
                                <td><?php echo $value->fecha_uso ?>&nbsp;</td>

                                <td class="actions">
                                    <a href="?c=indicadors&a=meta&indicador_id=<?= $_REQUEST['indicador_id'] ?>&id=<?= $value->id ?>" type="button" class="" title="Editar meta">
                                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                    </a>
                                    <a onclick="Quitar('<?= $value->id ?>')" type="button" class="" title="Quitar metas">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <!-- <h4 class="title">Grafico</h4> -->
            </div>
            <div class="body">
                <!-- Prepare a DOM with a defined width and height for ECharts -->
                <div id="main" style="width: 100%; height: 400px;"></div>
            </div>
        </div>

    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2 class="title">Acciones</h2>
            </div>
            <div class="body">
                <?php if (!empty($acciones)) : ?>
                    <table id="acciones" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">Fecha Aplicación</th>
                                <th>Analisis</th>
                                <th>Accion</th>
                                <th>Ejecución</th>
                                <th width="2%">Menu</th>
                            </tr>
                        <tbody>
                            </thead>
                            <?php
                            //if (!empty($acciones)) : 
                            $i = 1;
                            foreach ($acciones as $value0) : ?>
                                <tr>
                                    <td><?php echo $value0->fecha_aplicacion ?>&nbsp;</td>
                                    <td><?php echo $value0->analisis ?></td>
                                    <td><?php echo $value0->accion; ?>&nbsp;</td>
                                    <td><?php echo $value0->f_ejecucion ?></td>
                                    <td style="vertical-align: middle;text-align: center;"><a href="<?php echo '?c=acciones&a=add&id=' . $dato_id . '&ind_id=' . $_REQUEST['indicador_id'] . '&accion_id=' . $value0->accion_id ?>"><i title=" Editar Plan de acción" class="glyphicon glyphicon-edit"></i></a>
                                        <!-- <a href="#" onclick="Delete('<?= $value0->id ?>')" type="button" title="Botón para eliminar dato">
                                        <i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                    </a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->
<script>
    function Borrar(val) {
        Swal.fire({
                title: "¿Estás seguro de eliminar este dato, tambien se eliminaran las acciones relacionadas?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "POST",
                        url: '?c=indicadors&a=DeleteDato',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dato eliminado con éxito',
                                timer: 2000
                            }, )
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000)
                        }
                    });
                }
            });
    }
</script>
<script>
    // Convierte los datos a un objeto de JavaScript
    const data = <?= json_encode($datos) ?>;
    // Lista de colores para las barras
    var colors = ['#0F71F2', '#318C07', '#F2A20C', '#D92929', '#EDCD21', '#F76E2A', '#E111E0', '#ffbf90', '#1E41F7', '#19F7B3', '#F7EE19'];
    // Extrae los valores de los datos para la configuración de ECharts
    const xAxisData = data.map(item => item.fecha_aplicacion);
    const yAxisData = data.map(item => parseFloat(item.resultado));
    const meta = data.map(item => item.valor);
    // Calcula el total de las cantidades
    const total0 = yAxisData.reduce((a, b) => parseFloat(a) + parseFloat(b), 0).toFixed(3);
    const total = parseFloat(total0).toFixed(2);
    // Inicializa el gráfico
    const chart = echarts.init(document.getElementById('main'));
    // Configura la opción del gráfico
    let option = {
        title: {
            name: 'Metas Por proceso',
            text: '<?php echo $indicador->nombre ?>',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis',
            formatter: 'Aplicacion: {b0}<br />Resultado: {c0}<br />Meta: {c1}',
            borderColor: '#333',
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
        calculable: true,
        xAxis: {
            data: xAxisData,
            axisLabel: {
                interval: 0, // Mostrar todos los nombres
                rotate: 45, // Rotar los nombres para que sean legibles
                textStyle: {
                    align: 'right',
                    position: 'top', // Alinear el texto al centro del intervalo                    
                    fontSize: 12
                }
            },
        },
        yAxis: {},
        series: [{
                type: 'bar',
                data: yAxisData,
                markLine: {
                    data: [{
                        type: 'average',
                        name: 'Avg',
                    }]
                },
                showBackground: true,
                backgroundStyle: {
                    color: 'rgba(180, 180, 180, 0.2)'
                },
                label: {
                    show: true,
                    formatter: '{c0}',
                    color: 'white',
                    fontSize: 11,
                    fontFamily: 'Microsoft YaHei',
                    overflow: 'truncate',
                    padding: [2, 4, 2, 4],
                    rotate: 90,
                },
                itemStyle: {
                    normal: {
                        type: 'linear',
                        color: function(params) {
                            // Cambiar el color de la barra según la relación con la meta
                            if (params.value === meta[params.dataIndex]) {
                                return '#ff9e22'; // Amarillo
                            } else if (params.value < meta[params.dataIndex]) {
                                return '#E53935'; // Rojo
                            } else {
                                return '#66BB6A'; // Verde
                            }
                        },
                        barBorderRadius: [10, 10, 0, 0],
                    }
                }
            },
            {
                name: 'Meta',
                type: 'line',
                data: meta,
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
    // Renderiza el gráfico
    chart.setOption(option);

    function changeChartType(type) {
        if (type === 'bar') {
            option.series[0].type = 'bar';
            option.series[1].type = 'line';
        } else if (type === 'pie') {
            option.series[0].type = 'pie';
            option.series[1].type = 'pie';
        }
        chart.setOption(option);
    }

    chart.resize();

    function Ver(val) {
        var id = val
        $.ajax({
            data: {
                ind: id
            },
            type: "post",
            url: "?c=indicadors&a=meta",

            success: function(resp) {
                $('#metas').html(resp);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
    }
</script>

<script>
    function Quitar(val) {
        var id = val
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=indicadors&a=quitar",

            success: function(resp) {
                Swal.fire({
                        title: "Estas seguro?",
                        text: "Esta acción no puede ser desecha",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                        //  timer: 1500
                    },

                    function(isConfirm) {
                        if (isConfirm) {
                            form.submit();
                            setTimeout(function() {
                                window.location = '?c=indicadors&a=index';
                                // window.location.reload(1);
                            }, 2000) // submitting the form when user press yes
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
                setTimeout(function() {
                    window.location.reload();
                }, 2000)

            }
        });
    }
</script>