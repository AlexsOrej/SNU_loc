<?php
require_once 'Models/Autoload.php';

class DebesController
{
    public $debe;
    public $requisitos;

    public function __CONSTRUCT()
    {
       $this->requisitos = new Requisito();
       $this->debe = new Debes();
    }


    public function Index()
    {
        $requisitos = $this->requisitos->Obtener($_REQUEST['requisito']);
        $debe = $this->debe->ObtenerPorRequisito($_REQUEST['requisito']);
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Debes/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        $requisitos = new Requisito();
        if (isset($_REQUEST['seccion_id'])) {
            $requisitos = $this->requisitos->Obtener($_REQUEST['seccion_id']);
        }
        require_once 'Views/Debes/crud.php';
    }

    public function Registrar()
    {

        $nuevosNumeros = filter_input(INPUT_POST, 'nuevoNumero', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $nuevosTitulos = filter_input(INPUT_POST, 'nuevoTitulo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        // Verificar que todos los arrays tengan la misma longitud
        if (count($nuevosNumeros) === count($nuevosTitulos)) {
            // Llamar a la función registrar en tu controlador
            $this->debe->Registrar($_REQUEST['requisitoid'], $nuevosNumeros, $nuevosTitulos);

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
}
