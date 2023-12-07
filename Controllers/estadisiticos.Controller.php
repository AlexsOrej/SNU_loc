<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Contrato.php';
require_once 'Models/Persona.php';
require_once 'Models/Cargo.php';
require_once 'Models/Postulacion.php';

class ContratacionController
{
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Contrato();
    }

    public function Index()
    {
        require_once 'Views/Layout/estadistico.php';
        require_once 'Views/Estadisticas/Index.php';
        require_once 'Views/Layout/foot.php';
    }
}