<?php //print_r($mantenimientos);?>
<div class="responsive">
    <form action="?c=mantenimientos&a=EjecMant" method="post">        
        <div class="card col-md-4">
            <div class="card-header text-center">
                <h4>LISTA DE ELEMENTOS</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-check"></span></th>
                            <th>Código</th>
                            <th>Elementos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mantenimientos as $key=>$value) : ?>
                            <tr>
                                <td>
                                    <?php 
                                    echo $value->est_ejecucion=="ejecucion"?'<span class="glyphicon glyphicon-check ">':'<input name="productos['. $key.']->id" type="checkbox" class="Filled In" id="'.$value->produId.'" value="'. $value->produId.'" />
                                    '?>
                                      </td>
                                <td><?= $value->produId ?> </td>
                                <td><?= $value->produNombre ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="codigo" value="<?php echo $value->codigo;?>">
        <input type="hidden" name="est_ejecucion" value="ejecucion">
        <input type="hidden" name="modified" value="<?php echo date('Y-m-d');?>">
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">INFORMACIÓN DE MANTENIMIENTO</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-4 col-sm-4 col-md-6 col-lg-12">
                        <p class="text-center">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Descripción del mantenimiento: <?= $value->fecha ?></label>
                                <input type="" class="form-control" name="" value="<?= $value->descripcion ?>" readonly>
                            </div>
                        </div>
                        </p>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Detalles</label>
                                <textarea type="" class="form-control" name="detalles" cols="4" rows="4" value="" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Recomendación</label>
                                <textarea type="" class="form-control" name="recomendacion" cols="4" rows="4" value="" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                        <input type="submit" value="Registrar" id="guardar" class="btn btn-default btn-block">
                    </div>
                </div>
            </div>
    </form>
</div>
</div>