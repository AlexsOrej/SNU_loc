<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-10">
               <h2>Sedes</h2> 
            </div>
            <div class="col-md-2">
                <button style="margin-top:15px" title="Botón para agregar una nueva sede" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar sede</button>
            </div>
        </div>
    </div>
    <div class="body">
        <!-- Table -->
        <div class="panel panel-body">
            <table id="sedes" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>                        
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                     
                    foreach ($sedes as $value) : ?>
                        <tr>
                            <td><?php echo  utf8_encode($value->nombre) ?></td>                            
                            <td style="vertical-align: middle;text-align: center;">
                                <a onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit" title="Botón para editar una sede"></i></a>
                                <a onclick="Borrar('<?php echo $value->id ?>')" href="#"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash" title="Botón para eliminar una sede"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
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
            <div class="modal-body" id="index"></div>            
        </div>
    </div>
</div>
<script>
    function Add() {
        $.ajax({
            type: "POST",
            url: '?c=sedes&a=add',
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
            url: '?c=sedes&a=add',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Borrar(val) {
        $.ajax({
            type: "POST",
            url: '?c=sedes&a=delete',
            data: 'id=' + val,
            success: function(response) {
                if (response > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Advertencia',
                        text: 'Esta sede tiene ' + response + ' activos relacionados y no puede ser eliminada'
                    });
                } else {
                    Swal.fire({
                        title: "¿Estás seguro de eliminar esta sede?, esta acción es irreversible",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            EliminarCategoria(val);
                        }
                    });
                }
            }
        });
    }

    function EliminarCategoria(val) {
        $.ajax({
            type: "POST",
            url: '?c=sedes&a=delete',
            data: 'id=' + val,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡BIEN HECHO!',
                    text: 'La sede se eliminó con éxito',
                    timer: 2000,
                    showConfirmButton: false
                });
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            }
        });
    }

   
</script>