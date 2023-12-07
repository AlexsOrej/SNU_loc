<ol class="breadcrumb">
  <li><a href="?c=Ssocial">AFILIACIONES</a></li>
 
</ol>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>REGISTRAR</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                   <!-- <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>-->
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           <form id="frm-Usuario" action="?c=Ssocial&a=Guardar" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $alm->id; ?>"/>
                          
                          <?php  if(isset($_REQUEST['u_id'])){
                                   $id=$_REQUEST['u_id'];
                                 }else{
                                   $id=$alm->usuario_id;
                                 };  
                            ?>
                          
                          
                          <input type="hidden" name="usuario_id" value="<?php echo $id; ?>"/>
                          
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Eps</label>
                                            
                                            <?php  $esps=$this->model->Eps('EPS'); ?>
                                            
                                            <select name='eps' class='form-control' required>
                                                <?php if(isset($alm->eps)):?> 
                                                <option value="<?php echo $alm->eps; ?>"><?php echo $alm->eps; ?>  </option>
                                                <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php else:?>
                                                <option value="">Seleccionar</option>
                                                 <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Arl</label>
                                            <?php  $esps=$this->model->Eps('ARL'); ?>
                                            
                                            <select name='arl' class='form-control' required>
                                                <?php if(isset($alm->arl)):?> 
                                                <option value="<?php echo $alm->arl; ?>"><?php echo $alm->arl; ?>  </option>
                                                <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php else:?>
                                                <option value="">Seleccionar</option>
                                                 <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                            
                                            
                                          
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fondo Pensiones</label>
                                            <?php  $esps=$this->model->Eps('AFP'); ?>
                                            
                                            <select name='fondo' class='form-control' required>
                                                <?php if(isset($alm->fondo)):?> 
                                                <option value="<?php echo $alm->fondo; ?>"><?php echo $alm->fondo; ?>  </option>
                                                <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php else:?>
                                                <option value="">Seleccionar</option>
                                                 <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Caja Compesación</label>
                                            <?php  $esps=$this->model->Eps('CCF'); ?>
                                            
                                            <select name='caja' class='form-control' required>
                                                <?php if(isset($alm->caja)):?> 
                                                <option value="<?php echo $alm->caja; ?>"><?php echo $alm->caja; ?>  </option>
                                                <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php else:?>
                                                <option value="">Seleccionar</option>
                                                 <?php foreach($esps as $esp):?>
                                                 <option value="<?php echo $esp->nombre; ?>"><?php echo $esp->nombre; ?></option>
                                                 <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                           
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Fecha de Afiliación</label>
                                             <input type="date" name="afiliacion_fecha" value="<?php echo $alm->afiliacion_fecha; ?>" class="form-control"/>
                                          </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-12">
						            <input type="submit"  class="btn btn-guardar btn-block" value="Registrar" />
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