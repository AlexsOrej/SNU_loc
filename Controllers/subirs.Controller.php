<?php
require_once 'Models/database.php';
require_once 'Models/Subir.php';

class SubirsController
{
    private $rol;
    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Subir();
    }

    public function Index()
    {
        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Subir/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        $this->model->Subir();
        
    }
    public function UploadFoto()
    {
        $this->model->UploadFoto();
        
    }
}
