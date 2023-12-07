<?php


class Evento
{
	private $pdo;
	public $id;
	public $nombreevento;
	public $correoresponsable;
	public $sigla;
	public $created;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
		public function GetEvento($id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT *   
               FROM categoriaeventos  
               WHERE id = $id");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function CargoIndex()
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

	public function Add(Evento $data)
	{
		try {

			$stm = "INSERT INTO categoriaeventos (nombreevento, sigla, correoresponsable, created )
            VALUES(?,?,?,?)";
			$this->pdo->prepare($stm)->execute(array(
				$data->nombreevento,
				$data->sigla,
				$data->correoresponsable,
				$data->created,
			));
			$id = $this->pdo->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Edit(Evento $data)
	{
		try {
			$sql = "UPDATE categoriaeventos SET  nombreevento='$data->nombreevento', sigla='$data->sigla', correoresponsable='".$data->correoresponsable."'  WHERE id = $data->id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Delete($id)
	{
		try {
			$sql = "DELETE FROM `categoriaeventos` WHERE  id = $id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	
}
