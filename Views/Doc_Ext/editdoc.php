<form method="post" name="formEditDoc" id="formEditDoc" enctype="multipart/form-data">
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Código</label>
                        <input type="text" name="CodDocumento" id="CodDocumento" class="form-control" value="<?=$documentos->CodDocumento ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Proceso</label>
                        <input type="text" name="Proceso" id="Proceso" class="form-control" value="<?=$documentos->Proceso ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Nombre</label>
                        <input type="text" name="NomDocumento" id="NomDocumento" class="form-control" value="<?=$documentos->NomDocumento ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Versión</label>
                        <input type="text" name="Version" id="Version" class="form-control" value="<?=$documentos->Version ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Protección</label>
                        <input type="text" name="proteccion" id="proteccion" class="form-control" value="<?=$documentos->proteccion ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Almacenamiento</label>
                        <input type="text" name="Almacenamiento" id="Almacenamiento" class="form-control" value="<?=$documentos->Almacenamiento ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Preservación</label>
                        <input type="text" name="preservacion" id="preservacion" class="form-control" value="<?=$documentos->preservacion ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Emisión</label>
                        <input type="text" name="Emision" id="Emision" class="form-control" value="<?=$documentos->Emision ?>">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Actualización</label>
                        <input type="text" name="Actualizacion" id="Actualizacion" class="form-control" value="<?=$documentos->Actualizacion ?>">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?=$documentos->id ?>">
                 
                    </div>
                </div>
            </div> 
            <div class="col-md-12">
                <input type="button" id="guardar" class="btn btn-default btn-block" value="Actualizar">
            </div>
        </div>
    </div>
</form>
<script>

    $(document).on('click', '#guardar', function(e) {
       // var data = $("#formResponder").serialize();
         var formData = new FormData($("#formEditDoc")[0]);
         
        $.ajax({
            url: "?c=documentos&a=Registrar",
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
                    $('#modal-id').modal('hide');
                    $( "#table" ).load(window.location.href + " #table" );
                    // window.location.reload(1);
                }, 2000)

            }
        });
    });
</script>