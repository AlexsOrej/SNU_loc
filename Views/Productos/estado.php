<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>CAMBIO DE ESTADO</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form action="" method="POST" name="formProducto" id="formProducto" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?= $producto->id ?>">
                        <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $producto->usuario_id ?>">
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Estado</label>
                                    <select name="estado_id"  id="estado_id" class="form-control" required="true">
                                        <option value="">Seleccione...</option>
                                        <option value="1" <?php echo $producto->estado_id == '1' ? 'selected' : '' ?>>Excelente</option>
                                        <option value="2" <?php echo $producto->estado_id == '2' ? 'selected' : '' ?>>Bueno</option>
                                        <option value="3" <?php echo $producto->estado_id == '3' ? 'selected' : '' ?>>Regular</option>
                                        <option value="4" <?php echo $producto->estado_id == '4' ? 'selected' : '' ?>>Malo</option>
                                        <option value="5" <?php echo $producto->estado_id == '5' ? 'selected' : '' ?>>Baja</option>
                                        <option value="6" <?php echo $producto->estado_id == '6' ? 'selected' : '' ?>>Propiedad de Terceros</option>
                                        <option value="7" <?php echo $producto->estado_id == '7' ? 'selected' : '' ?>>Obsoleto</option>
                                    </select>
                                </div>
                            </div>
                        </div>                    
                         <input type="button" id="guardar" class="btn btn-guardar" value="Cambiar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
<script>
    $(document).on('click', '#guardar', function(e) {
        // var data = $("#formResponder").serialize();
        var formData = new FormData($("#formProducto")[0]);
        var idp= document.getElementById("id").value
        
        $.ajax({
            url: "?c=productos&a=Reg_Estado",
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
                    // window.location = '?c=productos&a=Ver&id='+idp;
                     window.location.reload();
                }, 2000)

            }
        });
    });
</script>