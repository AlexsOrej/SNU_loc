<? // print_r($cargos)
?>
<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE CARGOS</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar cargos" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar Cargo</button>
            </div>
        </div>
    </div>
    <div class="body">
        <!-- Table -->
        <div class="panel panel-body">
            <div class="responsive">
            <table id="tableCargo" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach ($cargos as $value) : ?>
                        <tr>
                            <?php $ruta ="Assets/Perfiles/".$_SESSION['datos_cliente']->nombre."/".$value->cargo;
                            
                                $estado_archivo = "";

                                if (!file_exists($ruta)) {
                                   $estado_archivo = "<i class='glyphicon glyphicon-warning-sign'></i>";
                                }
                            ?>
                            <td> <a href="Assets/Perfiles/<?php echo $_SESSION['datos_cliente']->nombre.'/'.$value->cargo?>" target="_blank"><?php echo  $value->cargo ?></a> <small style="color:red;"><?= $estado_archivo ?></small>  </td>
                            <td><?php echo  $value->NombreProceso ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit" title="Botón para actualizar cargos"></i></a>
                                <a style="cursor:pointer;" onclick="Borrar('<?php echo $value->id ?>')"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash" title="Botón para eliminar cargos"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
            </div>
        </div>
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
                <button type="button" class="bg-orange btn" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function Add() {
        $.ajax({
            type: "POST",
            url: '?c=cargos&a=add_cargos',
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
            url: '?c=cargos&a=add_cargos',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
    function Borrar(val) {
        Swal.fire({
                title: "¿Estás seguro de eliminar este cargo?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "POST",
                        url: '?c=cargos&a=delete_cargos',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: "success",
                                title: "Bien Hecho!",
                                text: datos,
                                timer: 2000
                            }, )
                            setTimeout(function() {                                
                              window.location.reload();
                            }, 2000)
                        }
                    });
                }
            });
    }
</script>