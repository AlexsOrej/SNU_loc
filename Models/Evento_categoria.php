<?php


class Evento_categoria
{
	private $pdo;
	public $id;
	public $clasificacionIncidente;
	public $tipoIncidente;
	public $correcionIncidente;
	public $fechaRegistro;
	public $usuario;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
		public function GetEventoCategoria($id)
	{
		try {
			$result = array();
			$sql="SELECT * FROM tb_condiciones  WHERE id = $id";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Index()
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT * FROM tb_condiciones");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}	

	public function Add(Evento_categoria $data)
	{
		try {

			$stm = "INSERT INTO tb_condiciones (clasificacionIncidente, tipoIncidente, correcionIncidente, fechaRegistro,usuario )
            VALUES(?,?,?,?,?)";
			$this->pdo->prepare($stm)->execute(array(
				$data->clasificacionIncidente,
				$data->tipoIncidente,
				$data->correcionIncidente,
				$data->fechaRegistro,
				$data->usuario,
			));
			$id = $this->pdo->lastInsertId();	        

			// Si la inserción fue exitosa, devolver una respuesta de éxito al cliente
			$response = array(
				'success' => true,
				'message' => 'Evento categoría agregado correctamente',
				'id' => $id
			);
			echo json_encode($response);

		} catch (Exception $e) {
			 // Si se produce un error, capturarlo y devolver una respuesta de error al cliente
			 $response = array(
				'success' => false,
				'message' => 'Error al agregar el evento categoría',
				'error' => $e->getMessage()
			);
			echo json_encode($response);
		}
	}

	public function Edit(Evento_categoria $data)
	{
		try {
			$sql = "UPDATE tb_condiciones SET 
			clasificacionIncidente='$data->clasificacionIncidente', 
			tipoIncidente='$data->tipoIncidente', 
			correcionIncidente='$data->correcionIncidente',
			fechaRegistro='$data->fechaRegistro',
			usuario='$data->usuario'
			WHERE id = $data->id";
			$this->pdo->prepare($sql)->execute();

            // Si la inserción fue exitosa, devolver una respuesta de éxito al cliente
			$response = array(
				'success' => true,
				'message' => 'Evento categoría actualizado correctamente',
				
			);
			echo json_encode($response);



		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'message' => 'Error al agregar el evento categoría',
				'error' => $e->getMessage()
			);
			echo json_encode($response);
		}
	}
	public function Delete($id)
	{
		try {
			$sql = "DELETE FROM `tb_condiciones` WHERE  id = $id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	
}
