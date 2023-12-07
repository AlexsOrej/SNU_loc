<?php

class Indicador
{
    private $pdo;
    public $id;
    public $indicador_id;
    public $proceso_id;
    public $formula_id;
    public $nombre;
    public $cargo_id;
    public $definicion;
    public $interpretacion;
    public $periodicidad;
    public $fecha_control;
    public $tipo;
    public $comparativo;
    public $valor;
    public $meta;
    public $num_meta;



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Index()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT indicadors.*, indicadors.id as i_id, modelos.*, procesos.NombreProceso
            FROM indicadors ,modelos, procesos
            WHERE indicadors.formula_id=modelos.id
            AND  indicadors.proceso_id=procesos.id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetByProceso()
    {
        $id_proceso = $_REQUEST['procesos'];
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT indicadors.*, indicadors.id as i_id, modelos.*, procesos.NombreProceso
            FROM indicadors ,modelos, procesos
            WHERE indicadors.formula_id=modelos.id
            AND  indicadors.proceso_id=procesos.id 
            AND  indicadors.proceso_id=$id_proceso");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Categoriaevento()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  categoriaeventos ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Add(Indicador $data)
    {
        try {
            // print_r($data);
            $stm = "INSERT INTO indicadors(proceso_id, formula_id,nombre,cargo_id,definicion,interpretacion,periodicidad,meta,num_meta,fecha_control, tipo)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->proceso_id,
                $data->formula_id,
                $data->nombre,
                $data->cargo_id,
                $data->definicion,
                $data->interpretacion,
                $data->periodicidad,
                $data->meta,
                $data->num_meta,
                $data->fecha_control,
                $data->tipo,
            ));
            return $id_indicador = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Update(Indicador $data)
    {
        // print_r($data);        
        // exit();
        try {
            $sql = "UPDATE indicadors SET             
                            proceso_id='$data->proceso_id',
                            formula_id='$data->formula_id',
                            nombre='$data->nombre',
                            cargo_id= '$data->cargo_id',
                            definicion= '$data->definicion',
                            interpretacion= '$data->interpretacion',
                            periodicidad= '$data->periodicidad',
                            fecha_control= '$data->fecha_control',
                            tipo= '$data->tipo',
                            num_meta= '$data->num_meta',
                            meta= '$data->meta'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetIndicador($id)
    {

        try {

            $stm = $this->pdo->prepare("SELECT indicadors.*, indicadors.id as indicador_id,procesos.*, procesos.id as proceso_id , modelos.*, modelos.id as modelo_id
            FROM   indicadors, procesos, modelos 
            WHERE 
            indicadors.id='$id'
            AND 
            indicadors.proceso_id= procesos.id
            AND
            indicadors.formula_id= modelos.id");
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function IndicadorNombre()
    {
        $proceso_id = isset($_REQUEST['procesos']) ? $_REQUEST['procesos'] : 0;
        $sql = "SELECT indicadors.nombre, id, periodicidad FROM indicadors";
        if ($proceso_id != 0) {
            $sql .= " WHERE proceso_id = ?";
        }
        try {
            $stm = $this->pdo->prepare($sql);
            if ($proceso_id != 0) {
                $stm->bindParam(1, $proceso_id, PDO::PARAM_INT);
            }
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return false;
        }
    }
    public function IndicadorDato()
    {

        try {

            if (!isset($_REQUEST['desde']) or !isset($_REQUEST['hasta'])) {
                $sql = "SELECT  datos.*,metas.comparativo, CONCAT(metas.comparativo,' ',metas.valor) AS meta, metas.valor as metaV
                FROM datos, metas WHERE datos.meta_id=metas.id            
                ORDER BY fecha_aplicacion DESC";
            } else {
                $desde = $_REQUEST['desde'];
                $hasta = $_REQUEST['hasta'];
                $sql = "SELECT  datos.*,metas.comparativo, CONCAT(metas.comparativo,' ',metas.valor) AS meta, metas.valor as metaV
                FROM datos, metas 
                WHERE datos.meta_id=metas.id
                AND fecha_aplicacion BETWEEN '$desde' AND '$hasta' 
                ORDER BY fecha_aplicacion DESC";
            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtenerIndicadores($proceso_id = null, $desde = null, $hasta = null)
    {
        try {
            $sql = "SELECT indicadors.nombre, indicadors.id AS indicador_id, periodicidad,
                    datos.*, metas.comparativo, CONCAT(metas.comparativo, ' ', metas.valor) AS meta, metas.valor as metaV
                    FROM indicadors
                    LEFT JOIN datos ON indicadors.id = datos.indicador_id
                    LEFT JOIN metas ON datos.meta_id = metas.id";

            if (!empty($proceso_id)) {
                $sql .= " WHERE indicadors.proceso_id = :proceso_id";
            }

            if (!empty($desde) && !empty($hasta)) {
                $sql .= " AND datos.fecha_aplicacion BETWEEN :desde AND :hasta";
            }

            $stm = $this->pdo->prepare($sql);

            if (!empty($proceso_id)) {
                $stm->bindParam(':proceso_id', $proceso_id);
            }

            if (!empty($desde) && !empty($hasta)) {
                $stm->bindParam(':desde', $desde);
                $stm->bindParam(':hasta', $hasta);
            }

            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Delete()
    {
        try {
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**perfil */
    public function IndicadorPorPersona($id)
    {
        $sql = "SELECT i.*
        FROM indicadors i
        JOIN normalizacion_snu.usuarios ns ON ns.cargo_id = i.cargo_id
        WHERE ns.id =:id";
        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    /**perfil */
}
