<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- <div class="card">-->
        <div class="body">
            <form id="formRequisicion" name="formRequisicion" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>" />
                <div class="row clearfix">
                    <div class="col-sm-12 text-center">
                        <div class="form-group">
                            <div class="form-line">
                                <label style="color:red"> *ESTADO AUTORIZACIÓN* </label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="1">Solicitado</option>
                                    <option value="2">Aceptado</option>
                                    <option value="3">Rechazado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input name='cargo_id' id="cargo_id" value="<?php echo $alm->cargo_id; ?>" type="hidden">
                    </fieldset>
                    <div class="col-md-12">
                    <a href="#" title="Boton para registrar autorización" id="guardar" class="btn-guardar btn-block"  >Registrar</a>           
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<? //print_r($alm)?>
<!-- #END# Textarea -->
<script>
    $(document).on('click', '#guardar', function(e) {       
        var formData = new FormData($("#formRequisicion")[0]);
        $.ajax({
            url: "?c=Requisicions&a=Autor_guardar",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'La autotizacion se regsitro con éxito',
                    timer: 1500,
                    showConfirmButton: false,
                }, )
                setTimeout(function() {
                window.location = '?c=requisicions&a=index';
                }, 2000)
            }
        });
    });
</script>
