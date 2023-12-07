<?php
//nombrar la clase
class Traslado
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $ubicacion_id;
    public $producto_id;
    public $user_id;
    public $observacion;
    public $created;
    public $modified;
    public $sede_id; //atributo del objeto


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
            $stm = $this->pdo->prepare("SELECT * FROM  traslados ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Xid($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  traslados WHERE  id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SedesUbicacion()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT sedes.id as sede_id, sedes.nombre as nomSede, ubicacions.id as ubicacion_id, ubicacions.nombre as nomUbicacion 
            FROM  sedes,ubicacions 
            WHERE  sedes.id=ubicacions.sede_id
            ORDER BY sedes.id  ASC, ubicacions.id ASC");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Xubicacion($ubicacion_id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  traslados WHERE  ubicacion_id=$ubicacion_id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Xproducto($producto_id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  traslados WHERE  producto_id=$producto_id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Add(Traslado $data)
    {
        try {

            $stm = "INSERT INTO `traslados`(`ubicacion_id`, `producto_id`, `user_id`, `observacion`, `created`, `modified`) VALUES (?,?,?,?,?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->ubicacion_id,
                $data->producto_id,
                $data->user_id,
                $data->observacion,
                $data->created,
                $data->modified,

            ));
            $id_cliente = $this->pdo->lastInsertId();

            try {
                $sql = "UPDATE productos SET sede_id='$data->sede_id', ubicacion_id='$data->ubicacion_id'  WHERE id = $data->producto_id";
                $this->pdo->prepare($sql)->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Traslado $data)
    {
        try {
            $sql = "UPDATE `traslados` SET `ubicacion_id`=$data->ubicacion_id,`producto_id`=$data->producto_id,`user_id`=$data->user_id,`observacion`='$data->observacion',`modified`='$data->modified'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `traslados` WHERE $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
