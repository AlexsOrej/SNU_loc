<div class="card">
    <div class="header">
        <h3 class="title">Actualizar Permisos </h3>
    </div>
    <!-- /.card-header -->
    <div class="body">
        <form action="" method="post" name="permiso" id="permiso">
            <div class="row" id="main2">
                <table class="table table-bordered">
                    <tr>
                        <th style=" text-align:center">Cod</th>
                        <th style=" text-align:center">Módulos</th>
                        <th style=" text-align:center">Acción</th>
                        <th style=" text-align:center">
                            Activar
                            <a href="javascript:seleccionar_todo()">Todos</a> ||
                            <a href="javascript:deseleccionar_todo()">Ninguno</a>
                        </th>                        
                    </tr>
                    <?
                   // print_r($accions);
                    foreach ($accions as $key => $value) : ?>
                        <tr>
                            <td width="10%" style=" text-align:center"><?= $value->id ?></td>
                            <td width="15%" style=" text-align:center"><?= ucwords($value->modulo) ?></td>
                            <td width="15%" style=" text-align:center"><?= ucwords($value->nombre) ?></td>
                            <td width="30%" style=" text-align:center">
                                <? if (@$this->model->GetControlAccion($value->id, $_REQUEST['usuario_id'])->estado == 'activo') : ?>
                                    <input type="checkbox" name="accion->id_a[<?= $value->id ?>]" id="<?= $key ?>" value="<?= $value->id ?>" class="Filled In" checked>
                                <? else : ?>
                                    <input type="checkbox" name="accion->id_a[<?= $value->id ?>]" id="<?= $key ?>" value="<?= $value->id ?>" class="Filled In">
                                <? endif; ?>
                            </td>                            
                        </tr>
                    <? endforeach; ?>
                </table>
                <div class="col-md-12"><br>
                    <input type="hidden" id="id_usuario" name='id_usuario' value="<?= $_REQUEST['id_usuario'] ?>">
                    <!-- <input type="button" id="autorizar" class="btn btn-success" value="Autorizar"> -->
                </div>
            </div>
    </div>
    </form>
    <script>
        
        function deseleccionar_todo() {
            for (i = 0; i < document.permiso.elements.length; i++)
                if (document.permiso.elements[i].type == "checkbox")
                    document.permiso.elements[i].checked = 0
        }

        function seleccionar_todo() {
            for (i = 0; i < document.permiso.elements.length; i++)
                if (document.permiso.elements[i].type == "checkbox")
                    document.permiso.elements[i].checked = 1
        }
       
        $(document).on('click', '#autorizar', function(e) {
            e.preventDefault();
            var data = $("#permiso").serializeArray();
            $.ajax({
                //async: false,
                data: data,
                type: "post",
                url: "?c=permisos&a=AccionGuardar",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'La autorización se registro con éxito',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                    //    $('#buscar').click();
                       window.location.reload(1);
                    }, 1500)

                }
            });
        });       
    </script>