<?php

class Respuesta
{
    private $pdo;
    public $id;
    public $pqrs_id;
    public $accion;
    public $clasificacion_id;
    public $estado;
    public $soporte;
    public $respuesta;
    public $proceso_id;
    public $fecha;
    public $usuario;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function AddRespuesta(Respuesta $data)
    {
        try {
            $sql = "INSERT INTO respuestas (pqrs_id, proceso_id,accion,respuesta,clasificacion_id, estado ,soporte,fecha, usuario) 
		        VALUES (?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($sql)->execute(
                array(
                    $data->pqrs_id,
                    $data->proceso_id,
                    $data->accion,
                    $data->respuesta,
                    $data->clasificacion_id,
                    $data->estado,
                    $data->soporte,
                    date("Y-m-d h:i:s"),
                    $data->usuario
                )
            );
            $sql0 = "UPDATE normalizacion_snu.pqrs SET estado='$data->estado', tipo_peticion='$data->clasificacion_id',identificacion=$data->identificacion  WHERE id = $data->pqrs_id";
            $this->pdo->prepare($sql0)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Valrespuesta($data)
    {
        try {
            $sql = "UPDATE respuestas SET
              proceso_id='$data->proceso_id',              
              accion='$data->accion',
              respuesta='$data->respuesta',
              clasificacion_id='$data->clasificacion_id'
              WHERE id = $data->respuesta_id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT respuestas.*, pqrs.url, segmentos. nombre as segmento 
            FROM respuestas,segmentos ,normalizacion_snu.pqrs 
            WHERE pqrs_id = ?
            AND  pqrs.id=respuestas.pqrs_id
            AND respuestas.accion=segmentos.id
            ");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function CerrarRespuesta($res_id)
    {
        try {
           $res = "UPDATE respuestas SET  estado='cerrado' WHERE id = '$res_id'";
            $this->pdo->prepare($res)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
