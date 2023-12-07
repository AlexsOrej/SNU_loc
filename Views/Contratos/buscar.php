<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="datoModal">
            </div>
            <div class="modal-footer">
                <button type="button" class="bg-orange btn" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="header">
        <h3 class="title">Resultados</h3>
    </div>
    <div class="body">
        <table class="table table-bordered" id="tbl_aspirante">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Identificación</th>
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $value) : ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->nombre ?></td>
                        <td><?= $value->apellidos ?></td>
                        <td><?= $value->cedula ?></td>
                        <td><?= $value->status ?></td>
                        <td><?= $value->FechaRegistro . '-' . $value->rol_id ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <?php if ($value->status == 'Seleccionado') : ?>
                                <a title="Botón para contratar postulado" type="button" id="contratar" onclick="Contratar('<?= $value->id ?>')" class="btn bg-light-blue" data-toggle="modal" href='#modal-id'>
                                    <i class="material-icons">fingerprint</i>
                                    Contratar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function Procesar(dato) {
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=procesar',
            data: {
                id: dato
            },
            beforeSend: function() {
                $('#cargando').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
            }
        });
    }
    function Novedad() {
        var data = document.getElementById("novedad").value
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=novedad',
            data: {
                id: data
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
            }
        });
    }
    function Contratar(data) {
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=contratar',
            data: {
                id: data
            },
            success: function(resp) {
                $('#datoModal').html(resp);
            }
        });
    }
</script>