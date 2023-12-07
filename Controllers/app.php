<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/NomClase.php';

//nombre la clase
class ServiciosController
{
    public function __CONSTRUCT()
    {
        $this->model = new Producto();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Add()
    {
        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Edit()
    {
        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
    }

}