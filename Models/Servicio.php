<?php
class Servicio
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id; //atributo del objeto
    public $servicio_id;
    public $cliente_id;
    public $f_inicio;
    public $estado;
    public $url;

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
            $stm = $this->pdo->prepare("SELECT servicios_cliente.*,
            servicios_cliente.id as servicios_id, ofertas.id, ofertas.oferta,
            clientes.nombre  as cliente
            FROM  servicios_cliente, ofertas, clientes 
            WHERE ofertas.id=servicios_cliente.servicio_id 
            AND clientes.id=servicios_cliente.cliente_id
            ORDER BY servicios_cliente.cliente_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function GetServicio($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  servicios_cliente WHERE servicios_cliente.id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function ValidarServicio($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT ofertas.dir, ofertas.oferta
            FROM  servicios_cliente, ofertas 
            WHERE ofertas.id = servicios_cliente.servicio_id  
            AND servicios_cliente.cliente_id=? ");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Add(Servicio $data)
    {
        try {

            $stm = "INSERT INTO servicios_cliente( servicio_id,cliente_id,f_inicio,estado, url)
            VALUES(?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->servicio_id,
                $data->cliente_id,
                $data->f_inicio,
                $data->estado,
                $data->url
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Edit(Servicio $data)
    {
        try {
            $sql = "UPDATE servicios_cliente SET servicio_id='$data->servicio_id' ,cliente_id='$data->cliente_id', f_inicio='$data->f_inicio', estado='$data->estado', url='$data->url' WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM `servicios_cliente` WHERE  id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function  Servicio()
    {
        try {
            $id = $_SESSION['datos_cliente']->id;
            $stm = $this->pdo->prepare("SELECT servicios_cliente.*, ofertas.oferta , ofertas.dir
                                        FROM servicios_cliente, ofertas 
                                        WHERE servicios_cliente.cliente_id=$id
                                        AND servicios_cliente.servicio_id=ofertas.id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function calcularDiasPasadosOVigentes($fechaInicio)
    {
        $fechaInicioObj = new DateTime($fechaInicio);
        $fechaVencimientoObj = clone $fechaInicioObj;
        $fechaVencimientoObj->modify("+1 year");
        $fechaActual = new DateTime();
        $diferencia = $fechaVencimientoObj->diff($fechaActual);
        if ($fechaActual > $fechaVencimientoObj) {
            return "Han pasado " . $diferencia->days . " días desde el vencimiento.";
        } elseif ($fechaActual == $fechaVencimientoObj) {
            return "La duración se ha completado hoy.";
        } else {
            $diferencia = $fechaActual->diff($fechaVencimientoObj);
            return "Faltan " . $diferencia->days . " días para el vencimiento.";
        }
    }

    /**
     *   ESTADITICAS DE USO   
     */

    public function ModulosVencidos()
    {
        try {
            // Consulta SQL
            $sql = "SELECT c.nombre AS nombre_cliente, 
                     COUNT(sc.servicio_id) AS total_servicios, 
                     SUM(CASE WHEN DATEDIFF(NOW(), sc.f_inicio) > 365 THEN 1 ELSE 0 END) AS servicios_vencidos 
                     FROM servicios_cliente sc 
                     JOIN clientes c ON sc.cliente_id = c.id      
                     WHERE sc.estado=1              
                     GROUP BY c.nombre, sc.cliente_id";
            // Ejecutar la consulta
            $stmt = $this->pdo->query($sql);
            // Obtener los resultados
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Cerrar la conexión a la base de datos
            $conn = null;
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function UsuariosMasUso()
    {
    }

    public function ModuloMasUsado()
    {
    }
}
