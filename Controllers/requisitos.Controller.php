<?php

use Matrix\Functions;

require_once 'Models/Autoload.php';

class RequisitosController
{


    public $seccion;
    public $requisitos;
    public function __CONSTRUCT()
    {
        $this->seccion = new Secciones();
        $this->requisitos = new Requisito();
    }


    public function Index()
    {
        $seccion = $this->seccion->Obtener($_REQUEST['seccion']);
        $requisitos = $this->requisitos->ObtenerPorSeccion($_REQUEST['seccion']);
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Requisitos/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Obtener()
    {

        $requisitos = $this->requisitos->ObtenerPorSeccion($_REQUEST['seccion']);
        require_once 'Views/Requisitos/obtener.php';
    }

    public function Crud()
    {
        $requisitos = new Requisito();
        if (isset($_REQUEST['seccion_id'])) {
            $requisitos = $this->requisitos->Obtener($_REQUEST['seccion_id']);
        }
        require_once 'Views/Requisitos/crud.php';
    }

    public function Registrar()
    {

        $nuevosNumeros = filter_input(INPUT_POST, 'nuevoNumero', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $nuevosTitulos = filter_input(INPUT_POST, 'nuevoTitulo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        // Verificar que todos los arrays tengan la misma longitud
        if (count($nuevosNumeros) === count($nuevosTitulos)) {
            // Llamar a la función registrar en tu controlador
            $this->requisitos->Registrar($_REQUEST['seccionid'], $nuevosNumeros, $nuevosTitulos);

            // Ejemplo de respuesta (puedes ajustar según tus necesidades)
            echo  json_encode(['mensaje' => 'Datos registrados con exito']);
            exit();
        } else {
            // Enviar un mensaje de error si los arrays no tienen la misma longitud
            json_encode(['error' => 'Error en los datos recibidos']);
            exit();
        }
    }

    public function Eliminar()
    {
        echo  $result =   $this->requisitos->Eliminar($_REQUEST['seccion_id']);
    }

    //**ASOCIAR REQUISTOS PARA LA LISTA DE CHEQUEO */
    public function Asociar()
    {
        $_REQUEST['isChecked'] == "true" ?
            $result = $this->requisitos->Asociar($_SESSION['pid'], $_REQUEST['requisito_id']) :
            $result = $this->requisitos->DesAsociar($_SESSION['pid'], $_REQUEST['requisito_id']);
        echo $result;
    }
}
