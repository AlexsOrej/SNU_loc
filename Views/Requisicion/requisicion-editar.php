<?php //print_r($alm); ?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header"><h5>DATOS DE LA VACANTE</h5></div>
            <div class="body">
                <form id="formRequisicion" id="formRequisicion" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>" />
                    <!-- 1=solicitado, 2=aprobado 3=rechazado -->
                    <input type="hidden" name="estado" id="estado" value="1" />
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Cargo Requerido</label>
                                    <select class="form-control" name="cargo_requerido" id="cargo_requerido" required>
                                        <?php $cargo = $this->model->Cargos(); ?>
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($cargo as $value) : ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo $value->id == $alm->cargo_id ? "selected" : ""; ?>><?php echo $value->cargo; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="res"></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="num_vacantes" id="num_vacantes" value="1" min="1" class="form-control" placeholder="" required />
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <!-- <div class="form-line">
                                        <label>Sede</label>
                                        <input name="sede" id="sede" value="<?php echo $alm->sede; ?>" type="text" class="form-control" placeholder="" required />
                                    </div> -->
                                    <label for="">Seleccionar sede</label>
                                    <select class="form-control" name="sede" id="sede" required>
                                            <?php $sedes = $this->model->sedes(); 
                                            //print_r($sedes);
                                            ?>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($sedes as $value) : ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo $value->id == $alm->sede ? "selected" : ""; ?>><?php echo $value->nombre?></option>
                                            <?php endforeach; ?>
                                    </select>
                                    <div id="res"></div>


                                </div>
                            </div>    
                            
                            <div id="res"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Prioridad</label>
                                    <select class="form-control" name="prioridad" id="prioridad" required>
                                        <option value="">Seleccionar</option>
                                        <option value="0" <?= $alm->prioridad == 0 ? 'selected' : '' ?>>Bajo</option>
                                        <option value="1" <?= $alm->prioridad == 1 ? 'selected' : '' ?>>Medio</option>
                                        <option value="2" <?= $alm->prioridad == 2 ? 'selected' : '' ?>>Alto</option>
                                    </select>
                                </div>
                            </div>
                            <div id="res"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Motivo Requisición</label>
                                    <select class="form-control" name="motivo" id="motivo" required>
                                        <option value="">Seleccionar</option>
                                        <option value="Retiro/Renuncia" <?= $alm->motivo == "Retiro/Renuncia" ? 'selected' : '' ?>>Retiro/Renuncia</option>
                                        <option value="Reemplazo" <?= $alm->motivo == "Reemplazo" ? 'selected' : '' ?>>Reemplazo</option>
                                        <option value="Nuevo Cargo" <?= $alm->motivo == "Nuevo Cargo" ? 'selected' : '' ?>>Nuevo Cargo</option>
                                    </select>
                                </div>
                            </div>
                            <div id="res"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Ingreso Propuesto</label>
                                    <input name="fecha_ingreso" id="fecha_ingreso" value="<?php echo $alm->fecha_ingreso; ?>" type="date" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Condiciones</label>
                                    <textarea name="condiciones" id="condiciones" cols="30" rows="1" class="form-control"><?php echo $alm->condiciones; ?></textarea>
                                </div>
                            </div>
                            <div id="res"></div>
                        </div>
                        </fieldset>
                        <div class="col-md-12 text-center">
                            <a href="#" title="Botón para guardar cambios" id="guardar" class="btn-guardar" style="width:100%;">Registrar </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Textarea -->

<script>
    $(document).on('click', '#guardar', function(e) {

        var msn = '';
        var est = true;
        var cargo_requerido = document.getElementById('cargo_requerido').value;
        var num_vacantes = document.getElementById('num_vacantes').value;
        var sede = document.getElementById('sede').value;
        var prioridad = document.getElementById('prioridad').value;
        var motivo = document.getElementById('motivo').value;
        var fecha_ingreso = document.getElementById('fecha_ingreso').value;
        var condiciones = document.getElementById('condiciones').value;
        if (cargo_requerido === '') {
            var msn = 'El cargo debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )

        }
        if (num_vacantes === '') {
            var msn = 'El numero de vacantes debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )


        }
        if (sede === '') {
            var msn = 'La sede debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )


        }
        if (prioridad === '') {
            var msn = 'La prioridad debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )


        }
        if (motivo === '') {
            var msn = 'El motivo debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )


        }
        if (fecha_ingreso === '') {
            var msn = 'La fecha ingreso debe ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )


        }
        if (condiciones === '') {
            var msn = 'Las condiciones deben ser Diligeciado';
            var est = false;
            Swal.fire({
                icon: 'success',
                title: msn,
                timer: 1500,
                showConfirmButton: false,
            }, )

        }

        if (est) {
            var formData = new FormData($("#formRequisicion")[0]);
            $.ajax({
                url: "?c=requisicions&a=Guardar",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                       // title: 'La requisicion se registro con éxito',
                        title: data,
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                       window.location = '?c=requisicions&a=index';
                    }, 1501)
                }
            });
        }
    });
</script>