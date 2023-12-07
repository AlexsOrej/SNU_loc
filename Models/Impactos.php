<?php

class Impactos
{
    private $pdo;
    public $id;
    public $nombre;
    public $valor;
    public $afectacion;
    public $afectacion_economica; 
    public $afectacion_reputacional; 
  




    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Impactos $data)
    {
        try {
            
            // $stm = "INSERT INTO accions(dato_id, analisis, accion, f_ejecucion, cargo_id  )
            // VALUES(?, ?, ?, ?, ?)";
            $stm="INSERT INTO `impactos`(`nombre`, `valor`, `afectacion`, `afectacion_economica`, `afectacion_reputacional`) 
            VALUES (?,?,?,?,?)";
           $result =  $this->pdo->prepare($stm)->execute(array(
                $data->nombre,
                $data->valor,
                $data->afectacion,
                $data->afectacion_economica,
                $data->afectacion_reputacional,
            ));

            if($result){
                echo "Impacto registrado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT `id`, `nombre`, `valor`, `afectacion`, `afectacion_economica`, `afectacion_reputacional` FROM `impactos` order by valor ASC;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT `id`, `nombre`, `valor`, `afectacion`, `afectacion_economica`, `afectacion_reputacional` FROM `impactos`
            WHERE id= $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Impactos $data)
    {
        try {
            $stm="UPDATE `impactos` SET
             `nombre`=:nombre,`valor`=:valor,
             `afectacion`=:afectacion,
             `afectacion_economica`=:afectacion_economica,
             `afectacion_reputacional`=:afectacion_reputacional 
            WHERE id = :id";
            $result = $this->pdo->prepare($stm)->execute(array(
                ':nombre' => $data->nombre,
                ':valor' => $data->valor,
                ':afectacion' => $data->afectacion,
                ':afectacion_economica' => $data->afectacion_economica,
                ':afectacion_reputacional' => $data->afectacion_reputacional,
                ':id' => $data->id,
            ));

            if($result){
                echo "Impacto Actualizado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try { 
            $sql="DELETE FROM `impactos` WHERE id = $id";
            $stm = $this->pdo->prepare($sql);
            $result = $stm->execute();
            if($result){
                echo "impacto eliminado con exito";
            }else{
                echo "ocurrio un error, intentelo de nuevo";
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
