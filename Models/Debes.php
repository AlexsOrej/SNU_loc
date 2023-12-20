<?php
class Debes
{

    private $pdo;
    public $id;
    public $idnorma;
    public $numero;
    public $titulo;
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
        $tableName = 'debes';

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
        $sql = "CREATE TABLE debes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            idrequisito INT NOT NULL,
            numeral VARCHAR(50) NOT NULL,            
            descripcion TEXT,
            FOREIGN KEY (idrequisito) REFERENCES requisito(id)
        )";

        $this->pdo->exec($sql);
    }


    public function Index($id)
    {
        try {
            $sql = 'SELECT * FROM requisitos WHERE idNorma=:id';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function Registrar($requisitoid, $nuevosNumeros, $nuevosTitulos)
    {
        $sql = "INSERT INTO debes (idrequisito, numeral, descripcion) VALUES (:idrequisito, :numero, :titulo)";

        // Preparar la consulta una vez fuera del bucle
        $stmt = $this->pdo->prepare($sql);

        // Verificar si los arrays tienen la misma longitud
        if (count($nuevosNumeros) === count($nuevosTitulos)) {
            // Ejecutar la consulta con cada conjunto de datos
            for ($i = 0; $i < count($nuevosNumeros); $i++) {
                // Verificar si el número es numérico antes de ejecutar la consulta
                if (!empty($nuevosNumeros[$i])) {
                    // Asignar valores a los parámetros
                    $stmt->bindParam(':idrequisito', $requisitoid);
                    $stmt->bindParam(':numero', $nuevosNumeros[$i]);
                    $stmt->bindParam(':titulo', $nuevosTitulos[$i]);

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
    }

    public function ObtenerPorRequisito($idrequisito)
    {
        $sql = "SELECT * FROM debes WHERE idrequisito = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idrequisito);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Obtener($idSeccion)
    {
        $sql = "SELECT * FROM secciones WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idSeccion);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function Actualizar(Secciones $data)
    {
        $sql = "UPDATE secciones
                SET numero = :numero, titulo = :titulo
                WHERE id = :idSeccion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data->id);
        $stmt->bindParam(':numero', $data->numero);
        $stmt->bindParam(':titulo', $data->titulo);
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
