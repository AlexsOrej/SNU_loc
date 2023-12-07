<?php
//nombrar la clase
class Oferta
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $oferta;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp01();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Index()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  ofertas ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Add(Oferta $data)
    {
        try {

            $stm = "INSERT INTO ofertas(oferta)
            VALUES(?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->oferta,
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Oferta $data)
    {
        try {
            $sql = "UPDATE Ofertas SET oferta='$data->oferta' WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Getoferta($id)
    {

        try {

            $stm = $this->pdo->prepare("SELECT * FROM  ofertas  WHERE id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function Delete()
    {
        try {
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
