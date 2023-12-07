<?php

class Proceso 
{
    private $pdo;
    public $id;
    public $Iniciales;
    public $NombreProceso;
    public $tipo;
    public $cod_int;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

     public function getProceso0()
     {
        $usuario_id=$_SESSION['user']->user_id;
        try {
            $sql = "SELECT * FROM procesos";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($usuario_id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
     }

     public function getProceso()
     {
        $usuario_id=$_SESSION['user']->user_id;
        try {
            $sql = "SELECT procesos.* 
                    FROM procesos 
                    INNER JOIN usuario_proceso ON procesos.id = usuario_proceso.proceso_id 
                    WHERE usuario_proceso.usuario_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($usuario_id));
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
     }
     
     public function getProcesos($id)
     {
             try {
                $result = array();
                $stm = $this->pdo->prepare("SELECT * FROM  procesos WHERE id=$id");
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
     }

     public function getProcesosALL()
     {
             try {
                $result = array();
                $stm = $this->pdo->prepare("SELECT * FROM  procesos");
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (Exception $e) {
                die($e->getMessage());
            }
     }

     public function Index()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM rols");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    
    public function Add(Proceso $data)
    {
     try {

         $stm = "INSERT INTO procesos (Iniciales, NombreProceso, tipo, cod_int )
         VALUES(?,?,?,?)";
         $this->pdo->prepare($stm)->execute(array(
             $data->Iniciales,
             $data->NombreProceso,                
             $data->tipo=0,
             $data->cod_int='P0',
          ));
         $id = $this->pdo->lastInsertId();
     } catch (Exception $e) {
         die($e->getMessage());
     }
    }


    public function Edit(Proceso $data)
 {
     try {
         $sql = "UPDATE procesos SET Iniciales='$data->Iniciales', NombreProceso='$data->NombreProceso'  WHERE id = $data->id";
         $this->pdo->prepare($sql)->execute();
     } catch (Exception $e) {
         die($e->getMessage());
     }
 }
 public function Delete($id)
 {
     try {
         $sql = "DELETE FROM `procesos` WHERE  id = $id";
         $this->pdo->prepare($sql)->execute();

     } catch (Exception $e) {
         die($e->getMessage());
     }
 }

     

    }

