<?php

class Novedades
{
	private $pdo;
	public $id;
	public $persona_id;
	public $tipo_id;
	public $descripcion;
	public $fecha_novedad;
	public $fecha_registro;
	public $soporte;


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
			$stm = $this->pdo->prepare("SELECT novedades.*, tipo_novedades.evento, CONCAT(personal.nombre,'-',personal.apellidos) AS fullNombre,personal.cedula FROM novedades, personal,  tipo_novedades WHERE novedades.persona_id=personal.id AND novedades.tipo_id= tipo_novedades.id ORDER BY id desc limit 15");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function GetNovedadPersona($id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT novedades.*, tipo_novedades.evento 
			FROM novedades,tipo_novedades 
			WHERE novedades.persona_id = :id
			AND novedades.tipo_id= tipo_novedades.id
			ORDER BY id desc");
			$stm->bindParam(":id", $id);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	public function Obras()
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM obras ORDER BY cliente_id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Puestos()
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM puestos ORDER BY obra_id ");
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
			$stm = $this->pdo->prepare("SELECT usuarios.*, usuarios.id as user ,roles.*, roles.id AS ROL_ID FROM usuarios,roles WHERE usuarios.cedula='$cc' AND  usuarios.rol_id=roles.id");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Novedad($dato)
	{

		/*"SELECT novedades.* ,  tipo_novedades.evento, personal.cedula, CONCAT(personal.nombre,' ',personal.apellidos) as fullNombre, personal.Correo, personal.celular, personal.id as persona_id
                                         FROM personal
                                         LEFT JOIN novedades ON novedades.persona_id=personal.id
                                         LEFT JOIN tipo_novedades ON novedades.tipo_id= tipo_novedades.id
                                         WHERE personal.cedula='$cc'                                                                                                                         
                                         ORDER BY `novedades`.`fecha_novedad` DESC"*/

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT novedades.* ,  tipo_novedades.evento, personal.cedula, CONCAT(personal.nombre,' ',personal.apellidos) as fullNombre, personal.Correo, personal.celular, personal.id as persona_id
			FROM personal
			LEFT JOIN novedades ON novedades.persona_id=personal.id
			LEFT JOIN tipo_novedades ON novedades.tipo_id= tipo_novedades.id
			WHERE personal.cedula like '$dato' or personal.nombre like '%$dato%' or personal.apellidos like '%$dato%'                                                                                                                      
			ORDER BY `novedades`.`fecha_novedad` DESC;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Novedades $data)
	{

		try {

			$sql = "INSERT INTO novedades (persona_id, tipo_id,  descripcion, fecha_novedad, fecha_registro, soporte) 
		            VALUES (?,?,?,?,?,?)";
			$this->pdo->prepare($sql)->execute(
				array(
					$data->persona_id,
					$data->tipo_id,
					$data->descripcion,
					$data->fecha_novedad,
					$data->fecha_registro,
					$data->soporte
				)
			);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	public function ListarDatos($id)
	{

		try {
			$result = array();
			$sql = "SELECT * FROM novedades WHERE id=$id";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Editar(Novedades $datas)
	{
		// print_r($datas);
		try {
			$sql = "UPDATE novedades SET soporte='$datas->soporte',tipo_id='$datas->tipo_id', descripcion='$datas->descripcion',fecha_novedad='$datas->fecha_novedad',fecha_registro='$datas->fecha_registro'  WHERE id ='$datas->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {

			die($e->getMessage());
		}
	}

	public function Eliminar0($id)
	{
		try {
			echo $id = $_REQUEST['id'];
			$stm = $this->pdo->prepare("DELETE FROM novedades WHERE id = $id");

			$stm->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
