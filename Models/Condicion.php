<?php


class Condicion
{

    private $pdo;
    public $id;
    public $clasificacionIncidente;
    public $proctipoIncidenteeso_id;
    public $correcionIncidente;
    public $fechaRegistro;
    public $usuario;



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetCondicion($clasificacion)
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare(" SELECT tipoIncidente, id  FROM tb_condiciones WHERE clasificacionIncidente='$clasificacion' ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
