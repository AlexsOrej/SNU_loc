<?php
//nombrar la clase
class Ubicacion
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $nombre; //atributo del objeto
    public $sede_id; //atributo del objeto
    public $created; //atributo del objeto
    public $modified; //atributo del objeto


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
            $result = array();
            $stm = $this->pdo->prepare("SELECT ubicacions.* , sedes.nombre as sede 
                                        FROM  ubicacions,sedes
                                        WHERE ubicacions.sede_id=sedes.id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Ubicacion()
    {
        try {
            $id = $_REQUEST['id'];
            $stm = $this->pdo->prepare("SELECT * FROM  ubicacions WHERE id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function UbicacionxSede()
    {
        try {
            $id = $_REQUEST['sede_id'];
            $stm = $this->pdo->prepare("SELECT * FROM  ubicacions WHERE sede_id=$id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Add(Ubicacion $data)
    {
        try {

            $stm = "INSERT INTO ubicacions(nombre, sede_id, created, modified)
            VALUES(?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->nombre,
                $data->sede_id,                
                $data->created,
                $data->modified,
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Ubicacion $data)
    {
        try {
            $sql = "UPDATE ubicacions SET nombre='$data->nombre', sede_id='$data->sede_id',modified='$data->modified'
                  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `ubicacions` WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ValDelete($id)
    {
        try {
            $sql = "SELECT COUNT(id) as cantidad FROM `productos` WHERE ubicacion_id = $id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $respuesta = $stm->fetch(PDO::FETCH_OBJ);         
            return $respuesta->cantidad;           
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
