<?php

class Meta
{
    private $pdo;
    public $id;
    public $indicador_id;
    public $comparativo;
    public $fecha_uso;
    public $valor;



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Add(Meta $data)
    {
        try {

            $stm = "INSERT INTO metas(indicador_id,comparativo, valor,fecha_uso)
            VALUES(?, ?, ?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->indicador_id,
                $data->comparativo,
                $data->valor,
                $data->fecha_uso
            ));
            $id_cliente = $this->pdo->lastInsertId();
            return $data->indicador_id;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Update(Meta $data)
    {
        try {
            $sql = "UPDATE metas SET             
                            comparativo='$data->comparativo',
                            valor='$data->valor'
                            WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
            return $data->indicador_id;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetMeta($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT * 
            FROM   metas
            WHERE  id='$id'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function GetMetas($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT * FROM  metas WHERE  indicador_id='$id'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function Quitar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM  metas WHERE id='$id'");
            $stm->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
