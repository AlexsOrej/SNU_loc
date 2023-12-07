<?php 
//print_r($nivel);   

?>
<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE CLASIFICACION DE RIESGOS</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar CLASIFICACION DE RIESGOS" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar Clasificacion de riesgo</button>
            </div>
        </div>
    </div>
    <div class="body">
        <?php
                    if ($clasificacion == null){ ?>
                        <div style="padding:5%;" class="container text-center p-5">
                            <h4 class="text-muted p-5">Registra una nueva clasificación</h4>
                        </div>
                    <?php
                    }else{
        ?>
        <!-- Table -->
        <div class="panel panel-body">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <?php foreach ($clasificacion as $value) : ?>
                        <tr class="">
                            <td><?php echo  $value->nombre ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a title="Botón para editar un proceso"  onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Botón para borrar un proceso" href="#" onclick="Borrar('<?php echo $value->id ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;
                   ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </tfoot>
            </table>
            <?php } ?>
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
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>
<script>
    function Add() {
        $.ajax({
            type: "POST",
            url: '?c=clasificacionriesgo&a=add',
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
            url: '?c=clasificacionriesgo&a=add',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Borrar(val) {
        Swal.fire({
                title: "¿Estás seguro de eliminar este proceso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "POST",
                        url: '?c=clasificacionriesgo&a=delete',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: 'success',
                                title: datos,
                                timer: 1800
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