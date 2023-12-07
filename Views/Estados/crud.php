<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Estado</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $estado->nombre ?>" class="form-control">
                </div>
            </div>
            <div id="nombre_"></div>
        </div>

        <div class="col-md-12">
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="id" name="id" value="<?php echo $estado->id ?>" class="form-control">
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
            url: "?c=estados&a=Crud",
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