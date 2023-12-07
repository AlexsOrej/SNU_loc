<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="header">
                <!-- <a href="https://scribehow.com/shared/Como_realizar_el_registro_de_indicadores_de_proceso__a5_rF7wNQ8a1uZ-sLUwQ-g" target="_blank">
                        <span class="material-icons">
                            help_center
                        </span>
                    </a> -->
                </i><strong>Indicadores</strong><br>
                <small>Seleccionar proceso para ver el listado de indicadores</small>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Procesos</label>
                        <select name="procesos" id="procesos" class="form-control" required="required">
                            <option value="">Seleccionar</option>
                            <? foreach ($procesos as  $value) : ?>
                                <option value="<?= $value->id ?>"><?= $value->Iniciales . '-' . $value->NombreProceso ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <h2>LISTADO DE INDICADORES</h2>
                    </div>
                </div>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="?c=indicadors&a=add" class="neu">
                            Registrar Ficha de Indicador
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body" id="indicador">
                <table id="tableIndicador" class="table table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Nombre</th>
                            <th>Proceso</th>
                            <!-- <th>Formula</th> -->
                            <th>Periodicidad</th>
                            <!-- <th>Fecha Control</th> -->
                            <!-- <th>Registros</th> -->
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //debug($indicadors);
                        foreach ($indicadors as $indicador) : ?>
                            <tr>
                                <!-- <td><?php echo $indicador->i_id ?></td> -->
                                <td><?php echo $indicador->nombre ?></td>
                                <td>
                                   <p class="pull-left"> <?php echo ucwords(strtolower($indicador->NombreProceso)) . '</p><br>';
                                    foreach ($cargos as $cargo) :
                                        if ($indicador->cargo_id == $cargo->id)
                                            echo "<label class='badge bg-teal pull-right'>". $cargo->cargo."</label>";
                                    endforeach;
                                    ?>&nbsp;</td>
                                <!-- <td> <?php echo $indicador->formula ?></td> -->
                                <td><?php echo ucwords($indicador->periodicidad) ?></td>
                                <!-- <td><?php echo $indicador->fecha_control ?></td> -->
                                <!-- <td></td> -->
                                <td class="actions">

                                    <a href="<?php echo '?c=indicadors&a=add&id=' . $indicador->i_id ?>" type="button" class="" title="editar indicador">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                    <!-- <a onclick="Ver('<?= $indicador->i_id ?>')" data-toggle="modal" href='#modal-id' type="button" class="" title="crear meta">
                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                        </a>
                                        <a onclick="VerIndex('<?= $indicador->i_id ?>')" data-toggle="modal" href='#modal-id' type="button" class="" title="ver metas">
                                            <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </a>
                                        <a href="<?php echo '?c=indicadors&a=datos&id=' . $indicador->i_id ?>" type="button" class="" title="Registrar datos del indicador">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </a> -->
                                    <a href="<?php echo '?c=indicadors&a=verdatos&indicador_id=' . $indicador->i_id ?>" type="button" class="" title="Gestionar el indicador">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </a>
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
<!-- #END# CPU Usage -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Meta</h4>
            </div>
            <div class="modal-body" id="metas">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#procesos').on('change', function() {
        var estado = document.getElementById("procesos").value
        $.ajax({
            type: "POST",
            url: '?c=indicadors&a=indice',
            data: {
                procesos: estado
            },
            beforeSend: function() {
                $('#indicador').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#indicador').html(resp);
            }
        });
    });
</script>