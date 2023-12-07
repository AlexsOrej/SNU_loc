<?
// print_r($especificacion);
?>
<form id="especificacionesForm">
    <div class="row">
        <input type="hidden" class="form-control" id="producto_id" name="producto_id" value="<?= isset($_REQUEST['producto_id']) ? $_REQUEST['producto_id'] : $especificacion->producto_id ?>">
        <div class="col-md-4">
            <div class="form-group">
                <label for="ubicacion_especifica">Ubicación Específica:</label>
                <input type="text" class="form-control" id="ubicacion_especifica" name="ubicacion_especifica" value="<?= $especificacion->ubicacion_especifica ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="uso">Uso:</label>
                <input type="text" class="form-control" id="uso" name="uso" value="<?= $especificacion->uso ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?= $especificacion->marca ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="material">Material:</label>
                <input type="text" class="form-control" id="material" name="material" value="<?= $especificacion->material ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="lugar_origen">Lugar de Origen:</label>
                <input type="text" class="form-control" id="lugar_origen" name="lugar_origen" value="<?= $especificacion->lugar_origen ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="resolucion">Resolución:</label>
                <input type="text" class="form-control" id="resolucion" name="resolucion" value="<?= $especificacion->resolucion ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bateria">Batería:</label>
                <input type="text" class="form-control" id="bateria" name="bateria" value="<?= $especificacion->bateria ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="presicion">Precisión:</label>
                <input type="text" class="form-control" id="presicion" name="presicion" value="<?= $especificacion->presicion ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="tipo_certificado">Tipo de Certificado:</label>
                <input type="text" class="form-control" id="tipo_certificado" name="tipo_certificado" value="<?= $especificacion->tipo_certificado ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="clasificacion_riesgo">Clasificación de Riesgo:</label>
                <input type="text" class="form-control" id="clasificacion_riesgo" name="clasificacion_riesgo" value="<?= $especificacion->clasificacion_riesgo ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $especificacion->modelo ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" value="<?= $especificacion->color ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="color">Frecuencia de mantenimiento(meses):</label>
                <input type="number" class="form-control" id="frecu_mantenimiento" name="frecu_mantenimiento" min="1" max="30" value="<?= $especificacion->frecu_mantenimiento ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="inicio_mantenimiento">Inicio de Mantenimiento:</label>
                <input type="date" class="form-control" id="inicio_mantenimiento" name="inicio_mantenimiento" value="<?= $especificacion->inicio_mantenimiento ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="reg_DIAN">Registro DIAN:</label>
                <input type="text" class="form-control" id="reg_DIAN" name="reg_DIAN" value="<?= $especificacion->reg_DIAN ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="rango_ini_calibracion">Rango Inicial de Calibración:</label>
                <input type="text" class="form-control" id="rango_ini_calibracion" name="rango_ini_calibracion" value="<?= $especificacion->rango_ini_calibracion ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="rango_fin_calibracion">Rango Final de Calibración:</label>
                <input type="text" class="form-control" id="rango_fin_calibracion" name="rango_fin_calibracion" value="<?= $especificacion->rango_fin_calibracion ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="rango_ini_medicion">Rango Inicial de Medición:</label>
                <input type="text" class="form-control" id="rango_ini_medicion" name="rango_ini_medicion" value="<?= $especificacion->rango_ini_medicion ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="rango_fin_medicion">Rango Final de Medición:</label>
                <input type="text" class="form-control" id="rango_fin_medicion" name="rango_fin_medicion" value="<?= $especificacion->rango_fin_medicion ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="rango_fin_medicion">Link a documentación</label>
                <input type="text" class="form-control" id="link" name="link" value="<?= $especificacion->link ?>">
            </div>
        </div>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="<?= $especificacion->id ?>">
    <button type="submit" class="neu">Guardar
        <span class="material-icons">
            save
        </span>
    </button>
</form>

<script>
    $(document).ready(function() {
        $('#especificacionesForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var isValid = true;

            // Verificar si hay campos vacíos
            form.find('input, select, textarea').not('[name="id"]').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // Romper el bucle si se encuentra un campo vacío
                }
            });

            // Si algún campo está vacío, muestra un mensaje de error
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, completa todos los campos del formulario.',
                });
            } else {
                // Si no hay campos vacíos, enviar el formulario con AJAX
                $.ajax({
                    url: '?c=especificaciones&a=registrar', // Cambia esto por la URL de tu controlador
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Maneja la respuesta aquí
                        Swal.fire({
                            icon: 'success',
                            title: 'El registro se realizó con éxito',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                           window.location.reload();
                        }, 1500);
                    }
                });
            }
        });
    });
</script>