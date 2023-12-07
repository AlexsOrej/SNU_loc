<?php
//nombrar la clase
class Tipocontrato
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $nombre; //atributo del objeto
    public $contenido; //atributo del objeto
   

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
            $stm = $this->pdo->prepare("SELECT * FROM tipo_contratos");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    
    public function Listar($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM tipo_contratos WHERE id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function Add(Tipocontrato $data)
    {
        try {

            $stm = "INSERT INTO tipo_contratos(nombre, contenido)
            VALUES(?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->nombre,                
                $data->contenido              
            ));
            $id_contrato = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Tipocontrato $data)
    {
        try {
            $sql = "UPDATE  tipo_contratos SET nombre='$data->nombre',contenido='$data->contenido' WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ComprobarEliminacion($id){
        try{
            $sql = "SELECT count(*) as contratos FROM `persona_contratos` WHERE tipo_contrato = $id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();

        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `tipo_contratos` WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
