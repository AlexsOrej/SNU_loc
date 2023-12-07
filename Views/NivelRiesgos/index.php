<?php 
//print_r($nivel);   

if ($nivel == null){
}
?>
<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE NIVELES DE RIESGO</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar procesos" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Registrar Nivel de riesgo</button>
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
                        <th>Descripcion</th>
                        <th>De</th>
                        <th>Hasta</th>
                        <th>Color</th>


                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($nivel == null){ ?>
                        <div class="container text-center"></div>
                    <?php
                    }
                    ?>
                    <?php foreach ($nivel as $value) : ?>
                        <tr class="">
                            <td><?php echo  $value->nombre ?></td>
                            <td><?php echo  $value->descripcion ?></td>
                            <td><?php echo  $value->rango ?></td>
                            <td><?php echo  $value->rango2 ?></td>
                            <td style="vertical-align: middle; text-align: center;"> <div style="vertical-align: middle;text-align: center; background:<?php echo  $value->color ?>;">.</div> </td>




                            <td style="vertical-align: middle;text-align: center;">
                                <a title="Botón para editar un proceso"  onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Botón para borrar un proceso" href="#" onclick="Borrar('<?php echo $value->id ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>De</th>
                        <th>Hasta</th>
                        <th>Color</th>
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
            url: '?c=nivelriesgos&a=add',
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
            url: '?c=nivelriesgos&a=add',
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
                        url: '?c=nivelriesgos&a=delete',
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