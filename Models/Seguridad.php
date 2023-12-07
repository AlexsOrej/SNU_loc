<?php

class Seguridad
{

    private $pdo;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    public function getUser($user, $pass)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  usuarios  WHERE  username='$user' AND  password='$pass' AND estado='1'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Login($u, $c)
    {

        try {
            $e = 1;
            $consulta = "SELECT * FROM usuarios WHERE username = :username AND password = :password AND estado=:estado ";
            $sentencia = $this->pdo->prepare($consulta);
            $sentencia->bindParam(':username', $u);
            $sentencia->bindParam(':password', $c);
            $sentencia->bindParam(':estado', $e);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Identificar($u, $c)
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $result = array();
                $stm = $this->pdo->prepare("SELECT clientes.id as cliente_id, clientes.nombre as cliente, rols.rol,rols.id as rol_id, squemas.squema,  CONCAT(usuarios.nombres,' ',usuarios.apellidos) as FullName, usuarios.id as user_id, usuarios.username as username, usuarios.identificacion as cc, usuarios.cargo_id as cargo_id
                                            FROM  usuarios  
                                            LEFT JOIN clientes ON usuarios.cliente_id = clientes.id 
                                            LEFT JOIN rols ON usuarios.rol_id = rols.id 
                                            LEFT JOIN squemas ON usuarios.squema_id = squemas.id 
                                            WHERE  username='$u' 
                                            AND  password='$c' 
                                            AND estado='1'");
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
        }
    }

    public function SubirImg($files)
    {

        $nombre = mt_rand(1, 10000000);
        // get details of the uploaded file 1
        $fileTmpPath = $files->tpm_name;
        $fileName = $files->name;
        $fileSize = $files->size;
        $fileType = $files->type;
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = 'logo_' . $nombre . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {

            // directory in which the uploaded file will be moved
            $uploadFileDir = 'Assets/img/logos/';

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
        return $newFileName;
    }
}
