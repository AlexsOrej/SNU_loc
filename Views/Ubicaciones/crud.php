<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Ubicación</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $ubicacion->nombre ?>" class="form-control">
                </div>
                <div id="nombre_"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
            <div class="form-line">
                <label for="">Sede</label>
                <select name="sede_id" id="sede_id" class="form-control" required="required">
                    <?php foreach ($sedes as $value) : ?>
                        <option value="<?= $value->id ?>" <?php echo $value->id == $ubicacion->sede_id ? 'selected' : '' ?>> <?= $value->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            </div>
        </div>

        <div class="col-md-12">
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="id" name="id" value="<?php echo $ubicacion->id ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn btn-guardar">
        </div>
    </form>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        e.preventDefault(); // Corrige "event.preventDefault;" y utiliza "e.preventDefault()"
        var nombre = $("#nombre").val();
        if (nombre === "") {
            $('#nombre_').html("<p class='font-bold col-orange'>Diligencia el nombre</p>");
            return; // Detiene la ejecución si el nombre está en blanco
        }
        var data = $("#formCrud").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=ubicaciones&a=Crud",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 2000
                }, )
                setTimeout(function() {
                    window.location.reload();
                }, 2000)
            }
        })
    });
</script>