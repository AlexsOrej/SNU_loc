<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Roles.php';

class RolesController
{    
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Roles();
        
    }


    public function Index()
    {
        $roles=$this->model->Index();
        
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Roles/index.php';
        require_once 'Views/Layout/foot.php';
        
    }

    public function AddEdit()
    {
        $rols=  new Roles();
        if(isset($_REQUEST['id'])){
        $rols=$this->model->getRol($_REQUEST['id']);  
        //print_r($rols);
         }
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Roles/crud.php';
        require_once 'Views/Layout/foot.php';
    }

    
    public function View()
    {
        require_once 'Views/Layout/default.php';
        require_once 'Views/Solicitudes/View.php';
        require_once 'Views/Layout/foot.php';
    }

public function Registrar(){
  
    $_REQUEST['id'] > 0 ?
     $this->model->Actualizar($_REQUEST['rol'],$_REQUEST['id'])
    :$this->model->Registrar($_REQUEST['rol']);

    echo "
        <script>
         window.location.href ='?c=permisos&a=index';
         </script>
    ";

}


}
