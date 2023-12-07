<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div style="margin-bottom:10px;" class="header p-5">
                <div class="col-sm-6 mb-3">
                    <h2>Registrar</h2>
                    
                </div>
                <div class="col-sm-6 mb-3 aling-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <br>
            </div>
            <div class="body">
                <form id="frm-nivel" name="frm-nivel" action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nivel Academico</label>
                                    <select name="nivel" class="form-control" required>
                                        <?php if (!empty($alm->nivel)) : ?>
                                            <option value="<?php echo $alm->nivel; ?>"> <?php echo $alm->nivel; ?></option>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                        <?php endif; ?>
                                        <option value="Basica primaria">Básica primaria</option>
                                        <option value="Secundaria">Secundaria</option>
                                        <option value="Media">Media</option>
                                        <option value="Curso">Curso</option>
                                        <option value="Seminarios">Seminarios</option>
                                        <option value="Tecnica">Tecnica</option>
                                        <option value="Tecnologica">Tecnologica</option>
                                        <option value="Profesional">Profesional</option>
                                        <option value="Especialización">Especialización</option>
                                        <option value="Diplomados">Diplomados</option>
                                        <option value="Maestria">Maestria</option>
                                        <option value="Doctorado">Doctorado</option>
                                        <option value="Posdoctorado">Posdoctorado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Estado</label>
                                    <select name="estudio" class="form-control" required>
                                        <?php if (!empty($alm->estudio)) : ?>
                                            <option value="<?php echo $alm->estudio; ?>"> <?php echo $alm->estudio; ?>
                                            </option>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                        <?php endif; ?>
                                        <option value="Terminado">Terminado</option>
                                        <option value="Aplazado">Aplazado</option>
                                        <option value="Suspendido">Suspendido</option>
                                        <option value="Activo">Activo</option>
                                    </select>
                                    <!-- <input  name="estudio" value="<?php echo $alm->estudio; ?>"  type="text" class="form-control" placeholder="" />-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Institución Educativa</label>
                                    <input name="curso_vigilancia" value="<?php echo $alm->curso_vigilancia; ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Lugar Realización</label>
                                    <input name="lugar" value="<?php echo $alm->lugar; ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha realización</label>
                                    <input name="fecha" value="<?php echo $alm->fecha; ?>" type="date" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <input name="usuario_id" value="<?php echo $alm->usuario_id != null ? $alm->usuario_id : $_REQUEST['id']; ?>" type="hidden" class="form-control" placeholder="" />
                        <div class="col-md-12">
                            <input type="button" id="botonenviar" class="btn btn-guardar btn-block" value="Registrar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Textarea -->
<script>
    $(document).ready(function() {
        $('#botonenviar').click(function() {
            var nivel = $('select[name=nivel]').val();
            var estudio = $('select[name=estudio]').val();
            var curso_vigilancia = $('input[name=curso_vigilancia]').val();
            var lugar = $('input[name=lugar]').val();
            var fecha = $('input[name=fecha]').val();
            var usuario_id = $('input[name=usuario_id]').val();

            // Validación de campos
            if (nivel == '' || estudio == '' || curso_vigilancia == '' || lugar == '' || fecha == '' || usuario_id == '') {
                Swal.fire({
                        icon: 'error',
                        title: 'Por favor, complete todos los campos.',
                        timer: 1500,
                        showConfirmButton:false,
                    }, )
                    
                return false;
            }

            // Validación personalizada
            if (!validarFecha(fecha)) {
                alert('La fecha ingresada es inválida.');
                return false;
            }

            // Envío de solicitud
            $.ajax({
                type: 'POST',
                url: '?c=Nivelacademico&a=Guardar',
                data: $('#frm-nivel').serialize(),
                success: function(response) {
                    Swal.fire({
                            icon: 'success',
                            title: 'El registro  se realizo, con éxito',
                            timer: 1500
                        }, ),
                        setTimeout(function() {
                            window.location.reload(1);
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
        function validarFecha(fecha) {
            var regex = /^\d{4}-\d{2}-\d{2}$/;
            if (!regex.test(fecha)) {
                return false;
            }
            var partes = fecha.split('-');
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