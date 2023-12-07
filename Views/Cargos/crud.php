
<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud" enctype="multipart/form-data">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Nombre</label>
                    <input type="text" id="cargo" name="cargo" value="<?php echo $cargo->cargo ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Procesos</label>
                    <select name="proceso_id" id="proceso_id" class="form-control">
                        <?php foreach ($procesos as $value) : ?>
                            <option value="<?php echo $value->id ?>" <?php echo $value->id == $cargo->proceso_id ? 'selected' : '' ?>> <?= $value->Iniciales . ' ' . $value->NombreProceso ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>        
        <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">PERFIL DEL CARGO</label>
                            <input type="file" id="file" name="file" value="" class="form-control">
                        </div>
                    </div>
                </div>
        <div class="col-md-12">
            <input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo $_SESSION['datos_cliente']->id ?>" class="form-control">
            <input type="hidden" id="id" name="id" value="<?php echo $cargo->id ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn-guardar btn-block">
        </div>
    </form>
</div>
<script>
      $(document).on('click', '#guardar', function(e) {        
        var formData = new FormData($("#formCrud")[0]);
       
        var nombre = document.getElementById('cargo').value
        var proceso = document.getElementById('proceso_id').value

      

        if(nombre == "" || proceso == ""){
            alert("Tienes campos vacios");
        }else{
            $.ajax({
            url: "?c=cargos&a=Crud",
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
        }
    });
</script>