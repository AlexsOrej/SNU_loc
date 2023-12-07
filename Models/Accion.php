<?php

class Accion
{
    private $pdo;
    public $id;
    public $dato;
    public $analisis;
    public $accion;
    public $f_ejecucion;
    public $cargo_id;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Add(Accion $data)
    {
        try {
            $stm = "INSERT INTO accions(dato_id, analisis, accion, f_ejecucion, cargo_id  )
            VALUES(?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->dato_id,
                $data->analisis,
                $data->accion,
                $data->f_ejecucion,
                $data->cargo_id,
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Update(Accion $data)
    {
        print_r($data);
        try {
            $sql = "UPDATE accions SET  analisis='$data->analisis',accion='$data->accion', f_ejecucion='$data->f_ejecucion', cargo_id='$data->cargo_id'                          
                             WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetPlanAccion($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * 
            FROM  accions
            WHERE id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetPlanAccions()
    {
        try {
            //code...
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function GetAccionInd($indicador_id)
    {
        try {
            //code...
            $stm = $this->pdo->prepare("SELECT accions.* ,accions.id as accion_id, datos.id as dato_id, datos.fecha_aplicacion
            FROM  datos, accions
            WHERE datos.indicador_id=$indicador_id 
            AND accions.dato_id=datos.id
            ORDER BY datos.fecha_aplicacion ASC
            ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
