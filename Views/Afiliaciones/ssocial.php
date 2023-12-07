<div class="well well-sm text-right">
    <a class="btn btn-primary <?php echo  $disable ?>" href="?c=Ssocial&a=Crud&u_id=<?php echo $_REQUEST['id']?>">Nueva Afiliación</a>
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
    <h3 class="panel-title">Afiliaciones<?php echo  $disable ?> </h3>
  </div>
  <div class="panel-body">
     <div class="table-responsive">
              <table class="table table-bordered table-condensed table-hover">
     <tr>
         <th>eps</th>
         <th>arl</th>
         <th>fondo</th>
         <th>caja</th>
         <th>afiliacion_fecha</th>
         <th></th>
        
    </tr>
<?php foreach($this->model->listar($_REQUEST['id']) AS $R): ?>    
    <tr>
         <td><?php echo $R->eps ?></td>
         <td><?php echo $R->arl ?></td>
         <td><?php echo $R->fondo ?></td>
         <td><?php echo $R->caja ?></td>
         <td><?php echo $R->afiliacion_fecha ?></td>
         <td><a  class="<?php echo  $disable ?>" href="?c=Ssocial&a=Crud&id=<?php echo $R->id?>">Editar</a>
         <a class="<?php echo  $disable ?>" onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=Ssocial&a=Eliminar&idf=<?php echo $R->id; ?>&id=<?php echo $_REQUEST['id']; ?>">Eliminar</a>
         </td>
    </tr>
<?php endforeach; ?> 
   
</table>                 
      </div>
  </div>
</div></div>
    </div>
    
    
</div>










































            

