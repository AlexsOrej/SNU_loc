<?php
 require_once 'Models/Autoload.php';

class NormasController
{

    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Auditoria();
        
    }


    public function Index()
    {       
        
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Auditorias/index.php';
        require_once 'Views/Layout/foot.php';
    }
}
