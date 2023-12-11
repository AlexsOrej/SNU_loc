<?php
class Norma
{

    private $pdo;
    public $id;
    public $version;
    public $fecha_publicacion;
    public $descripcion;
    public $ultima_actualizacion;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
            $this->verificarCrearTabla();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    private function verificarCrearTabla()
    {
        $tableName = 'normas';

        $sql = "SHOW TABLES LIKE :tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tableName', $tableName);
        $stmt->execute();

        $tableExists = $stmt->rowCount() > 0;

        if (!$tableExists) {
            // La tabla no existe, crea la tabla
            $this->crearTabla();
        }
    }

    private function crearTabla()
    {
        $sql = "CREATE TABLE normas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            version VARCHAR(255) NOT NULL,
            fecha_publicacion DATE NOT NULL,
            descripcion TEXT,
            ultima_actualizacion DATE
        )";

        $this->pdo->exec($sql);
    }

    public function Index()
    {
        try {
            $sql = 'SELECT * FROM normas';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    public function Registrar(Norma $data)
    {

        try {
            $sql = "INSERT INTO normas (version, fecha_publicacion, descripcion, ultima_actualizacion)
            VALUES (:version, :fechaPublicacion, :descripcion, :ultimaActualizacion)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':version', $data->version);
            $stmt->bindParam(':fechaPublicacion', $data->fecha_publicacion);
            $stmt->bindParam(':descripcion', $data->descripcion);
            $stmt->bindParam(':ultimaActualizacion', $data->ultima_actualizacion);
            $exito = $stmt->execute();
            if ($exito) {
                echo "La inserción se realizó correctamente.";
            } else {
                echo "Error en la inserción: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    public function Actualizar(Norma $data)
    {

        try {
            $sql = "UPDATE normas
            SET version = :version, fecha_publicacion = :fechaPublicacion, descripcion = :descripcion, ultima_actualizacion = :ultimaActualizacion
            WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $data->id);
            $stmt->bindParam(':version', $data->version);
            $stmt->bindParam(':fechaPublicacion', $data->fecha_publicacion);
            $stmt->bindParam(':descripcion', $data->descripcion);
            $stmt->bindParam(':ultimaActualizacion', $data->ultima_actualizacion);
            $exito = $stmt->execute();
            if ($exito) {
                echo "La Actualización se realizó correctamente.";
            } else {
                echo "Error en la actualización: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            print_r($e);
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
            $exito = $stmt->execute();
            if ($exito) {
                echo "La eliminación se realizó correctamente.";
            } else {
                echo "Error en la eliminacion: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $th) {
            print_r($th);
        }
    }
}
