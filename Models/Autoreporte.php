<?php

class Autoreporte
{
    private $pdo;
    public $proceso;
    public $cargo_id;
    public $TbCondiciones_id;
    public $descEvento;
    public $lugarEvento;
    public $estado;
    public $fechaRegistro;
    public $fechaValidacion;
    public $respuesta;
    public $usuario;
    public $observacion_1;
    public $observacion;
    public $fechaRespuesta;
    public $num_accion_corr;
    public $conciliacion;
    public $taccion;

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

    public function Add(Autoreporte $data)
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
                $data->observacion_1 = '-',
                $data->observacion = '-',
                $data->fechaRespuesta = '0000-00-00',
                $data->num_accion_corr = '',
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Autoreporte $data)
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
    public function RespuestaEdit(Autoreporte $data)
    {

        try {
            print_r($data);
            $fechaRespuesta = date('Y-m-d');
            $sql = "UPDATE  tb_proceso_noconformes 
            SET estado='$data->estado', 
            fechaRespuesta= '$fechaRespuesta', 
            conciliacion='$data->conciliacion',
            taccion='$data->taccion',
            respuesta='$data->respuesta',
            num_accion_corr='$data->num_accion_corr' , 
            fechaValidacion='$data->fechaValidacion',
            observacion='$data->observacion',
            observacion_1='$data->observacion1' 
            WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetAutoreporte($campo, $valor)
    {

        try {

            $stm = $this->pdo->prepare("SELECT  tb_proceso_noconformes.*, tb_proceso_noconformes.FechaRegistro as registro,tb_condiciones.* , tb_proceso_noconformes.usuario as user, tb_proceso_noconformes.id as id1
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

            $stm = $this->pdo->prepare("SELECT  tb_proceso_noconformes.*, tb_proceso_noconformes.FechaRegistro as registro,tb_condiciones.* , tb_proceso_noconformes.usuario as user, tb_proceso_noconformes.id as id1 
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
    public function ListaEventos()
    {
        try {
            $sql = "SELECT * FROM tb_condiciones";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetEventos($id)
    {
        try {
            $sql = "SELECT tb_condiciones.tipoIncidente,correcionIncidente,categoriaeventos.correoresponsable 
            FROM tb_condiciones,categoriaeventos 
            WHERE
            tb_condiciones.clasificacionIncidente=categoriaeventos.sigla
            AND
            tb_condiciones.id=$id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**::::::::::::::::::::::::::::::::::DASHBOARD:::::::::::::::::::::::::::::::::::::::::::::::::::: */


    public function EventosRegistrados()
    {
        try {
            $sql = "SELECT COUNT(id) as total FROM tb_proceso_noconformes";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EventosEnTramite()
    {
        try {
            $sql = "SELECT COUNT(id) as total FROM tb_proceso_noconformes WHERE estado='En Tramite'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosEnRevision()
    {
        try {
            $sql = "SELECT COUNT(id) as total FROM tb_proceso_noconformes WHERE estado='Revisión'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosAprobacion()
    {
        try {
            $sql = "SELECT COUNT(id) as total FROM tb_proceso_noconformes WHERE estado='Aprobacion'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosProceso()
    {
        try {
            $sql = "SELECT procesos.Iniciales, COUNT(tb_proceso_noconformes.proceso) AS cantidad 
            FROM tb_proceso_noconformes INNER JOIN procesos ON tb_proceso_noconformes.proceso = procesos.id 
            GROUP BY tb_proceso_noconformes.proceso";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosCondiciones()
    {
        try {
            $sql = "SELECT categoriaeventos.nombreevento, COUNT(tb_proceso_noconformes.TbCondiciones_id) AS cantidad FROM tb_proceso_noconformes INNER JOIN tb_condiciones ON tb_proceso_noconformes.TbCondiciones_id = tb_condiciones.id INNER JOIN categoriaeventos ON tb_condiciones.clasificacionIncidente = categoriaeventos.sigla GROUP BY tb_condiciones.clasificacionIncidente;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosIncidente()
    {
        try {
            $sql = "SELECT categoriaeventos.nombreevento, categoriaeventos.sigla, tb_condiciones.tipoIncidente, COUNT(tb_proceso_noconformes.TbCondiciones_id) AS cantidad 
            FROM tb_proceso_noconformes 
            INNER JOIN tb_condiciones ON tb_proceso_noconformes.TbCondiciones_id = tb_condiciones.id 
            INNER JOIN categoriaeventos ON tb_condiciones.clasificacionIncidente = categoriaeventos.sigla 
            GROUP BY tb_condiciones.tipoIncidente";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**PERFIL USUARIO */

    public function EventosPorPersona($id)
    {
        try {
            $sql = "SELECT 
            categoriaeventos.nombreevento, 
            categoriaeventos.sigla, 
            tb_condiciones.tipoIncidente,
            tb.*, 
            CONCAT(u.nombres, ' ', u.apellidos) AS usuario
        FROM 
            tb_proceso_noconformes tb
        JOIN 
            normalizacion_snu.usuarios u ON u.id = tb.cargo_id          
        INNER JOIN 
            tb_condiciones ON tb.TbCondiciones_id = tb_condiciones.id 
        INNER JOIN 
            categoriaeventos ON tb_condiciones.clasificacionIncidente = categoriaeventos.sigla 
        WHERE 
            tb.estado = 'Revision' 
            AND tb.cargo_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $E) {
            throw $E;
        }
    }


    public function EventosEnRevisionPorPersona($id)
    {
        try {
            $sql = "SELECT COUNT(id) as total FROM tb_proceso_noconformes 
            WHERE estado='Revision' AND cargo_id=:id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**PERFIL USUARIO */
}
