<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Aspirante</h2>
            </div>
            <div class="body">
                <form id="frm-Usuario" action="?c=seleccion&a=guardar" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="" />
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Hoja de vida </label>
                                    <input name="hvida" value="" type="file" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Número de identificación</label>
                                    <input name="cedula" value="" type="number" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Lugar Expedición</label>
                                    <input name="expedicion" value="" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombres</label>
                                    <input name="Nombre" value="" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Apellidos</label>
                                    <input name="Apellido" value="" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Grupo sanguineo</label>
                            <select name="grupo" class="form-control show-tick" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>RH</label>
                            <select name='rh' class="form-control show-tick" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Sexo</label>
                            <select class="form-control show-tick" name="sexo" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">Otro</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Nacimiento</label>
                                    <input name="FechaNacimiento" value="" type="date" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Lugar Nacimiento</label>
                                    <input name="LugarNacimiento" value="" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Estado Civil</label>
                                    <select name="estado_civil" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <option value="soltero">Soltero</option>
                                        <option value="casado">Casado</option>
                                        <option value="divorciado">Divorciado</option>
                                        <option value="viudo">Viudo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Estrato</label>
                                    <input name="estrato" value="" type="number" class="form-control" min="1" max="8" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Dirección</label>
                                    <input name="direccion" value="" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Barrio</label>
                                    <input name="barrio" type="text" value="" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Ciudad Residencia</label>
                                    <input name="ciudad_residencia" type="text" value="" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <input name="" type="hidden" value="1" class="form-control" placeholder="" required />
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Correo Electronico</label>
                                    <input name="Correo" type="mail" value="" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Telefono Fijo</label>
                                    <input name="telefono_fijo" type="number" value="" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Telefono Movil</label>
                                    <input name="celular" type="number" value="" class="form-control" required="required" placeholder="" />
                                    <input name="rol" type="hidden" value="5" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombre Persona Emergencia</label>
                                    <input name="nom_cont_emer" type="text" value="" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Contacto de Emergencia</label>
                                    <input name="num_cont_emer" type="number" value="" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nivel Academico</label>
                                    <select name="nivel_educativo" id="" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                        <option value="basica">Educación Básica Secundaria</option>
                                        <option value="media">Educación media</option>
                                        <option value="tecnica">Educación Técnica </option>
                                        <option value="tecnologica">Educación Tecnológica</option>
                                        <option value="superior">Educación superior</option>
                                        <option value="especializacion">Especialización</option>
                                        <option value="maestria">Maestria</option>
                                        <option value="doctorado">Doctorado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Profesión</label>
                                    <input name="profesion" type="text" value="" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Cargo al que Aspira</label>
                                <select name="cargo_id" class="form-control" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($cargos as $cargo) : ?>
                                        <option value="<?php echo $cargo->id ?>  "><?php echo $cargo->cargo ?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" name="registro" class="btn btn-guardar btn-block" value="Registrar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- #END# Textarea -->