<?php
class Cartelera
{

	private $pdo;
	public $id;
	public $titulo;
	public $contenido;
	public $usuario_id;
	public $vigencia;
	public $fecha_registro;


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
			$stm = $this->pdo->prepare("SELECT * FROM carteleras");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Carteleravigente()
	{
		try {

			$fecha = date('Y-m-d');
			// Prepare a SQL query to select all records from 'carteleras' where 'vigencia' is less than or equal to the current timestamp
			$stm = $this->pdo->prepare("SELECT c.*, concat(u.nombres,' ',u.apellidos) as usuario 
			FROM carteleras c
			LEFT JOIN normalizacion_snu.usuarios u ON c.usuario_id=u.id
			WHERE vigencia >= '$fecha'");

			// Execute the prepared statement
			$stm->execute();

			// Fetch all results as objects and return them
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			// If an exception occurs, output the error message and terminate the script
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM carteleras WHERE id = ?");
			$stm->execute(array($id));

			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM carteleras WHERE id = ?");
			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Cartelera $data)
	{
		try {
			$sql = "INSERT INTO carteleras (titulo, contenido, vigencia, fecha_registro, usuario_id) VALUES (?, ?, ?, ?, ?)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->execute([
				$data->titulo,
				$data->contenido,
				$data->vigencia,
				$data->fecha_registro,
				$data->usuario_id,
			]);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function Actualizar(Cartelera $data)
	{
		try {
			$sql = "UPDATE carteleras SET titulo = ?, contenido = ?, vigencia = ? WHERE id = ?";

			$this->pdo->prepare($sql)->execute([
				$data->titulo,
				$data->contenido,
				$data->vigencia,
				$data->id
			]);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	function tiempoTranscurrido($fechaPasada)
	{
		$fechaPasadaObj = new DateTime($fechaPasada);
		$ahora = new DateTime();

		$intervalo = $fechaPasadaObj->diff($ahora);

		if ($intervalo->y > 0) {
			return 'Hace'. $intervalo->y . ' años';
		} elseif ($intervalo->m > 0) {
			return 'Hace'.$intervalo->m . ' meses';
		} elseif ($intervalo->d > 0) {
			return 'Hace'.$intervalo->d . ' días';
		} elseif ($intervalo->h > 0) {
			return 'Hace'.$intervalo->h . ' horas';
		} elseif ($intervalo->i > 0) {
			return 'Hace'.$intervalo->i . ' minutos';
		} else {
			return 'Hace'.$intervalo->s . ' segundos';
		}
	}
}
