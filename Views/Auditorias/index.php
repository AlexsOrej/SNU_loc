<div class="card">
    <div class="header">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-6">
                <h2 class="title">Programa Auditoria</h2>
            </div>
            <div class="col-xs-12 col-sm-6 align-right">
                <button class="neu" id="registrar" data-toggle="modal" href='#modal-id'>Registrar Programa</button>
            </div>
        </div>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha Realización</th>
                        <th>Menu del Plan</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Planeación</th>
                        <th>Ejecución</th>
                    </tr>
                    <thead>
                    <tbody>
                        <? foreach ($programa as $programas) : ?>
                            <tr>
                                <td>PAU0<?= $programas->id ?></td>
                                <td><?= $programas->alcances ?></td>
                                <td><?= $programas->metodo ?></td>
                                <td><?= $programas->fecha_inicio ?></td>
                                <td><?= $programas->fecha_fin ?></td>
                                <td>
                                    <a type="button" class="" onclick="PlanAuditoria('<?= $programas->id ?>')" title="CREAR LOS PLANES DE AUDITORIA POR PROCESO" data-toggle="modal" href='#modal-id'>
                                        <span class="glyphicon glyphicon-tag"></span>
                                    </a>
                                    <a type="button" class="" onclick="ver('<?= $programas->id ?>')" title="EDITAR EL PROGRAMA DE AUDITORIA">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="?c=auditorias&a=verplanesauditoria&programa_id=<?= $programas->id ?>" type="" class="" title="VER EL PROGRAMA DE AUDITORIA">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <a type="button" class="" onclick="ver('<?= $programas->id ?>')" title="ELIMINAR EL PROGRAMA DE AUDITORIA">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Programa Auditoria</h4>
            </div>
            <div class="modal-body" id="contenido">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#registrar', function(e) {

        $.ajax({
            type: "post",
            url: "?c=auditorias&a=crud",
            success: function(response) {
                $('#contenido').html(response);
            }
        })
    });


    function PlanAuditoria(programa_id) {
        $.ajax({
            type: "post",
            data: {
                programa_id: programa_id
            },
            url: "?c=auditorias&a=PlanAuditoria",
            success: function(response) {
                $('#contenido').html(response);
            }
        })
    }
</script>