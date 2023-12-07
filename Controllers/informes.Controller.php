<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Informe.php';

//nombre la clase
class InformesController
{
    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Informe();
    }
    /*crear los metodos necesarios*/
    public function InformeDocumental()
    {
        require_once 'Views/Layout/default.php';
        require_once 'Views/Informes/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function InformePqrs()
    {
        require_once 'Views/Layout/pqrs.php';
        require_once 'Views/Informes/index_pqrs.php';
        require_once 'Views/Layout/foot.php';
    }

    public function InformeResultado()
    {
         // require_once 'Views/Layout/default.php';
         $desde = $_REQUEST['desde'];
         $hasta = $_REQUEST['hasta'];
         $solicitudes = $this->model->getSolictudesCambio($desde, $hasta);
         $promrespuesta = $this->model->getPromRespuesta($desde, $hasta);
         $sinsolicitud = $this->model->GetProcesoSinSolicitud($desde, $hasta);
         $solicitudesxproceso = $this->model->getSolictudesXproceso($desde, $hasta);        
         require_once 'Views/Informes/resultado.php';
         require_once 'Views/Layout/filtro.php';
    }




    public function InformeResultadoPqrs()
    {
        require_once 'Views/Layout/echart.php';
        $desde = $_REQUEST['desde'];
        $hasta = $_REQUEST['hasta'];
        $tiempoRespuesta =  $this->model->TiempoRespuestaPqrs($desde, $hasta);
        $datosJson = json_encode($tiempoRespuesta);
        
        $segmentacionpqrs =  $this->model->Segmentacionpqrs($desde, $hasta);
        $segmentacionJson = json_encode($segmentacionpqrs);

        $SegTipoPqrs =  $this->model->SegTipoPqrs($desde, $hasta);
        $segtipoJson = json_encode($SegTipoPqrs);
        require_once 'Views/Informes/resultadopqrs.php';
    }

    public function InformeResultado01()
    {
        // require_once 'Views/Layout/default.php';
        require_once 'Views/Informes/resultado01.php';
        // require_once 'Views/Layout/foot.php';
    }

    
}
