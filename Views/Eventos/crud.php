<? //print_r($cargo)
?>
<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Nombre</label>
                    <input type="text" id="nombreevento" name="nombreevento" value="<?php echo $evento->nombreevento ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Sigla</label>
                    <input type="text" id="sigla" name="sigla" value="<?php echo $evento->sigla ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Correo Responsable</label>
                    <input type="text" id="correoresponsable" name="correoresponsable" value="<?php echo $evento->correoresponsable ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" id="id" name="id" value="<?php echo $evento->id ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn-guardar">
        </div>
    </form>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formCrud").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=eventos&a=Crud",
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