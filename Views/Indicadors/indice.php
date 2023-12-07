<table id="tableIndicador" class="table table-bordered">
    <thead>
        <tr>
            <!-- <th>No</th> -->
            <th>Nombre</th>
            <th>Proceso</th>
            <!-- <th>Formula</th> -->
            <th>Periodicidad</th>
            <!-- <th>Fecha Control</th> -->
            <th>Menu</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($indicadors as $indicador) : ?>
            <tr>
                <!-- <td><?php echo $indicador->i_id ?></td> -->
                <td><?php echo $indicador->nombre ?></td>
                <td>
                    <p class="pull-left"> <?php echo ucwords(strtolower($indicador->NombreProceso)) . '</p><br>';
                                            foreach ($cargos as $cargo) :
                                                if ($indicador->cargo_id == $cargo->id)
                                                    echo "<label class='badge bg-teal pull-right'>" . $cargo->cargo . "</label>";
                                            endforeach;
                                            ?>&nbsp;
                </td>
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
                    <a href="<?php echo '?c=indicadors&a=verdatos&indicador_id=' . $indicador->i_id ?>" type="button" class="" title="Registrar datos del indicador">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>