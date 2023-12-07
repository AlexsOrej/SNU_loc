<div class="panel panel-default">
    <div class="panel-body">
        <? if ($novedades) : ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Novedad</th>
                        <th>Descripción</th>
                        <th>Fecha Novedad</th>
                        <th>Fecha Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    foreach ($novedades as $novedad) : ?>
                        <tr>
                            <td><?= $novedad->evento ?></td>
                            <td><?= $novedad->descripcion ?><br>
                                <a href="<?= $path . $novedad->persona_id . '/' . $novedad->soporte ?>" target="_blank" >
                                    <i class="glyphicon glyphicon-download"> </i> Soporte</a>
                            <td><?= $novedad->fecha_novedad ?></td>
                            <td><?= $novedad->fecha_registro ?></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        <? else : ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>No hay Novedades Registradas</strong>
            </div>
        <? endif; ?>
    </div>
</div>