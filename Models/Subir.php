<?php

class Subir
{

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Subir()
    {
        if (!empty($_FILES)) {
            $carpeta = $_SESSION['datos_cliente']->nombre;
            $targetDir = "Assets/img/" . $carpeta . "/";

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileName = $_FILES['file']['name'];
            $targetFile = $targetDir . $fileName;
            move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);
        }
    }
    public function SubirLogo()
    {
        if (!empty($_FILES)) {

            $targetDir = "Assets/img/uploads/colegio/";

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            echo   $fileName =  str_replace(" ", "", $_FILES['file']['name']);
            $targetFile = $targetDir . $fileName;

            move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);
        }
    }

    public function UploadFoto()
    {
        echo $_FILES["file"]["type"];
        if ($_FILES["file"]["type"] == "image/jpeg" or $_FILES["file"]["type"] == "image/jpg" or $_FILES["file"]["type"] == "image/png") {

            $carpeta = $_SESSION['datos_cliente']->nombre;
            $targetDir = "Assets/img/" . $carpeta . "/Fotos/";

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $type = explode("/", $_FILES["file"]["type"]);
            $fileName = $_REQUEST['foto_nom'] . '.' . $type[1];
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                //more code here...   
                echo $targetFile;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
}
