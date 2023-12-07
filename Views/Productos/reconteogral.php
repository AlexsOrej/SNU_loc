<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Conteo X Ubicación</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Buscar</h3>
                    </div>
                    <div class="panel-body">
                        <form action="?c=productos&a=reconteogral" method="POST">
                            <div class="form-group text-center">
                                <div class="col-sm-6">
                                    <label>Sede</label>
                                    <select name="sede" id="sede" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <? foreach ($sedes as  $value) : ?>
                                            <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                                <div id="sede_" class="col-sm-6">
                                    <label>Ubicaciones</label>
                                    <select name="ubicacion_id" id="" class="form-control" required="required">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-sm-12 text-center"><br>
                                    <button type="submit" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <? if (isset($_REQUEST['ubicacion_id'])) : ?>
                    <table id="informe" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Nombre</th>
                                <th>Caracteristicas</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($reconteo  as $result0) : ?>
                                <tr>
                                    <td><?= $result0->cantidad ?></td>
                                    <td><?= utf8_encode($result0->nombre) ?></td>
                                    <td><?= utf8_encode($result0->carateristicas) ?></td>
                                    <td><?= $result0->ubicacion . '-' . $result0->sede ?></td>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $('#sede').on('change', function() {
        var id = document.getElementById("sede").value
        if (id > 0) {
            $.ajax({
                type: "POST",
                url: '?c=productos&a=descripcion',
                data: {
                    sede_id: id
                },
                beforeSend: function() {
                    $('#sede_').html("<h5 class='text-center'>Cargando Información</h5>");
                },
                success: function(resp) {
                    $('#sede_').html(resp);
                    $('#respuesta').html("");
                }
            });
        }
    });
</script>