<!-- Agregamos los archivos necesarios de ECharts -->
<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.0/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts@5.2.0/dist/extension/dataTool.min.js"></script>
<div class="col-md-12" id="rango">
    <div class="card">
        <div class="body">
            <div class="row text-center">
                <div class="col-md-4">
                    Inicios de sesión desde: <u><? echo $totalvisitas->desde = date('Y-m-d', strtotime($totalvisitas->desde)) ?></u><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitas->cantidad) ?></span>
                </div>
                <div class="col-md-4">
                    Inicios de sesión ultimos <strong>7 dias</strong>: <u><? echo $totalvisitas7dias->desde = date('Y-m-d', strtotime($totalvisitas7dias->desde));                                                                            ?></u><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitas7dias->cantidad) ?></span>
                </div>
                <div class="col-md-4">
                    Inicios de sesión <strong>hoy</strong><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitasdiaActual->cantidad) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card" style="width: auto;">
        <!-- Default panel contents -->
        <div class="header text-right">
            <button class="btn btn-warning" onclick="Clientes_add()" data-toggle="modal" data-target="#modelId">Registrar Cliente</button>
        </div>
        <div class="body text-center align-center">
            <!-- Table -->
            <table id="tableCliente" class="table  table-striped" style="padding:0; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th class="text-center">Acceso</th>
                        <th class="text-center">Detalles</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td style="align-items: center; vertical-align: middle; ">
                                <a href="?c=clientes&a=verificar&id=<?php echo $cliente->cliente_id ?>" class="btn" data-toggle="tooltip" data-placement="bottom" title="Entrar Aqui">
                                    <img src="Assets/img/uploads/colegio/<?php echo $cliente->filename ?>" alt="Profile Image" width='100' height='90' class="bg-white" /><br>
                                </a>
                            </td>
                            <td style="align-items: left;">
                                <ul style="list-style: none;">
                                    <li><b>Nombre:</b> <?php echo $cliente->nombre ?></li>
                                    <li><b>Nit:</b> <?php echo $cliente->telefono ?></li>
                                    <li><b>Direccion:</b> <?php echo $cliente->direccion ?></li>
                                    <li><b>Correos:</b>
                                        <?php
                                        $correo = explode("~", $cliente->correos);
                                        echo '<br>' . $correo[0];
                                        echo '<br>' .  $correo[1];
                                        ?>
                                    </li>
                                    <?
                                    $folderPath = 'Assets/img/' . $cliente->nombre;
                                    $folderSize = $this->model->getFolderSize($folderPath);
                                    $folderSizeInMegabytes = $this->model->bytesToMegabytes($folderSize);
                                    ?>
                                    <li> <span class="label label-danger">Espacio usado:<?= $folderSizeInMegabytes . " MB"; ?> </span>
                                    </li>
                                </ul>
                            </td>
                            <td class="text-center">
                                <span>
                                    <a onclick="Clientes_Edit('<?php echo $cliente->cliente_id ?>')" class="" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-edit" title="Actualizar"></i></a>
                                </span>
                                <span>
                                    <a onclick="SubirImg('<?php echo $cliente->cliente_id ?>')" class="" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-picture" title="Subir o actualizar img"></i></a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="header">
            Cantidad de Universos activos por cliente
        </div>
        <div class="body">
            <div id="chart-container" style="height: 400px;"></div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="title">Ingresos por usuario</div>
                </div>
                <div class="body">
                    <section>
                        <div class="card">
                            <div class="body">
                                <label for="top 10">Top 10</label>
                                <select name="porusuario" id="porusuario" class="form-control">
                                    <option value="">Selecciones</option>
                                    <option value="30">Ultimo Mes</option>
                                    <option value="90">Ultimo Trimestre</option>
                                    <option value="180">Ultimo Semestre</option>
                                    <option value="365">Ultimo Año</option>
                                </select>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="card">
                            <div class="body">
                                <div id="pusuario">
                                    <table id="ingresosporusuario" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ingresos</th>
                                                <th>Usuario</th>
                                                <th>Cliente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ingresosporusuario as $key => $value) : ?>
                                                <tr>
                                                    <td><?= $value->cantidad ?></td>
                                                    <td><?= $value->usuario ?></td>
                                                    <td><?= $value->nombre ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="title">Universos por cliente</div>
                </div>
                <div class="body">
                    <table id="tableCliente1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Vencidos</th>
                                <th>Total universos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($serviciosInfo as $key => $value) : ?>
                                <tr>
                                    <td><?= $value->nombre_cliente ?></td>
                                    <td><?= $value->servicios_vencidos ?></td>
                                    <td><?= $value->total_servicios ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    Cantidad de usuarios activos por cliente

                </div>
                <div class="body">
                    <div id="chart-container1" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="clientes">
                <form action="" name="formCrud" id="formCrud" method="post" enctype="multipart/form-data">
                    <input type="file" name="logo" id="logo" class="form-control">
                    <br>
                    <input type="hidden" name="cliente_id" id="cliente_id">
                    <input type="button" name="registro" class="btn btn-primary upload" value="Subir" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- fin modal -->
