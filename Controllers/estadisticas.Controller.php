<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Estadistica.php';

//nombre la clase
class EstadisticasController
{
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Estadistica();
    }
    /*crear los metodos necesarios*/

    public function Index()
    {
        $eventos= $this->model->Index();
        $ip=$this->model->getUserIpAddress();
        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Estadisticas/Index.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
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