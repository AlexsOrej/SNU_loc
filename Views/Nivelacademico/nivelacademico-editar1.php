<ol class="breadcrumb">
  <li><a href="?c=Grupofamiliar">Nivel Academico</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->nivel : 'Nuevo Formación'; ?></li>
</ol>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Registrar integrante</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           <form id="frm-Usuario" action="?c=Nivelacademico&a=Guardar1" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $alm->id; ?>"/>
                            <div class="row clearfix">
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nivel Academico</label>
                                            <select name="nivel" class="form-control">
                                                <?php if(!empty($alm->nivel)):?>
                                                <option value="<?php echo $alm->nivel; ?>"> <?php echo $alm->nivel; ?></option>
                                                <?php else: ?>
                                                <option value="">Seleccionar</option>
                                                <?php endif; ?>
                                                
                                                <option value="Basica primaria">Básica primaria</option>
                                                 <option value="Secundaria">Secundaria</option>
                                                  <option value="Media">Media</option>
                                                   <option value="Tecnica">Tecnica</option>
                                                   <option value="Tecnologica">Tecnologica</option>
                                                   <option value="Profesional">Profesional</option>
                                            </select>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Estado</label>
                                            <select name="estudio" class="form-control">
                                                <?php if(!empty($alm->estudio)):?>
                                                <option value="<?php echo $alm->estudio; ?>"> <?php echo $alm->estudio; ?></option>
                                                <?php else: ?>
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
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Institución Educativa</label>
                                            <input  name="curso_vigilancia" value="<?php echo $alm->curso_vigilancia; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Lugar Realización</label>
                                            <input  name="lugar" value="<?php echo $alm->lugar; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha realización</label>
                                            <input  name="fecha" value="<?php echo $alm->fecha; ?>"  type="date" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <input  name="usuario_id" value="<?php echo $alm->usuario_id != null ? $alm->nombre : $_GET['usuario_id']; ?>"  type="hidden" class="form-control" placeholder="" />
                                   
                                 
                                <div class="col-md-12">
						            <input type="submit"  class="btn btn-primary btn-block" value="Registrar" />
								    </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Textarea -->

<script>
    $(document).ready(function(){
        $("#frm-Usuario").submit(function(){
            return $(this).validate();
        });
    })
</script>