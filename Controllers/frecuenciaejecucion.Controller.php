<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/FrecuenciaEjecucion.php';


class frecuenciaEjecucionController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new frecuenciaEjecucion();
    }

    public function index()
    {
        $frecuencia = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/FrecuenciaEjecucion/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function add(){
      $frec = new frecuenciaEjecucion();
      if(isset($_REQUEST['id'])){
          $frec = $this->model->consultarPorId($_REQUEST['id']);
      }
      require_once 'Views/FrecuenciaEjecucion/crud.php';
  }

  public function crud(){
      $data = new frecuenciaEjecucion();
      $data->id = $_REQUEST['id'];
      $data->nombre = $_REQUEST['nombre'];
      $data->descripcion =  $_REQUEST['descripcion'];

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