<script>
    function Clientes_Edit(val) {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=crud',
            data: 'id=' + val,
            success: function(resp) {
                $('#clientes').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Clientes_add() {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=crud',
            success: function(resp) {
                $('#clientes').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function SubirImg(cli_id) {
        document.querySelector("#cliente_id").value = cli_id;

    }

    $(document).ready(function() {
        $(".upload").on('click', function() {
            var form = $("#formCrud")[0];
            var formData = new FormData(form);
            var file = $('#logo')[0].files[0];
            formData.append('file', file);

            var settings = {
                url: '?c=clientes&a=subirimg',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'El logo fue Actualizado',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1500)

                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'El logo no pudo ser actualizado',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1500)
                }
            };

            $.ajax(settings);
        });
    });




    // Obtenemos los datos de la consulta y los convertimos a formato compatible con ECharts
    const colors = ['#e6b4e5', '#a3a8e2', '#2b91c8', '#5793f3', '#d14a61', '#675bba', '#ff8feb', '#ffbf90', '#d6f8ca', '#ff95aa', '#f6e5a6', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f', '#292b2c', '#dd4b39', '#007bff', '#6c757d', '#ffc107', '#28a745'];

    var data = <?= json_encode($servicios); ?>;
    // Creamos un objeto de ECharts y lo configuramos
    var chart = echarts.init(document.getElementById('chart-container'));
    chart.setOption({
        title: {
            text: ''
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c}'
        },
        xAxis: {
            type: 'category',
            axisLabel: {
                interval: 4,
                rotate: 30
            },
            data: data.map(function(item) {
                return item.cliente;
            })
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            name: 'Cliente',
            type: 'bar',
            itemStyle: {
                normal: {
                    type: 'linear',
                    color: function(params) {
                        return colors[params.dataIndex % colors.length];
                    },
                },
            },
            data: data.map(function(item) {
                return item.servicios_activos;
            }),
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
    });

    // Agregamos la funcionalidad de exportar los datos a CSV
    chart.on('click', function(params) {
        var data = [Object.keys(params.valueMap)];
        data.push(Object.values(params.valueMap));
        var csvContent = "data:text/csv;charset=utf-8," + data.map(e => e.join(",")).join("\n");
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "datos.csv");
        document.body.appendChild(link);
        link.click();
    });
    //------g2-------//
    // Obtenemos los datos de la función PHP y los convertimos a formato compatible con ECharts
    var data1 = <?php echo json_encode($usuarios); ?>;

    // Creamos un objeto de ECharts y lo configuramos
    // var chart1 = echarts.init(document.getElementById(''));
    var chartDom = document.getElementById('chart-container1');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        title: {
            text: ''
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c}'
        },
        xAxis: {
            type: 'category',
            axisLabel: {
                interval: 5,
                rotate: 30
            },
            data: data1.map(function(item) {
                return item.cliente;
            })
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            name: 'cliente',
            type: 'bar',
            itemStyle: {
                normal: {
                    type: 'linear',
                    color: function(params) {
                        return colors[params.dataIndex % colors.length];
                    },
                },
            },
            data: data1.map(function(item) {
                return item.cantidad_usuarios_activos;
            }),
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
    option && myChart.setOption(option);


    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById("porusuario");
        selectElement.addEventListener("change", function() {
            var selectedOption = selectElement.options[selectElement.selectedIndex].value;
            $('#pusuario').html('<br><p class="text-center badge bg-orange">Buscando los registros de los últimos ' + selectedOption + ' dias</p>');

            $.ajax({
                type: "POST",
                url: '?c=clientes&a=porusuario',
                data: {
                    dias: selectedOption
                },
                dataType: 'json',
                success: function(response) {
                    var table = '<br><table id="tableCliente2" class="table table-bordered table-hover>"';
                    table += '<thead><tr><th>Usuario</th><th>Cantidad</th><th>Nombre</th></tr></thead>';
                    for (var i = 0; i < response.length; i++) {
                        table += '<tbody><tr><td>' + response[i].usuario + '</td><td>' + response[i].cantidad + '</td><td>' + response[i].nombre + '</td></tr></tbody>';
                    }
                    table += '</table>';
                    $('#pusuario').html(table);

                }
            });


        });
    });
</script>
