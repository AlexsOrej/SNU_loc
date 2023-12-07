<div class="card">
    <div class="body">
        <? if ($PqrsfAsignadasAbierta) : ?>
            <div class="table-responsive">
                <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">
                    <thead>
                        <tr>
                            <th>Petición</th>
                            <th>Fecha Asignación</th>
                            <th>Radicado</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($PqrsfAsignadasAbierta as $value) : ?>
                            <tr>
                                <td><?= $value->tipo_peticion ?></td>
                                <td><?= $value->f_asignacion ?></td>
                                <td><?= $value->radicado ?></td>
                                <td><?= $value->descripcion ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <? else : ?>
            <div class="text-center">
                <h4>NO TIENES EVENTOS PENDIENTES</h4>
            </div>
        <? endif; ?>

        </body>
    </div>
</div>