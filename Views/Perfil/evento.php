<div class="card">
    <div class="body">
        <? if ($eventosAsignadas) : ?>
            <div class="table-responsive">
                <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">                    
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Asignación</th>
                            <th>Estado</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventosAsignadas as $value) : ?>
                            <tr>
                                <td><?= $value->nombreevento ?></td>
                                <td><?= $value->fechaRegistro ?></td>
                                <td><?= $value->estado ?></td>
                                <td><?= $value->descEvento ?></td>
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