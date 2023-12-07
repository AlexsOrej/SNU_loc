<?php

class tipoEjecucion
{
    private $pdo;
    public $id;
    public $nombre;
    public $descripcion;



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(tipoEjecucion $data)
    {
        try {
            
           
            $query = "INSERT INTO `clasificacion_riesgo`(`nombre`, descripcion) VALUES (:nombre, :descripcion)";
            $statement = $this->pdo->prepare($query);

            $statement->bindParam(':nombre', $data->nombre);
            $statement->bindParam(':descripcion', $data->descripcion);

           

            $result = $statement->execute();


            if($result){
                echo "Tipo ejecucion control registrado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT `id`, `nombre`, descripcion FROM `tipo_ejecucion_ctrl` order by id ASC;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT `id`, `nombre`, descripcion FROM `tipo_ejecucion_ctrl`
            WHERE id= $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(tipoEjecucion $data)
    {
        try {
            $query = "UPDATE `tipo_ejecucion_ctrl` SET `nombre`=:nombre, descripcion = :descripcion WHERE id = :id";
            $statement = $this->pdo->prepare($query);

            $result = $statement->execute([
                ':nombre' => $data->nombre,
                ':descripcion' => $data->descripcion,
                ':id' => $data->id,
            ]);

            if($result){
                echo "Tipo de ejecucion de control actualizado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try { 
            $sql="DELETE FROM `tipo_ejecucion_ctrl` WHERE id = $id";
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
