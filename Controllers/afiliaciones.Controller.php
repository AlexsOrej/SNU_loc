<?php
// importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Afiliacion.php';

//nombre la clase
class AfiliacionesController
{
    public function __CONSTRUCT()
    {
        $this->model = new Afiliacion();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {   
        $afiliaciones=$this->model->Index($_REQUEST['id']);
        require_once 'Views/Afiliaciones/index.php';
     
    }
    public function Crud()
    {   
        $alm= new Afiliacion();
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
           
        }        
        $epss=$this->model->eps();
        $afps=$this->model->Afp();
        $arls=$this->model->Arl();
        $cajas=$this->model->Caja();
        $parars=$this->model->Para();
        require_once 'Views/Afiliaciones/ssocial-editar.php';
      
    }
    public function Edit()    {        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
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
       $alm->id > 0 
           ? $this->model->Actualizar($alm)
           : $this->model->Registrar($alm);      
       
   }
   public function Eliminar(){
    $this->model->Eliminar($_REQUEST['idf']);
  $id=$_REQUEST['id'];
                echo "<script>
		          alert('La eliminacion de la información se realizo correctamente');
		                window.location = '?c=seleccion&a=gestion&id=".$id."';
		        </script>";
}

}