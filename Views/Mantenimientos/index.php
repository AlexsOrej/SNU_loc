<div class="row">
    <?php
    if ($_SESSION['rol'] != 'proveedor') :
        $disable = '';
    else :
        $disable = 'disabled';
    endif;
    if (isset($_REQUEST['true'])) :
        if ($_REQUEST['true'] == 1) :
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'La planificacion se registro con éxito!!',
                    showConfirmButton: false,
                    timer: 1500
                }, )
                setTimeout(function() {
                    window.location = '?c=mantenimientos&a=index';
                //  window.location.reload(1);
                }, 2000)
                </script>";
        else : echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'La planificacion no se registro con éxito, por favor  elige al menos 1(uno), trata de nuevo',
                    showConfirmButton: false,
                    timer: 1500
                }, )
                setTimeout(function() {
                    // window.location = '?c=mantenimientos&a=index';
                //  window.location.reload(1);
                }, 2000)
                </script>";
        endif;
    endif;
    ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading align-right">
                    <div class="btn-group">
                        <button type="button" id="ver" class="btn btn-success">Ver Estados</button>
                        <button type="button" id="planear" class="btn btn-success" <?= $disable ?>>Planear</button>
                        <button type="button" id="ejecutar" class="btn btn-success">Ejecutar</button>
                        <button type="button" id="Validar" class="btn btn-success" <?= $disable ?>>Validar</button>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <form action="" method="post" id="form_buscar" name="form_buscar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Desde</label>
                                            <input name="desde" id="desde" value="" type="date" class="form-control" placeholder="" required />
                                            <div id="val"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Hasta</label>
                                            <input name="hasta" id="hasta" value="" type="date" class="form-control" placeholder="" required />
                                            <div id="val0"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Sede</label>
                                            <select name="sede" id="sede" class="form-control" required="required">
                                                <option value="">Seleccionar</option>
                                                <? foreach ($sedes as $value) : ?>
                                                    <option value="<?= $value->id ?>"> <?= $value->nombre ?></option>
                                                <? endforeach; ?>
                                            </select>
                                            <div id="val1"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="ubicacion0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Ubicación</label>
                                            <select name="ubicacion" id="ubicacion" class="form-control" required="required">
                                                <option value=""></option>
                                                <option value="">Todas las ubicaciones</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="BuscarIndex" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info">
                <div class="panel-body" id="respuesta"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="resultado"></div>
</div>
<script>
    $('#ver').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=IndexTodo',
            beforeSend: function() {
                $('#respuesta').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
            }
        });
    });
    $('#planear').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=planear',
            beforeSend: function() {
                $('#respuesta').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
            }
        });
    });
    $('#ejecutar').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=ejecutar',
            beforeSend: function() {
                $('#respuesta').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
            }
        });
    });
    $('#Validar').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=verificar',
            beforeSend: function() {
                $('#respuesta').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
            }
        });
    });
    $('#BuscarIndex').on('click', function() {
        var desde = document.getElementById('desde').value
        var hasta = document.getElementById('hasta').value
        var ubicacion = document.getElementById('ubicacion').value
        var sede = document.getElementById('sede').value
        if (desde.length === 0) {
            $('#val').html("<div class='text-center'> <p style='color:red'>Selecciona la fecha  inicio</p> </div>");
        }
        if (hasta.length === 0) {
            $('#val0').html("<div class='text-center'> <p style='color:red'>Selecciona la fecha final</p> </div>");
        }
        if (ubicacion.length === 0) {
            $('#val1').html("<div class='text-center'> <p style='color:red'>Selecciona un Ubicacion</p> </div>");
        }
        if (desde.length > 0 && hasta.length > 0 && ubicacion.length > 0)
            $.ajax({
                type: "POST",
                url: '?c=mantenimientos&a=buscar',
                data: {
                    desde: desde,
                    hasta: hasta,
                    ubicacion: ubicacion,
                    sede: sede
                },
                beforeSend: function() {
                    $('#respuesta').html("<h5 class='text-center'>Cargando Información</h5>");
                },
                success: function(resp) {
                    $('#respuesta').html(resp);
                }
            });
    });
    $('#sede').on('change', function() {
        var sede = document.getElementById('sede').value
        if (sede.length > 0)
            $.ajax({
                type: "POST",
                url: '?c=mantenimientos&a=ubicacion',
                data: {
                    sede_id: sede
                },
                beforeSend: function() {
                    $('#ubicacion0').html("<h5 class='text-center'>Cargando Información</h5>");
                },
                success: function(resp) {
                    $('#ubicacion0').html(resp);
                }
            });
    });
</script>