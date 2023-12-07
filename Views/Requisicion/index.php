<?php //print_r($requisions); 
// print_r($requisions);
?>
<div class="well well-sm text-right">
    <a title="Botón para registrar una nueva requisición" href="?c=requisicions&a=Crud" style="padding-bottom:10px; font-weight:bold;" class="neu"> <i class="glyphicon glyphicon-plus"></i> Nueva Requisición</a>
</div>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    REQUISICION INTERNA DE PERSONAL
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tbl_requicision" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sede</th>
                                <th>Motivo</th>
                                <th>Solicitud</th>
                                <th>Solicitante</th>
                                <th>Fecha Ingreso</th>
                                <th>Estado</th>
                                <th>Prioridad</th>
                                <th>Ménu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // <!-- 1=solicitado, 2=aprobado -->
                            foreach ($requisions as $r) :
                                if ($r->estado == '1') :
                                    $color = "success";
                                    $estado = "Solicitado";
                                endif;
                                if ($r->estado == '2') :
                                    $color = "warning";
                                    $estado = "Aprobado";
                                endif;
                                if ($r->estado == '3') :
                                    $color = "danger";
                                    $estado = "Rechazado";
                                endif; ?>
                                <tr>
                                    <td><?php echo $r->id; ?></td>
                                    <td><?php echo $r->sede; ?></td>
                                    <td><?php echo $r->motivo ?></td>
                                    <td><?php echo $r->cargo; ?></td>
                                    <td><?php echo $r->solicitante; ?></td>
                                    <td><?php echo $r->fecha_ingreso; ?></td>
                                    <td>
                                        <?php //echo $estado; 
                                        ?>
                                        <?php
                                        if ($estado == "Solicitado") {
                                            echo '<span class="label label-info">Solicitado</span>';
                                        } elseif ($estado == "Aprobado") {
                                            echo '<span class="label label-warning">Aprobado</span>';
                                        } elseif ($estado == "Rechazado") {
                                            echo '<span class="label label-danger">Rechazado</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($r->prioridad == 0) {
                                            echo '<span class="label label-default">Baja</span>';
                                        } elseif ($r->prioridad == 1) {
                                            echo '<span class="label label-warning">Media</span>';
                                        } elseif ($r->prioridad == 2) {
                                            echo '<span class="label label-danger">Alta</span>';
                                        } ?>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <? if ($r->estado != '3' and $estado != "Aprobado") : ?>
                                            <a title="Botón para editar esta requisición" href="#" onclick="Edit('<?= $r->id ?>')" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-edit"></i></a>
                                            <a title="Botón para autorizar una requisición" href="#" onclick="Autorizacion('<?= $r->id ?>')" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-cog"></i></a>
                                        <? endif; ?>
                                        <? if ($estado == "Aprobado") : ?>
                                            <!-- <a onclick="Evaluar('<?= $r->id ?>')" data-toggle="modal" data-target="#modal-id"><i class="glyphicon glyphicon-list-alt"></i></a> -->
                                        <? endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<div class="modal fade" id="modelId">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">REQUISICION INTERNA DE PERSONAL</h4>
            </div>
            <div class="modal-body index" id="index">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">EVALUACIÓN</h4>
            </div>
            <div class="modal-body index1" id="index1"></div>
        </div>
    </div>
</div>
<? if (isset($_REQUEST['r'])) : ?>
    <script>
        window.addEventListener('load', init, false);

        function init() {
            Swal.fire({
                icon: 'success',
                title: 'Bien Hecho!!',
                text: 'La requisicion fue actualizada con éxito',
                showConfirmButton: true,
                showCloseButton: true,
                timer: 2500
            }, )
            setTimeout(function() {
                window.location = '?c=requisicions&a=index';
            }, 2000)
        }
    </script>
<? endif; ?>
<script>
    function Index() {
        $('#index').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            type: "POST",
            url: '?c=requisicion&a=Crud',
            success: function(resp) {
                $('#index1').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Edit(id) {
        $('#index').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            type: "POST",
            url: '?c=requisicions&a=Crud',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Autorizacion(id) {
        $('#index').html("<h5>Cargando Complementos55</h5>");
        $.ajax({
            type: "POST",
            url: '?c=requisicions&a=Autorizacion',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Evaluar(id) {
        $('#index').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            type: "POST",
            url: '?c=requisicions&a=evaluacion',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index1').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Ver(id) {
        $('#index1').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            type: "POST",
            url: '?c=requisicion&a=Ver',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index1').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>