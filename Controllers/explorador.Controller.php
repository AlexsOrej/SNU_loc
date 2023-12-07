<?php
// importar los modelos necesarios
// require_once 'Models/database.php';
// require_once 'Models/Explorador.php';
//nombre la clase
class ExploradorController
{
    public function __CONSTRUCT()
    {
        // $this->model = new Explorador();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
         require_once 'Views/Explorador/index.php';
        
    }
    public function Subir()
    {
         require_once 'Views/Explorador/subir.php';
        
    }
    
 public function Cargar(){
        
function sanitizeFilename($filename) {
    $filename = preg_replace("/[^\w\-_.]/", '_', $filename);
    return $filename;
}

if (isset($_FILES['archivo'])) {
    $nombreCliente = str_replace(' ', '', strtolower($_SESSION['datos_cliente']->nombre));
    $carpetaDestino = "Assets/images/{$nombreCliente}/";

    if (!file_exists($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    $archivoNombre = sanitizeFilename($_FILES['archivo']['name']);
    $archivoDestino = $carpetaDestino . $archivoNombre;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivoDestino)) {
        echo "El archivo se ha subido correctamente.";
    } else {
        echo "Error al subir el archivo.";
    }
}
    }


   

}