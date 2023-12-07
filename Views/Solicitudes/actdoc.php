<!-- #END# CPU Usage -->
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
                    <input type="hidden" name="id" value="<?= $docCodigo->id ?>">
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
                                <label>Fecha Revisión/Ejecución</label>
                                <input type="date" name="EjecucionCambio" id="EjecucionCambio" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Codigo</label>
                            <?php //$numCod = $separada[2] + 1; 
                            ?>
                            <input type="text" name="CodDocumento" id="CodDocumento" class="form-control" value="<?= $docCodigo->CodDocumento ?>">
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre Documento</label>
                            <input type="text" name="NomDocumento" id="NomDocumento" class="form-control" value="<?= $docCodigo->NomDocumento ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Almacenamiento</label>
                            <input type="text" name="Almacenamiento" id="Almacenamiento" class="form-control" value="<?= $docCodigo->Almacenamiento ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">protección</label>
                            <input type="text" name="proteccion" id="proteccion" class="form-control" value="<?= $docCodigo->proteccion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">preservación</label>
                            <input type="text" name="preservacion" id="preservacion" class="form-control" value="<?= $docCodigo->preservacion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Elaboración</label>
                            <input type="date" name="Emision" id="Emision" class="form-control" value="<?php echo date('Y-m-d', strtotime($docCodigo->Emision)) ?>" required readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Actualización</label>
                            <input type="date" name="Actualizacion" id="Actualizacion" class="form-control" value="<?php echo date('Y-m-d', strtotime($docCodigo->Actualizacion)) ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <? if (empty($onlinedocs)) : ?>
                            <div class="form-line">
                                <label>Documento .pdf</label>
                            </div>
                            <input type="file" name="filename" id="filename" class="form-control">
                        <? endif; ?>

                        <input type="hidden" name="dir" id="dir" class="form-control">
                        <input type="hidden" name="Proceso" id="Proceso" class="form-control" value="<?= $docCodigo->Proceso ?>">
                        <input type="hidden" name="Version" id="Version" class="form-control" value="<?= $docCodigo->Version + 1 ?>">
                        <input type="hidden" name="sol_id" id="sol_id" class="form-control" value="<?= $_REQUEST['id'] ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" id="TipoSolicitud" name="TipoSolicitud" class="" value="<?= $solicitud->TipoSolicitud ?>">
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
        var Actualizacion = document.getElementById("Actualizacion");
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
                title: 'Recuerda Digitar la observación detallamente',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else if (Actualizacion.value === "") {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda Digitar la fecha de Actualización',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else {
            var formData = new FormData($("#formResponder")[0]);
            $.ajax({
                url: "?c=solicitudes&a=GestionDocumento",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    let timerInterval
                    Swal.fire({
                        title: 'REGISTRANDO',
                        html: 'Creando el Documento <b></b> milisegundo restantes',
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
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        text: response,
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location = '?c=solicitudes&a=index';
                    }, 1501)
                }
            });
        }
    });
</script>