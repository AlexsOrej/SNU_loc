<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Tipocontrato.php';

//nombre la clase
class TipocontratosController
{
    public function __CONSTRUCT()
    {
        $this->model = new Tipocontrato();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $tipo = new Tipocontrato();
        $tipo = $tipo->Index();

        require_once 'Views/Layout/talento.php';
        require_once 'Views/TipoContrato/index.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Registrar()
    {
        $comprobar = array('contratos' => 0);
        
        $tipo= new Tipocontrato();
        if (isset($_REQUEST['id'])) {
            $tipo = $this->model->Listar($_REQUEST['id']);
            $comprobar = $this->model->ComprobarEliminacion($_REQUEST['id']);

        }
        require_once 'Views/TipoContrato/tipo_contrato.php';
    }

    public function Editar($id){
        // if(isset($_REQUEST['id'])){
        // }
       // $comprobar = $this->model->ComprobarEliminacion($_REQUEST['id']);


    }
    public function Crud()
    {
        $tipocontrato = new Tipocontrato();
        $tipocontrato->id = $_REQUEST['id'];
        $tipocontrato->nombre = strtoupper($_REQUEST['tipo']); 
        $tipocontrato->contenido = strtoupper($_REQUEST['contenido']); 
        $tipocontrato->id > 0 ? $tipocontrato->Edit($tipocontrato) : $tipocontrato->Add($tipocontrato);
    }
    public function Delete()
    {
        $comprobar = $this->model->ComprobarEliminacion($_REQUEST['id']);

        if ($comprobar['contratos'] >= 1) {
            echo "El contrato tiene ".$comprobar['contratos']." trabajadores asociados, no se puede borrar";
        }else{
             $this->model->Delete($_REQUEST['id']);
        }
    }


}