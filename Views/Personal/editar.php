<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Información general</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form id="frm_Personal" name="frm_Personal" method="post">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Número de identificación</label>
                                    <input name="cedula" id="cedula" value="<?= $alm->cedula ?>" type="number" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Lugar Expedición</label>
                                    <input name="expedicion" id="expedicion" value="<?= $alm->expedicion ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombres</label>
                                    <input name="Nombre" id="Nombre" value="<?= $alm->nombre ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Apellidos</label>
                                    <input name="Apellido" id="Apellido" value="<?= $alm->apellidos ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label>Grupo sanguineo</label>
                            <select name="grupo" id="grupo" class="form-control show-tick" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>RH</label>
                            <select name='rh' id='rh' class="form-control show-tick" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Sexo</label>
                            <select class="form-control show-tick" name="sexo" id="sexo" required>
                                <option value="">-- Seleccionar --</option>
                                <option value="<?= $alm->Sexo ?>" <?= $alm->Sexo == 1 ? 'selected' : '' ?>>Masculino</option>
                                <option value="<?= $alm->Sexo ?>" <?= $alm->Sexo == 2 ? 'selected' : '' ?>>Femenino</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Nacimiento</label>
                                    <input name="FechaNacimiento" id="FechaNacimiento" value="<?= $alm->FechaNacimiento ?>" type="date" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Lugar Nacimiento</label>
                                    <input name="LugarNacimiento" id="LugarNacimiento" value="<?= $alm->LugarNacimiento ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Estado Civil</label>

                                    <select name="estado_civil" id="estado_civil" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <option value="<?= $alm->estado_civil ?>" <?= $alm->estado_civil == 'soltero' ? 'selected' : '' ?>>Soltero</option>
                                        <option value="<?= $alm->estado_civil ?>" <?= $alm->estado_civil == 'casado' ? 'selected' : '' ?>>Casado</option>
                                        <option value="<?= $alm->estado_civil ?>" <?= $alm->estado_civil == 'divorciado' ? 'selected' : '' ?>>Divorciado</option>
                                        <option value="<?= $alm->estado_civil ?>" <?= $alm->estado_civil == 'viudo' ? 'selected' : '' ?>>Viudo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Estrato</label>
                                    <input name="estrato" id="estrato" value="<?= $alm->estrato ?>" type="number" class="form-control" min="1" max="8" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Dirección</label>
                                    <input name="direccion" id="direccion" value="<?= $alm->direccion ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Barrio</label>
                                    <input name="barrio" id="barrio" type="text" value="<?= $alm->Barrio ?>" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Ciudad Residencia</label>
                                    <input name="ciudad_residencia" id="ciudad_residencia" type="text" value="<?= $alm->ciudad_recidencia ?>" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Correo Electronico</label>
                                    <input name="Correo" id="Correo" type="email" value="<?= $alm->correo ?>" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Telefono Fijo</label>
                                    <input name="telefono_fijo" id="telefono_fijo" type="number" value="<?= $alm->telefono_fijo ?>" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Telefono Movil</label>
                                    <input name="celular" id="celular" type="number" value="<?= $alm->celular ?>" class="form-control" required="required" placeholder="" />

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombre Persona Emergencia</label>
                                    <input name="nom_cont_emer" id="nom_cont_emer" type="text" value="<?= $alm->nom_contacto_emergencia ?>" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Contacto de Emergencia</label>
                                    <input name="num_cont_emer" id="num_cont_emer" type="number" value="<?= $alm->num_contacto_emergencia ?>" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nivel Academico</label>
                                    <select name="nivel_educativo" id="nivel_educativo" class="form-control" required="required">
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'basica' ? 'selected' : '' ?>>Educación básica</option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'media' ? 'selected' : '' ?>>Educación media</option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'superior' ? 'selected' : '' ?>>Educación superior</option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'tecnica' ? 'selected' : '' ?> >Educación Técnica </option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'tecnologica' ? 'selected' : '' ?> >Educación Tecnológica</option>                                        
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'especializacion' ? 'selected' : '' ?> >Especialización</option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'maestria' ? 'selected' : '' ?> >Maestria</option>
                                        <option value="<?= $alm->nivel_educativo ?>" <?= $alm->nivel_educativo == 'doctorado' ? 'selected' : '' ?> >Doctorado</option>    
                                   
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Profesión</label>
                                    <input name="profesion" id="profesion" type="text" value="<?= $alm->profesion ?>" class="form-control" required="required" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="btn" name="registro" id="registro" class="btn btn-guardar btn-block" value="Registrar" />
                            <input type="hidden" name="id" id="id" class="" value="<?= $alm->id ?>" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Textarea -->

<script>
    $(document).ready(function() {
    $("#registro").on('click', function() {
        if($('#FechaNacimiento').val() == "" || $('#correo').val() == "") { 
            var camposFaltantes = [];
            if ($('#FechaNacimiento').val() == "") {
                camposFaltantes.push("Fecha de Nacimiento");
            }
            if ($('#correo').val() == "") {
                camposFaltantes.push("Correo");
            }
            var mensajeError = "Los siguientes campos están vacíos: " + camposFaltantes.join(", ");
            Swal.fire({
                icon: 'error',
                title: mensajeError,
                timer: 1500,
                showConfirmButton: false,
            });
        } else {
            var datos = $('#frm_Personal').serialize();
            $.ajax({
                url: '?c=personas&a=editar',
                type: 'post',
                data: datos,
                success: function(resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'La información se actualizo con exito',
                        timer: 1500,
                        showConfirmButton: false,
                    });
                    setTimeout(function() {
                     $("#contenido").load(location.href + " #contenido");
                    }, 1500);
                },
                error: function(xhr, status, error) {
                    // Manejar la excepción aquí
                    alert("Se produjo un error al enviar la solicitud: " + error);
                }
            });
        }
    });
});

</script>