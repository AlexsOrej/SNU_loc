<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Riesgos.php';
require_once 'Models/Impactos.php';
require_once 'Models/Probabilidad.php';
require_once 'Models/Clasificacionriesgos.php';
require_once 'Models/Proceso.php';
require_once 'Models/Nivelriesgos.php';
require_once 'Models/Controles.php';







class RiesgosController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new Riesgos();
        $this->probabilidad = new Probabilidad();
        $this->impactos = new Impactos();
        $this->clasificacion = new Clasificacionriesgos();
        $this->procesos = new Proceso();
        $this->nivelRiesgos = new Nivelriesgos();
        $this->controles = new Controles();





    }

    public function Dashboard()
    {
        $riesgo = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Riesgos/dashboard.php';
        require_once 'Views/Layout/foot.php';
    }

    public function index()
    {
        $riesgo = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Riesgos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function gestionRiesgo()
    {
        $riesgo_id = $_GET['riesgo_id'];
        $riesgo = $this->model->consultarPorId($riesgo_id);
        $datosImpacto = $this->impactos->consultar();
        $datosProbabilidad = $this->probabilidad->consultar();
        $nivelRiesgo = $this->nivelRiesgos->consultar();
        $controles = $this->controles->consultar();
        //Fraccion de codigo para obtener los valores de impacto
        $valoresI = [];
        foreach ($datosImpacto as $objeto) {
            $valoresI[] = $objeto->valor;
        }
        usort($valoresI, function ($a, $b) {
            return $a <=> $b;
        });

        //Fraccion de codigo para obtener los valores de probabilidad
        $valoresP = [];
        foreach ($datosProbabilidad as $objeto) {
            $valoresP[] = $objeto->valor;
        }
        usort($valoresP, function ($a, $b) {
            return $b <=> $a;
        });

      

       
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/Riesgos/riesgos.php';
        require_once 'Views/Layout/foot.php';
    }

  

    public function add(){
        $nivel = new Riesgos();
        if(isset($_REQUEST['id'])){
            $nivel = $this->model->consultarPorId($_REQUEST['id']);
        }
       
        $probabilidad = $this->probabilidad->consultar(); 
        $impactos = $this->impactos->consultar(); 
        $clasificacion =  $this->clasificacion->consultar(); 
        $procesos = $this->procesos->getProceso0(); 

        require_once 'Views/Riesgos/crud.php';
    }

    public function crud(){
        $data = new Riesgos();
    
        $data->id = $_REQUEST['id'];	
        $data->nombre= $_REQUEST['nombre'];	
        $data->clasificacion = $_REQUEST['clasificacion'];
        $data->impacto= $_REQUEST['impacto']; // es la id	
        $data->probabilidad= $_REQUEST['probabilidad'];	// es la id
        $data->proceso= $_REQUEST['proceso'];	
        $data->descripcion= $_REQUEST['descripcion'];	
        $data->fecha_registro= date('Y-m-d');	
        $data->usuario_registro= $_REQUEST['usuario'];
        $data->control_id = isset($_REQUEST['nombreControl']);

        $imp = $this->impactos->consultarPorId($_REQUEST['impacto']); // uso el id para conocer el valor
        $prob = $this->probabilidad->consultarPorId($_REQUEST['probabilidad']);

        $valorProbabilidad = $prob->valor;
        $valorImpacto = $imp->valor;
        // OJO POR QUE EL VALOR QUE SE LE SUMA A LA PROBABILIDAD DEPENDE DE LA EVALUACION DEL CONTROL
        $control = $_REQUEST['control']; 
        if($control == "si"){
            $nivel_riesgo = $valorProbabilidad * $valorImpacto;
        }else if($control == "no"){
            //$nivel_riesgo = ($valorProbabilidad * $valorImpacto) + 2;
            $nivel_riesgo = $valorProbabilidad * $valorImpacto;
        }
        $data->nivel_riesgo= $nivel_riesgo;

        if( $data->id > 0)
        {
        $this->model->Actualizar($data);

        }else{
        $this->model->Registrar($data);
        }
    }

    public function delete(){
        $id = $_REQUEST['id'];
        $this->model->delete($id);
    }



  

    
}
