<?php
//importar los modelos necesarios
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Cartelera.php';
require_once 'Models/Proceso.php';
//nombre la clase
class CarteleraController
{
    private $cartelera;
    public function __CONSTRUCT()
    {
        $this->cartelera = new Cartelera();
    }
    /*crear los metodos necesarios*/
    public function Listar()
    {
        $cartelera = $this->cartelera->Listar();
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cartelera/listar.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        $datos = new Cartelera();
        if (isset($_POST['id'])) {
            //si se ha enviado el id de un registro, buscarlo y cargarlo en variables para editarlo
            $datos = $datos->Obtener($_REQUEST["id"]);
        }
        require_once 'Views/Cartelera/crud.php';
    }


    public function Agregar()
    {
        //agregar registro
        $cartelera = new Cartelera();

        $cartelera->id = $_POST["id"];
        $cartelera->titulo = $_POST["titulo"];
        $cartelera->contenido = $_POST["contenido"];
        $cartelera->usuario_id = $_POST["usuario_id"];
        $cartelera->vigencia = $_POST["vigencia"];

        $cartelera->id > 0 ?
            $cartelera->Actualizar($cartelera) :
            $cartelera->Registrar($cartelera);
        //header("Location: /Cartelera/Listar");
    }



    public function Actualizar()
    {
        //actualizar registro
        $datos = array(
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "fecha" => $_POST["fecha"],
            "hora" => $_POST["hora"],
            "cantidad" => $_POST["cantidad"],
            "precio" => $_POST["precio"]
        );
        $cartelera = new Cartelera();
        $cartelera->Actualizar($datos);
        header("Location: /Cartelera/Listar");
    }

    public function Eliminar()
    {
        //eliminar registro
        $id = $_POST["id"];
        $cartelera = new Cartelera();
        $cartelera->Eliminar($id);
        
    }
}
