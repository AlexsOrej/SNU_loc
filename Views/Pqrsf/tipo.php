<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">PQRSF <?= strtoupper($_REQUEST['tipo']) ?></h3>
    </div>
    <div class="panel-body">
        <div class="responsive">
            <table id="table" class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th WIDTH="10%">Tipo</th>
                        <th WIDTH="15%">Llegada</th>
                        <th WIDTH="50%">Descripción</th>
                        <th WIDTH="">Menu</th>
                    </tr>
                </thead>                
                <tbody>
                    <?php foreach ($pqrsBytipo as $value) : ?>
                        <tr>
                            <td>
                                <?= ucwords($value->tipo_peticion) . '<br> <span class="label label-warning"> ' . ucwords($value->estado) . '</strong> </span><br>'  ?>
                                <?= $value->estado == 'asignado' ? '<span class="label label-info"> A: ' . ucwords($value->responsable) . '</span>' : ''; ?>
                            </td>
                            <td><?= $value->fecha_registro;
                                $date1 = new DateTime($value->fecha_registro);
                                $hoy = date("Y-m-d");
                                $date2 = new DateTime($hoy);
                                $diff = $date1->diff($date2);
                                // will output 2 days
                                // echo $diff->days . ' dias ';
                                echo $value->dias_transcurridos==0 ? '<br>' . ($diff->invert == 1) ? ' - ' . $diff->days . ' Dias '  : $diff->days . ' Dias ': '<br>' . $value->dias_transcurridos.' Dias';
                                ?></td>
                            <td style="text-align: justify;"><?= $value->descripcion   . '<br> <span class="label label-info"> ' . ucwords($value->nombres . ' ' . $value->apellidos) . '</span><br> <strong> Número contacto: ' . $value->n_contacto . '<br> Correo: ' . $value->email . '</strong>' ?></td>
                            <td style="vertical-align: middle;text-align: center;" >
                                <?php
                                switch ($value->estado) {
                                    case 'abierto': ?>
                                        <a onclick="Asignar('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Registra al funcionario encargado de dar respuesta a la solicitud">
                                            <span class="material-icons">
                                                manage_accounts
                                            </span></a>

                                    <?php break;
                                    case 'asignado': ?>
                                        <a onclick="Responder('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Registra la respuesta para la solicitud">
                                            <span class="material-icons">
                                                settings_applications
                                            </span>
                                        </a>

                                    <?php break;
                                    case 'revision': ?>
                                        <a onclick="Revisar('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Revisa la respuesta de la solicitud">
                                            <span class="material-icons">
                                                person_search
                                            </span>
                                        </a>
                                        <a onclick="Notificar('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Notifica la respuesta de la solicitud"><span class="material-icons">
                                                contact_mail
                                            </span>
                                        </a>

                                    <?php break;
                                    case 'cerrado': ?>
                                        <a onclick="Satisfacion('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Registra el seguimiento a la solicitud"><span class="material-icons">
                                                admin_panel_settings
                                            </span></a>

                                <?php break;
                                } ?>
                                <a onclick="Resumen('<?= $value->id ?>')" data-toggle="modal" href='#modal-id' data-toggle="tooltip" data-placement="bottom" title="Encuentra el resumen de la solicitud"><span class="material-icons">
                                        preview
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="modal-id" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="result">

                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function Resumen(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=resumen',
            data: {
                id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };

    function Asignar(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=asignar',
            data: {
                id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };

    function Responder(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=responder',
            data: {
                id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };

    function Revisar(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=responder',
            data: {
                id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };

    function Notificar(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=notificar',
            data: {
                id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };

    function Satisfacion(id) {
        var id = id
        $.ajax({
            type: "POST",
            url: '?c=pqrsf&a=satisfacion',
            data: {
                pqrs_id: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });

    };
</script>