<?php
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Proveedor.php';


class ProveedoresController
{
    public function __CONSTRUCT()
    {
        $this->model = new Proveedor();
        $tblproveedor = new Model();
        $tblproveedor->TblProveedor('proveedores');
    }

    public function Index()
    {
        $proveedor = $this->model->Index();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Proveedores/index.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Crud()
    {
        $proveedor = new Proveedor();
        if (isset($_REQUEST['id'])) {
            $proveedor = $this->model->ObtenerProveedor($_REQUEST['id']);
        }
        require_once 'Views/Proveedores/crud.php';
    }
    public function Soporte()
    {
        require_once 'Views/Proveedores/soporte.php';
    }
    public function subirSoporte()
    {

        $_FILES["soporte"]["type"];
        if ($_FILES["soporte"]["type"] == "application/pdf") {
            $carpeta = $_SESSION['datos_cliente']->nombre;
            $proveedor = "proveedor_" . $_REQUEST['id'];
            $targetDir = "Assets/img/" . $carpeta . "/soportes/" . $proveedor . "/";

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $type = explode("/", $_FILES["soporte"]["type"]);
            $fileName = $_REQUEST['soporte_nom'] . '.' . $type[1];
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["soporte"]["tmp_name"], $targetFile)) {
                //more code here...   
                echo $targetFile;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }


    public function Guardar()
    {
        $proveedor = new Proveedor();
        $proveedor->id = $_REQUEST['id'];
        $proveedor->tipo_servicio = $_REQUEST['tiposervicio'];
        $proveedor->nombre = $_REQUEST['nombre'];
        $proveedor->direccion = $_REQUEST['direccion'];
        $proveedor->ciudad = $_REQUEST['ciudad'];
        $proveedor->estado = $_REQUEST['estado'];
        $proveedor->pais = $_REQUEST['pais'];
        $proveedor->telefono = $_REQUEST['telefono'];
        $proveedor->email = $_REQUEST['correo'];
        $proveedor->contacto = $_REQUEST['contacto'];
        $proveedor->nit = $_REQUEST['nit'];

        $proveedor->id > 0 ? $this->model->Actualizar($proveedor) : $this->model->CrearProveedor($proveedor);
    }


    public function VerSoporte()
    {
        $vsoporte =  $this->model->ObtenerArchivos($_REQUEST['url']);
        require_once 'Views/Proveedores/versoporte.php';
    }

    public function Buscarprovee()
    {
        $provee= new Proveedor();

        $proveedores= $provee->Buscar();

    }
}
