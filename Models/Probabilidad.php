<?php

class Probabilidad
{
    private $pdo;
    public $id;
    public $nombre;
    public $valor;
   




    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Probabilidad $data)
    {
        try {
            
           
            $query = "INSERT INTO `probabilidad`(`nombre`, `valor`) VALUES (:nombre, :valor)";
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':nombre', $data->nombre);
            $statement->bindParam(':valor', $data->valor);

            $result = $statement->execute();


            if($result){
                echo "Probabilidad registrada con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT `id`, `nombre`, `valor` FROM `probabilidad` order by valor ASC;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT `id`, `nombre`, `valor` FROM `probabilidad`
            WHERE id= $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Probabilidad $data)
    {
        try {
            $query = "UPDATE `probabilidad` SET `nombre`=:nombre, `valor`=:valor WHERE id = :id";
            $statement = $this->pdo->prepare($query);

            $result = $statement->execute([
                ':nombre' => $data->nombre,
                ':valor' => $data->valor,
                ':id' => $data->id,
            ]);

            if($result){
                echo "Probabilidad actualizada con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try { 
            $sql="DELETE FROM `probabilidad` WHERE id = $id";
            $stm = $this->pdo->prepare($sql);
            $result = $stm->execute();
            if($result){
                echo "Probabilidad eliminada con exito";
            }else{
                echo "ocurrio un error, intentelo de nuevo";
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
