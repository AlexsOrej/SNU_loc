<?php
class Seccion
{

    private $pdo;
    public $id;
    public $idNorma;
    public $numero;
    public $titulo;
    public $descripcion;

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
            $sql = 'SELECT * FROM secciones';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return false;
        }
    }
    public function Crear(Seccion $data)
    {
        $sql = "INSERT INTO secciones (idNorma, numero, titulo, descripcion)
                       VALUES (:idNorma, :numero, :titulo, :descripcion)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idNorma', $idNorma);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function Obtener($idSeccion)
    {
        $sql = "SELECT * FROM secciones WHERE id = :idSeccion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idSeccion);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function Actualizar(Seccion $data)
    {
        $sql = "UPDATE secciones
                SET numero = :numero, titulo = :titulo, descripcion = :descripcion
                WHERE id = :idSeccion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idSeccion);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function Eliminar($id)
    {
        $sql = "DELETE FROM secciones WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idSeccion', $id);
        return $stmt->execute();
    }
}
