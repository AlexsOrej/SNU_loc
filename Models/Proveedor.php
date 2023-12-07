<?php

class Proveedor
{
    private $pdo;
    public $id;
    public $tipo_servicio;
    public $nombre;
    public $direccion;
    public $ciudad;
    public $telefono;
    public $email;
    public $contacto;
    public $estado;
    public $pais;
    public $nit;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function CrearProveedor(Proveedor $data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO proveedores (tipo_servicio, nombre, direccion, ciudad, telefono, email, contacto,  estado, pais,nit) 
            VALUES (:tipo_servicio, :nombre, :direccion, :ciudad, :telefono, :email, :contacto, :estado, :pais, :nit)");
            $stmt->bindParam(":tipo_servicio", $data->tipo_servicio);
            $stmt->bindParam(":nombre", $data->nombre);
            $stmt->bindParam(":direccion", $data->direccion);
            $stmt->bindParam(":ciudad", $data->ciudad);
            $stmt->bindParam(":telefono", $data->telefono);
            $stmt->bindParam(":email", $data->email);
            $stmt->bindParam(":contacto", $data->contacto);
            $stmt->bindParam(":estado", $data->estado);
            $stmt->bindParam(":pais", $data->pais);
            $stmt->bindParam(":nit", $data->nit);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error al crear el proveedor: " . $e->getMessage();
            return false;
        }
    }

    function Index()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM proveedores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    function ObtenerProveedor($id)
    {

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM proveedores WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $proveedor = $stmt->fetch(PDO::FETCH_OBJ);
            return $proveedor;
        } catch (PDOException $e) {
            echo "Error al obtener el proveedor: " . $e->getMessage();
            return false;
        }
    }


    function Actualizar(Proveedor $data)
    {
        $stmt = $this->pdo->prepare("UPDATE proveedores 
                                    SET tipo_servicio = ?, 
                                    nombre = ?, direccion = ?, 
                                    ciudad = ?, telefono = ?, 
                                    email = ?, contacto = ?, 
                                    estado = ?, pais = ?,
                                    nit = ?
                                    WHERE id = ?");
        $stmt->execute(
            array(
                $data->tipo_servicio,
                $data->nombre,
                $data->direccion,
                $data->ciudad,
                $data->telefono,
                $data->email,
                $data->contacto,
                $data->estado,
                $data->pais,
                $data->nit,
                $data->id
            )
        );
    }

    public function CountFilesInFolder($folderPath)
    {
        // Obtener una lista de todos los archivos en la carpeta
        $files = scandir($folderPath);

        // Eliminar los elementos "." y ".." del array
        $files = array_diff($files, array('.', '..'));

        // Contar la cantidad de elementos en el array restante
        $numFiles = count($files);

        // Devolver el resultado
        return $numFiles;
    }

    function ObtenerArchivos($url_carpeta)
    {
        // Obtener la ruta absoluta de la carpeta a partir de la URL
        $ruta_carpeta = $_SERVER['DOCUMENT_ROOT'] . parse_url($url_carpeta, PHP_URL_PATH);

        // Obtener el listado de archivos y subdirectorios en la carpeta
        $archivos = scandir($url_carpeta);

        // Filtrar solo los archivos PHP
        $archivos_php = array_filter($archivos, function ($archivo) {
            return pathinfo($archivo, PATHINFO_EXTENSION) == 'pdf';
        });

        // Devolver el array de archivos PHP     

        // print_r($archivos_php);
        return $archivos_php;
    }

    public function Buscar()
    {
        try {
            $sql = "SELECT * FROM proveedores WHERE nombre = :nombre";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al obtener el proveedor: " . $e->getMessage();
            return false;
        }
    }
}
