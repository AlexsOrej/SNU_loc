<?php
//importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Evento.php';

//nombre la clase
class Eventos_categoriasController
{   private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Evento();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $eventos = $this->model->CargoIndex();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Eventos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Add()
    {
        
        $evento = new Evento();
        if (isset($_REQUEST['id'])) {
            $evento = $this->model->GetEvento($_REQUEST['id']);
        }
        require_once 'Views/Eventos/crud.php';
    }
    public function Crud()
    {
        $evento = new Evento();
        $evento->id = $_REQUEST['id'];
        $evento->nombreevento = $_REQUEST['nombreevento'];
        $evento->sigla = $_REQUEST['sigla'];
        $evento->correoresponsable = $_REQUEST['correoresponsable'];
        $evento->created = date('Y-m-d');

        $evento->id > 0 ? $this->model->Edit($evento) : $this->model->Add($evento);
    }

   public function Delete()
   {
        $this->model->Delete($_REQUEST['id']);
   }



}
