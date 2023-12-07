<?php
// importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Evento.php';

//nombre la clase
class ClasificacionesController
{ 
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Evento();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {   
        $eventos=$this->model->CargoIndex();
        require_once 'Views/Layout/eventos.php';
        require_once 'Views/Evento_categorias/index.php';
        require_once 'Views/Layout/filtro.php';
        require_once 'Views/Layout/foot.php';
    }
}