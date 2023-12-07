<div id="main">
<div id='result'></div>
<div class="card">
    <div class="header">
        <h3 class="title">Actualizar Permisos</h3>
    </div>
    <!-- /.card-header -->
    <div class="body" id="main2">
        <form action="" method="post" name="permiso" id="permiso">
            <div class="row" id="main2">
                <div class="col-md-3">
                    <label for="">Crear</label>
                    <select name="crear" id="crear" class="form-control">
                        <option <?php echo  $update->crear == 1 ? 'selected' : '' ?> value="1">SI</option>
                        <option <?php echo  $update->crear == 2 ? 'selected' : '' ?> value="2">NO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Leer</label>
                    <select name="leer" id="leer" class="form-control">
                        <option <?php echo $update->leer == 1 ? 'selected' : '' ?> value="1">SI</option>
                        <option <?php echo $update->leer == 2 ? 'selected' : '' ?> value="2">NO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Actualizar</label>
                    <select name="actualizar" id="actualizar" class="form-control">
                        <option <?php echo $update->actualizar == 1 ? 'selected' : '' ?> value="1">SI</option>
                        <option <?php echo $update->actualizar == 2 ? 'selected' : '' ?> value="2">NO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="">Borrar</label>
                    <select name="borrar" id="borrar" class="form-control">
                        <option <?php echo $update->borrar == 1 ? 'selected' : '' ?> value="1">SI</option>
                        <option <?php echo $update->borrar == 2 ? 'selected' : '' ?> value="2">NO</option>
                    </select>
                </div><br>
                <div class="col-md-12"><br>
                    <input type="hidden" id="id" name='id' value=" <?php echo $update->id ?>">
                    <input type="hidden" id="tipo_usuarios" name='tipo_usuarios' value=" <?php echo $update->tipo_usuarios ?>">

                    <input type="button" id="guardar" class="btn btn-success" value="Guardar">
                </div>
            </div>
    </div>
    </form>
</div>
</div>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        var tipo_usuarios = document.getElementById('tipo_usuarios').value;
        var data = $("#permiso").serialize();
        $.ajax({
            //async: false,
            data: data,
            type: "post",
            url: "?c=permisos&a=actualizar",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                },)
                $('#resultado1').load(' #main');
            }
        });
    });
</script>