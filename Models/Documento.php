<?php

class Documento
{
    private $pdo;
    public $id;
    public $CodDocumento;
    public $Proceso;
    public $NomDocumento;
    public $Version;
    public $Recuperacion;
    public $proteccion;
    public $Almacenamiento;
    public $preservacion;
    public $Emision;
    public $Actualizacion;
    public $dir;
    public $filename;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getDocumentos($proceso)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT MAX(CodDocumento) AS ultimo
            FROM  documentos 
            WHERE Proceso='$proceso' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getDocCod($codigo)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT *
            FROM  documentos 
            WHERE CodDocumento='$codigo' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getDocProceso($proceso)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT documentos.*, procesos.* 
            FROM  documentos, procesos
            WHERE documentos.Proceso = procesos.id
            AND   documentos.Proceso = '$proceso'
            ORDER BY CodDocumento");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getDocs($proceso)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT *  FROM  documentos
            WHERE documentos.Proceso = '$proceso'
            ORDER BY CodDocumento");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetDoc($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM  documentos WHERE id='$id'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function upClienteValidar($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT clientes.*, squemas.* FROM  clientes, squemas 
            WHERE clientes.id=squemas.cliente_id AND clientes.id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Documento $data)
    {
        try {
            $stm = "INSERT INTO documentos(CodDocumento, Proceso,NomDocumento, Version, Recuperacion, proteccion, Almacenamiento, preservacion, Emision,Actualizacion,filename,dir )
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->CodDocumento,
                $data->Proceso,
                $data->NomDocumento,
                $data->Version,
                $data->Recuperacion = '-',
                $data->proteccion,
                $data->Almacenamiento,
                $data->preservacion,
                $data->Emision,
                $data->Actualizacion = '0000-00-00',
                $data->filename,
                $data->dir = 'Assets/Solicitudes/' . $_SESSION['datos_cliente']->nombre . '/'
            ));
             $id = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

   public function Actualizar(Documento $data)
    {
        try {
            $sql = "UPDATE documentos SET CodDocumento='$data->CodDocumento', Proceso='$data->Proceso', NomDocumento='$data->NomDocumento',
              	Version='$data->Version', Recuperacion='$data->Recuperacion', proteccion='$data->proteccion', Almacenamiento='$data->Almacenamiento',
              preservacion='$data->preservacion' ,Emision='$data->Emision', Actualizacion='$data->Actualizacion' ,filename='$data->filename'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

   public function SubirDoc()
    {
        $fileTmpPath = $_FILES['filename']['tmp_name'];
        $fileName = $_FILES['filename']['name'];
        $fileSize = $_FILES['filename']['size'];
        $fileType = $_FILES['filename']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        !isset($_REQUEST['CodDocumento'])
            ? $newFileName = $fileName
            : $newFileName = $_REQUEST['CodDocumento'] . '.pdf';
        $allowedfileExtensions = array('xls', 'xlsx', 'doc', 'pdf', 'docx');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            !isset($_REQUEST['CodDocumento'])
                ? $uploadFileDir = 'Assets/Solicitudes/' . $_SESSION['datos_cliente']->nombre . '/'
                : $uploadFileDir = "Assets/img/" . $_SESSION['datos_cliente']->nombre . '/';
            $dest_path = $uploadFileDir . $newFileName;
            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'El archivo se cargó correctamente.' . $newFileName;
            } else {
                $message = 'Hubo algún error al mover el archivo al directorio de carga. Asegúrese de que el servidor web pueda escribir en el directorio de carga.';
            }
        } else {
            echo '<script type = "text/javascript">
                    alert("La solictud fue gestionada , el archivo no pudo se subido, revisa el formato, recuerda que debe ser .pdf");
                    </script> ';
        }
    }
}
