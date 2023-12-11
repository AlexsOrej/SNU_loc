<?php
class Norma
{

    private $pdo;
    public $id;
    public $version;
    public $fechaPublicacion;
    public $descripcion;
    public $ultimaActualizacion;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Index()
    {
        try {
            $sql = 'SELECT * FROM normas';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return false;
        }
    }


    public function Registrar(Norma $data)
    {

        try {
            $sql = "INSERT INTO normas (version, fecha_publicacion, descripcion, ultima_actualizacion)
            VALUES (:version, :fechaPublicacion, :descripcion, :ultimaActualizacion)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':version', $data->version);
            $stmt->bindParam(':fechaPublicacion', $data->fechaPublicacion);
            $stmt->bindParam(':descripcion', $data->descripcion);
            $stmt->bindParam(':ultimaActualizacion', $data->ultimaActualizacion);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function Actualizar(Norma $data)
    {
        try {
            $sql = "UPDATE normas
            SET version = :version, fecha_publicacion = :fechaPublicacion, descripcion = :descripcion, ultima_actualizacion = :ultimaActualizacion
            WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':version', $version);
            $stmt->bindParam(':fechaPublicacion', $fechaPublicacion);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':ultimaActualizacion', $ultimaActualizacion);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function Obtener($id)
    {
        try {
            $sql = 'SELECT * FROM normas WHERE id=:id ';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function Eliminar($id)
    {

        try {
            $sql = "DELETE FROM normas WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $th) {
            throw $th;
        }
    }
}
