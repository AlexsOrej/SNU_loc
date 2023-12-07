<?php
//nombrar la clase
class Seleccion
{

    private $pdo; // atributo de la conexion a bd

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Postulados()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM  personal where rol_id = 1 ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ImportarPersonas($cliente_id)
    {
        try {

        $sql1 = "ALTER TABLE `personal`
          MODIFY COLUMN `Sexo`   VARCHAR(10) NULL,
          MODIFY COLUMN `expedicion`  VARCHAR(50) NULL,           
          MODIFY COLUMN `LugarNacimiento`  VARCHAR(50) NULL,           
          MODIFY COLUMN `FechaNacimiento`  DATE NULL,           
          MODIFY COLUMN `telefono_fijo`  VARCHAR(50) NULL,           
          MODIFY COLUMN `celular`  VARCHAR(50) NULL,           
          MODIFY COLUMN `estado_civil`  VARCHAR(255) NULL,           
          MODIFY COLUMN `nom_contacto_emergencia`  VARCHAR(50) NULL,           
          MODIFY COLUMN `ciudad_recidencia`  VARCHAR(50) NULL,           
          MODIFY COLUMN `estrato`  VARCHAR(50) NULL,           
          MODIFY COLUMN `nivel_educativo`  VARCHAR(50) NULL,           
          MODIFY COLUMN `profesion`  VARCHAR(50) NULL,           
          MODIFY COLUMN `rh`  VARCHAR(50) NULL,
          ADD UNIQUE INDEX (`cedula`)";
            $this->pdo->prepare($sql1)->execute();


            $sql = "INSERT INTO personal (nombre, apellidos, correo, rol_id, cedula, FechaRegistro, estado)
        SELECT nombres, apellidos, email, 1, identificacion, created, estado
        FROM normalizacion_snu.usuarios 
        WHERE cliente_id = $cliente_id and rol_id !=4 and estado=1
        ON DUPLICATE KEY UPDATE 
            nombre = VALUES(nombre), 
            apellidos = VALUES(apellidos), 
            correo = VALUES(correo), 
            rol_id = VALUES(rol_id), 
            FechaRegistro = VALUES(FechaRegistro), 
            estado = VALUES(estado);";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Quitar($id){
            try {
                $sql="DELETE FROM personal WHERE id=:id";
                $stmt = $this->pdo->prepare($sql);   
                $stmt->bindParam(':id', $id);
                return ($stmt -> execute()) ? true : false;
            } catch (Throwable $th) {
                Throw $th;
            }
    }
}
