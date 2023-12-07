<?php


class Roles
{

    private $pdo;
    public $id;
    public $rol;
    public $created;
    public $modified;

    public function __CONSTRUCT()
    {
        try {
           $this->pdo = Database::StartUp01();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Index()
    {
        try {
        if( $_SESSION['rol_id'] == 1 ){
           $stm = $this->pdo->prepare("SELECT * FROM rols");  
        }
        else{
            $stm = $this->pdo->prepare("SELECT * FROM rols WHERE id != 1");
        }
        

            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function AddEdit()
    {
    }
    public function Registrar($rol)
    {
              $created=date('Y-m-d');
              $modified=date('Y-m-d');
              try {

                $stm = "INSERT INTO rols(rol, created, modified )
                VALUES(?, ?, ?)";
                $this->pdo->prepare($stm)->execute(array($rol,$created,$modified));
            } catch (Exception $e) {
                die($e->getMessage());
            }

    }
    public function Actualizar($rol,$id)
    {
             
              $modified=date('Y-m-d');
              try {
                $sql = "UPDATE rols SET rol='$rol' , modified='$modified' WHERE id = $id";
                $this->pdo->prepare($sql)->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }

    }

    public function getRol($id)
    {
        try {
                $stm = $this->pdo->prepare("SELECT * FROM rols WHERE id=$id");
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }

    }
    public function Delete()
    {
    }
}
