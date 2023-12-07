<div class="card">
    <div class="header">
        <div class="row">
            <div class="col-sm-10">
                <h2>Clasificación de Eventos</h2>
            </div>
            <div class="col-sm-2">
            <a title="Botón para registrar un evento" onclick="Registrar()" data-toggle="modal" href="#modal-id" class="neu pull-right">    
            <span> <i class="glyphicon glyphicon-plus"></i> Registrar</span>
                    
                </a>
            </div>
        </div>
    </div>
    <div class="body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre Evento</th>
                    <th>Sigla</th>
                    <th>Correo Responsable</th>
                    <th style="vertical-align: middle;text-align: center;" >Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento) : ?>
                    <tr>
                        <td><?= $evento->nombreevento ?></td>
                        <td><?= $evento->sigla ?></td>
                        <td><?= $evento->correoresponsable ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <a title="Botón para editar evento" onclick="Editar('<?= $evento->id ?>')" data-toggle="modal" href="#modal-id" class="" title="Editar los datos">

                                <i class="glyphicon glyphicon-edit"></i>
                                <span></span>

                            </a>
                        </td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="index">

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>

    <script>
        function Registrar() {
            $.ajax({
                type: "POST",
                url: '?c=eventos&a=add',
                success: function(resp) {
                    $('#index').html(resp);
                    $('#respuesta').html("");
                }
            });
        }

        function Editar(id) {
            $.ajax({
                type: "POST",
                url: '?c=eventos&a=add',
                data: {
                    id: id
                },
                success: function(resp) {
                    $('#index').html(resp);
                    $('#respuesta').html("");
                }
            });
        }
    </script>