<div class="col-md-6">
    <div class="row">
        <div class="card">
            <div class="header">
                <h4>Procesos</h4>
                <small>Asignar los proceso al colaborador:
                    <strong class="col-cyan"><?= $usuario_per->nombres . ' ' . $usuario_per->apellidos ?></strong>
                </small>
            </div>
            <div class="body">
                <form method="post" name="form_proceso" id="form_proceso">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="resultado1">
                                <thead>
                                    <tr>
                                        <th width="30%" style=" text-align:center">
                                            <a href="javascript:seleccionar_todo()">Todos</a> ||
                                            <a href="javascript:deseleccionar_todo()">Ninguno</a>
                                        </th>
                                        <th style=" text-align:center">Procesos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $asignados_ids = array();
                                    foreach ($asignados as $asignado) {
                                        $asignados_ids[$asignado->procesos_id] = true;
                                    }

                                    foreach ($procesos as $proceso) {
                                        $checked = isset($asignados_ids[$proceso->id]) ? 'checked disabled' : '';
                                    ?>
                                        <tr>
                                            <td width="10%" style="text-align: center">
                                                <input type="checkbox" id="proceso_id[<?= $proceso->id ?>]" name="proceso_id[<?= $proceso->id ?>]" value="<?= $proceso->id ?>" class="Filled In" <?= $checked ?>>
                                            </td>
                                            <td style="text-align:left"><?= $proceso->Iniciales . ' ' . $proceso->NombreProceso ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <input type="hidden" id="usuario_id" name="usuario_id" value="<?= $_REQUEST['id'] ?>">
                            <div class="text-center">
                                <input type="submit" id="asignar" class="btn bg-green" value="Asignar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="header">
            <h4>Procesos Autorizados</h4>
            <small>Elimina los permisos del colaborador:
                <strong class="col-cyan"><?= $usuario_per->nombres . ' ' . $usuario_per->apellidos ?></strong>
            </small>
        </div>
        <div class="body">
            <table class="table table-bordered" id="resultado">
                <tr>
                    <th>Procesos</th>
                    <th style=" text-align:center">Quitar</th>
                </tr>
                <? foreach ($asignados as $value) : ?>
                    <tr>
                        <td><?= ucwords($value->NombreProceso) ?></td>
                        <td  style="text-align:center">
                            <a type="" onclick="Quitar('<?= $value->usuario_proceso_id ?>')" name="quitar" class="glyphicon glyphicon-trash col-red" value=""></a>
                        </td>
                    </tr>
                <? endforeach; ?>
            </table>
        </div>
    </div>
</div>
<style>
    ul {
        list-style-type: none;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#form_proceso').submit(function(event) {
            event.preventDefault(); // Evitar que se envíe el formulario por defecto

            var checkboxChecked = false;
            $("input[type='checkbox']").each(function() { // Recorrer todos los checkboxes
                if ($(this).is(":checked")) {
                    checkboxChecked = true;
                    return false; // Salir del bucle cuando se encuentre un checkbox seleccionado
                }
            });

            if (!checkboxChecked) {
                alert("Debe seleccionar al menos un proceso"); // Mostrar mensaje de error
                return;
            }

            $.ajax({
                url: "?c=permisos&a=asignarprocesoadd",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        //  window.location.reload(1);
                        $('#resultado').load(window.location.href + ' #resultado');
                        $('#resultado1').load(window.location.href + ' #resultado1');
                    }, 1500)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Hacer algo en caso de error
                }
            });
        });
    });
    //-------------//      
    function deseleccionar_todo() {
        for (i = 0; i < document.form_proceso.elements.length; i++)
            if (document.form_proceso.elements[i].type == "checkbox")
                document.form_proceso.elements[i].checked = 0
    }
    //--------------//
    function seleccionar_todo() {
        for (i = 0; i < document.form_proceso.elements.length; i++)
            if (document.form_proceso.elements[i].type == "checkbox")
                document.form_proceso.elements[i].checked = 1
    }
    //--------------//

    //---------------//
    function Quitar(quitarproceso) {
        Swal.fire({
            title: 'Esta seguro?',
            text: "Recuerda que puedes activar el permiso de nuevo si es necesario!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminalo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '?c=permisos&a=Procesoquitar',
                    data: {
                        id: quitarproceso,
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Eliminado!',
                            text: 'El permiso fue eliminado.',
                            icon: 'success',
                            //showConfirmButton: false,
                        }).then(() => {
                            // Aquí puedes agregar cualquier lógica adicional que necesites después de la eliminación exitosa
                            // Por ejemplo, actualizar una tabla o lista de permisos 
                            $('#resultado1').load(window.location.href + ' #resultado1');
                            $('#resultado').load(window.location.href + ' #resultado');
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Se produjo un error al intentar eliminar el permiso.',
                            icon: 'error'
                        });
                    }
                });
            } else {
                // Si el usuario hace clic en "Cancelar", no se hace nada
                return;
            }
        });
    }
</script>