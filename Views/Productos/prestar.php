<!-- Basic Validation -->
<?php
$num01 = date('Y');
$num02 = date('d');
$num03 = $num01 . $num02 . $_REQUEST['id'];
$num= rand(5,$num03);
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>REGISTRO DE SALIDA</h2>                
            </div>            
            <div class="body">
                <form action="" id="formPrestamo" name="formPrestamo" method="POST" role="form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Consecutivo</label>
                                        <input type="text" class="form-control" id="cons" name="cons" placeholder="" Value='<?= $num ?>'>
                                        <input type="hidden" class="form-control" id="id" name="id" placeholder="" Value=''>
                                        <input type="hidden" class="form-control" id="producto_id" name="producto_id" placeholder="" Value='<?= $_REQUEST['id'] ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Fecha Entrega</label>
                                        <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Identificación</label>
                                        <input type="number" class="form-control" id="identificacion" name="identificacion" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Contacto</label>
                                        <input type="number" class="form-control" id="contacto" name="contacto" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Correo Electronico</label>
                                        <input type="text" class="form-control" id="correo" name="correo" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Tipo Beneficiario</label>
                                        <select name="beneficiario" id="beneficiario" class="form-control">
                                            <option value="">Seleccionar</option>
                                            <option value="docente"> Docente</option>
                                            <option value="alumno"> Alumno </option>
                                            <option value="acudiente">Acudiente </option>
                                            <option value="administrativo"> Administrativo </option>
                                            <option value="proveedor"> Proveedor </option>
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Tramite</label>
                                        <select name="tramite" id="tramite" class="form-control" required="required">                                           
                                            <option value="" >Seleccionar</option>                                            
                                            <option value="prestamo" >Prestamo</option>                                            
                                            <option value="prestamo" >Mantenimiento</option>                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Barrio Residencia</label>
                                        <input type="text" class="form-control" id="barrio" name="barrio" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Dirección Residencia</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Funcionario</label>
                                        <input type="text" class="form-control" id="funcionario" name="funcionario" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Observaciones</label>
                                        <textarea type="text" class="form-control" id="observaciones" name="observaciones" placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                                <input type="button" id="guardar" class="btn btn-guardar" value="Registrar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).on('click', '#guardar', function(e) {
               
                var formData = new FormData($("#formPrestamo")[0]);             

                $.ajax({
                    url: "?c=productos&a=addPrestamo",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BIEN HECHO!!',
                            timer: 1500
                        }, )
                        setTimeout(function() {
                            // window.location = '?c=productos&a=Ver&id='+idp;
                             window.location.reload();
                        }, 2000)

                    }
                });
            });
        </script>