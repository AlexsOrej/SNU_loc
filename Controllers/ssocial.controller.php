<?php
require_once 'Models/database.php';
require_once 'Models/Afiliacion.php';
class AfiliacionesController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Afiliacion();
    }
    
    public function Index(){
        
        require_once '../vista/header.php';
        require_once '../vista/ssocial/ssocial.php';
        require_once '../vista/footer.php';
        
    }
    
    public function Crud(){
        $alm = new Afiliacion();       
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
           
        }
        
        require_once '../vista/header.php';
        require_once '../vista/ssocial/ssocial-editar.php';
        require_once '../vista/footer.php';
       
    }

    
    public function Add(){
         $alm = new Afiliacion();
        
         $alm->id = $_REQUEST['id'];
         $alm->eps = $_REQUEST['eps'];
         $alm->usuario_id = $_REQUEST['usuario_id'];
         $alm->arl = $_REQUEST['arl'];
         $alm->fondo = $_REQUEST['fondo'];
         $alm->caja = $_REQUEST['caja'];
         $alm->afiliacion_fecha = $_REQUEST['afiliacion_fecha'];
         
         
//exit();
        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        
        echo "<script>
		          alert('El registro de la información se realizo correctamente');
		                window.location = '?c=Ssocial&a=Index&id=".$alm->usuario_id."';
		        </script>";
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['idf']);
      $id=$_REQUEST['id'];
        echo "<script>
		          alert('La eliminacion de la información se realizo correctamente');
		                window.location = '?c=seleccion&a=gestion&id=".$id."';
		        </script>";
    }
    
    
    public function listarServicio(){
        $serv = new Servicio();
        $serv =  $this->model->ListarServicios();
        
    }
    
}