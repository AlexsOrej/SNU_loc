<?php

class Nivelriesgos
{
    private $pdo;
    public $id;
    public $nombre;
    public $descripcion;
    public $rango;
    public $rango2; 
    public $color ;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(NivelRiesgos $data)
    {
        try {
            
           
            $query = "INSERT INTO `nivel_riesgos`(`nombre`, `descripcion`, rango, rango2, color) VALUES (:nombre, :descripcion, :rango, :rango2, :color)";
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':nombre', $data->nombre);
            $statement->bindParam(':descripcion', $data->descripcion);
            $statement->bindParam(':rango', $data->rango);
            $statement->bindParam(':rango2', $data->rango2);
            $statement->bindParam(':color', $data->color);

            $result = $statement->execute();


            if($result){
                echo "Nivel de riesgo registrado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT `id`, `nombre`, `descripcion`, rango, rango2, color FROM `nivel_riesgos` order by id ASC;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT `id`, `nombre`, `descripcion`, rango, rango2, color FROM `nivel_riesgos`
            WHERE id= $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(NivelRiesgos $data)
    {
        try {
            $query = "UPDATE `nivel_riesgos` SET `nombre`=:nombre, `descripcion`=:descripcion, rango = :rango, rango2 = :rango2, color = :color  WHERE id = :id";
            $statement = $this->pdo->prepare($query);

            $result = $statement->execute([
                ':nombre' => $data->nombre,
                ':descripcion' => $data->descripcion,
                ':rango'=>$data->rango,
                ':rango2'=>$data->rango2,
                ':color'=>$data->color,
                ':id' => $data->id,
            ]);

            if($result){
                echo "Nivel de riesgo actualizado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try { 
            $sql="DELETE FROM `nivel_riesgos` WHERE id = $id";
            $stm = $this->pdo->prepare($sql);
            $result = $stm->execute();
            if($result){
                echo "Nivel de riesgo eliminado con exito";
            }else{
                echo "ocurrio un error, intentelo de nuevo";
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
