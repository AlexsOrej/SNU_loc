<!--<div class="row clearfix">-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>REGISTRAR PLAN DE ACCIÓN</h2>
        </div>
        <div class="body">
            <div class="row clearfix">
                <form action="" name="formAccion" id="formAccion" method="POST" role="form">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Análisis del indicador</label>
                                <textarea name="analisis" class="form-control" rows="10" cols="40" placeholder="Digita el analisis para este plan" required><?= $accions->analisis; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Actividades a desarrollar</label>
                                <textarea name="accion" class="form-control" rows="10" cols="40" placeholder="Digita las actividades para este plan" required><?= $accions->accion; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha de ejecución de actividades</label>
                                <input name="f_ejecucion" class="form-control" type="date" value="<?= $accions->f_ejecucion; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Responsable de la actividad</label>
                                <select name="cargo_id" class="form-control">
                                    <?php foreach ($cargos as $cargo) : ?>
                                        <option value='<?php echo $cargo->id ?>' <?php echo $cargo->id == $accions->cargo_id ? 'selected' : '' ?>><?php echo $cargo->cargo ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input name="dato_id" id="dato_id" type="hidden" value="<?php echo $_REQUEST['id'] ?>">
                                <input name="accion_id" id="accion_id" type="hidden" value="<?php echo $_REQUEST['accion_id'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-block">Registrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Input -->
<script>
    $(document).on('submit', '#formAccion', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var data = $(this).serialize(); // Serialize the form data
        $.ajax({
            data: data,
            type: "post",
            url: "?c=Acciones&a=Crud",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                });
                setTimeout(function() {
                    window.location = '?c=indicadors&a=verdatos&indicador_id=<?= $_REQUEST["ind_id"] ?>';
                }, 1501);
            }
        });
    });
</script>