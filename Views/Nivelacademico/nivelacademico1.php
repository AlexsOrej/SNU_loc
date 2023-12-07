<?
isset($_REQUEST['id'])
    ? $personal = $_REQUEST['id']
    : $personal = $_REQUEST['personal_id']
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Formación Academica</h2>
                <div class="header-dropdown m-r--1">
                    <a title="Botón para registrar información academica" class="btn  bg-blue" onclick="Nuevo('<?= $personal ?>')" data-toggle="modal" href='#modal-id'>
                     <i style="color:#FFF !important; font-size:13px" class="material-icons col-amber">contacts</i>
                      Registrar</a>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Estudio</th>
                                <th>Estado</th>
                                <th>Institución Educativa</th>
                                <th>Academia</th>
                                <th>Fecha realización</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Estudio</th>
                                <th>Estado</th>
                                <th>Institución Educativa</th>
                                <th>Academia</th>
                                <th>Fecha realización</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($formacion as $r) : ?>
                                <tr>
                                    <td><?php echo $r->nivel; ?></td>
                                    <td><?php echo $r->estudio; ?></td>
                                    <td><?php echo $r->curso_vigilancia; ?></td>
                                    <td><?php echo $r->lugar; ?></td>
                                    <td><?php echo $r->fecha; ?></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <a  title="Botón para editar formacion academica" class="" onclick="Editar('<?php echo $r->id ?>')" data-toggle="modal" href='#modal-id'>
                                            <i class="glyphicon glyphicon-edit"></i>
                                           
                                        </a>
                                        <a title="Botón para "  class="" onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=Nivelacademico&a=Eliminar&id=<?= $r->id; ?>&user=<?php echo $_REQUEST['id']; ?>">
                                        <i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                        
                                    </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade col-md-offset-3 col-md-6" id="modal-id">
    <div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
      
    </div>
    <div class="modal-body" id="resultados"></div>
</div>
<script>
    function Nuevo(id) {
        $.ajax({
            type: "POST",
            url: '?c=Nivelacademico&a=Crud',
            data: {
                id: id
            },
            success: function(resp) {
                $('#resultados').html(resp);
            }
        });
    }

    function Editar(id) {
        $.ajax({
            type: "POST",
            url: '?c=Nivelacademico&a=Crud',
            data: {
                formacion_id: id
            },
            success: function(resp) {
                $('#resultados').html(resp);
            }
        });
    }
</script>