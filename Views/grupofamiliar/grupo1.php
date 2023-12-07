

<div class="well well-sm text-right">    
    <a class="btn btn-success <?php echo  $disable ?>" href="?c=Grupofamiliar&a=Crud&usuario_id=<?php echo $id ?>"  >Registrar Información Pariente</a>
 
</div>
<div class="row">
    
    <div class="col-md-12">
        <div class="col-md-4"><div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Usuario</h3>
  </div>
  <div class="panel-body">
              <?php 
                $path="../vista/includes/gestionUsuario.php";
                include "$path";
                ?>
  </div>
</div></div>
        <div class="col-md-8"><div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Grupo Familiar</h3>
  </div>
  <div class="panel-body">
     <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Parentesco</th>
            <th>Fecha Nacimiento</th>
            <th>Número de Contacto</th>
            
            <th></th>
            <th></th>
        </tr>
                </thead>
                    <tfoot>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Parentesco</th>
            <th>Fecha Nacimiento</th>
            <th>Número de Contacto</th>
            <th></th>
            <th></th>
        </tr>
                                    </tfoot>
                                    <tbody>
    <?php
    
    
   $flia= $this->model->Obtener2($id);
    foreach($flia as $r):?>
        
           
        <tr>
            <td><?php echo $r->nombre; ?></td>
            <td><?php echo $r->apellidos; ?></td>
            <td><?php echo $r->parentesco; ?></td>
            <td><?php echo $r->fecha_nacimiento; ?></td>
            <td><?php echo $r->contacto; ?></td>
            <td>
               <a href="?c=Grupofamiliar&a=Crud&id=<?php echo $r->id; ?>" class="<?php echo  $disable ?>">Editar</a>
            </td>
            <td>
                <a  class="<?php echo  $disable ?>" onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=Grupofamiliar&a=Eliminar&idf=<?php echo $r->id; ?>&id=<?php echo $id; ?>">Eliminar</a>
            </td>
        </tr>
    <?php  endforeach; ?>
                                       
                                    </tbody>
                                </table>
                            </div>
  </div>
</div></div>
    </div>
    
    
</div>









