<?php
//nombrar la clase
class Categoria
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $nombre; //atributo del objeto
    public $codigo; //atributo del objeto
    public $vidautil; //atributo del objeto
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
            $stm = $this->pdo->prepare("SELECT * FROM  categorias ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Categoria()
    {
        try {
            $id = $_REQUEST['id'];
            $stm = $this->pdo->prepare("SELECT * FROM  categorias WHERE id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Add(Categoria $data)
    {
        try {

            $stm = "INSERT INTO categorias(nombre, codigo, vidautil, created, modified)
            VALUES(?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->nombre,
                $data->codigo,
                $data->vidautil,
                $data->created,
                $data->modified,
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Categoria $data)
    {
        try {
            $sql = "UPDATE categorias SET nombre='$data->nombre', codigo='$data->codigo', vidautil='$data->vidautil',modified='$data->modified'
                  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `categorias` WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ValDelete($id)
    {
        try {
            $sql = "SELECT COUNT(id) as cantidad FROM `productos` WHERE categoria_id = $id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $respuesta = $stm->fetch(PDO::FETCH_OBJ);         
            return $respuesta->cantidad;           
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}
