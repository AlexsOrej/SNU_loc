<?php
require_once 'Models/database.php';
require_once 'Models/Soporte.php';
require_once 'Models/Persona.php';

class SoportesController
{

    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Soporte();
    }

    public function Index()
    {
        $alm = new Persona();
        if (isset($_REQUEST['id'])) {
            $alm = $alm->GetPersona($_REQUEST['id']);
        }
        require_once 'Views/Soportes/index.php';
    }
    public function Indexnew()
    {
        $colaborador = new Persona();
        if (isset($_REQUEST['id'])) {
            $colaborador = $colaborador->GetPersona($_REQUEST['id']);
        }
        $soportes = $this->model->ObtenerArchivos("Assets/soportes/" . $colaborador->cedula);
        require_once 'Views/Soportes/indexnew.php';
    }

    public function Subir()
    {
        $ubicacion = 'Assets/soportes/';
        $fileTmpPath = $_FILES['file_eps_afp']['tmp_name'];
        $fileName = $_FILES['file_eps_afp']['name'];
        $fileSize = $_FILES['file_eps_afp']['size'];
        $fileType = $_FILES['file_eps_afp']['type'];
        $soporte = new Soporte();
        $soporte->cedula = $_REQUEST['cedula'];

        foreach ($_FILES as $key => $value) {
            if ($value != '0') {
                $soporte->nombre = $key;
                $soporte->tmp_name = $value['tmp_name'];
                $soporte->size = $value['size'];
                $soporte->type = $value['type'];
                $soporte->dir = 'Assets/soportes/' . $_REQUEST['cedula'] . '/';
                if ($soporte->size > 0) {
                    $this->model->Mover($soporte);
                }
            }
        }
        echo '
        <script>                
         alert("Los Soportes se subieron con éxito");
         window.history.back();
        //  window.location.reload(1)
        //   window.location = "?c=seleccion&a=gestion&id=' . $_REQUEST['id1'] . '";
        </script>';
    }



    public function SubirSoporte()
    {
        // Establece las configuraciones necesarias
        $ubicacion = 'Assets/soportes/'.$_REQUEST['colaborador'].'/';
        // $directorio = $_SERVER['DOCUMENT_ROOT'] . '/' . $ubicacion; // Ruta absoluta del directorio
        $tamanio_maximo = 5242880; // Tamaño máximo del archivo en bytes (en este caso, 5MB)
        $tipos_permitidos = array('pdf'); // Tipos de archivo permitidos (en este caso, solo PDF)
    
        // Verifica si se ha enviado un archivo
        if (!isset($_FILES['archivo'])) {
            return false;
        }
    
        $archivo = $_FILES['archivo'];
    
        // Verifica si ocurrió un error durante la carga
        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
    
        // Obtiene el nombre del archivo
        $nombre_archivo = $archivo["name"];
    
        // Obtiene la extensión del archivo
        $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
    
        // Valida el tamaño del archivo
        if ($archivo["size"] > $tamanio_maximo) {
            return false;
        }
    
        // Valida el tipo de archivo
        if (!in_array($extension, $tipos_permitidos)) {
            return false;
        }
    
        // Genera un nombre único para el archivo
        $nombre_unico = $_REQUEST['nombre_archivo'] . '.' . $extension;
    
        // Mueve el archivo al directorio destino
        $ruta_archivo = $ubicacion. $nombre_unico;
        if (!move_uploaded_file($archivo["tmp_name"], $ruta_archivo)) {
            return false;
        }
    
        // Devuelve la ruta relativa del archivo
        echo  $nombre_unico;
    }
    



    public function Renombrar($cc, $archivo, $nuevo)
    {
        $ubicacion = "Assets/soportes/";
        // Obtenemos el nombre del archivo actual
        $archivo_actual = $_POST['archivo_actual'];

        // Obtenemos el nuevo nombre del archivo
        $archivo_nuevo = $_POST['archivo_nuevo'];

        // Renombramos el archivo
        if (rename($archivo_actual, $archivo_nuevo)) {
            // El archivo se renombró correctamente
            echo "El archivo se renombró correctamente.";
        } else {
            // El archivo no se pudo renombrar
            echo "No se pudo renombrar el archivo.";
        }
    }

    public function Eliminar()
    {
              
        $ruta= $_REQUEST['ruta'];
         // Verificamos que el archivo exista
        $ubicacion = "Assets/soportes/";
        if (!file_exists($ruta)) {
            return false;
        }
        // Eliminamos el archivo
        unlink($ruta);
        // Devolvemos true si el archivo se eliminó correctamente
        return true;
    }
}
