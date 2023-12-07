<?php if (isset($_REQUEST['est'])) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'El documento fue validado con éxito',
            timer: 1500
        }, )
    </script>
<?php endif;?>
<!-- CPU Usage -->
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <h2>RESPONDER SOLICITUD # <?= $solicitud->id ?></h2>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Tipo Solicitud</label>
                                <input type="text" value="<?= ucwords($solicitud->TipoSolicitud) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Proceso</label>
                                <input type="text" value="<?= ucwords($solicitud->Proceso) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for=" ">Tipo Documento</label>
                                <input type="text" value="<?= ucwords($solicitud->TipoDocumento) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Nombre Solicitante</label>
                                <input type="text" value="<?= ucwords($solicitud->NombreSolicitante) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Fecha Solicitud</label>
                                <input type="text" value="<?= ucwords($solicitud->FechaSolicitud) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="Descripción">Justificación</label>
                                <input type="text" value="<?= ucwords($solicitud->Descripcion) ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($onlinedocs)) : ?>
                        <div class="col-md-12 text-center">
                            <label>Esta solicitud tiene un Documento por revisar</label><br>
                            <a onclick="Online('<?= $_REQUEST['id'] ?>')" class="btn btn-primary">ABRIR</a>
                        </div>
                        <div class="col-md-12" id='online'></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_r($asignados) ?>

<!-- #END# CPU Usage -->
<script>
    function Online(id) {
        $.ajax({
            type: "POST",
            url: '?c=documentos&a=editor_validar',
            data: 'id=' + id,
            beforeSend: function() {
                $('#online').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando el editor</p> </div>");
            },
            success: function(resp) {
                $('#online').html(resp);

            }
        });
    }
</script>