<?php
class Formato
{

    private $pdo;
    public $id;
    public $CodFormato;
    public $Proceso;
    public $NomFormato;
    public $RutaFormato;
    public $Version;
    public $Emision;
    public $Actualizacion;
    public $Almacenamiento;
    public $Proteccion;
    public $TipoRecuperacion;
    public $TiempoRetencion;
    public $DispFinal;
    public $Recuperacion;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function getFormato($proceso)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT MAX(CodFormato) AS ultimo
            FROM  formatos 
            WHERE Proceso='$proceso' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getForCod($codigo)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT *
            FROM  formatos 
            WHERE CodFormato='$codigo' ");
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
            $stm = $this->pdo->prepare("SELECT formatos.*, procesos.* 
            FROM  formatos, procesos
            WHERE formatos.Proceso = Procesos.id
            AND   formatos.Proceso = '$proceso'
            ORDER BY CodFormato");
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
            $stm = $this->pdo->prepare("SELECT *  FROM  formatos
            WHERE formatos.Proceso = '$proceso'
            ORDER BY Codformato");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function GetDoc($id)
    {

        try {

            $stm = $this->pdo->prepare("SELECT * FROM  formatos WHERE id='$id'");
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

    public function Registrar(Formato $data)
    {

        try {

            $stm = "INSERT INTO formatos( CodFormato, Proceso, NomFormato, RutaFormato, Version, Emision, Actualizacion, Almacenamiento, Proteccion, TipoRecuperacion, Recuperacion, TiempoRetencion, DispFinal, Responsable)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->CodFormato,
                $data->Proceso,
                $data->NomFormato,
                $data->RutaFormato,
                $data->Version,
                $data->Emision,
                $data->Actualizacion = '0000-00-00',
                $data->Almacenamiento,
                $data->Proteccion,
                $data->TipoRecuperacion,
                $data->Recuperacion,
                $data->TiempoRetencion,
                $data->DispFinal,
                $data->Responsable

            ));

            $id = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Formato $data)
    {

        try {
            $sql = "UPDATE formatos SET CodFormato = :CodFormato, Proceso = :Proceso, NomFormato = :NomFormato, 
                    Version = :Version, RutaFormato = :RutaFormato, Emision = :Emision, Actualizacion = :Actualizacion, 
                    Almacenamiento = :Almacenamiento, Proteccion = :Proteccion, TipoRecuperacion = :TipoRecuperacion, 
                    Recuperacion = :Recuperacion, TiempoRetencion = :TiempoRetencion, DispFinal = :DispFinal, 
                    Responsable = :Responsable WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':CodFormato', $data->CodFormato);
            $stmt->bindParam(':Proceso', $data->Proceso);
            $stmt->bindParam(':NomFormato', $data->NomFormato);
            $stmt->bindParam(':Version', $data->Version);
            $stmt->bindParam(':RutaFormato', $data->RutaFormato);
            $stmt->bindParam(':Emision', $data->Emision);
            $stmt->bindParam(':Actualizacion', $data->Actualizacion);
            $stmt->bindParam(':Almacenamiento', $data->Almacenamiento);
            $stmt->bindParam(':Proteccion', $data->Proteccion);
            $stmt->bindParam(':TipoRecuperacion', $data->TipoRecuperacion);
            $stmt->bindParam(':Recuperacion', $data->Recuperacion);
            $stmt->bindParam(':TiempoRetencion', $data->TiempoRetencion);
            $stmt->bindParam(':DispFinal', $data->DispFinal);
            $stmt->bindParam(':Responsable', $data->Responsable);
            $stmt->bindParam(':id', $data->id);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error al actualizar el registro: " . $e->getMessage());
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
        $newFileName = 'S' . $_REQUEST['id'] . '-' . $_REQUEST['NomDocumento'] . '.' . $fileExtension;
        $allowedfileExtensions = array('xls', 'doc', 'pdf', 'docx');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = 'Assets/Solicitudes/';
            $dest_path = $uploadFileDir . $newFileName;
            if (!($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'El archivo se cargó correctamente.';
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
