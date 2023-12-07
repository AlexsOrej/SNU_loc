<div class="body">
    <!--Basic Card-->
    <? //print_r($contrato);?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="card">
                <div class="header">
                    <h2>Ingresa los datos para la elaborar el contrato a:
                        <small>
                        <span class="font-bold col-teal">
                                <?php echo $seleccionado->nombre . ' ' . $seleccionado->apellidos . '</span><br>Identificación: ' . $seleccionado->cedula ?>
                        </small>
                    </h2>
                </div>
                <div class="body">
                    <form method="POST" action="" name="form-contrato" id="form-contrato">
                        <input name="usuario" id="usuario" type="hidden" class="form-control" value="<?php echo $seleccionado->id ?>">
                        <div class="row ">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Tipo de Contrato</label>
                                        <select name="tipoContrato" id="tipoContrato" class="form-control" required>
                                            <option value=" ">Seleccionar</option>
                                            <?php
                                            foreach ($tipos as $value) : ?>
                                                <option value="<?php echo $value->id ?>" <?=$value->id==$contrato->tipo_contrato?'selected':'' ?>><?php echo $value->nombre ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Cargo</label>
                                        <select name="cargo_id" id="cargo_id" class="form-control" required>
                                            <option value=" ">Seleccionar</option>
                                            <?php
                                            foreach ($cargos as $cargo) : ?>
                                                <option value="<?php echo $cargo->id ?>" <?=$cargo->id==$contrato->cargo_id?'selected':'' ?>><?php echo $cargo->cargo ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Salario</label>
                                        <input name="valor" id="valor" type="number" class="form-control" value="<?=$contrato->valor?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Auxilio Transporte</label>
                                        <input name="aux_trans" id="aux_trans" type="text" class="form-control" value="<?=$contrato->aux_trans?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Fecha de Inicio</label>
                                        <input name="inicio_contrato" id="inicio_contrato" type="date" class="form-control" value="<?=$contrato->inicio_contrato?>" required>
                                        <input name="usuario_id" id="usuario_id" type="hidden" class="form-control" value="<?php echo $_SESSION['user']->FullName ?>" required>
                                        <input name="id" id="id" type="hidden" class="form-control" value="<?=$contrato->id?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Termino Duración del Contrato</label>
                                        <input name="duracion" id="duracion" type="date" class="form-control" value="<?=$contrato->duracion?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Lugar de la Actividad</label>
                                        <input name="lugar" id="lugar" type="text" class="form-control" value="<?=$contrato->lugar?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Enviar Manual De Funciones</label> <br>
                                        <input type="radio" id="no" name="manual" value="NO" <?=$contrato->manual=="NO" ?'checked':'' ?> >
                                        <label for="no">No</label>
                                        <input type="radio" id="si" name="manual" value="SI" <?=$contrato->manual=="SI" ?'checked':'' ?>>
                                        <label for="si">Si</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Enviar Copia del Contrato</label> <br>
                                        <input type="radio" id="no1" name="contrato" value="NO" <?=$contrato->notiContrato=="NO" ?'checked':'' ?>>
                                        <label for="no1">No</label>
                                        <input type="radio" id="si1" name="contrato" value="SI" <?=$contrato->notiContrato=="SI" ?'checked':'' ?>>
                                        <label for="si1">Si</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Encargado de Firmar</label> <br>
                                        <select name="encargadofirma" id="encargadofirma" class="form-control">
                                            <option value="">Seleccionar</option>
                                            <?php foreach($usuarios as $value): ?>
                                            <option value="<?= $value->id  ?>"><?=$value->nombres.' '.$value->apellidos?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                                <input type="button" id="botonenviar" class="btn btn-guardar btn-block" value="Registrar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#botonenviar').click(function() {
                    if (($('#tipoContrato').val() != "") && ($('#cargo_id').val() != "") && ($('#valor').val() != "") && ($('#aux_trans').val() != "") && ($('#usuario_id').val() != "") && ($('#duracion').val() != "") && ($('#lugar').val() != "")) {
                        var datos = $('#form-contrato').serialize();
                        var persona = document.getElementById("usuario").value
                        $.ajax({
                            type: "POST",
                            url: "?c=contratacion&a=Guardar",
                            data: datos,
                            success: function(response) {                               
                                    Swal.fire({
                                        icon: 'success',
                                        title: "Bien hecho",
                                        text:"los datos del contrato se crearon con éxito"
                                        // timer: 1500
                                    }, )
                                    setTimeout(function() {
                                     window.location = '?c=contratacion&a=Historial&id=' + persona;
                                    }, 1500)                              
                            }
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Debe Diligenciar todos los campos',
                            timer: 1500
                        }, )
                    }
                    return false;
                });
            });
        </script>