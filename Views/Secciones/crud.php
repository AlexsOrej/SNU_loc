<div class="card">
    <div class="body">
        <form method="post" name="formSeccion" id="formSeccion">
            <div class="row">
                <!-- ... tus inputs existentes ... -->
                <div class="col-sm-12" id="nuevosInputsContainer">
                    <!-- Plantilla oculta para nuevos inputs -->
                    <div id="plantillaNuevosInputs">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="nuevoNumero">Número</label>
                                    <input class="form-control" type="text" name="nuevoNumero[]" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="nuevoTitulo">Título</label>
                                    <input class="form-control" type="text" name="nuevoTitulo[]" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la plantilla oculta -->
                </div>
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary" onclick="agregarNuevosInputs()">Agregar Nuevos Inputs</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <input id="id" class="form-control" type="hidden" name="id" value="<?= $seccion->id ?>">
                    <input id="normaid" class="form-control" type="hidden" name="normaid" value="<?= $_REQUEST['norma_id'] ?>">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function agregarNuevosInputs() {
        // Obtener la plantilla oculta
        var plantilla = document.getElementById('plantillaNuevosInputs');

        // Clonar la plantilla
        var nuevoInput = plantilla.cloneNode(true);

        // Cambiar el ID de la plantilla clonada para que sea único
        nuevoInput.id = 'nuevoInput' + (document.querySelectorAll('[id^="nuevoInput"]').length + 1);

        // Mostrar la plantilla clonada
        nuevoInput.style.display = 'block';

        // Agregar la plantilla clonada al contenedor
        document.getElementById('nuevosInputsContainer').appendChild(nuevoInput);
    }

    function enviarFormulario() {
        var formData = new FormData(document.getElementById('formSeccion'));

        $.ajax({
            type: 'POST',
            url: '?c=secciones&a=Registrar', // Reemplaza con la URL correcta de tu controlador
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Manejar la respuesta del controlador (puede ser una redirección, mensaje, etc.)
                Swal.fire({
                    icon: 'success',
                    title: 'El registro se realizó con éxito',
                    text: response,
                    // timer: 1500,
                    // showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1500)
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(xhr.responseText);
            }
        });
    }

    // Manejar el evento submit del formulario
    $(document).ready(function() {
        $('#formSeccion').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario estándar
            // agregarNuevosInputs(); // Agregar nuevos inputs si es necesario
            enviarFormulario(); // Enviar el formulario con Ajax
        });
    });
</script>