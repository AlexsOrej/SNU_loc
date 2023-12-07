<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <a href="https://scribehow.com/shared/Como_hacer_las_solicitudes_para_un_cambio_en_los_procedimientos_formato_y_externos__dr3MbP9XTD-FrzEDh2SASA" target="_blank">
                        <span class="material-icons">
                            help_center
                        </span></a> </i>DATOS DE LA SOLICITUD
                        <small>Solicitud para el Control de Cambios</small>
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form method="post" name="formSolicitud" id="formSolicitud" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Proceso Solicitante</label>
                                        <select class="form-control show-tick" name="Proceso" id='Proceso' required>
                                            <option value="">-- Seleccionar --</option>
                                            <?php foreach ($procesos as $sgc) : ?>
                                                <option value="<?php echo $sgc->Iniciales ?>"><?php echo $sgc->NombreProceso ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Tipo de Información</label>
                                        <select class="form-control show-tick" name="TipoDocumento" id="TipoDocumento" required>
                                            <option value="">-- Seleccionar --</option>
                                            <option value="documento">Documento</option>
                                            <option value="formato">Formato</option>
                                            <option value="software">Software</option>
                                            <option value="externo">Externo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Tipo Solicitud</label>
                                        <select class="form-control show-tick" name="TipoSolicitud" id="TipoSolicitud" required>
                                            <option value="">-- Seleccionar --</option>
                                            <option value="creacion">Creación</option>
                                            <option value="actualizacion">Actualización</option>
                                            <option value="eliminacion">Eliminación</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="index" id="index"></div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Numero Solicitud</label>
                                        <input type="text" name="id" value="<?php echo $ultima_solicitud->ULTIMA + 1 ?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Nombre Solicitante</label>
                                        <input type="text" name="NombreSolicitante" id="NombreSolicitante" value="<?php echo ucwords($_SESSION['user']->FullName) ?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Fecha Solicitud</label>
                                        <input type="date" name="FechaSolicitud" class='form-control' value="<?php echo date('Y-m-d') ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Words o excel de un peso maximo de 2MB">
                                    <div class="form-line">
                                        <label>Adjuntar Archivo</label>
                                        <input type="file" name="filename" class='form-control' value="">
                                        <input type="hidden" name="dir" class='form-control' value="">
                                        <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="form-group" data-toggle="tooltip" data-placement="bottom" title="Brinda detalle de la solicitud, nombre del documento y su importancia">
                                    <div class="form-line">
                                        <label>Justificación</label>
                                        <textarea name="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="button" id="guardar" class="btn btn-guardar" value="Guardar">
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#TipoSolicitud').on('change', function() {
        var TipoDocumento = document.getElementById("TipoDocumento").value
        var Proceso = document.getElementById("Proceso").value
        var TipoSolicitud = document.getElementById("TipoSolicitud").value
        $.ajax({
            type: "POST",
            url: '?c=solicitudes&a=descripcion',
            data: {
                TipoDocumento: TipoDocumento,
                Proceso: Proceso,
                TipoSolicitud: TipoSolicitud
            },
            beforeSend: function() {
                $('#index').html("<h5 class='text-center'> <img src='Assets/images/gifs/cargando-loading-026.gif'> Cargando Información</h5>");
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    });

    $(document).on('click', '#guardar', function(e) {
        // var data = $("#formResponder").serialize();
        var formData = new FormData($("#formSolicitud")[0]);
        $.ajax({
            url: "?c=solicitudes&a=Registrar",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                }, )
                setTimeout(function() {
                    // window.location = '?c=solicitudes&a=index';                    
                }, 2000)

            }
        });
    });
</script>