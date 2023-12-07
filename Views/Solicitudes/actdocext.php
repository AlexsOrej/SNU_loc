<!-- #END# CPU Usage -->
<?php //print_r($solicitud->TipoSolicitud);
?>
<div class="card">
    <div class="header">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12">
                <h2>VALIDACIÓN DE CAMBIOS</h2>
            </div>
        </div>
    </div>
    <div class="body">
        <form method="post" name="formResponder" id="formResponder" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="hidden" name="sol_id" value="<?= $_REQUEST['id'] ?>">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Estado de la Solicitud</label>
                                <select name="Aprobado" id="Aprobado" class="form-control" required>
                                    <option value="">Seleccionar :)</option>
                                    <?php
                                    foreach ($asignados as $asignado) {
                                        if ($asignado->actividad == 'revisar') {
                                            echo '<option value="re">En revisión</option>';
                                        }
                                        if ($asignado->actividad == 'aprobar') {
                                            echo '<option value="si">Aprobado</option>';
                                            echo '<option value="no">No Aprobado</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Revisión respecto a la conveniencia y adecuación del sistema de gestión:</label>
                                <input type="text" name="Observaciones" id="Observaciones" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha Ejecución</label>
                                <input type="date" name="EjecucionCambio" id="EjecucionCambio" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" value="<?= $docCodigo->codigo ?>">
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= $docCodigo->nombre ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Expedición</label>
                            <input type='date' name="expedicion" id="expedicion" class="form-control" value="<?= $docCodigo->expedicion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" cols="3" rows="4"><?= $docCodigo->descripcion ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Documento (.pdf)</label>
                            <input type="file" name="filename" id="filename" class="form-control">
                            <input type="hidden" name="dir" id="dir" class="form-control">
                            <input type="hidden" name="proceso" id="proceso" class="form-control" value="<?= $solicitud->Proceso ?>">
                            <input type="hidden" name="tiposolicitud" id="tiposolicitud" class="form-control" value="<?= $solicitud->TipoSolicitud ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">                
                    <input type="button" id="guardar" class="btn btn-success" value="Guardar">                  
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        var select = document.getElementById("Aprobado");
        var Observaciones = document.getElementById("Observaciones");
        var nombre = document.getElementById("nombre");
        var expedicion = document.getElementById("expedicion");
        var descricion = document.getElementById("descripcion");
        var file = document.getElementById("filename");
        if (select.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda que el estado de la solicitud debe ser elegido',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else if (Observaciones.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda diligenciar la Revisión',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else if (nombre.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda darle un nombre al documento',
                timer: 1500,
                showConfirmButton: false,
            }, )

        } else if (expedicion.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda diligenciar la expedicion del documento',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else if (descricion.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda dar una descripción lo mas detallada posible',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else if (file.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda adjuntar el nuevo documeno externo en .pdf',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else {
            var formData = new FormData($("#formResponder")[0]);
            $.ajax({
                url: "?c=solicitudes&a=GestionDocext",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    let timerInterval
                    Swal.fire({
                        title: 'REGISTRANDO',
                        html: 'Creando el documento externo <b></b> milisegundo restantes',
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            // console.log('I was closed by the timer')
                        }
                    })
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado Con exito',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                      window.location = '?c=solicitudes&a=index';
                    }, 2000)

                }
            });
        }
    });
</script>