<?php
require_once 'Models/Autoload.php';

class SeccionesController
{

    public $norma;
    public $seccion;
    public function __CONSTRUCT()
    {
        $this->norma = new Norma();
        $this->seccion = new Secciones();
    }


    public function Index()
    {
        $norma = $this->norma->Obtener($_REQUEST['id']);
        $secciones = $this->seccion->Index($_REQUEST['id']);
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Secciones/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        $seccion = new Secciones();
        if (isset($_REQUEST['seccion_id'])) {
            $seccion = $this->seccion->Obtener($_REQUEST['seccion_id']);
        }
        require_once 'Views/Secciones/crud.php';
    }

    public function Registrar()
    {

        $nuevosNumeros = filter_input(INPUT_POST, 'nuevoNumero', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $nuevosTitulos = filter_input(INPUT_POST, 'nuevoTitulo', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
      
        // Verificar que todos los arrays tengan la misma longitud
        if (count($nuevosNumeros) === count($nuevosTitulos) ) {
            // Llamar a la función registrar en tu controlador
            $this->seccion->Registrar($_REQUEST['normaid'], $nuevosNumeros, $nuevosTitulos);

            // Ejemplo de respuesta (puedes ajustar según tus necesidades)
            echo json_encode(['mensaje' => 'Datos registrados con éxito']);
            exit();
        } else {
            // Enviar un mensaje de error si los arrays no tienen la misma longitud
            echo json_encode(['error' => 'Error en los datos recibidos']);
            exit();
        }
    }

    public function Eliminar()
    {
        echo  $result =   $this->seccion->Eliminar($_REQUEST['seccion_id']);
    }
}
