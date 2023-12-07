<?php

class Pqrs
{
	private $pdo;

	public $id;
	public $url;
	public $nombres;
	public $apellidos;
	public $tipo_peticion;
	public $identificacion;
	public $correo;
	public $n_contacto;
	public $descripcion;
	public $fecha_registro;
	public $estado;
	public $radicado;



	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Imagen($id)
	{
		try {

			$stm = $this->pdo->prepare("SELECT filename, dir FROM clientes WHERE id= $id");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Tyc($id)
	{
		try {

			$stm = $this->pdo->prepare("SELECT matriz FROM clientes WHERE id= $id");
			$stm->execute();

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pqrs");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Obtener($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM pqrs WHERE id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM pqrs WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{

		$id = $data->id;
		$nombre = $data->nombre;
		$apellido =  $data->apellido;
		$identificacion = $data->identificacion;
		$direccion =  $data->direccion;
		$celular =  $data->celular;
		$telefono_fijo =  $data->telefono_fijo;
		$email =  $data->email;
		$n_empresa =  $data->n_empresa;
		$lugar_hecho =  $data->lugar_hecho;
		$dirigido =  $data->dirigido;
		$tipopqrs =  $data->tipopqrs;
		$f_registro =  $data->f_registro;
		$descripcion =  $data->descripcion;
		$f_respuesta = $data->f_respuesta;
		$respuesta =  $data->respuesta;
		$estado =  $data->estado;
		$usuario =  $data->usuario;

		try {
			$sql = "UPDATE pqrs SET f_respuesta='$f_respuesta', respuesta='$respuesta', estado='$estado',usuario='$usuario' WHERE id = $id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Pqrs $data)
	{
		try {
			$sql = "INSERT INTO pqrs (url, tipo_peticion, nombres, apellidos, identificacion, email, n_contacto, descripcion, fecha_registro, estado, radicado, empresa) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$stmt = $this->pdo->prepare($sql);

			$stmt->bindParam(1, $data->url);
			$stmt->bindParam(2, $data->tipo_peticion);
			$stmt->bindParam(3, $data->nombres);
			$stmt->bindParam(4, $data->apellidos);
			$stmt->bindParam(5, $data->identificacion);
			$stmt->bindParam(6, $data->correo);
			$stmt->bindParam(7, $data->n_contacto);
			$stmt->bindParam(8, $data->descripcion);
			$stmt->bindParam(9, $data->fecha_registro);
			$stmt->bindParam(10, $data->estado);
			$stmt->bindParam(11, $data->radicado);
			$stmt->bindParam(12, $data->empresa);

			$stmt->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	public function Max()
	{
		try {
			$stm = $this->pdo->prepare("SELECT MAX(id) as l_id  FROM pqrs ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	function Squema()
	{
		$squema = $_REQUEST['urlp'];
		try {
			$sql = "SELECT squema FROM squemas WHERE cliente_id = '$squema' ";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->squema;
		} catch (PDOException $e) {
			return false;
		}
	}


	public function NotificarA($squema)
	{
		try {
			$sql = "SELECT usuario_id, email FROM $squema.notificaciones WHERE modulo_id = '5' ";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			return false;
		}
	}
}
