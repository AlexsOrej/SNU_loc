<?php //print_r($riesgo_id); ?>

<div class="panel panel-default" id="resultado">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-9 text-center">
                <h4>ADMINISTRACIÓN DE RIESGOS</h4>
            </div>
            <div class="col-md-3">
                <button title="Botón para registrar procesos" onclick="Add()" data-toggle="modal" href='#modal-id' class="neu pull-right"><i class="glyphicon glyphicon-plus"></i> Crear nuevo riesgo</button>
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
                        <th>Impacto</th>
                        <th>Probabilidad</th>
                        <th>Resultado</th>
                        <th>Proceso</th>
                        <th>Fecha Registro</th>




                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riesgo as $value) : ?>
                        <tr class="">
                            <td><?php echo  $value->riesgo ?></td>
                            <td><?php echo  $value->valorImpacto ?></td>
                            <td><?php echo  $value->valorProbabilidad ?></td>
                            <td><?php echo  $value->nivel_riesgo?></td>
                            <td><?php echo  $value->NombreProceso ?></td>
                            <td><?php echo  $value->fecha_registro ?></td>


                            <td style="vertical-align: middle;text-align: center;">
                             <!-- ?c=riesgos&a=gestionRiesgo&riesgo_id=<?php echo  $value->riesgo_id ?> -->
                                <a href="?c=riesgos&a=gestionRiesgo&riesgo_id=<?php echo  $value->riesgo_id ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                                </a>
                                <!-- <a title="Botón para editar un proceso"  onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Botón para borrar un proceso" href="#" onclick="Borrar('<?php echo $value->id ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Impacto</th>
                        <th>Probabilidad</th>
                        <th>Resultado</th>
                        <th>Proceso</th>
                        <th>Fecha Registro</th>

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
                <h4 class="modal-title">Riesgos</h4>
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
            url: '?c=riesgos&a=add',
            // data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function gestionar(val){
        $.ajax({
            type: "POST",
            url: '?c=riesgos&a=gestionRiesgo',
            data: 'id=' + val,
            success: function(resp) {
                window.location.href = '?c=riesgos&a=gestionRiesgo';
            }
        });
    }

    function Editar(val) {
        $.ajax({
            type: "POST",
            url: '?c=riesgos&a=add',
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
                        url: '?c=riesgos&a=delete',
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