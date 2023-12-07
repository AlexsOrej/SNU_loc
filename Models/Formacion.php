<?php
//nombrar la clase
class App
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $proceso; //atributo del objeto


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
            $stm = $this->pdo->prepare("SELECT * FROM  usuarios ");
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

    public function Add(Mantenimiento $data)
    {
        try {

            $stm = "INSERT INTO tb_proceso_noconformes(proceso, cargo_id, TbCondiciones_id, descEvento, lugarEvento,                
                        estado, fechaRegistro, fechaValidacion, respuesta, usuario,observacion_1, observacion, fechaRespuesta, num_accion_corr )
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->proceso,
                $data->cargo_id,
                $data->TbCondiciones_id,
                $data->descEvento,
                $data->lugarEvento,
                $data->estado,
                $data->fechaRegistro,
                $data->fechaValidacion,
                $data->respuesta,
                $data->usuario,
                $data->observacion_1,
                $data->observacion,
                $data->fechaRespuesta,
                $data->num_accion_corr,
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Mantenimiento $data)
    {
        try {
            $sql = "UPDATE tb_proceso_noconformes SET nombre='$data->nombre', direccion='$data->direccion', telefono='$data->telefono',
                correos='$data->correos', salario='$data->salario', matriz='$data->matriz', fechainicio='$data->fechainicio',
                rector='$data->rector'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function RespuestaEdit(Mantenimiento $data)
    {
        try {
            $sql = "UPDATE  tb_proceso_noconformes SET estado='$data->estado', fechaRespuesta='$data->fechaRespuesta', conciliacion='$data->conciliacion',
                taccion='$data->taccion', respuesta='$data->respuesta', num_accion_corr='$data->num_accion_corr' , 	fechaValidacion='$data->fechaValidacion', observacion='$data->observacion', observacion1='$data->observacion1'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function GetAutoreporte($campo, $valor)
    {

        try {

            $stm = $this->pdo->prepare("SELECT  tb_proceso_noconformes.*,tb_condiciones.* , tb_proceso_noconformes.usuario as user, tb_proceso_noconformes.id as id1
            FROM  tb_proceso_noconformes, tb_condiciones 
            WHERE 
             $campo='$valor'
             AND
             tb_proceso_noconformes.TbCondiciones_id=tb_condiciones.id
                
           ");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function GetAutorep($id)
    {

        try {

            $stm = $this->pdo->prepare("SELECT  tb_proceso_noconformes.*,tb_condiciones.* , tb_proceso_noconformes.usuario as user, tb_proceso_noconformes.id as id1 
            FROM  tb_proceso_noconformes, tb_condiciones 
            WHERE 
            tb_proceso_noconformes.id='$id'
             AND
             tb_proceso_noconformes.TbCondiciones_id=tb_condiciones.id           
            ");
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }

    public function Recurrente($pro, $cond)
    {
        try {

            $stm = $this->pdo->prepare("SELECT COUNT(tb_proceso_noconformes.id) AS cantidad
            FROM  tb_proceso_noconformes
            WHERE 
            tb_proceso_noconformes.proceso='$pro'
             AND
             tb_proceso_noconformes.TbCondiciones_id='$cond'           
            ");
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
