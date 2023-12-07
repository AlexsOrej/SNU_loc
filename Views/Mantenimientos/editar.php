<?php //print_r($mantenimiento); ?>
<form name="mante_form" id="mante_form" method="POST" role="form">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea type="text" class="form-control" rows="4" cols="50" id="descripcion" name="descripcion" placeholder="" required><?= $mantenimiento->descripcion ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Recomendación</label>
                <textarea type="text" class="form-control" rows="4" cols="50" id="recomendacion" name="recomendacion" placeholder="" required><?= $mantenimiento->recomendacion ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Detalles</label>
                <textarea type="text" class="form-control" rows="4" cols="50" id="detalles" name="detalles" placeholder="" required><?= $mantenimiento->detalles ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Verificacion</label>
                <textarea type="text" class="form-control" rows="4" cols="50" id="verificacion" name="verificacion" placeholder="" required><?= $mantenimiento->verificacion ?></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="" value="<?= $mantenimiento->fecha ?>" required>
            </div>
        </div>
        <div class="col-md-12 pull-left">
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?= $mantenimiento->id ?>" required>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#mante_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '?c=mantenimientos&a=actualizar', // Cambia esto por la URL de tu controlador
                type: 'POST',
                data: $('#mante_form').serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response,
                        //timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload(1);                       
                    }, 2000)
                }
            });
        });
    });
</script>