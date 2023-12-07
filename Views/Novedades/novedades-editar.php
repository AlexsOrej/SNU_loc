<?php  

 /*$this->model->Ver($_REQUEST['id']);*/
 //print_r($this->model->Usuariocargo($alm->usuario_id));
?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                           <form id="frm-Usuario" action="?c=Novedades&a=editar" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" id="id" value="<?php echo $alm->id; ?>"/>
                          <div class="row clearfix">
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Tipo de Novedad</label>
                                            <select name="tipo_id"  id="tipo_id" class="form-control">
                                              <?php  $tipoN=$this->model->TipoNovedad(); ?>   
                                              <?php foreach($tipoN as $tipoNs): ?>
                                               <option <?php echo $tipoNs->id == $alm->tipo_id ? 'selected' : ''; ?> value="<?php echo $tipoNs->id  ?>"><?php echo  $tipoNs->novedad ?></option>    
                                              <?php endforeach; ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Cargo</label>
                                            <select  name="cargo_id"  id="cargo_id" class="form-control">
                                              <?php  $cargo=$this->model->Cargos(); ?>   
                                              <?php foreach($cargo as $cargos): ?>
                                               <option <?php echo $cargos->id == $alm->cargo_id ? 'selected' : ''; ?> value="<?php echo $cargos->id  ?>"><?php echo $cargos->nombre ?></option>    
                                              <?php endforeach; ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Obra</label>
                                            <select  name="obra_id" id="obra_id" class="form-control">
                                              <?php  $obra=$this->model->Obras(); ?>   
                                              <?php foreach($obra as $obras): ?>
                                               <option <?php echo $obras->id == $alm->obra_id ? 'selected' : ''; ?> value="<?php echo $obras->id  ?>"><?php echo $obras->nombre ?></option>    
                                              <?php endforeach; ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Descripción</label>
                                            <input  name="descripcion" id="descripcion" value="<?php echo $alm->descripcion; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Otro Si</label>
                                            <input  name="otrosi" id="otrosi" value="<?php echo $alm->otro_si; ?>"  type="text" class="form-control" placeholder="" />
                                        </div>
                                    </div>
                                </div>                                 
                                <div class="col-md-12">
						            <button id="upSubmit"  type="button" class="btn btn-primary btn-block" onclick="cargar()">Actualizar</button>
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


    <script type="text/javascript">
    
                $(document).ready(function(){
                $(document).on("click","#upSubmit", function(){
                    
                var id = jQuery('#id').val();    
                var tipo_id = jQuery('#tipo_id').val();
                var cargo_id = jQuery('#cargo_id').val();
                var descripcion = jQuery('#descripcion').val();
                var obra_id = jQuery('#obra_id').val();
                var otrosi = jQuery('#otrosi').val();
                
                
                $('#Msg').html('<div class="loading">Procesando, por favor espere...</div>');
                
                $.ajax({
                url:"?c=Novedades&a=editar",
                type:"POST",
                cache:false,
                data:{
                id:id,
                tipo_id:tipo_id,
                cargo_id:cargo_id,
                obra_id:obra_id,
                descripcion:descripcion,
                otrosi:otrosi
                    
                },
                success:function(data){
                if (data != 1) {
                        jQuery('#cliente_id').val('');
                        jQuery('#tipo_id ').val('');
                        jQuery('#cargo_id').val('');
                        jQuery('#descripcion').val('');
                        jQuery('#otrosi').val('');
                        jQuery('#obra_id').val('');
                        
                        $("#Msg").html("<div class='alert alert-success' role='alert'>Actualizado.</div> ");
                        location.reload();
               }else{
                        jQuery('#cliente_id').val('');
                        jQuery('#tipo_id ').val('');
                        jQuery('#cargo_id').val('');
                        jQuery('#descripcion').val('');
                        jQuery('#otrosi').val('');
                        jQuery('#obra_id').val('');
                    $("#Msg").html("<div class='alert alert-danger' role='alert'>Error.</div> ");
                      location.reload();
                    }
                }
                });
                });
                });

function cargar(){
   // opener.location.reload();
    window.close();
}
</script>