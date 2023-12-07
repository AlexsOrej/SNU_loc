<?php

class Satisfacion01{

    private $pdo;
    public $id;
    public $respuesta_id;
    public $empresa_id;
    public $estado_cliente;
    public $sugerencia;
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

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT            
            satisfacions.id AS sat_id,
            satisfacions.estado_cliente AS gradoSat,
            satisfacions.sugerencia,
            satisfacions.created
        FROM
            satisfacions            
        WHERE
            respuesta_id = ? 
        AND 
            empresa_id=?
            ");
            $stm->execute(array($id,$_SESSION['datos_cliente']->id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    

    public function AddSatisfacion (Satisfacion01 $data)
    {
        try {
            $sql = "INSERT INTO satisfacions (respuesta_id,empresa_id, estado_cliente,sugerencia,created,modified) 
		        VALUES (?,?,?,?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $data->respuesta_id,
                    $data->empresa_id,
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
    public function EditSatisfacion (Satisfacion01 $data)
    {
        try {
            $sql = "UPDATE satisfacions SET sugerencia='$data->sugerencia'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
           
        }
    }



}