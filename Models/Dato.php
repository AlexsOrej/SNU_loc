<?php


class Dato
{
    private $pdo;
    public $id;
    public $indicador_id;
    public $meta_id;
    public $fecha_aplicacion;

    public $expresion;

    public $resultado;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Add(Dato $data)
    {
        try {
            $stm = "INSERT INTO datos(indicador_id, meta_id, fecha_aplicacion, expresion, resultado  )
            VALUES(?, ?, ?, ?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->indicador_id,
                $data->meta_id,
                $data->fecha_aplicacion,
                $data->expresion,
                $data->resultado,
            ));
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Update(Dato $data)
    {
        // print_r($data);
        //exit();
        try {
            $sql = "UPDATE datos SET  fecha_aplicacion='$data->fecha_aplicacion', meta_id='$data->meta_id', expresion='$data->expresion',resultado='$data->resultado'  WHERE id = $data->dato_id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetDato($id)
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT * 
            FROM  datos
            WHERE datos.id=$id 
            ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            //throw $th;
            die($e->getMessage());
        }
    }
    public function GetDatos($indicador_id)
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT datos.* ,datos.id as datoid, metas.id as meta_id, metas.*
            FROM  datos, metas
            WHERE datos.indicador_id=$indicador_id 
            AND metas.id=datos.meta_id
            ORDER BY fecha_aplicacion ASC ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            //throw $th;
            die($e->getMessage());
        }
    }
    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `datos` WHERE  id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
