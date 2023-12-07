<?php


class Cargo
{

	private $pdo;
	public $id;
	public $cargo;
	public $proceso_id;
	public $cliente_id;



	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function GetCargo($proceso_id)
	{
		//echo $proceso_id;
		$cliente =  $_SESSION['datos_cliente']->id;
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

	public function GetCargos($cargo_id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT cargos.id, cargos.cargo, cargos.proceso_id   
               FROM cargos  
               WHERE cargos.id = $cargo_id");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function SetCargos()
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT cargos.id,  cargos.cargo, cargos.proceso_id   
               FROM cargos ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function SetCargosPersonas()
	{
		try {
			$result = array();
			$cliente =  $_SESSION['datos_cliente']->id;
			$stm = $this->pdo->prepare("SELECT cargos.id,  cargos.cargo, cargos.proceso_id , nsu.nombres, nsu.apellidos  
					   FROM cargos
					   INNER JOIN normalizacion_snu.usuarios nsu ON cargos.id=nsu.cargo_id
					   WHERE nsu.cliente_id=:cliente
					   ORDER BY cargos.cargo");
			$stm->bindParam(':cliente', $cliente);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function CargoIndex()
	{

		$cliente_id = $_SESSION['datos_cliente']->id;

		try {
			$result = array();
			$stm = $this->pdo->prepare(" SELECT cargos.id,  cargos.cargo, cargos.proceso_id, procesos.NombreProceso FROM cargos , procesos WHERE cargos.proceso_id=procesos.id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function IndexUsuarios($cliente_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT normalizacion_snu.usuarios.*, normalizacion_snu.rols.rol, normalizacion_snu.clientes.nombre AS cliente
            FROM  normalizacion_snu.usuarios
             LEFT JOIN normalizacion_snu.clientes ON normalizacion_snu.clientes.id = normalizacion_snu.usuarios.cliente_id
             JOIN normalizacion_snu.rols ON normalizacion_snu.usuarios.rol_id=normalizacion_snu.rols.id
             AND normalizacion_snu.clientes.id=$cliente_id");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function IndexUsuariosAdmin($cliente_id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT CONCAT(normalizacion_snu.usuarios.nombres,'  ',normalizacion_snu.usuarios.apellidos) AS FullName,normalizacion_snu.usuarios.email, normalizacion_snu.rols.rol, normalizacion_snu.clientes.nombre AS cliente
            FROM  normalizacion_snu.usuarios
             LEFT JOIN normalizacion_snu.clientes ON normalizacion_snu.clientes.id = normalizacion_snu.usuarios.cliente_id
             JOIN normalizacion_snu.rols ON normalizacion_snu.usuarios.rol_id=normalizacion_snu.rols.id
             AND normalizacion_snu.clientes.id=$cliente_id
			 AND normalizacion_snu.usuarios.rol_id=2");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Add(Cargo $data)
	{
		try {

			$stm = "INSERT INTO cargos (cliente_id, codigo, cargo, proceso_id)
            VALUES(?,?,?,?)";
			$this->pdo->prepare($stm)->execute(array(
				$data->cliente_id,
				$data->codigo = 0,
				$data->cargo,
				$data->proceso_id,
			));
			$id = $this->pdo->lastInsertId();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Edit(Cargo $data)
	{
		try {
			$sql = "UPDATE cargos SET  cargo='$data->cargo', proceso_id='$data->proceso_id'  WHERE id = $data->id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	// esta funcion va a validar si el cargo ya tiene un contrato asignado
	public function ComprobarEliminacionCargo($id){
		try{
			$sql = "SELECT COUNT(*) as contratos FROM persona_contratos WHERE cargo_id = $id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetch();
		}catch (Exception $e){
			die($e->getMessage());
		}
	}
	public function Delete($id)
	{
		try {
			$sql = "DELETE FROM `cargos` WHERE  id = $id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function SubirPerfil()
	{
		$fileTmpPath = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		$fileSize = $_FILES['file']['size'];
		$fileType = $_FILES['file']['type'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		$newFileName = $_REQUEST['cargo'];
		$allowedfileExtensions = array('pdf');
		if (in_array($fileExtension, $allowedfileExtensions)) {
			// directory in which the uploaded file will be moved
			$uploadFileDir = 'Assets/Perfiles/' . $_SESSION['datos_cliente']->nombre . '/';
			$dest_path = $uploadFileDir . $newFileName;
			if (!file_exists($uploadFileDir)) {
				mkdir($uploadFileDir, 0777, true);
			}
			if (move_uploaded_file($fileTmpPath, $dest_path)) {
				$message = 'El archivo se cargó correctamente.';
			} else {
				$message = 'Hubo algún error al mover el archivo al directorio de carga. Asegúrese de que el servidor web pueda escribir en el directorio de carga.';
			}
		} else {
			echo '<script type = "text/javascript">
                    alert("La solictud fue gestionada , el archivo no pudo se subido, revisa el formato, recuerda que debe ser .pdf");
                    </script> ';
		}
	}
}
