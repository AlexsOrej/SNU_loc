<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                REGISTRAR FICHA DEL INDICADOR
            </h2>
        </div>
        <div class="body">
            <form action="" name="formIndicador" id="formIndicador" method="POST">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Nombre del Indicador</label>
                                <?php $fecha = date('Y-m-d'); ?>
                                <input type="text" name="nombre" name="nombre" class='form-control' value="<?php echo $indicador->nombre ?>" required>
                            </div>
                            <div id="nombre_"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Proceso Responsable</label>
                            <select name="proceso_id" id="proceso_id" class="form-control select2" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($procesos as $pro) : ?>
                                    <option value="<?php echo $pro->id; ?>" <?php echo $indicador->proceso_id == $pro->id ? 'selected' : ''   ?>><?php echo $pro->Iniciales . '-' . $pro->NombreProceso; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="proceso_id_"></div>
                    </div>
                    <div class="col-sm-4">
                        <?
                        //  echo'<pre>';
                        //  print_r($cargos) ;
                        //  echo'</pre>';
                        ?>
                        <div class="form-group">
                            <label>Cargo Responsable</label>
                            <select class="form-control select2" id="cargo_id" name="cargo_id" required>
                                <option value="">Seleccionar</option>';
                                <?php foreach ($cargos as $value) : ?>
                                    <option value="<?php echo $value->id ?>" <?= $value->id == $indicador->cargo_id ? 'selected' : '' ?>><?= $value->cargo . " " . $value->nombres . " " . $value->apellidos ?> </option>;
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha Control</label>
                                <input type="date" name="fecha_control" class='form-control' value="<?php echo $indicador->fecha_control; ?>" required>
                            </div>
                            <div id="fecha_control_"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Formula</label>
                                <select class="form-control show-tick" name="formula_id" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($formulas as  $formula) : ?>
                                        <option value="<?php echo $formula->id ?>" <?php echo $indicador->formula_id == $formula->id ? 'selected' : '' ?>><?php echo $formula->formula ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div id="formula_id_"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fuente del recurso</label>
                                <textarea class="form-control" name="definicion" value="" required><?php echo $indicador->definicion; ?></textarea>
                            </div>
                            <div id="definicion_"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Interpretación</label>
                                <textarea class="form-control" name="interpretacion" value="" required><?php echo $indicador->interpretacion; ?></textarea>
                            </div>
                            <div id="interpretacion_"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Periodicidad</label>
                                <select class="form-control" name="periodicidad" required>
                                    <option value="">Seleccionar</option>
                                    <option value="mensual" <?php echo $indicador->periodicidad == 'mensual' ? 'selected' : '' ?>>Mensual</option>
                                    <option value="bimensual" <?php echo $indicador->periodicidad == 'bimensual' ? 'selected' : '' ?>>Bimensual</option>
                                    <option value="trimestral" <?php echo $indicador->periodicidad == 'trimestral' ? 'selected' : '' ?>>Trimestral</option>
                                    <option value="semestral" <?php echo $indicador->periodicidad == 'semestral' ? 'selected' : '' ?>>Semestral</option>
                                    <option value="anual" <?php echo $indicador->periodicidad == 'anual' ? 'selected' : '' ?>>Anual</option>
                                </select>
                            </div>
                            <div id="periodicidad_"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <input class="form-control" name="meta" placeholder="" type="hidden" value="1" required>
                        <input class="form-control" name="num_meta" placeholder="" type="hidden" value="0" required>
                        <input name="id" id="id" type="hidden" value="<?php echo $indicador->indicador_id; ?>">
                        <input type="submit" id="guardar" class="btn btn-default btn-block" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #END# Input -->
<script>
    $(document).ready(function() {
        $("#formIndicador").submit(function(e) {
            e.preventDefault();
            // Si todos los campos están llenos, ejecuta la llamada AJAX
            var data = $("#formIndicador").serialize();
            $.ajax({
                data: data,
                type: "post",
                url: "?c=indicadors&a=Crud",
                success: function(response) {
                    var idValue = $('#id').val();
                    var text = (idValue > 0) ? 'Datos actualizados' : 'Ahora registra la meta del indicador';

                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        text: text,
                        timer: 1500
                    }).then(() => {
                        var redirectUrl = (idValue > 0) ? `?c=indicadors&a=verdatos&indicador_id=${idValue}` : `?c=indicadors&a=meta&indicador_id=${response.trim()}`;
                        window.location = redirectUrl;
                    });
                }

            });
        });
    });


    $('#proceso_id').on('change', function(e) {
        var proceso_id = document.getElementById("proceso_id").value
        $.ajax({
            data: {
                proceso_id: proceso_id
            },
            type: "post",
            url: "?c=indicadors&a=Cargos",
            success: function(resp) {
                $('#div_subcategorias_wrapper').html(resp);
            }
        })
    });
</script>