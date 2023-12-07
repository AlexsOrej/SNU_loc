<?php
// importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Categoria.php';

//nombre la clase
class CategoriasController
{
    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Categoria();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $categoria = new Categoria();
        $categorias = $categoria->Index();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Categorias/index.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Add()
    {
        $categoria = new Categoria();
        if (isset($_REQUEST['id'])) {
            $categoria = $categoria->Categoria($_REQUEST['id']);
        }
        require_once 'Views/Categorias/crud.php';
    }

    public function Crud()
    {
        $categoria = new Categoria();
        $categoria->id = $_REQUEST['id'];
        $categoria->nombre = $_REQUEST['nombre'];
        $categoria->codigo = $_REQUEST['codigo'];
        $categoria->vidautil = $_REQUEST['vidautil'];
        $categoria->created = $_REQUEST['created'];
        $categoria->modified = date('Y-m-d');

        $categoria->id > 0 ? $categoria->Edit($categoria) : $categoria->Add($categoria);
    }



    public function Delete()
    {
        if ($this->model->ValDelete($_REQUEST['id']) == 0) {
               $this->model->Delete($_REQUEST['id']);
            echo 0;   
        } else {
            echo  $this->model->ValDelete($_REQUEST['id']);
        }
    }
}
