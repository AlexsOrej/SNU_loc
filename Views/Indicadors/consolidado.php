<div class="card">
    <div class="header text-center">
        <h2 class="title">
            <i class="glyphicon glyphicon-search"></i>
            Buscar
        </h2>
    </div>
    <div class="body">
        <form action="" method="POST" class="form-horizontal" role="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Opciones</label>
                                <select class="form-control" id="opciones">
                                    <option value="rf">Rango Fecha</option>
                                    <option value="30">Ultimo Mes</option>
                                    <option value="60">Ultimo Bimestre</option>
                                    <option value="90">Ultimo Trimestre</option>
                                    <option value="180">Ultimo Semestre</option>
                                </select>
                            </div>
                            <div id="val_option"></div>
                        </div>
                    </div>
                    <div class="col-md-3" id="d-desde">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Desde</label>
                                <input type="date" name="desde" id="desde" class="form-control">
                            </div>
                            <div id="val"></div>
                        </div>
                    </div>
                    <div class="col-md-3" id="d-hasta">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Hasta</label>
                                <input type="date" name="hasta" id="hasta" class="form-control">
                            </div>
                            <div id="val0"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Proceso</label>
                                <select name="procesos" id="procesos" class="form-control" required="required">
                                    <option value="0" selected>Todos</option>
                                    <? foreach ($procesos as  $value) : ?>
                                        <option value="<?= $value->id ?>"><?= $value->Iniciales . '-' . $value->NombreProceso ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                            <div id="val1"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="button" name="buscar" id="buscar" class="btn btn-success" value="Filtrar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="header">
        <h2 class="title">Consolidado de Indicadores</h23>
    </div>
    <div class="body" id="result">
        <table class="table table-bordered table-condensed">
            <tr class="active text-center">
                <th colspan="">INDICADORES</th>
                <th colspan="">RESULTADOS</th>
                <th colspan="">METAS</th>
            </tr>
            <? foreach ($indicadornombre as  $value) : ?>
                <tr>
                    <th class="info" colspan="3">
                        <a href="?c=indicadors&a=verdatos&indicador_id=<?= $value->id ?>"><?= $value->nombre ?></a>
                        <span class="label label-info"><?= ucwords($value->periodicidad) ?></span>
                    </th>
                </tr>
                <?php foreach ($indicadordato as $value0) :
                    $fecha = explode("-", $value0->fecha_aplicacion);
                    $dia = $fecha[2];
                    $mes = $fecha[1];
                    $año = $fecha[0];
                ?>
                    <?php if ($value0->indicador_id == $value->id) : ?>
                        <tr>
                            <th>
                                <? switch ($mes) {
                                    case '1':

                                        echo $dia . ' Enero ' . $año;
                                        break;
                                    case '2':
                                        # code...
                                        echo $dia . ' Febrero ' . $año;
                                        break;
                                    case '3':
                                        # code...
                                        echo $dia . ' Marzo ' . $año;
                                        break;
                                    case '4':
                                        # code...
                                        echo $dia . ' Abril ' . $año;
                                        break;
                                    case '5':
                                        # code...
                                        echo $dia . ' Mayo ' . $año;
                                        break;
                                    case '6':
                                        # code...
                                        echo $dia . ' Junio ' . $año;
                                        break;
                                    case '7':
                                        # code...
                                        echo $dia . ' Julio ' . $año;
                                        break;
                                    case '8':
                                        # code...
                                        echo $dia . ' Agosto ' . $año;
                                        break;
                                    case '9':
                                        # code...
                                        echo $dia . ' Septiembre ' . $año;
                                        break;
                                    case '10':
                                        # code...
                                        echo $dia . ' Octubre ' . $año;
                                        break;
                                    case '11':
                                        # code...
                                        echo $dia . ' Noviembre ' . $año;
                                        break;
                                    case '12':
                                        # code...
                                        echo $dia . ' Diciembre ' . $año;
                                        break;
                                    default:
                                        # code...
                                        break;
                                } ?>
                            </th>
                            <td><?= number_format($value0->resultado, 2) . '%' ?></td>
                            <td class="
                        <?php switch ($value0->comparativo) {
                            case '<=':
                            case '<':
                                echo   $value0->resultado <= $value0->metaV ? 'alert alert-success' : 'alert alert-danger';
                                break;
                            case '>=':
                            case '>':
                                echo  $value0->resultado >= $value0->metaV ? 'alert alert-success' : 'alert alert-danger';
                                break;
                            case '=':
                                echo  $value0->resultado == $value0->metaV ? 'alert alert-info' : 'alert alert-danger';
                                break;
                        } ?>">
                                <?= $value0->meta ?>
                            </td>
                        </tr>
                    <?php else : ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tr>
            <? endforeach; ?>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Ocultar los elementos al cargar la página
        $('#d-desde, #d-hasta').show();
        var desde = $('#desde').val();
        var desde = $('#hasta').val();
        // Manejar el evento change
        $('#opciones').on('change', function() {
            var opcion = $(this).val();
            // Ocultar o mostrar inputs según la opción seleccionada
            if (opcion !== 'rf') {
                // $('#d-desde, #d-hasta').hide();
                document.getElementById("desde").value = sumarDias(opcion);
                document.getElementById("hasta").value = obtenerFechaActual();
            } else {
                $('#d-desde, #d-hasta').show();
            }
        });
    });

    function sumarDias(numeroDias, fechaInicial) {
        // Si no se proporciona una fecha inicial, toma la fecha actual
        fechaInicial = fechaInicial || new Date();

        var fecha = new Date(fechaInicial);
        fecha.setDate(fecha.getDate() - numeroDias);

        var dia = fecha.getDate();
        var mes = fecha.getMonth() + 1; // Los meses se cuentan desde 0
        var anio = fecha.getFullYear();

        // Asegúrate de que el formato tenga dos dígitos
        dia = dia < 10 ? '0' + dia : dia;
        mes = mes < 10 ? '0' + mes : mes;

        // Construye la fecha en formato "YYYY-MM-DD"
        var fechaCalculada = anio + '-' + mes + '-' + dia;

        return fechaCalculada;
    }

    function obtenerFechaActual() {
        var fechaActual = new Date();
        var dia = fechaActual.getDate();
        var mes = fechaActual.getMonth() + 1; // Los meses se cuentan desde 0
        var anio = fechaActual.getFullYear();

        // Asegúrate de que el formato tenga dos dígitos
        dia = dia < 10 ? '0' + dia : dia;
        mes = mes < 10 ? '0' + mes : mes;

        // Construye la fecha en formato "YYYY-MM-DD"
        var fechaFormateada = anio + '-' + mes + '-' + dia;

        return fechaFormateada;
    }
    // Ejemplo de uso: suma 30 días a la fecha actual
    // var fechaCalculada = sumarDias(30);

    $('#buscar').on('click', function() {

        var option = document.getElementById("opciones").value
        var desde = document.getElementById("desde").value
        var hasta = document.getElementById("hasta").value
        var procesos = document.getElementById("procesos").value

        if (desde.length === 0) {
            $('#val').html("<div class='text-center'> <p style='color:red'>Selecciona la fecha  inicio</p> </div>");
        }
        if (hasta.length === 0) {
            $('#val0').html("<div class='text-center'> <p style='color:red'>Selecciona la fecha final</p> </div>");
        }

        if (option.length === 0) {
            $('#val_option').html("<div class='text-center'> <p style='color:red'>Selecciona un proceso</p> </div>");
        }
        if (procesos.length === 0) {
            $('#val1').html("<div class='text-center'> <p style='color:red'>Selecciona un proceso</p> </div>");
        }

        if (hasta.length > 0 && hasta.length > 0 && hasta.length > 0)
            $.ajax({
                type: "POST",
                url: '?c=indicadors&a=consolidado2',
                data: {
                    procesos: procesos,
                    desde: desde,
                    hasta: hasta,
                },
                beforeSend: function() {
                    $('#result').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#result').html(resp);
                }
            });
        else
            $('#result').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>SIN FILTRO PARA LA CONSULTA</p> </div>");

    });
</script>