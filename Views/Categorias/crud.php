<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $categoria->nombre ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <div class="form-line">
                <label for="">Codigo</label>
                <input type="text" id="codigo" name="codigo" value="<?php echo $categoria->codigo ?>" class="form-control">
            </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <div class="form-line">
                <label for="">Vida Util</label>
                <input type="number" id="vidautil" min="1" max="10" name="vidautil" value="<?php echo $categoria->vidautil ?>" class="form-control">
            </div>
            </div>

        </div>

        <div class="col-md-12">
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="id" name="id" value="<?php echo $categoria->id ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn btn-guardar btn-block">
        </div>
    </form>
</div>


<script>
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formCrud").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=categorias&a=Crud",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 2000
                }, )
                setTimeout(function() {
                    window.location = '?c=categorias&a=index';
                }, 2000)
            }

        })
    });
</script>