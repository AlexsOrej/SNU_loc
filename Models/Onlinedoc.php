<?php
class Onlinedoc
{
    private $pdo;
    public $id;
    public $solicitud_id;
    public $contenido;
    public $fecha_creacion;
    public $estado;
    public $editor;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Onlinedoc $data)
    {
        try {
            $stm = "INSERT INTO doc_online( solicitud_id,contenido,fecha_creacion, estado, editor)
            VALUES(?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->solicitud_id,
                $data->contenido,
                $data->fecha_creacion,
                $data->estado,
                $data->editor
            ));
            $id = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetOnline($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM doc_online WHERE solicitud_id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetOnlineDoc($id)
    {
        try {

            $stm = $this->pdo->prepare("SELECT doc_online.*, solicitudes.*, documentos.NomDocumento, documentos.Version,documentos.Actualizacion
            FROM doc_online, solicitudes, documentos
            WHERE doc_online.solicitud_id=solicitudes.id 
            AND documentos.CodDocumento=solicitudes.Codigo
            AND doc_online.id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Index()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM doc_online");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Valdoconline(Onlinedoc $data)
    {
        try {
            $sql = "UPDATE doc_online SET contenido='$data->contenido' WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Documentos($codigo)
    {
        try {
            $stm = $this->pdo->prepare("SELECT
          MAX(doc_online.id) as doc_online_id
        FROM
            solicitudes,
            doc_online, documentos           
        WHERE   
             solicitudes.id = doc_online.solicitud_id
             AND
             solicitudes.Codigo = documentos.CodDocumento
             AND
             documentos.CodDocumento='$codigo'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
