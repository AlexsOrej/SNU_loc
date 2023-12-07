<?php 
//print_r($nivel);   

// if ($nivel == null){
// }
?>
<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>Criterios de evaluacion de controles</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar procesos" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar Criterio</button>
            </div>
        </div>
    </div>
    <div class="body">
        <!-- Table -->
        <div class="panel panel-body">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>valor</th>
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    if ($criterio == null){ ?>
                        <div class="container text-center"></div>
                    <?php
                    }
                    ?>
                    <?php foreach ($criterio as $value) :
                        $total = $value->valor + $total;
                        ?>
                        <tr class="">
                            <td><?php echo  $value->nombre ?></td>
                            <td><?php echo  $value->valor."%" ?></td>

                            <td style="vertical-align: middle;text-align: center;">
                                <a title="Botón para editar un criterio"  onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Botón para borrar un criterio" href="#" onclick="Borrar('<?php echo $value->id ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                                <a title="Botón para editar un criterio" href="?c=respuestascontrol&a=respuestas&id=<?= $value->id ?>"   data-toggle="modal" href='#modal-respuesta'><i class="glyphicon glyphicon-edit"></i></a>
                        <!-- onclick="Editar('<?php // echo $value->id ?>')" -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th><?= $total."%"?></th>
                       
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </tfoot>
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
            url: '?c=criterioscontrol&a=add',
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
            url: '?c=criterioscontrol&a=add',
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
                        url: '?c=criterioscontrol&a=delete',
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