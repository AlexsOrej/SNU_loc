<?php
if (isset($_REQUEST['ind'])) {
    $indicador_id = $_REQUEST['ind'];
} elseif (isset($_REQUEST['indicador_id'])) {
    $indicador_id = $_REQUEST['indicador_id'];
} else {
    $indicador_id =  $metas->indicador_id;
}
// print_r($metas);
// echo $metas->comparativo;
?>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <h2>REGISTRAR META</h2>
                    </div>
                </div>
            </div>
            <div class="body">
                <form name="formMeta" id="formMeta">
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Condición</label>
                                <div class="form-line">
                                    <select name="comparativo" class="form-control" required>
                                        <option value="">seleccionar</option>
                                        <option value="=" <?= $metas->comparativo == '=' ? 'selected' : '' ?>>IGUAL QUE ( = )</option>
                                        <option value=">" <?= $metas->comparativo == '>' ? 'selected' : '' ?>>MAYOR QUE( > )</option>
                                        <option value=">=" <?= $metas->comparativo == '>=' ? 'selected' : '' ?>>MAYOR IGUAL QUE ( >= )</option>
                                        <option value="<" <?= $metas->comparativo == '<' ? 'selected' : '' ?>>MENOR QUE( < )</option>
                                        <option value="<=" <?= $metas->comparativo == '<=' ? 'selected' : '' ?>>MENOR IGUAL QUE ( <= )</option>
                                        <option value="entre" <?= $metas->comparativo == 'entre' ? 'selected' : '' ?>>ENTRE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Valor</label>
                                    <input type="number" step="any" lang="en" name="valor" id="valor" class="form-control" value="<?= $metas->valor ?>" required>
                                    <input type="hidden" name="indicador_id" class="form-control" value="<?= $indicador_id ?>">
                                    <input type="hidden" name="id" class="form-control" value="<?= $metas->id ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Uso</label>
                                    <input type="date" name="fecha_uso" class="form-control" value="<?= $metas->fecha_uso ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <input type="submit" id="guardar" class="neu" value="Registrar">
                        </div>
                        <!-- #END# Input -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#formMeta").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                data: data,
                type: "post",
                url: "?c=indicadors&a=CrudMeta",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!',
                        text: "La meta fue registrada con éxito",
                        timer: 1500
                    });
                    setTimeout(function() {
                       window.location = '?c=indicadors&a=verdatos&indicador_id=' + response.trim();
                    }, 1500);
                }
            });
        });
    });
</script>