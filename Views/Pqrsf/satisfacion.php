<? //print_r($respuesta)
?>
<h1>Registrar</h1>
<form id="form-satisfacion" name="form-satisfacion">
    <div class="col-md-12 text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Grado de Satisfación</label>
                        <select name="satisfacion" id="satisfacion" class="form-control" required>
                            <option value="">Seleccionar</option>
                            <option <?= $satisfacion->estado_cliente == 1 ? 'selected' : '' ?> value="Muy Satisfecho">Muy Satisfecho</option>
                            <option <?= $satisfacion->estado_cliente == 2 ? 'selected' : '' ?> value="Satisfecho">Satisfecho</option>
                            <option <?= $satisfacion->estado_cliente == 3 ? 'selected' : '' ?> value="Poco Satisfecho">Poco Satisfecho</option>
                            <option <?= $satisfacion->estado_cliente == 4 ? 'selected' : '' ?> value="Nada Satisfecho">Nada Satisfecho</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <label>Observación</label>
                <textarea name="observacion" id="observacion" cols="20" rows="10" class="form-control"><?= $satisfacion->id ?></textarea>
            </div>
            <div class="col-md-6">
                <input type="hidden" id="empresa_id" name="empresa_id" value="<?= $respuesta->url ?>">
                <input type="hidden" id="id" name="id" value="<?= $satisfacion->id ?>">
                <input type="hidden" id="pqrs_id" name="pqrs_id" value="<?= $_REQUEST['pqrs_id'] ?>">
                <input type="hidden" id="respuesta_id" name="respuesta_id" value="<?= $respuesta->id ?>">
            </div>
        </div><br>
        <div class="col-md-6 col-md-offset-3">
            <button id="guardar" type="button" class="btn btn-guardar">Guardar</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#guardar').click(function() {
            var datos = $('#form-satisfacion').serialize();
            if (($('#satisfacion').val() != "") && ($('#observacion').val() != "")) {
                $.ajax({
                    type: "POST",
                    url: "?c=pqrsf&a=crudsatisfacion",
                    data: datos,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BIEN HECHO!',
                            // timer: 1500
                        }, )
                        setTimeout(function() {
                         window.location.reload();
                        }, 1500)
                    }
                });
            }
        });
    });
</script>