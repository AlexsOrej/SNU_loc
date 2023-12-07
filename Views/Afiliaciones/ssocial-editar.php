<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">

                <div class="col-sm-6">
                <h2>REGISTRAR</h2>
                </div>
                <div class="col-sm-6">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; Cerrar </button>
                </div>
                <br>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                    </li>
                </ul>
            </div>
            <div class="body">
                <form id="frmAfiliacion" name="frmAfiliacion" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />                    
                    <input type="hidden" name="usuario_id" value="<?php echo isset($_REQUEST['usuario_id'])?$_REQUEST['usuario_id']:$_REQUEST['id'] ?>" />
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Eps</label>
                                    <select name='eps' class='form-control' required>
                                        <?php if (isset($alm->eps)) : ?>
                                            <option value="<?php echo $alm->eps; ?>"><?php echo $alm->eps; ?> </option>
                                            <?php foreach ($epss as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($epss as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Arl</label>
                                    <select name='arl' class='form-control' required>
                                        <?php if (isset($alm->arl)) : ?>
                                            <option value="<?php echo $alm->arl; ?>"><?php echo $alm->arl; ?> </option>
                                            <?php foreach ($arls as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($arls as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fondo Pensiones</label>
                                    <select name='fondo' class='form-control' required>
                                        <?php if (isset($alm->fondo)) : ?>
                                            <option value="<?php echo $alm->fondo; ?>"><?php echo $alm->fondo; ?> </option>
                                            <?php foreach ($afps as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($afps as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Caja Compesación</label>
                                    <?php $esp = $this->model->Eps('CCF'); ?>
                                    <select name='caja' class='form-control' required>
                                        <?php if (isset($alm->caja)) : ?>
                                            <option value="<?php echo $alm->caja; ?>"><?php echo $alm->caja; ?> </option>
                                            <?php foreach ($cajas as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($cajas as $esp) : ?>
                                                <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha de Afiliación</label>
                                    <input type="date" name="afiliacion_fecha" value="<?php echo $alm->afiliacion_fecha; ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
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
            var eps  = $('select[name=eps]').val();
            var arl = $('select[name=arl]').val();
            var fondo = $('input[name=fondo]').val();
            var caja = $('input[name=caja]').val();
            var afiliacion_fecha = $('input[name=afiliacion_fecha]').val();        

            // Validación de campos
            if (eps == '' || arl == '' || fondo == '' || caja == '' || afiliacion_fecha == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, complete todos los campos.',
                    timer: 1500,
                    showConfirmButton: false,
                }, )
                return false;
            }

            // Validación personalizada
            if (!validarFecha(afiliacion_fecha)) {
                alert('La fecha ingresada es inválida.');
                return false;
            }
            // Envío de solicitud
            $.ajax({
                type: 'POST',
                url: '?c=afiliaciones&a=add',
                data: $('#frmAfiliacion').serialize(),
                success: function(response) {
                    Swal.fire({
                            icon: 'success',
                            title: 'El registro se realizo',
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
        function validarFecha(afiliacion_fecha) {
            var regex = /^\d{4}-\d{2}-\d{2}$/;
            if (!regex.test(afiliacion_fecha)) {
                return false;
            }
            var partes = afiliacion_fecha.split('-');
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