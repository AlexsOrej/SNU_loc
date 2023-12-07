<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Afiliaciones Seguridad Social</h2>
                <div class="header-dropdown m-r--1">
                    <a class="btn  bg-blue" onclick="Nuevo('<?php echo $_REQUEST['id'] ?>')" data-toggle="modal" href='#modal-id'>
                     <i style="color:#FFF !important; font-size:13px" class="material-icons col-amber">contacts</i>
                      Registrar</a>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Eps</th>
                            <th>Arl</th>
                            <th>Fondo Pensiones</th>
                            <th>Caja Compensación</th>
                            <th>Fecha Registro</th>
                            <th></th>
                        </tr>
                        <?php foreach ($afiliaciones as $R) : ?>
                            <tr>
                                <td><?php echo $R->eps ?></td>
                                <td><?php echo $R->arl ?></td>
                                <td><?php echo $R->fondo ?></td>
                                <td><?php echo $R->caja ?></td>
                                <td><?php echo $R->afiliacion_fecha ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <a title="" class="" onclick="Nuevo('<?php echo $R->id ?>')" data-toggle="modal" href='#modal-id'>
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a title="" class="" onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=afiliaciones&a=Eliminar&idf=<?php echo $R->id; ?>&id=<?php echo $_REQUEST['id']; ?>">
                                    <i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                     </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>












<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-header">
        </div>
        <div class="modal-body" id="resultados">
        </div>
    </div>
</div>

<script>
    function Nuevo(id) {
        $.ajax({
            type: "POST",
            url: '?c=afiliaciones&a=crud',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultados').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultados').html(resp);

            }
        });
    }
</script>