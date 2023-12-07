<?php

class Riesgos
{
    private $pdo;
    public $id;	
    public $nombre;	
    public $clasificacion;
    public $impacto;	
    public $probabilidad;	
    public $nivel_riesgo;
    public $proceso;	
    public $descripcion;	
    public $fecha_registro;	
    public $usuario_registro;




    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Riesgos $data)
    {
        try {
            $query = "INSERT INTO `riesgos`(`nombre`, `clasificacion_id`, `impacto_id`, `probabilidad_id`, `nivel_riesgo_id`, `proceso_id`, `descripcion`, `fecha_registro`, `usuario_registro`) 
            VALUES (:nombre,
                    :clasificacion_id,
                    :impacto_id,
                    :probabilidad_id,
                    :nivel_riesgo_id,
                    :proceso_id,
                    :descripcion,
                    :fecha_registro,
                    :usuario_registro)";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':nombre', $data->nombre);
            $statement->bindParam(':clasificacion_id', $data->clasificacion);
            $statement->bindParam(':impacto_id', $data->impacto);
            $statement->bindParam(':probabilidad_id', $data->probabilidad);
            $statement->bindParam(':nivel_riesgo_id', $data->nivel_riesgo);
            $statement->bindParam(':proceso_id', $data->proceso);
            $statement->bindParam(':descripcion', $data->descripcion);
            $statement->bindParam(':fecha_registro', $data->fecha_registro);
            $statement->bindParam(':usuario_registro', $data->usuario_registro);

            $result = $statement->execute();


            if($result){
                echo "Riesgo registrado con exito";
            }else{
                echo "Ocurrio un error, intentelo de nuevo";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultar(){
        try { 
            $sql="SELECT riesgos.nombre as riesgo, riesgos.id as riesgo_id, riesgos.impacto_id, riesgos.probabilidad_id, riesgos.nivel_riesgo_id as nivel_riesgo, procesos.NombreProceso, riesgos.usuario_registro, riesgos.fecha_registro, clasificacion_riesgo.nombre as clasificacion, riesgos.descripcion, impactos.valor as valorImpacto, probabilidad.valor as valorProbabilidad
            FROM riesgos
            JOIN clasificacion_riesgo ON riesgos.clasificacion_id = clasificacion_riesgo.id
            JOIN procesos ON riesgos.proceso_id = procesos.id
            JOIN impactos On riesgos.impacto_id = impactos.id
            JOIN probabilidad On riesgos.probabilidad_id = probabilidad.id;";

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function consultarPorId($id){
        try { 
            $sql="SELECT riesgos.nombre as riesgo, riesgos.id as riesgo_id, riesgos.impacto_id, riesgos.probabilidad_id, riesgos.nivel_riesgo_id as nivel_riesgo, procesos.NombreProceso, riesgos.usuario_registro, riesgos.fecha_registro, clasificacion_riesgo.nombre as clasificacion, riesgos.descripcion, impactos.valor as valorImpacto, probabilidad.valor as valorProbabilidad
            FROM riesgos
            JOIN clasificacion_riesgo ON riesgos.clasificacion_id = clasificacion_riesgo.id
            JOIN procesos ON riesgos.proceso_id = procesos.id
            JOIN impactos On riesgos.impacto_id = impactos.id
            JOIN probabilidad On riesgos.probabilidad_id = probabilidad.id
            Where riesgos.id = $id;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Riesgos $data)
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
