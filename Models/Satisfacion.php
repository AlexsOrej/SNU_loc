<?php

class Satisfacion{

    private $pdo;
    public $id;
    public $respuesta_id;
    public $estado_cliente;
    public $sugerencia;
    public $created;
    public $modified;
    


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT
            respuestas.id AS res_id,
            respuestas.respuesta,
            respuestas.clasificacion_id,
            satisfacions.id AS sat_id,
            satisfacions.estado_cliente AS gradoSat,
            satisfacions.sugerencia,
            satisfacions.created
        FROM
            satisfacions,
            respuestas
        WHERE
            respuestas.pqrs_id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    

    public function AddSatisfacion (Satisfacion $data)
    {
        try {
            $sql = "INSERT INTO satisfacions (respuesta_id, estado_cliente,sugerencia,created,modified) 
		        VALUES (?,?,?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $data->respuesta_id,
                    $data->estado_cliente,
                    $data->sugerencia,
                    $data->created,
                    $data->modified                    
                )
            );
           
        } catch (Exception $e) {
            die($e->getMessage());
           
        }
    }
    public function EditSatisfacion (Satisfacion $data)
    {
        try {
            $sql = "UPDATE satisfacions SET sugerencia='$data->sugerencia'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
           
        }
    }



}