<form action="?c=roles&a=registrar" method="POST" >
    <!-- Input -->
    <!--   <div class="row clearfix">-->
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                ROL
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line text-center">
                                <label>ROL</label>
                                <?php $fecha = date('Y-m-d'); ?>
                                <input type="text" name="rol" class='form-control' value="<?=$rols->rol?>">
                                <input type="hidden" name="id" class='form-control' value="<?=$rols->id?>">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block"> Registrar</button>
            </div>
        </div>
    </div>
    </div>
</form>
    <!-- #END# Input -->