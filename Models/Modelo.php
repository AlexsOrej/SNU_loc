<?php


class Modelo
{

    private $pdo;
    public $id;
    public $formula;
    



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetFormula()
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare(" SELECT * FROM modelos ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
