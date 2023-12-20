<form method="post" name="formplanauditoria" id="formplanauditoria">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Alcance</label>
                        <input name="alcance" id="alcance" class="form-control" value="<?=$auditoria->alcances?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Criterios</label>
                        <input name="criterios" id="criterios" class="form-control" value="<?=$auditoria->criterios ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Objetivo</label>
                        <input name="objetivos" id="objetivos" class="form-control"  value="<?=$auditoria->objetivos ?>"required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Riesgos</label>
                        <input name="riesgos" id="riesgos" class="form-control" value="<?=$auditoria->riesgos ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Metodo</label>
                        <input name="metodo" id="metodo" class="form-control" value="<?=$auditoria->metodo ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Cantidad de Auditores</label>
                        <input name="cant_auditores" id="cant_auditores" type="number" class="form-control" value="<?=$auditoria->cant_auditores ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Fecha Inicio</label>
                        <input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" value="<?=$auditoria->fecha_inicio ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Fecha Fin</label>
                        <input name="fecha_fin" id="fecha_fin" type="date" class="form-control" value="<?=$auditoria->observaciones ?>" fecha_fin>       
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Observaciones</label>
                        <input name="observaciones" id="observaciones" type="text" class="form-control" value="<?=$auditoria->observaciones ?>" required>
                        <input name="id" id="id" type="hidden" class="" value="<?=$auditoria->id ?>" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </div>
</form>
<script>
    function enviarFormulario() {
        var formData = new FormData(document.getElementById('formplanauditoria'));

        $.ajax({
            type: 'POST',
            url: '?c=auditorias&a=Registrar', // Reemplaza con la URL correcta de tu controlador
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
        $('#formplanauditoria').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario estándar  
            enviarFormulario(); // Enviar el formulario con Ajax
        });
    });
</script>