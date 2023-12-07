<form method="post" name="formEditDoc" id="formEditFor" enctype="multipart/form-data">
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                        <input type="text" name="Version" id="Version" class="form-control" value="<?= $documentos->Version ?>">
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
                <input title="Botón para guardar los datos" type="button" id="guardar" class="btn btn-guardar btn-block" value="Actualizar">
            </div>
        </div>
    </div>
</form>
<script>
    $(document).on('click', '#guardar', function(e) {
        // var data = $("#formResponder").serialize();
        var formData = new FormData($("#formEditFor")[0]);
        $.ajax({
            url: "?c=formatos&a=Registrar",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500,
                    showConfirmButton: false,

                }, )
                setTimeout(function() {                    
                  window.location.reload();
                }, 2000)

            }
        });
    });
</script>