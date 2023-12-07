<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>INFORMACIÓN DE PRESTAMO</h2>                
            </div>
            <?php // print_r($prestamos); 
            ?>
            <div class="body">
                <form action="" id="formPrestamo" name="formPrestamo" method="POST" role="form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Consecutivo</label>
                                        <input type="text" class="form-control" id="cons" name="cons" placeholder="" Value='<?= $prestamos->num_prestamo?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Fecha Entrega</label>
                                        <input type="text" class="form-control" id="fechaEntrega" name="fechaEntrega" Value='<?= $prestamos->fecha_entrega?>' placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres"  Value='<?= $prestamos->nombre_bene?>'placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" Value='<?= $prestamos->apellido_bene?>' placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Identificación</label>
                                        <input type="number" class="form-control" id="identificacion" name="identificacion" Value='<?= $prestamos->identificacion_bene?>' placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Contacto</label>
                                        <input type="text" class="form-control" id="contacto" name="contacto" Value='<?= $prestamos->num_contacto?>' placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Correo Electronico</label>
                                        <input type="text" class="form-control" id="correo" Value='<?= $prestamos->correo?>' name="correo"  placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Tipo Beneficiario</label>
                                        <select name="beneficiario" id="beneficiario" class="form-control">
                                            <option value=""><?= ucwords($prestamos->tipo_bene) ?></option>                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                <div class="form-line">
                                    <label for="">Tramite</label>
                                    <select name="tramite" id="tramite" class="form-control" required="required">
                                    <option value=""><?= ucwords($prestamos->tipo) ?></option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Barrio Residencia</label>
                                        <input type="text" class="form-control" id="barrio" name="barrio" Value='<?= $prestamos->barrio?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Dirección Residencia</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" Value='<?= $prestamos->ubicacion_bene?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Funcionario</label>
                                        <input type="text" class="form-control" id="funcionario" name="funcionario" Value='<?= $prestamos->funcionario?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Observaciones</label>
                                        <textarea type="text" class="form-control" id="observaciones" name="observaciones" Value=''><?= $prestamos->observaciones?></textarea>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>