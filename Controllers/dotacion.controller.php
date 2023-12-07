<?php
require_once '../clases/Dotacion.php';

class DotacionController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Dotacion();
    }
    
    public function Index(){
        
        require_once '../vista/header.php';
        require_once '../vista/dotacion/dotacion.php';
        require_once '../vista/footer.php';
        
    }
    
    public function Crud(){
        $alm = new Dotacion();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once '../vista/header.php';
        require_once '../vista/dotacion/dotacion-editar.php';
        require_once '../vista/footer.php';
    }
    
    public function Guardar(){
        $alm = new Dotacion();
        
         $alm->id = $_REQUEST['id'];
              $alm->talla_camisa = $_REQUEST['talla_camisa'];
               $alm->talla_pantalon = $_REQUEST['talla_pantalon'];
              $alm->talla_zapato = $_REQUEST['talla_zapato'];
              $alm->usuario_id = $_REQUEST['usuario_id'];

        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}