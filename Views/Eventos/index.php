<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading"> 
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE EVENTOS</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar un evento" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar evento</button>
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
                        <th>Sigla</th>
                        <th>Clasificación</th>
                        <th>Notificación</th>
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach ($eventos as $value) : ?>
                        <tr>
                            <td><?php echo  $value->sigla ?></td>
                            <td><?php echo  $value->nombreevento ?></td>
                            <td><?php echo  $value->correoresponsable ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit" title="Botón para actualizar eventos"></i></a>
                                <a href="" onclick="Borrar('<?php echo $value->id ?>')"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash" title="Botón para eliminar este evento"></i></a>
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
        </div>
    </div>
</div>
<script>
    function Add() {
        $.ajax({
            type: "POST",
            url: '?c=eventos&a=add',
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
            url: '?c=eventos&a=add',
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
                        url: '?c=eventos&a=delete',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: 'success',
                                title: 'BIEN HECHO!!',
                                timer: 2000
                            }, )
                            setTimeout(function() {
                                //window.location = '?c=solicitudes&a=index';
                                window.location.reload();
                            }, 2000)
                        }
                    });
                }
            });

    }
</script>