<?php
class Grupofamiliar
{
	private $pdo;
	public $id;
	public $nombre;
	public $apellidos;
	public $parentesco;
	public $contacto;
	public $fecha_nacimiento;
	public $usuario_id;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM grupofamiliar");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM grupofamiliar WHERE usuario_id = '$id'");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Obtener1($id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM grupofamiliar WHERE id = '$id'");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Obtener2($id)
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM grupofamiliar WHERE usuario_id = '$id'");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Eliminar($idf)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM grupofamiliar WHERE id='$idf'");

			$stm->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar($data)

	{

		$id = $data->id;

		try {
			$sql = "UPDATE grupofamiliar SET 
						nombre= ?, 
						apellidos= ?,
						parentesco= ?,
						contacto= ?,
						fecha_nacimiento= ?					
                     WHERE id = '$id'";
		$result=$this->pdo->prepare($sql)->execute(
				array(
					$data->nombre,
					$data->apellidos,
					$data->parentesco,
					$data->contacto,
					$data->fecha_nacimiento,
				)
			);

			if ($result) {
				echo 'Los datos de ' . $data->nombre . ' ' . $data->apellidos . ' se actualizo con éxito ';
			} else {
				echo 'Ha habido un error al actualizar el registro';
			}

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Registrar(Grupofamiliar $data)
	{
		// print_r($data);
		// exit();
		try {
			$sql = "INSERT INTO grupofamiliar (nombre,apellidos,parentesco,contacto,fecha_nacimiento,usuario_id) 
		        VALUES (? ,? ,? ,? ,? ,?)";

			$result = $this->pdo->prepare($sql)
				->execute(
					array(
						$data->nombre,
						$data->apellidos,
						$data->parentesco,
						$data->contacto,
						$data->fecha_nacimiento,
						$data->usuario_id
					)
				);
			if ($result) {
				echo 'el registro de ' . $data->nombre . ' ' . $data->apellidos . 'se realizo con éxito';
			} else {
				echo 'Ha habido un error al crear el registro';
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Post($cc)
	{
		try {

			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE cedula= '$cc'");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Buscar($cc)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT usuarios.*, usuarios.id as user ,roles.*, roles.id AS ROL_ID FROM usuarios,roles WHERE usuarios.id='$cc' AND  usuarios.rol_id=roles.id");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
