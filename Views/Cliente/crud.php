<?php $mail = explode('~', $clientes->correos); ?>
<!-- Basic Validation -->
        <form action="?c=clientes&a=Registrar" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line campos">
                            <label>Nombre Empresa</label>
                            <input type="text" id="nombre" name="nombre" class="form-control is-valid" placeholder="" required value="<?php echo $clientes->nombre ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nit</label>
                            <input type="number" id="telefono" name="telefono" minlength="10" class="form-control" placeholder="" required value="<?php echo $clientes->telefono ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" placeholder="" required value="<?php echo $clientes->direccion ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nombre del representante</label>
                            <input type="text" id="rector" name="rector" required value="<?php echo $clientes->rector ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Telefono del representante</label>
                            <input type="tel" id="rect_telefono" name="rect_telefono" minlength="10" required value="<?php echo $clientes->rect_telefono ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Correo Director</label>
                            <input type="email" id="correos0" name="correos0" required value="<?php echo @$mail[0] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Correo institucional</label>
                            <input type="email" id="correos1" name="correos1" required value="<?php echo @$mail[1] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">                    
                    <div class="form-group">
                        <div class="form-line">
                            <label>Correo Secretaria</label>
                            <input type="email" id="correos2" name="correos2"  required value="<?php echo @$mail[2] ?>" class="form-control">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="form-line">
                            <label>Salario Minimo Vigente</label>
                            <input type="number" id="salario" name="salario" required value="<?php echo $clientes->salario ?>" class="form-control">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="form-line">
                            <label>Logo</label>
                            <input type="file" id="filename" name="filename" class="form-control" placeholder="" value="">
                            <input type="hidden" id="dir" name="dir" class="form-control" placeholder="" value="">
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id" name="id"  value="<?php echo $clientes->id ?>" class="form-control">
            </div>
            <button class="btn btn-success btn-guardar" id="guardar" type="submit">GUARDAR</button>
    </div>
    </form>

<!-- #END# Basic Validation -->