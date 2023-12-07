<?php

class Clasificacionriesgos
{
    private $pdo;
    public $id;
    public $nombre;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Clasificacionriesgos $data)
    {
        try {
            
           
            $query = "INSERT INTO `clasificacion_riesgo`(`nombre`) VALUES (:nombre)";
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':nombre', $data->nombre);
           

            $result = $statement->execute();


            if($result){
                echo "Clasificacion de riesgo registrada con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT `id`, `nombre` FROM `clasificacion_riesgo` order by id ASC;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT `id`, `nombre` FROM `clasificacion_riesgo`
            WHERE id= $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Clasificacionriesgos $data)
    {
        try {
            $query = "UPDATE `clasificacion_riesgo` SET `nombre`=:nombre WHERE id = :id";
            $statement = $this->pdo->prepare($query);

            $result = $statement->execute([
                ':nombre' => $data->nombre,
                ':id' => $data->id,
            ]);

            if($result){
                echo "Clasificacion de riesgo actualizado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try { 
            $sql="DELETE FROM `clasificacion_riesgo` WHERE id = $id";
            $stm = $this->pdo->prepare($sql);
            $result = $stm->execute();
            if($result){
                echo "Clasificación de riesgo eliminado con exito";
            }else{
                echo "ocurrio un error, intentelo de nuevo";
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
