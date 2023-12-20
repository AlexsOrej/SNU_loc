<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <h2>SOLICITUD</h2>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-3">
                        <label>Numero de la Solicitud</label> <br>
                        <?php echo $solicitudes->id; ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Nombre Solicitante</label> <br>
                        <?php echo $solicitudes->NombreSolicitante; ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Fecha Solicitud</label> <br>
                        <?php echo $solicitudes->FechaSolicitud; ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Proceso</label> <br>
                        <?php echo $solicitudes->Proceso; ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Tipo Solicitud</label> <br>
                        <?php echo $solicitudes->TipoSolicitud; ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Codigo</label> <br>
                        <?php echo $solicitudes->Codigo; ?>
                        &nbsp;
                    </div>
                    <div class="col-sm-3">
                        <label>Versión Cambiar</label> <br>
                        <?php
                        if ($solicitudes->TipoSolicitud == 'creacion') {
                            echo 0;
                        }
                        if ($solicitudes->VersionCambiar == 1) {
                            echo 1;
                        }
                        if ($solicitudes->VersionCambiar > 1) {
                            echo $solicitudes->VersionCambiar;
                        }
                        ?>
                        &nbsp;
                    </div>
                    <div class="col-sm-3">
                        <label>Tipo Documento</label> <br>
                        <?php echo $solicitudes->TipoDocumento; ?>
                        &nbsp;
                    </div>
                    <div class="col-sm-4">
                        <label>Ejecucion Cambio</label> <br>
                        <?php echo $solicitudes->EjecucionCambio; ?>
                        &nbsp;
                    </div>
                    <div class="col-sm-4">
                        <label>Aprobado</label> <br>
                        <?php echo $solicitudes->Aprobado; ?>
                        &nbsp;

                    </div>
                    <div class="col-sm-6">

                        <label>Descripción</label> <br>

                        <?php echo $solicitudes->Descripcion; ?>
                        &nbsp;

                    </div>
                    <div class="col-sm-6">
                        <label>Observaciones</label><br>
                        <?php echo $solicitudes->Observaciones; ?>&nbsp;
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tramite</th>
                                    <th>Colaborador</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historial as $value) : ?>
                                    <tr>
                                        <td><?php
                                            if ($value->tipo == 're') {
                                                echo 'Revisado';
                                            } elseif ($value->tipo == 'si') {
                                                echo 'Aprobado';
                                            } elseif ($value->tipo == 'no') {
                                                echo 'Rechazado';
                                            } else {
                                                echo 'En espera';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $value->usuario ?></td>
                                        <td><?php echo $value->fecha ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>