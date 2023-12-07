<?php

require_once 'Models/Model.php';
require_once 'Models/Novedades.php';
require_once 'Models/Tiponovedad.php';


class NovedadesController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Novedades();
        $personal = new Model();
        $personal->Tblnovedad('novedades');
        $personal->Tbltiponovedades('tipo_novedades');

    }

    public function Index()
    {
        $novedades = $this->model->Listar();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Novedades/buscar.php';
        require_once 'Views/Layout/footer.php';
    }

    public function GetNovedadPersona()
    {
        $novedades = $this->model->GetNovedadPersona($_REQUEST['id']);
        $cliente = $_SESSION['datos_cliente']->nombre;
        @$persona = $_SESSION['persona'];
        $path = 'Assets/img/' . $cliente . '/Personal/Novedades/' . $persona . '/';
        require_once 'Views/Novedades/nov_persona.php';
    }
    public function Resultado()
    {
        $dato = $_REQUEST['dato'];
        $novedades = $this->model->Novedad($_REQUEST['dato']);

        if ($novedades != null) {
            require_once 'Views/Novedades/novedades.php';
        } else {
            echo "<div class='text-center'><h3> No hay registros</h3></div>";
        }
    }
    public function ResultadoFicha()
    {
        $dato = $_REQUEST['dato'];
        $novedades = $this->model->Novedad($_REQUEST['dato']);

        if ($novedades != null) {
            require_once 'Views/Novedades/infoPersona.php';
        } else {
            echo "<div class='text-center'><h3> No hay registros</h3></div>";
        }
    }


    public function Nov()
    {
        require_once '../vista/header.php';
        require_once '../vista/novedades/nov.php';
        require_once '../vista/footer.php';
    }

    public function Actualizar()
    {
        $alm = new Novedades();
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->ListarDatos($_REQUEST['id']);
        }
        require_once '../vista/novedades/novedades-editar.php';
    }

    public function Delete()
    {
        $this->model->Eliminar0($_REQUEST['id']);
        // echo "<script>
        //           alert('La NOVEDAD se Elimino correctamente');
        //                     window.location ='?c=Novedades';
        //         </script>";        
    }


    public function ObtenerDatos()
    {

        require_once '../vista/novedades/ObtenerDatos.php';
    }

    public function Buscar()
    {

        require_once '../vista/header.php';
        require_once '../vista/novedades/buscar.php';
        require_once '../vista/footer.php';
    }

    public function otroSi()
    {

        // require_once '../vista/header.php';
        require_once '../vista/novedades/otroSi.php';
        //  require_once '../vista/footer.php';

    }

    public function Registro()
    {
        $nov = new Novedades();
        $tiponov = new Tiponovedad();
        $tiposnovedades = $tiponov->Index();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $idp = $data['idp'];
            $dato = $data['dato'];
            $accion = $data['accion'];
        }
        if ($accion == "modificar") {
            $nov = $this->model->ListarDatos($idp);
        }


        require_once 'Views/Novedades/registro.php';
    }


    public function Crud()
    {
        $nov = new Novedades();
        $nov->id = $_REQUEST['id'];
        $nov->fecha_novedad = $_REQUEST['fevento'];
        $nov->fecha_registro = $_REQUEST['fregistro'];
        $nov->persona_id = $_REQUEST['persona_id'];
        $nov->tipo_id = $_REQUEST['tipo_id'];
        $nov->descripcion = $_REQUEST['descripcion'];


        // get details of the uploaded file
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $file = substr(str_shuffle($permitted_chars), 0, 15);
        $newFileName = $file . '.' . $fileExtension;
        $nov->soporte = $newFileName;
        $allowedfileExtensions = array('pdf');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $cliente = $_SESSION['datos_cliente']->nombre;
            $persona = $_SESSION['persona'];
            // directory in which the uploaded file will be moved
            $uploadFileDir = 'Assets/img/' . $cliente . '/Personal/Novedades/' . $persona . '/'; 
            $dest_path = $uploadFileDir . $newFileName;


            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'El archivo se cargó correctamente.';
            } else {
                $message = 'Hubo algún error al mover el archivo al directorio de carga. Asegúrese de que el servidor web pueda escribir en el directorio de carga.';
            }
        }
        $nov->id > 0 ?
            $this->model->Editar($nov) :
            $this->model->Registrar($nov);
    }
}
