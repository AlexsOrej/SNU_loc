<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Tiponovedad.php';

class TiponovedadesController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Tiponovedad();
    }


    public function Index()
    {
        $tipoNovedades = $this->model->Index();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Tiponovedades/index.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Crud()

    {
        $tipo = new Tiponovedad();
        $tipo->id = $_REQUEST['id'];
        $tipo->evento = $_REQUEST['evento'];
        $tipo->tipo = $_REQUEST['tipo'];
        $tipo->id > 0 ? $this->model->Editar($tipo) : $this->model->Registrar($tipo);
    }
    public function Editar()

    {
        $tipo = $this->model->GetTipo($_REQUEST['id']);
        require_once 'Views/Tiponovedades/editar.php';
    }
}
