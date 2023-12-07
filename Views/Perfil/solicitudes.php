<div class="card">
    <div class="body">
        <? if ($solicitudes) : ?>
            <div class="table-responsive">
                <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">
                    <thead>
                        <tr>
                            <th>Fecha Solicitud</th>
                            <th>Tipo Documento</th>
                            <th>Tipo Solicitud</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $value) : ?>
                            <tr>
                                <td><?= $value->FechaSolicitud ?></td>
                                <td><?= $value->TipoDocumento ?></td>
                                <td><?= $value->TipoSolicitud ?></td>
                                <td> <span class="badge bg-cyan"><?= $value->Codigo ?></span>
                                    <?= $value->Observaciones ?>
                                </td>
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