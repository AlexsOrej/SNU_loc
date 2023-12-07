<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Notificaciones</h3>
    </div>
    <div class="panel-body">
        <table id="tablePqrs" class="table table-bordered">
            <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Correo</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $user) : ?>
                    <?php
                    $isAssigned = false;
                    foreach ($asignados as $asignado) {
                        if ($asignado->user === $user->nombres . ' ' . $user->apellidos) {
                            $isAssigned = true;
                            $quitar = "";
                            break;
                        }
                    }
                    ?>
                    <tr>
                        <td><?= $user->nombres . ' ' . $user->apellidos ?></td>
                        <td><?= $user->email ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <?php if ($isAssigned) : ?>
                                <a class="" data-id="<?= $asignado->user ?>"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash" ></i></a>
                            <?php else : ?>
                                <input type="checkbox" class="chk" data-id="<?= $asignado->user  ?>">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button id="guardar" class="btn btn-guardar">Guardar</button>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#guardar').on('click', function() {
            var selectedData = [];
            $('.chk:checked').each(function() {
                var id = $(this).data('id');
                var nombres = $(this).closest('tr').find('td:eq(0)').text();
                var correo = $(this).closest('tr').find('td:eq(1)').text();
                selectedData.push({
                    id: id,
                    nombres: nombres,
                    correo: correo
                });
            });

            if (selectedData.length > 0) {
                $.ajax({
                    data: {
                        data: JSON.stringify(selectedData)
                    },
                    type: "post",
                    url: "?c=notificaciones&a=registrar_pqrsf",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BIEN HECHO!!',
                            text: 'Se Asigno con Exito',
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location = '?c=notificaciones&a=notificar_pqrsf';
                        }, 1501);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Selecciona al menos un usuario.',
                    timer: 1500
                });
            }
        });
    });

    $(document).ready(function() {
        $('.btn-remove-assign').on('click', function() {
            var userId = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción retirará la asignación del usuario.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, retirar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar solicitud Ajax para retirar la asignación
                    $.ajax({
                        url: "?c=notificaciones&a=notificar_pqrsf_quitar",
                        type: "POST",
                        data: {
                            userId: userId
                        },
                        success: function(response) {
                            // Manejar la respuesta del servidor
                           
                                Swal.fire(
                                    'Retirada!',
                                    'La asignación ha sido retirada.',
                                    'success',
                                    false,
                                );
                                // Puedes realizar acciones adicionales después del éxito.
                                setTimeout(function() {
                                   window.location = '?c=notificaciones&a=notificar_pqrsf';
                                }, 1501);                         
                        },
                        error: function() {
                            Swal.fire(
                                'Error',
                                'Hubo un problema al comunicarse con el servidor.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

</html>