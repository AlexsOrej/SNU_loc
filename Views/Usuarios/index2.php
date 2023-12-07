<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE USUARIOS</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar un nuevo usuario" onclick="Registrar()" data-toggle="modal" href='#modal-id' class="neu pull-right"> <i class="glyphicon glyphicon-plus"></i> Registrar Usuario</button>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <!-- Table -->        
            <table class="table table-bordered" id="tb_usuarios">
                <thead>
                    <tr>
                        <!-- <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Cliente</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>General</th>
                        <th>Permisos</th> -->
                        <th>Usuarios</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>General</th>
                        <th>Permisos</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $key => $value) : ?>
                        <tr>
                            <td><?php echo  $value->nombres . ' ' . $value->apellidos ?><br>
                                <?php echo  $value->email ?><br>
                                <?php echo  $value->identificacion ?><br>
                        
                        
                        
                            </td>
                         
                            <td><?php echo  $value->username ?></td>
                      
                            <td><?php echo  $value->cliente ?></td>
                            <td><?php echo  ucwords($value->rol) ?></td>
                            <td><?php echo  $value->estado == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a onclick="Clave('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id' title="Botón para actualizar la contraseña del usuario"><i class="glyphicon glyphicon-lock"></i></a>
                                <a onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id' title="Botón para editar los datos del Usuario"><i class="glyphicon glyphicon-edit"></i></a>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a href="?c=permisos&a=index2&id=<?php echo $value->id ?>" ><i class="glyphicon glyphicon-plus" title=" Botón para asignar permisos del usuario"></i></a>
                                <a href="?c=permisos&a=AsignarProceso&id=<?php echo $value->id ?>" ><i class="glyphicon glyphicon-list" title="Botón para asignar permisos a procesos"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>       
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="index">
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>
<script>
    function Clave(id) {
        var val = id;
        $.ajax({
            type: "POST",
            url: '?c=usuarios&a=clave',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }


    function Registrar() {
        $.ajax({
            type: "POST",
            url: '?c=usuarios&a=Registrar',
            // data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Editar(val) {
        $.ajax({
            type: "POST",
            url: '?c=usuarios&a=Registrar',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>