<?php
//importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Evento_categoria.php';
require_once 'Models/Evento.php';

//nombre la clase
class Eventos_categoriasController
{   private $model;
    private $evento;
    public function __CONSTRUCT()
    {
        $this->model = new Evento_categoria();
        $this->evento = new Evento();
    }
    /*crear los metodos necesarios*/
    public function Index_eventos()
    {
        $eventos = $this->model->Index();
        require_once 'Views/Layout/eventos.php';
        require_once 'Views/Evento_categorias/Evindex.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Add()
    {
        
        $evento = new Evento_categoria();
        $clasificacion=$this->evento->CargoIndex();
        if (isset($_REQUEST['id'])) {
            $evento = $this->model->GetEventoCategoria($_REQUEST['id']);
        }
        require_once 'Views/Evento_categorias/crud.php';
    }
    public function Crud()
    {
        $evento = new Evento_categoria();
        $evento->id = $_REQUEST['id'];
        $evento->clasificacionIncidente = $_REQUEST['clasificacionIncidente'];
        $evento->tipoIncidente = $_REQUEST['tipoIncidente'];
        $evento->correcionIncidente = $_REQUEST['correcionIncidente'];
        $evento->fechaRegistro = date('Y-m-d');
        $evento->usuario='sistema';

        $evento->id > 0 ? 
        $this->model->Edit($evento) : 
        $this->model->Add($evento);
    }

   public function Delete()
   {
        $this->model->Delete($_REQUEST['id']);
   }



}
