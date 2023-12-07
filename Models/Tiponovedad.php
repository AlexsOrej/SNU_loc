<?php


class Tiponovedad
{
    private $pdo;
    public $id;
    public $evento;
    public $tipo;



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
            $sql = "SELECT * FROM tipo_novedades";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Novedad()
    {
        try {
            $sql = "SELECT * FROM tipo_novedades WHERE tipo = 1 ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetTipo($id)
    {
        try {
            $sql = "SELECT * FROM tipo_novedades WHERE id='$id'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Tiponovedad $data)
    {
        try {
            $sql = "INSERT INTO `tipo_novedades` (`evento`,`tipo`) VALUES (?,?);";
            $stm = $this->pdo->prepare($sql)->execute(array($data->evento, $data->tipo));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Editar(Tiponovedad $data)
    {
        try {
            $sql = "UPDATE `tipo_novedades` SET `evento` = '$data->evento', tipo='$data->tipo' WHERE `tipo_novedades`.`id` = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
