<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Fabricante</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo $fabricante->nombres ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="id" name="id" value="<?php echo $fabricante->id ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn btn-guardar">
        </div>
    </form>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formCrud").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=fabricantes&a=Crud",
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