<?php
class Cliente
{
    private $pdo;
    public $id;
    public $nombre;
    public $telefono;
    public $correos;
    public $direccion;
    public $salario;
    public $matriz;
    public $fechainicio;
    public $rector;
    public $rect_telefono;
    public $filename;
    public $dir;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp01();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getCliente()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT clientes.*, squemas.* FROM  clientes, squemas 
            WHERE clientes.id=squemas.cliente_id
                               ORDER BY clientes.nombre");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getCliente01()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT clientes.id, nombre FROM  clientes ORDER BY clientes.id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function upCliente($id)
    {

        try {

            $stm = $this->pdo->prepare("SELECT * FROM  clientes WHERE id='$id'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function upClienteValidar($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT clientes.*, squemas.* FROM  clientes, squemas 
            WHERE clientes.id=squemas.cliente_id AND clientes.id='$id' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(Cliente $data)
    {

        try {

            $stm = "INSERT INTO clientes(nombre, direccion, telefono, correos, salario, matriz, fechainicio, rector, rect_telefono, filename,dir )
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->nombre,
                $data->direccion,
                $data->telefono,
                $data->correos,
                $data->salario,
                $data->matriz,
                $data->fechainicio,
                $data->rector,
                $data->rector,
                $data->filename,
                $data->dir = 'img/uploads/colegio/filename'
            ));
            $id_cliente = $this->pdo->lastInsertId();
            // creamos la bs
            $squema_nombre = 'normalizacion_' . $data->nombre;
            // $bd_nombre =strtolower(str_replace(" ","",$squema_nombre));
            // $sql = 'CREATE DATABASE bd_nombre';
            // $this->pdo->exec($sql);
            // creamos la bs
            $squema = "INSERT INTO squemas(squema,cliente_id,created,modified)VALUES(?,?,?,?)";
            $this->pdo->prepare($squema)->execute(array(
                $data->squema = $squema_nombre,
                $data->cliente_id = $id_cliente,
                $data->created = date('Y-m-d'),
                $data->modified = date('Y-m-d'),
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Cliente $data)
    {
        try {

            $sql = "UPDATE clientes SET nombre='$data->nombre', direccion='$data->direccion', telefono='$data->telefono',
              correos='$data->correos', salario='$data->salario', matriz='$data->matriz', fechainicio='$data->fechainicio',
              rector='$data->rector'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ActualizarLogo($file, $id)
    {
        try {

            $sql = "UPDATE clientes SET filename='$file'  WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getFolderSize($folderPath)
    {
        $cli_file=new Cliente;
        if (!is_dir($folderPath)) {
            // la carpeta no existe
            return 0;
        }

        $totalSize = 0;
        $files = glob($folderPath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                $totalSize += filesize($file);
            } elseif (is_dir($file)) {
                $totalSize += $cli_file->getFolderSize($file);
            }
        }
        return $totalSize;
    }
    function bytesToMegabytes($bytes) {
        $megabytes = $bytes / 1048576;
        return round($megabytes, 2); // redondea a 2 decimales
    }



    function getServiciosActivosPorCliente() {
        $sql = "SELECT c.nombre AS cliente, COUNT(*) AS servicios_activos
        FROM servicios_cliente cs
        INNER JOIN clientes c ON cs.cliente_id = c.id
        WHERE cs.estado = '1'
        GROUP BY cs.cliente_id";        
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

 
    function getUsuariosActivosPorCliente() {
        // Conexión a la base de datos (omitiendo código de conexión)
        // ...
    
        // Consulta SQL para obtener la cantidad de usuarios activos por cliente
        $query = "SELECT c.nombre AS cliente, COUNT(*) AS cantidad_usuarios_activos
        FROM usuarios u
        JOIN clientes c ON u.cliente_id = c.id
        WHERE u.estado = 1
        GROUP BY c.nombre";
    
        // Preparar consulta
        $stmt =  $this->pdo->prepare($query);
    
        // Ejecutar consulta
        $stmt->execute();
    
        // Obtener resultados como array asociativo
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Cerrar conexión
        $pdo = null;
    
        // Devolver resultados
        return $results;
    }
    
}
