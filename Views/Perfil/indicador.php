<div class="card">
    <div class="body">
        <? if ($indicadoresAsignados) : ?>
            <div class="table-responsive">
                <table id="table" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Indicador</th>
                            <th>Periodicidad</th>
                            <th>Fecha Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($indicadoresAsignados as $value) : ?>
                            <tr>
                                <td><?= $value->nombre ?></td>
                                <td><?= $value->periodicidad ?></td>
                                <td><?= $value->fecha_control ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <? else : ?>
            <div class="text-center">
                <h4>NO HAY INDICADORES ASIGNADOS</h4>
            </div>
        <? endif; ?>
    </div>
</div>