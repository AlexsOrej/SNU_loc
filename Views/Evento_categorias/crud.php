<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Clasificación</label>
                <select name="clasificacionIncidente" id="clasificacionIncidente" class="form-control">
                    <option value="">Seleccionar</option>
                    <? foreach ($clasificacion as $value) : ?>
                        <option value="<?= $value->sigla ?>" <?= $evento->clasificacionIncidente == $value->sigla ? 'selected' : ''  ?>><?= $value->sigla . '-' . $value->nombreevento ?></option>
                    <? endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Tipo Incidente</label>
                    <input type="text" id="tipoIncidente" name="tipoIncidente" value="<?php echo $evento->tipoIncidente ?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <div class="form-line">
                    <label for="">Correción Incidente</label>
                    <textarea type="text" id="correcionIncidente" rows="4" name="correcionIncidente" value="<?php echo $evento->correcionIncidente ?>" class="form-control"><?php echo $evento->correcionIncidente ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" id="id" name="id" value="<?php echo $evento->id ?>" class="form-control">
            <input type="hidden" id="fechaRegistro" name="fechaRegistro" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="usuario" name="usuario" value="sistema" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn btn-guardar">
        </div>
    </form>
</div>

<script>
   $(document).on('click', '#guardar', function(e) {
    e.preventDefault(); // Evita que se realice el envío del formulario por defecto

    var tipoIncidente = $('#tipoIncidente').val().trim();
    var correcionIncidente = $('#correcionIncidente').val().trim();
    var clasificacionIncidente = $('#clasificacionIncidente').val().trim();

    // Validar campos vacíos
    if (tipoIncidente === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El campo "Tipo de Incidente" no puede estar vacío',
        });
        return; // Detener la ejecución de la función
    }

    if (correcionIncidente === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El campo "Corrección de Incidente" no puede estar vacío',
        });
        return; // Detener la ejecución de la función
    }

    if (clasificacionIncidente === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El campo "Clasificación de Incidente" no puede estar vacío',
        });
        return; // Detener la ejecución de la función
    }

    var formData = new FormData($("#formCrud")[0]);

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "?c=eventos_categorias&a=Crud",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Manejar la respuesta exitosa del servidor
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡BIEN HECHO!<br>' + response.message,
                });
                setTimeout(function() {                   
                    window.location.reload();
                }, 2000)
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                });
                setTimeout(function() {                   
                    window.location.reload();
                }, 2000)
            }
        },    
    });
});
</script>