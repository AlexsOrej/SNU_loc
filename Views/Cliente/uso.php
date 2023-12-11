<script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script>

<div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="card">
            <div class="header">Filtros Modulos</div>
            <div class="body">
                <form id="fservicios" name="fservicios">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="clientes">Clientes</label>
                            <select name="clientes" id="clientes" class="form-control" required>
                                <option value="">Buscar</option>
                                <option value="0">Todos</option>
                                <?php foreach ($clientes as $value) : ?>
                                    <option value="<?= $value->cliente_id ?>"><?= $value->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="servicios">Desde</label>                            
                            <input type="date" class="form-control" id="startDate" name="startDate" required />                           
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label for="servicios">Hasta</label>                            
                            <input type="date" class="form-control" id="endDate" name="endDate"  required/>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">VER INFO</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-lg-9 col-md-6">
        <div class="card" id="contenido">
            <div class="header">
                <h2>Inicios de Sección</h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>2021</th>
                                <th>2022</th>
                                <th>2023</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($EstadisticasSessiones as $estadistica) : ?>
                                <tr>
                                    <td><?php echo $estadistica->nombre; ?></td>
                                    <?php foreach ($estadistica as $key => $value) : ?>
                                        <?php if ($key !== 'nombre') : ?>
                                            <td><?php echo $value; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div id="grafico0" style="width: 100%; height: 400px;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="grafico1" style="width: 100%; height: 380px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    // $(document).ready(function() {
    //     $("#dateRange,#dateRange01").ionRangeSlider({
    //         type: "double",
    //         grid: true,
    //         min: fecha_a_valor_numerico("2022-01-01"),
    //         max: fecha_a_valor_numerico("2025-12-31"),
    //         from: fecha_a_valor_numerico("2022-01-01"),
    //         to: fecha_a_valor_numerico("2025-12-31"),
    //         prettify: function(num) {
    //             return valor_numerico_a_fecha(num);
    //         },
    //         onStart: function(data) {
    //             $("#startDate").val(valor_numerico_a_fecha(data.from));
    //             $("#endDate").val(valor_numerico_a_fecha(data.to));
    //         },
    //         onChange: function(data) {
    //             $("#startDate").val(valor_numerico_a_fecha(data.from));
    //             $("#endDate").val(valor_numerico_a_fecha(data.to));
    //         }
    //     });
    // });

    // function fecha_a_valor_numerico(fecha) {
    //     // Convierte una fecha en un valor numérico para el slider
    //     return new Date(fecha).getTime();
    // }

    // function valor_numerico_a_fecha(valor) {
    //     // Convierte un valor numérico del slider a una fecha
    //     return new Date(parseInt(valor)).toISOString().slice(0, 10);
    // }

    function Servicios() {

    }

    $(document).ready(function() {
        $(document).on('submit', '#fservicios', function(e) {
            // Evitar que el formulario se envíe normalmente
            e.preventDefault();

            // Resto de tu código aquí

            // Por ejemplo, puedes obtener los datos del formulario
            var formData = $(this).serialize();

            // Realizar alguna acción con los datos, como enviarlos a través de AJAX
            $.ajax({
                type: 'POST',
                url: '?c=clientes&a=filtroservicio', // Reemplaza con la URL a la que deseas enviar los datos
                data: formData,
                success: function(response) {
                    // Manejar la respuesta del servidor                   
                    $('#contenido').html(response)
                },
                error: function(error) {
                    // Manejar errores, si los hay
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    // Datos JSON proporcionados
    var datosJSON = <?= json_encode($EstadisticasSessiones); ?>
    // Obtener nombres y totales para el gráfico de pie
    var nombres = datosJSON.map(item => item.nombre);
    var totales = datosJSON.map(item => parseInt(item.TOTAL));
    // Configurar el gráfico de pie
    var myChart0 = echarts.init(document.getElementById('grafico0'));
    var option = {
        title: {
            text: 'Inicios de seccion por cliente ',
            subtext: 'Total por cliente'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} ({d}%)'
        },

        toolbox: {
            show: true,
            feature: {
                saveAsImage: {}
            }
        },
        legend: {
            orient: 'vertical',
            left: 10,
            data: totales
        },
        series: [{
            name: 'Clientes',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: nombres.map((nombre, index) => ({
                value: totales[index],
                name: nombre
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

    // Utilizar setOption para cargar los datos y mostrar el gráfico
    myChart0.setOption(option);
</script>

<script>
    // Datos JSON proporcionados
    // Obtener años únicos
    var years = Object.keys(datosJSON[0]).filter(key => key !== 'nombre' && key !== 'TOTAL');
    // Procesar datos para el gráfico de barras stack
    var seriesData = years.map(year => ({
        name: year,
        type: 'bar',
        stack: 'total',
        label: {
            show: true,
            position: 'top',
            fontSize: 8
        },
        emphasis: {
            focus: 'series'
        },

        data: datosJSON.map(item => parseInt(item[year]))
    }));

    // Configurar el gráfico de barras stack
    var myChart1 = echarts.init(document.getElementById('grafico1'));
    var option1 = {
        title: {
            text: 'Gráfico por Año',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: years,
            orient: "vertical",
            right: "0%",
            top: "13%",
            fontSize: 8
        },

        toolbox: {
            show: true,
            feature: {
                saveAsImage: {}
            }
        },
        xAxis: {
            type: 'category',
            data: datosJSON.map(item => item.nombre),
            axisLabel: {
                interval: 0, // Mostrar todos los nombres
                rotate: 45, // Rotar los nombres para que sean legibles
                textStyle: {
                    align: 'right',
                    position: 'top', // Alinear el texto al centro del intervalo                    
                    fontSize: 8
                }
            },
        },
        yAxis: {
            type: 'value'
        },
        series: seriesData
    };

    // Utilizar setOption para cargar los datos y mostrar el gráfico
    myChart1.setOption(option1);
</script>



<?php
// echo '<pre> sessiones';
// print_r($tiempo_Sesiones);
// echo '</pre>';
// echo '<pre>usuarios';
// print_r($clientes_usuarios);
// echo '</pre>';
// echo '<pre>servicios';
// print_r($obtener_servicios);
// echo '</pre>';
// echo '<pre>sessiones por año';
// print_r($EstadisticasSessiones);
// echo '</pre>';
?>