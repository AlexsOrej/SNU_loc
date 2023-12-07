<?php

use Evento as GlobalEvento;

class Evento
{
	private $pdo;
	public $id;
	public $cargo_id;
	public $TbCondiciones_id;
	public $descEvento;
	public $lugarEvento;
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
	private $bd_cliente;
	public $proceso;
	public $estado;


	public function __CONSTRUCT()
	{
		try {
            
			@session_start();
			$cliente = $this->bd_cliente = Database::Cbdato($_REQUEST['cliente']);
			$_SESSION['cliente'] = $cliente;
			if ($cliente != 'no hay squema') {
				$this->pdo = Database::StartUp($cliente);
				require_once 'control/evento.controller.php';
			} else {
				require_once 'Views/error.php';
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar($id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM contactos where empresa_id=$id");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	

	public function ClasificacionEventos ()
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT * FROM categoriaeventos");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function GetCargo($proceso_id)
	{
		//echo $proceso_id;
		$cliente =  $_REQUEST['cliente'];
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT
			cargos.id,
			cargos.cargo,
			cargos.proceso_id,
			usuarios.id as usuario_id,
			usuarios.nombres,
			usuarios.apellidos,
			usuarios.email,
			procesos.id AS procesoid,
			procesos.Iniciales,
			procesos.NombreProceso
		FROM
			cargos,
			procesos,
			normalizacion_snu.usuarios		
		WHERE
			procesos.id = cargos.proceso_id 
			AND usuarios.cargo_id = cargos.id 
			AND procesos.id = '$proceso_id' 
			AND usuarios.cliente_id=$cliente
			AND usuarios.estado!=0");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function GetCondicion($clasificacion)
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare(" SELECT tipoIncidente, id  FROM tb_condiciones WHERE clasificacionIncidente='$clasificacion' ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

	public function Add(Evento $data)
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

			echo "<br> {$data->usuario}<br> El evento {$id_cliente} se registro";
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

	public function Imagen($id){
		try
		{		

			$stm = $this->pdo->prepare("SELECT filename, dir FROM normalizacion_snu.clientes WHERE id= $id");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}
