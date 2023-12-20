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
            $this->verificarCrearTabla();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    private function verificarCrearTabla()
    {
        $tableName = 'requisitos';

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
        $sql = "CREATE TABLE requisitos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            idseccion INT NOT NULL,
            numero INT NOT NULL,            
            descripcion TEXT,
            FOREIGN KEY (idseccion) REFERENCES secciones(id)
        )";

        $this->pdo->exec($sql);
    }



    public function Registrar($seccionid, $nuevosNumeros, $nuevosTitulos)
    {
print_r($seccionid);
print_r($nuevosNumeros);
print_r($nuevosTitulos);
        try {
            $sql = "INSERT INTO requisitos (idseccion, numero, descripcion)
                VALUES (:idSeccion, :numero, :descripcion)";

            $stmt = $this->pdo->prepare($sql);

            // Verificar si los arrays tienen la misma longitud
            if (count($nuevosNumeros) === count($nuevosTitulos)) {
                // Ejecutar la consulta con cada conjunto de datos
                for ($i = 0; $i < count($nuevosNumeros); $i++) {
                    // Verificar si el número es numérico antes de ejecutar la consulta
                    if (!empty($nuevosNumeros[$i])) {
                        // Asignar valores a los parámetros
                        $stmt->bindParam(':idSeccion', $seccionid);
                        $stmt->bindParam(':numero', $nuevosNumeros[$i]);
                        $stmt->bindParam(':descripcion', $nuevosTitulos[$i]);
                        // Ejecutar la consulta
                        $stmt->execute();                        
                    } else {
                        // Ignorar el conjunto de datos si el número no es numérico
                        continue;
                    }
                }
            } else {
                // Manejar el caso cuando los arrays no tienen la misma longitud
                echo json_encode(['error' => 'Los arrays no tienen la misma longitud']);
                exit();
            }
        } catch (PDOException $th) {
            throw $th;
        }
    }

    public function ObtenerPorSeccion($idSeccion)
    {
        $sql = "SELECT * FROM requisitos WHERE idseccion = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idSeccion);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Obtener($idRequisito)
    {
        $sql = "SELECT * FROM requisitos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idRequisito);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
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

    /**ASOCIAR  REQUISITOS AL PLAN */

    public function Asociar($idPlan,$idRequisito){
        $sql="INSERT INTO requisitoplan ( idRequisito, idPlan) values(:idRequisito, :idPlan)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idRequisito', $idRequisito);
        $stmt->bindParam(':idPlan', $idPlan);
        $stmt->execute();
        return "Requisito asociado con exito";
    }
    public function DesAsociar($idPlan,$idRequisito){
        $sql="DELETE FROM requisitoplan  WHERE  idRequisito=:idRequisito AND idPlan=:idPlan";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idRequisito', $idRequisito);
        $stmt->bindParam(':idPlan', $idPlan);
        $stmt->execute();
        return "Requisito Desasociado con exito";

    }
}
