<? //print_r($usuarios) ?>
<? //print_r($_SESSION['datos_cliente']->id) ?>

<form method="post" name="formplanauditoria" id="formplanauditoria">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Proceso</label>
                        <select name="proceso_id" id="proceso_id" class="form-control">
                            <?php foreach ($procesos as $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->Iniciales . '-' . $value->NombreProceso ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Lider del Proceso</label>
                        <select name="liderproceso" id="liderproceso" class="form-control">
                            <?php foreach ($usuarios as $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombres . '-' . $value->apellidos ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Auditor Lider</label>
                        <select name="auditorLider" id="auditorLider" class="form-control">
                            <?php foreach ($usuarios as $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombres . '-' . $value->apellidos ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Auditor de Apoyo</label>
                        <select name="auditorapoyo" id="auditorapoyo" class="form-control">
                            <?php foreach ($usuarios as $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombres . '-' . $value->apellidos ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Experto Tecnico</label>
                        <select name="expertotecnico" id="expertotecnico" class="form-control">
                            <?php foreach ($usuarios as $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombres . '-' . $value->apellidos ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Hora Inicio Auditoria</label>
                        <input type="time" name="horainicio" id="horainicio" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Hora Fin Auditoria</label>
                        <input type="time" name="horafin" id="horafin" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label for="nuevoNumero">Fecha de Auditoria</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                        <input type="hidden" name="programa_id" id="programa_id" value="<?=$_REQUEST['programa_id'] ?>" class="form-control">
                        <input type="hidden" name="id" id="id" value="" class="form-control">
                
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success">Continuar</button>
            </div>
        </div>
</form>
<script>
    function enviarFormulario() {
        var formData = new FormData(document.getElementById('formplanauditoria'));

        $.ajax({
            type: 'POST',
            url: '?c=auditorias&a=RegistrarPlan', // Reemplaza con la URL correcta de tu controlador
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var data = JSON.parse(response); 
                Swal.fire({
                    icon: 'success',
                    title: data.mensaje,
                    title: 'Selecciona los Numerales para auditar',
                    text: response.mensaje,
                    // timer: 1500,
                    // showConfirmButton: false,
                });
                setTimeout(function() {
                   window.location.href = "?c=normas&a=numerales&pid="+data.plan_id;
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