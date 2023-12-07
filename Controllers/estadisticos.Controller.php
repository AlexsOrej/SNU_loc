<?php
require_once 'Models/database.php';
require_once 'Models/Indicador.php';
require_once 'Models/Estadistica.php';


class EstadisticosController
{
    private $model;
    private $estadistica;
    public function __CONSTRUCT()
    {
        $this->model = new Indicador();
        $this->estadistica = new Estadistica();
    }

    public function Index()
    {   

        $total=$this->estadistica->TotalIndicadores();
        $cumplidos=$this->estadistica->IndCumplidos();
        $indxprocesos=$this->estadistica->IndxProcesos();
        $metaxprocesos=$this->estadistica->MetaxProcesos();
        $AccionxProcesos=$this->estadistica->AccionxProcesos();
        
        $xprocesos=array();
        foreach ($indxprocesos as $pa) {
            $xprocesos[] = array(
                'name' => $pa->Iniciales,
                'value' => $pa->CantidadIndicadores
            );      
        }
        $axprocesos=array();
        foreach ($AccionxProcesos as $pa) {
            $axprocesos[] = array(
                'name' => $pa->Iniciales,
                'value' => $pa->cantidad_indicadores_sin_acciones
            );      
        }

       require_once 'Views/Layout/estadistico.php';
       require_once 'Views/Estadisticas/indice.php';
       require_once 'Views/Layout/foot.php';
    }
}
