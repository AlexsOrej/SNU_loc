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
                    <div class="col-sm-3">
                        <label>Ejecucion Cambio</label> <br>
                        <?php echo $solicitudes->EjecucionCambio; ?>
                        &nbsp;
                    </div>
                    <div class="col-sm-3">
                        <label>Aprobado</label> <br>
                        <?php echo $solicitudes->Aprobado; ?>
                        &nbsp;

                    </div>
                    <div class="col-sm-12">

                        <label>Descripción</label> <br>

                        <?php echo $solicitudes->Descripcion; ?>
                        &nbsp;

                    </div>
                    <div class="col-sm-12">
                        <label>Observaciones</label><br>
                        <?php echo $solicitudes->Observaciones; ?>&nbsp;

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>