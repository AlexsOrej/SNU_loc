<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/TipoControl.php';


class tipoControlController
{
    private $rol;
    public function __CONSTRUCT()
    {
        $this->model = new tipoControl();
    }

    public function index()
    {
        $tipoRiesgo = $this->model->consultar();
        require_once 'Views/Layout/riesgos.php';
        require_once 'Views/TipoControl/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function add(){
      $tipo = new tipoControl();
      if(isset($_REQUEST['id'])){
          $tipo = $this->model->consultarPorId($_REQUEST['id']);
      }
      require_once 'Views/TipoControl/crud.php';
  }

  public function crud(){
      $data = new tipoControl();
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
