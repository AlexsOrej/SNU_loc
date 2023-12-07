<!-- #END# CPU Usage -->
<? //print_r($docCodigo);
?>
<div class="card">
    <div class="header">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 text-center">
                <h2>VALIDACIÓN DE CAMBIOS</h2>
            </div>
        </div>
    </div>
    <div class="body">

        <form method="post" name="formResponder" id="formResponder" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="hidden" name="id" value="<?= $documentos->id ?>">
                    <input type="hidden" name="sol_id" value="<?= $_REQUEST['id']  ?>">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Estado de la Solicitud</label>
                                <select name="Aprobado" class="form-control" required>
                                    <option value="">Seleccionar :)</option>
                                    <?php
                                    foreach ($asignados as $asignado) {

                                        if ($asignado->actividad == 'revisar') {
                                            echo '<option value="re">En revisión</option>';
                                        } elseif ($asignado->actividad == 'aprobar') {
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
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Código</label>
                            <input type="text" name="CodFormato" id="CodFormato" class="form-control" value="<?= $documentos->CodFormato ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Proceso</label>
                            <input type="text" name="Proceso" id="Proceso" class="form-control" value="<?= $documentos->Proceso ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nombre</label>
                            <input type="text" name="NomFormato" id="NomFormato" class="form-control" value="<?= $documentos->NomFormato ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Ruta Formato</label>
                            <input type="text" name="RutaFormato" id="RutaFormato" class="form-control" value="<?= $documentos->RutaFormato ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Ruta Recuperación</label>
                            <input type="text" name="Recuperacion" id="Recuperacion" class="form-control" value="<?= $documentos->Recuperacion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Versión</label>
                            <input type="text" name="Version" id="Version" class="form-control" value="<?= $documentos->Version + 1 ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Emisión</label>
                            <input type="date" name="Emision" id="Emision" class="form-control" value="<?= date('Y-m-d', strtotime($documentos->Emision)) ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Actualización</label>
                            <input type="date" name="Actualizacion" id="Actualizacion" class="form-control" value="<?= date('Y-m-d', strtotime($documentos->Actualizacion)) ?>">
                            <input type="hidden" name="id" id="id" class="form-control" value="<?= $documentos->id ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Almacenamiento</label>
                            <input type="text" name="Almacenamiento" id="Almacenamiento" class="form-control" value="<?= $documentos->Almacenamiento ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Tipo Recuperación</label>
                            <input type="text" name="TipoRecuperacion" id="TipoRecuperacion" class="form-control" value="<?= $documentos->TipoRecuperacion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Tiempo Retención</label>
                            <input type="text" name="TiempoRetencion" id="TiempoRetencion" class="form-control" value="<?= $documentos->TiempoRetencion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Disposición Final</label>
                            <input type="text" name="DispFinal" id="DispFinal" class="form-control" value="<?= $documentos->DispFinal ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Protección</label>
                            <input type="text" name="Proteccion" id="Proteccion" class="form-control" value="<?= $documentos->Proteccion ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Responsable</label>
                            <input type="text" name="Responsable" id="Responsable" class="form-control" value="<?= $documentos->Responsable ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" id="tiposolicitud" name="tiposolicitud" class="" value="<?= $solicitud->TipoSolicitud ?>">
                    <input type="button" id="guardar" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on('click', '#guardar', function(e) {
        $.ajax({
            url: "?c=solicitudes&a=GestionFormato",
            type: "POST",
            data: $("#formResponder").serialize(),
            beforeSend: function() {
                let timerInterval
                Swal.fire({
                    title: 'REGISTRANDO',
                    html: 'Creando el formato <b></b> milisegundo restantes',
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
                    title: 'BIEN HECHO!!',
                    timer: 1500,
                    showConfirmButton: false,
                }, )
                setTimeout(function() {
                    window.location = '?c=solicitudes&a=index';
                    // window.location.reload(1);
                }, 2000)
            }
        });
    });
</script>