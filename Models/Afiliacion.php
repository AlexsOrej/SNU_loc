<?php
//nombrar la clase
class Afiliacion
{
    // crear los atributos poner los mismo nombre de la tb
    private $pdo; // atributo de la conexion a bd
    public $id;
    public $usuario_id;
    public $eps;
    public $arl;
    public $fondo;
    public $afiliacion_fecha;
    public $caja;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Index($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  afiliaciones WHERE usuario_id='$id' ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Arl()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.ssocial WHERE tipo='ARL'  ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Eps()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.ssocial WHERE tipo='EPS'  ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Afp()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.ssocial WHERE tipo='AFP'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Caja()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.ssocial WHERE tipo='CCF' ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Para()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.ssocial WHERE tipo='CCF' ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM afiliaciones WHERE id = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM afiliaciones WHERE id = ?");
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Afiliacion $data)
    {
        $user =   $data->usuario_id;
        $eps =   $data->eps;
        $arl =   $data->arl;
        $fondo =   $data->fondo;
        $af =   $data->afiliacion_fecha;
        $caja =   $data->caja;
        $id = $data->id;

        try {
            $sql = "UPDATE afiliaciones SET eps='$eps' ,arl='$arl' ,fondo='$fondo' ,afiliacion_fecha='$af' ,caja='$caja'  WHERE id = '$id'";

            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Afiliacion $data)
    {

        try {
            $sql = "INSERT INTO afiliaciones (usuario_id,eps,arl,fondo,afiliacion_fecha,caja) 
		        VALUES (?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->usuario_id,
                        $data->eps,
                        $data->arl,
                        $data->fondo,
                        $data->afiliacion_fecha,
                        $data->caja

                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
