<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-sm-10">
                <h2>Tipo de Eventos</h2>
            </div>
            <div class="col-sm-2">
                <a title="Botón para registar evento" onclick="Registrar()" data-toggle="modal" href="#modal-id" class="neu pull-right">
                    <span><i class="glyphicon glyphicon-plus"></i> Registrar</span>
                </a>
            </div>
        </div>
    </div>
    <div class="body">
        <table id="eventos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Clasificación</th>
                    <th>Tipo</th>
                    <th>Correccion</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento) : ?>
                    <tr>
                        <td><?= $evento->clasificacionIncidente ?></td>
                        <td><?= $evento->tipoIncidente ?></td>
                        <td><?= $evento->correcionIncidente ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <a title="Botón para editar tipo de evento " onclick="Editar('<?= $evento->id ?>')" data-toggle="modal" href="#modal-id" class="" title="Editar los datos">
                            <i class="glyphicon glyphicon-edit"></i>
                                <span></span>
                            </a>
                            <a title="Botón para borrar el tipo de evento" href="#" onclick="Delete('<?= $evento->id ?>')" title="Editar los datos">
                            <i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                <span></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="index">

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>
    <script>
        function Registrar() {
            $.ajax({
                type: "POST",
                url: '?c=eventos_categorias&a=add',
                success: function(resp) {

                    $('#index').html(resp);
                    $('#respuesta').html("");
                }
            });
        }

        function Editar(id) {
            $.ajax({
                type: "POST",
                url: '?c=eventos_categorias&a=add',
                data: {
                    id: id
                },
                success: function(resp) {
                    $('#index').html(resp);
                    $('#respuesta').html("");
                }
            });
        }

        function Delete(eventoId) {
            // Realizar la validación antes de borrar
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma la eliminación, realizar la acción de borrado
                    $.ajax({
                        type: "POST",
                        url: '?c=eventos_categorias&a=delete',
                        data: {
                            id: eventoId
                        },
                        success: function(response) {
                            // Manejar la respuesta exitosa del servidor
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Evento eliminado correctamente',
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000)
                                // Aquí puedes agregar código adicional después de eliminar el evento
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al eliminar el evento',
                                    text: response.message,

                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000)
                            }
                        },
                        // error: function(xhr, status, error) {
                        //     // Manejar el error de la solicitud AJAX
                        //     console.log('Error en la solicitud AJAX: ' + status);
                        //     console.log('Mensaje de error: ' + error);
                        // }
                    });
                }
            });
        }
    </script>