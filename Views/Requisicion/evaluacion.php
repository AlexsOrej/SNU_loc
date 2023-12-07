<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- <div class="card">-->
        <div class="body">
            <form id="frm-Usuario" action="?c=Requisicions&a=Eval_guardar" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>" />
                <div class="row clearfix">
                    <div class="col-sm-12 text-center">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label style="color:red">Aprobado Por:</label>
                                    <input name="aprobado_por" id="aprobado_por" value="<?php echo $alm->aprobado_por; ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Eval Competencia</label>
                                    <input name="fecha_eval_comp" id="fecha_eval_comp" value="<?php echo $alm->fecha_eval_comp; ?>" type="date" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Resultado</label>
                                    <input name="resultado" id="resultado" value="<?php echo $alm->resultado; ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Tiempo Vacante</label>
                                    <input name="tiempo_dur_vac" id="tiempo_dur_vac" value="<?php echo $alm->tiempo_dur_vac; ?>" type="text" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary btn-block" value="REGISTRAR" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<? //print_r($alm)
?>
<!-- #END# Textarea -->