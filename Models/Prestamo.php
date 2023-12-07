<?php
class Prestamo
{

    private $pdo;
    public $producto_id;
    public $fecha_entrega;
    public $nombre_bene;
    public $apellido_bene;
    public  $identificacion_bene;
    public  $ubicacion_bene;
    public   $num_contacto;
    public  $correo;
    public  $tipo_bene;
    public  $tipo;
    public  $funcionario;
    public  $num_prestamo;
    public   $barrio;
    public  $observaciones;
    public  $created;
    public  $modified;
    public $dellate_entrada;
    public $fecha_entrada;

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
            $stm = $this->pdo->prepare("SELECT prestamos.*, prestamos.id as prestamoId, productos.nombre, productos.carateristicas, productos.id as productoId FROM  prestamos, productos WHERE prestamos.producto_id= productos.id AND tipo='prestamo'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getPrestamo($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT prestamos.* ,
            prestamos.id as prestamoId, 
            productos.nombre,
            productos.carateristicas, productos.serie,
            productos.id as productoId,
            estados.nombre as estado
            FROM  prestamos, productos, estados 
            WHERE prestamos.producto_id= productos.id  
            AND productos.estado_id=estados.id           
            AND prestamos.id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Add(Prestamo $data)
    {
        try {
            $stm = "INSERT INTO `prestamos`(`producto_id`, `fecha_entrega`, `nombre_bene`, `apellido_bene`, 
            `identificacion_bene`, `ubicacion_bene`, `num_contacto`, `correo`, `tipo_bene`, `tipo`, `funcionario`,
             `num_prestamo`, `barrio`, `observaciones`, `dellate_entrada`, `fecha_entrada`, `created`, `modified`)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->producto_id,
                $data->fecha_entrega,
                $data->nombre_bene,
                $data->apellido_bene,
                $data->identificacion_bene,
                $data->ubicacion_bene,
                $data->num_contacto,
                $data->correo,
                $data->tipo_bene,
                $data->tipo,
                $data->funcionario,
                $data->num_prestamo,
                $data->barrio,
                $data->observaciones,
                $data->dellate_entrada = 'null',
                $data->fecha_entrada = '0000-00-00',
                $data->created=date('Y-m-d'),
                $data->modified='0000-00-00'
            ));
            $_SESSION['id_producto'] = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Devolucion(Prestamo $data)
    {
        try {
            $sql = "UPDATE `prestamos` SET  `dellate_entrada`='$data->dellate_entrada',`fecha_entrada`='$data->fecha_entrada',`tipo`='$data->tipo',`modified`='$data->fecha_entrada'
             WHERE id='$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Soporte()
    {
        try {
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
