<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-md-8">
                <h3>Lista de Solicitudes</h3>
            </div>
            <!-- <div class="col-md-4 text-right"><a href='?c=solicitudes&a=add' class="btn btn-default">Registrar Solicitud</a></div> -->
        </div>
    </div>
    <div class="body">
        <div class="sgcDocumentos index">
            <div class="table-responsive">
                <table id="tableSolicitud" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipo Documento</th>
                            <th>Solicitante</th>
                            <th>Fecha Solicitud</th>
                            <th>Proceso</th>
                            <th>Tipo Solicitud</th>
                            <th>Código</th>
                            <th>Estado</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $sgcManejoDocumental) : ?>
                            <tr>
                                <td><?php echo ($sgcManejoDocumental->id); ?>&nbsp;</td>
                                <td>
                                    <? if (empty($sgcManejoDocumental->online_id)) : ?>
                                        <a href="<?php echo  $sgcManejoDocumental->dir . $sgcManejoDocumental->filename ?>" target="_blank"><?php echo ucwords($sgcManejoDocumental->TipoDocumento); ?></a>&nbsp;
                                    <? else : ?>
                                        <a onclick="Online('<?php echo $sgcManejoDocumental->online_id ?>')" data-toggle="modal" href='#modal-id'><?php echo ucwords($sgcManejoDocumental->TipoDocumento); ?> Online</a>&nbsp;
                                    <? endif; ?>
                                </td>
                                <td><?php echo ucwords(strtolower($sgcManejoDocumental->NombreSolicitante)); ?>&nbsp;</td>
                                <td><?php echo ($sgcManejoDocumental->FechaSolicitud); ?>&nbsp;</td>
                                <td><?php echo ($sgcManejoDocumental->Proceso); ?>&nbsp;</td>
                                <td><?php echo ucwords($sgcManejoDocumental->TipoSolicitud); ?>&nbsp;</td>
                                <td><?php echo ($sgcManejoDocumental->Codigo); ?>&nbsp;</td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <?php
                                    if ($sgcManejoDocumental->Aprobado == 'si') {

                                        echo '<span class="label label-info">Aprobado</span>';
                                    }
                                    if ($sgcManejoDocumental->Aprobado == 'no') {

                                        echo '<span class="label label-danger">No aprobado</span>';
                                    }
                                    if ($sgcManejoDocumental->Aprobado == 're') {

                                        echo '<span class="label label-danger">En Revisión</span>';
                                    }
                                    
                                    if (empty($sgcManejoDocumental->Aprobado) or $sgcManejoDocumental->Aprobado == '') {
                                      
                                        echo '<span class="label label-warning">En espera</span>';
                                    }
                                    if ($sgcManejoDocumental->Aprobado == 'revision') {
                                        echo '<span class="label label-default">Revisión</span>';                                       
                                    }
                                    ?>
                                </td>
                                <td style="vertical-align: middle;text-align: center;" class="actions">
                                    <?php
                                    if ($sgcManejoDocumental->Aprobado == 'si') : ?>

                                        <a onclick="Ver('<?php echo $sgcManejoDocumental->id ?>')" data-toggle="modal" href='#modal-id' type="button" title="Ver datos de la Solicitud">
                                            <i style="color:#4CAF50" class="fas fa-eye"></i>
                                        </a>
                                         <?php if ($_SESSION['user']->rol_id == 2 or $_SESSION['user']->rol_id == 1) : ?>
                                            <a href="?c=solicitudes&a=editarsolicitud&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Actualizar datos de la Solicitud">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                        <?php endif; ?> 

                                    <?php else : ?>
                                        <?php //if ($_SESSION['user']->rol_id == 4 or $_SESSION['user']->rol_id == 1 or $_SESSION['user']->rol_id == 2) : ?>
                                            <a href="?c=solicitudes&a=responder&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Botón para responder solicitud">
                                            <i style="color:#FF9800" class="fas fa-file-signature"></i>
                                            <!-- <span class="material-symbols-outlined">library_add</span> -->
                                            </a>
                                        <?php //endif; ?>
                                        <a href="?c=solicitudes&a=versolicitud&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Botón para ver datos de la solicitud">
                                             <i style="color:#4CAF50" class="fas fa-eye"></i>
                                        </a>
                                        <?php //if ($_SESSION['user']->rol_id == 2 or $_SESSION['user']->rol_id == 1) : ?>
                                            <a href="?c=solicitudes&a=editarsolicitud&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Botón para actualizar datos de la solicitud">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                        <?php //endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>
<script>
    function Ver(id) {
        $.ajax({
            type: "POST",
            url: '?c=solicitudes&a=View',
            data: 'id=' + id,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Editar(id) {
        $.ajax({
            type: "POST",
            url: '?c=permisos&a=edit',
            data: 'id=' + id,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Online(id) {
        $.ajax({
            type: "POST",
            url: '?c=onlines&a=index',
            data: 'id=' + id,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>