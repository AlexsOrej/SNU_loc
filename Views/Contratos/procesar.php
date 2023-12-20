<section>
    <div class="card">
        <div class="header">
            <h2>
                Aspirante
                <small>Validar los datos generales del aspirante</small>
            </h2>
            <?php if (file_exists("Assets/soportes/" . $alm->cedula . "/")) {
                $ruta = "Assets/soportes/" . $alm->cedula . "/"; ?>
                <ul class="header-dropdown m-r--6">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="btn efecto dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="initials">
                                <i class="material-icons" style="font-size: 14px; color:aliceblue">attach_file</i>
                            </span><span class="list-text">SOPORTES</span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <?php $soportes = $this->model->obtener_estructura_directorios($ruta); ?>
                        </ul>
                    </li>
                </ul>
            <? } else {
                echo "Los Soportes no existen";
            }
            ?>
        </div>
        <div class="body">
            <form action="" id="form-aspirante" name="form-aspirante" method="post">
                <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
                <div class="row clearfix">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Número de identificación</label>
                                <input name="cedula" value="<?php echo $alm->cedula; ?>" type="number" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Lugar Expedición</label>
                                <input name="expedicion" value="<?php echo $alm->expedicion; ?>" type="text" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Nombres</label>
                                <input name="Nombre" value="<?php echo $alm->nombre; ?>" type="text" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Apellidos</label>
                                <input name="Apellido" value="<?php echo $alm->apellidos; ?>" type="text" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha Nacimiento</label>
                                <input name="FechaNacimiento" value="<?php echo $alm->FechaNacimiento; ?>" type="date" class="form-control" placeholder="CALI/AA-MM-DD" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Direccion</label>
                                <input name="direccion" value="<?php echo $alm->direccion; ?>" type="text" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Barrio</label>
                                <input name="Barrio" type="text" value="<?php echo $alm->Barrio; ?>" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Correo Electronico</label>
                                <input name="Correo" type="mail" value="<?php echo $alm->correo; ?>" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Telefono Fijo</label>
                                <input name="telefono_fijo" type="number" value="<?php echo $alm->telefono_fijo; ?>" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Telefono Movil</label>
                                <input name="celular" type="number" value="<?php echo $alm->celular; ?>" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label>ASPIRANTE A: </label>
                        <select name="cargo_id" id="cargo_id" class="form-control show-tick" required>
                            <?php foreach ($cargos as  $value) : ?>
                                <option value="<?= $value->id ?>"  ><?php echo $value->cargo; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>CAMBIAR ESTADO DEL ASPIRANTE</label>
                        <select name='estado' id="estado" class="form-control show-tick" required>
                            <option value="0">-- Seleccionar --</option>
                            <option value="1" <?= $alm->rol_id == 1 ? 'selected' : ''; ?>>ASPIRANTE</option>
                            <option value="2" <?= $alm->rol_id == 2 ? 'selected' : ''; ?>>SELECCIONADO</option>
                            <option value="4" <?= $alm->rol_id == 4 ? 'selected' : ''; ?>>NO SELECCIONADO</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input name="estrato" value="<?php echo $alm->estrato==""?'3':$alm->estrato; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="estado_civil" value="<?php echo $alm->estado_civil; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="nacionalidad" value="<?php echo $alm->nacionalidad; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="victima_conflicto" value="<?php echo $alm->victima_conflicto; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="usuario_tipo" value="<?php echo $alm->usuario_tipo; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="rh" value="<?php echo $alm->rh; ?>" type="hidden" class="form-control" placeholder="" />
                            <input name="nivel_libreta" value="<?php echo $alm->nivel_libreta; ?>" type="hidden" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="" name="botonenviar" id="botonenviar" class="btn btn-guardar btn-block" value="Registrar" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#botonenviar').click(function() {
            var cedula = $('input[name=cedula]').val();
            var expedicion = $('input[name=expedicion]').val();
            var Nombre = $('input[name=Nombre]').val();
            var Apellido = $('input[name=Apellido]').val();
            var FechaNacimiento = $('input[name=FechaNacimiento]').val();
            var direccion = $('input[name=direccion]').val();
            var Barrio = $('input[name=Barrio]').val();
            var Correo = $('input[name=Correo]').val();
            var telefono_fijo = $('input[name=telefono_fijo]').val();
            var celular = $('input[name=celular]').val();
            var cargo_id = $('#cargo_id').val();
            var estado = $('select[name=estado]').val();
            var estrato = $('select[name=estrato]').val();

            // Validación de campos
            // if (cedula == '' || expedicion == '' || Nombre == '' || Apellido == '' || FechaNacimiento == '' || direccion == '' ||
            //     Barrio == '' || Correo == '' || telefono_fijo == '' || celular == '' || cargo_id == '' ||  estado == '') {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Por favor, complete todos los campos.',
            //         timer: 1500,
            //         showConfirmButton: false,
            //     }, )

            //     return false;
            // }
            // Validación personalizada
            if (!validarFecha(FechaNacimiento)) {
                alert('La fecha ingresada es inválida.');
                return false;
            }
            // Envío de solicitud
            $.ajax({
                type: 'POST',
                url: '?c=contratacion&a=EstadoAsp',
                data: $('#form-aspirante').serialize(),
                success: function(response) {
                    Swal.fire({
                            icon: 'success',
                            title: 'El registro se realizo con éxito',
                            timer: 1500
                        }, ),
                       setTimeout(function() {
                        //   window.location.reload();
                       }, 1500)
                },
                error: function() {
                    Swal.fire({
                            icon: 'error',
                            title: 'El registro no se realizo, trata de nuevo',
                            timer: 1500
                        }, ),
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500)
                }
            });
        });

        // Función de validación personalizada
        function validarFecha(FechaNacimiento) {
            var regex = /^\d{4}-\d{2}-\d{2}$/;
            if (!regex.test(FechaNacimiento)) {
                return false;
            }
            var partes = FechaNacimiento.split('-');
            var anio = parseInt(partes[0]);
            var mes = parseInt(partes[1]);
            var dia = parseInt(partes[2]);
            if (anio < 1900 || anio > 2100 || mes < 1 || mes > 12 || dia < 1 || dia > 31) {
                return false;
            }
            return true;
        }
    });
</script>