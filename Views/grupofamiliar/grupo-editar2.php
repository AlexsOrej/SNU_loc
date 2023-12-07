<ol class="breadcrumb">
  <li><a href="?c=Grupofamiliar">Grupo Familiar</a></li>
  <li class="active"><?php echo $alm->id != null ? $alm->nombre : 'Nuevo Integrante'; ?></li>
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
                            <?php //echo $_SESSION['cc'];?>
                           <form id="frm-Usuario" action="?c=Grupofamiliar&a=Guardar2" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $alm->id; ?>"/>
                           
                          
                            <div class="row clearfix">
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre</label>
                                            <input  name="nombre"  value="<?php echo $alm->nombre; ?>" type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Apellidos</label>
                                            <input  name="apellidos" value="<?php echo $alm->apellidos; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        
                                            <label>Parentesco</label>
                                            <select name="parentesco" class="form-control">
                                                <option <?php echo $alm->parentesco == 'Madre' ? 'selected' : ''; ?> value="Madre">Madre</option>
                                                <option <?php echo $alm->parentesco == 'Padre' ? 'selected' : ''; ?> value="Padre">Padre</option>
                                                <option <?php echo $alm->parentesco == 'Hermano(a)' ? 'selected' : ''; ?> value="Hermano(a)">Hermano(a)</option>
                                                <option <?php echo $alm->parentesco == 'Hijo(a)' ? 'selected' : ''; ?> value="Hijo(a)">Hijo(a)</option>
                                                <option <?php echo $alm->parentesco == 'Conyuge' ? 'selected' : ''; ?> value="Conyuge">Conyuge</option> 
                                                <option <?php echo $alm->parentesco == 'Padrastro' ? 'selected' : ''; ?> value="Padrastro">Padrastro</option>
                                                <option <?php echo $alm->parentesco == 'Hijastro(a)' ? 'selected' : ''; ?> value="Hijastro(a)">Hijastro(a)</option>
                                                <option <?php echo $alm->parentesco == 'Madrastra' ? 'selected' : ''; ?> value="Madrastra">Madrastra</option> 
                                                <option <?php echo $alm->parentesco == 'Tia(o)' ? 'selected' : ''; ?> value="Tia(o)">Tia(o)</option>
                                                <option <?php echo $alm->parentesco == 'Abuelo(a)' ? 'selected' : ''; ?> value="Abuelo(a)">Abuelo(a)</option>
                                                <option <?php echo $alm->parentesco == 'Prima(o)' ? 'selected' : ''; ?> value="Prima(o)">Prima(o)</option>
                                            </select>
                                            
                                           
                                       
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha nacimiento</label>
                                            <input  name="fecha_nacimiento" value="<?php echo $alm->fecha_nacimiento; ?>"  type="date" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Contacto</label>
                                            <input  name="contacto" value="<?php echo $alm->contacto; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <input  name="usuario_id" value="<?php echo $_REQUEST['usuario_id']  ?>"  type="hidden" class="form-control" placeholder="" />
                                   
                                 
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