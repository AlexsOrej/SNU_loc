<div class="col-md-12">
    <div class="card">
        <div class="header">Actualiza el estado del colaborador</div>
        <div class="body">
            <div class="col-md-6 input-group">
                <select class="form-control" id="selectUser">
                    <option value="">Seleccionar Estado</option>
                    <?php foreach ($estado as $value) : ?>
                        <option value="<?= $value->id ?>" <?= $value->id == $persona->rol_id ? 'selected' : '' ?>><?= $value->status ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" id="usuario_id" value="<?= $_REQUEST['id'] ?>">
                <div class="input-group-append">
                    <button title="Botón para cambiar el estado del empleado"  class="btn-guardar btn-block" id="btnAssign">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnAssign').on('click', function() {
            var selectedUserId = $('#selectUser').val();
            var usuario_id = $('#usuario_id').val();

            if (selectedUserId) {
                // Aquí puedes realizar la lógica para asignar al usuario seleccionado.
                // Ejemplo:
                $.post("?c=personas&a=cambioestado", {
                        estadoId: selectedUserId,
                        usuario_id: usuario_id
                    },
                    function(response) {
                        // Manejar la respuesta del servidor                

                        Swal.fire(
                            'Actualizado!',
                            'El estado fue actualizado con éxito',
                            'success'
                        );
                        setTimeout(function() {
                            window.location.reload();                          
                        }, 1500)

                    });

            } else {
                Swal.fire(
                    'Error',
                    'Selecciona un estado antes de actualizar.',
                    'error'
                );
            }
        });
    });

</script>