<div class="card">
    <div class="header">
        <h2>CARTELERA</h2>
    </div>
    <div class="body">
        <div class="row clearfix">
            <form method="POST" name="formcartel" id="formcartel" role="form">
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="" required="required" value="<?= $datos->titulo ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="vigencia">Vigencia</label>
                            <input type="date" class="form-control" id="vigencia" name="vigencia" value="<?= $datos->vigencia ?>" required="required">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="contenido">Contenido</label>
                            <textarea name="contenido" id="contenido" class="form-control" rows="3" required="required"><?= $datos->contenido ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" class="form-control" name="usuario_id" id="usuario_id" value="<?= $datos->usuario_id>0?$datos->usuario_id:$_SESSION['user']->user_id ?>">
                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $datos->id ?>">
                    <button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-block">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
print_r($_SESSION['user']->user_id);
?>

<script>
    $(document).on('submit', '#formcartel', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=cartelera&a=agregar",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                });
            }
        });
    });
</script>