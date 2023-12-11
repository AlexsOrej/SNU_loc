<?php

class Requisito
{
    private $pdo;
    public $id;
    public $idSeccion;
    public $numero;
    public $descripcion;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function crear(Requisito $data)
    {
        $sql = "INSERT INTO requisitos (idSeccion, numero, descripcion)
                VALUES (:idSeccion, :numero, :descripcion)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idSeccion', $idSeccion);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function obtener($idRequisito)
    {
        $sql = "SELECT * FROM requisitos WHERE id = :idRequisito";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idRequisito);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($idRequisito, $numero, $descripcion)
    {
        $sql = "UPDATE Requisitos
                SET numero = :numero, descripcion = :descripcion
                WHERE idRequisito = :idRequisito";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idRequisito', $idRequisito);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function eliminar($idRequisito)
    {
        $sql = "DELETE FROM requisitos WHERE idRequisito = :idRequisito";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idRequisito', $idRequisito);

        return $stmt->execute();
    }
}
