<?php
//nombrar la clase
class Postulacion
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $usuario_id;
    public $cargo_id;
    public $aplicacion;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Getpostulacion($cc)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT postulaciones.*, cargos.* 
            FROM  postulaciones, cargos  
            WHERE postulaciones.usuario_id=?
            AND postulaciones.cargo_id=cargos.id ");
            $stm->execute(array($cc));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}