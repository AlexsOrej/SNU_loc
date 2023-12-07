<div class="card">
    <div class="header">
        <h3 class="title">Modulos</h3>
    </div>
    <!-- /.card-header -->
    <div class="body">
        <form method="post" name="controller" id="controller">
            <div class="row" id="main2">
                <table class="table table-bordered">
                    <tr>
                        <th style=" text-align:center">Cod</th>
                        <th style=" text-align:center">Módulos</th>
                        <th style=" text-align:center">
                            Seleccionar
                            <a href="javascript:seleccionar_todo()">Todos</a> ||
                            <a href="javascript:deseleccionar_todo()">Ninguno</a>
                        </th>
                    </tr>
                    <? foreach ($controlAccion as $key => $value) : ?>
                        <tr>
                            <td width="10%" style=" text-align:center"><?= ucwords($value->id) ?></td>
                            <td width="15%" style=" text-align:center"><?= ucwords($value->controller) ?></td>
                            <!-- <td width="15%" style=" text-align:center"><?= $value->accion ?></td> -->
                            <td width="30%" style=" text-align:center">
                                <input type="checkbox" name="moduloids[<?= $key ?>]" id="<?= $key ?>" value="<?= $value->id ?>" class="Filled In">
                            </td>
                        </tr>
                    <? endforeach; ?>
                </table>
                <div class="col-md-12"><br>
                    <input type="hidden" id="id_usuario" name='id_usuario' value="<?= $_REQUEST['usuario_id'] ?>">
                    <input type="submit" id="continuar" class="btn btn-success" value="Continuar">
                </div>
            </div>
    </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permisos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="acciones">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                    <button type="button" class="btn btn-primary" id='autorizar'>Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //-------------//      
        function deseleccionar_todo() {
            for (i = 0; i < document.controller.elements.length; i++)
                if (document.controller.elements[i].type == "checkbox")
                    document.controller.elements[i].checked = 0
        }
        //--------------//
        function seleccionar_todo() {
            for (i = 0; i < document.controller.elements.length; i++)
                if (document.controller.elements[i].type == "checkbox")
                    document.controller.elements[i].checked = 1
        }
        //--------------//

        $(function() {
            // Agregar evento submit al formulario
            $("#controller").on("submit", function(event) {
                // Evitar que se envíe el formulario por defecto
                event.preventDefault();

                // Verificar si al menos un checkbox ha sido marcado
                var checkboxMarcados = $("input[name^='moduloids']:checked");
                if (checkboxMarcados.length === 0) {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay módulos seleccionados, selecciona y trata de nuevo',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    return;
                }
                // Si al menos un checkbox ha sido marcado, enviar el formulario con AJAX
                $.ajax({
                    url: "?c=permisos&a=acciones",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hacer algo en caso de éxito
                        $('#acciones').html(response);
                        $('#modelId').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Hacer algo en caso de error
                        Swal.fire({
                        icon: 'error',
                        title: 'Ocurrio un error inesperado, trata de nuevo',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    return;
                    }
                });
            });
        });
    </script>