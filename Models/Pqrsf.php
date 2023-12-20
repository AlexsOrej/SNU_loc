
<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

class Pqrsf
{
	private $pdo;
	private $pdo2;

	public $id;
	public $url;
	public $nombres;
	public $nombre;
	public $apellidos;
	public $tipo_peticion;
	public $identificacion;
	public $correo;
	public $n_contacto;
	public $descripcion;
	public $fecha_registro;
	public $estado;
	public $radicado;
	public $empresa;
	public $responsable;
	public $f_asignacion;
	public $respuesta;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp01();
			$this->pdo2 = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ByEstado($id, $estado)
	{
		$squema = $_SESSION['squema'];
		try {
			$sql = "SELECT pqrs.*, DATEDIFF($squema.respuestas.fecha, pqrs.fecha_registro) AS dias_transcurridos 
                FROM pqrs 
                LEFT JOIN $squema.respuestas ON pqrs.id = $squema.respuestas.pqrs_id 
                WHERE pqrs.url = :id ";

			if ($estado != 'todo') {
				$sql .= "AND pqrs.estado = :estado ";
			}
			$sql .= "ORDER BY pqrs.fecha_registro DESC";

			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':id', $id);
			if ($estado != 'todo') {
				$stm->bindParam(':estado', $estado);
			}
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}



	public function ByTipo($id, $tipo)
	{
		$squema = $_SESSION['squema'];
		try {
			$sql = "SELECT pqrs.*, DATEDIFF($squema.respuestas.fecha, pqrs.fecha_registro) AS dias_transcurridos 
                FROM pqrs 
                LEFT JOIN $squema.respuestas ON pqrs.id = $squema.respuestas.pqrs_id 
                WHERE pqrs.url = :id ";

			if ($tipo != 'todo') {
				$sql .= "AND pqrs.tipo_peticion = :tipo ";
			}
			$sql .= "ORDER BY pqrs.fecha_registro DESC";

			$stm = $this->pdo->prepare($sql);
			$stm->bindParam(':id', $id);
			if ($tipo != 'todo') {
				$stm->bindParam(':tipo', $tipo);
			}
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function GrafByEst($cliente)
	{
		try {
			$sql = "SELECT estado, COUNT(id) as total FROM pqrs WHERE url=$cliente GROUP BY estado";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function GrafByTipo($cliente)
	{
		try {
			$sql = "SELECT tipo_peticion, COUNT(id) as total FROM pqrs WHERE url=$cliente GROUP BY tipo_peticion";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function TotalByTipo($cliente)
	{
		try {
			$sql = "SELECT COUNT(id) as sumtotal FROM pqrs WHERE url=$cliente";
			$stm = $this->pdo->prepare($sql);
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Asignar(Pqrsf $data)
	{
		try {
			$sql = "UPDATE pqrs SET responsable='$data->responsable', f_asignacion='$data->f_asignacion', estado='asignado' WHERE id = $data->id";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function CerrarPqrd($pqrs_id)
	{
		try {
			$sql = "UPDATE pqrs SET  estado='cerrado' WHERE id = $pqrs_id";
			$this->pdo->prepare($sql)->execute();
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

	public function Registrar(Pqrsf $data)
	{
		try {
			$sql = "INSERT INTO pqrs (url, tipo_peticion, nombres, apellidos, identificacion, email, n_contacto, descripcion, fecha_registro, estado, radicado, empresa) 
					VALUES (:url, :tipo_peticion, :nombres, :apellidos, :identificacion, :correo, :n_contacto, :descripcion, :fecha_registro, :estado, :radicado, :empresa)";
			
			$stmt = $this->pdo->prepare($sql);
	
			$stmt->bindParam(':url', $data->url);
			$stmt->bindParam(':tipo_peticion', $data->tipo_peticion);
			$stmt->bindParam(':nombres', $data->nombres);
			$stmt->bindParam(':apellidos', $data->apellidos);
			$stmt->bindParam(':identificacion', $data->identificacion);
			$stmt->bindParam(':correo', $data->correo);
			$stmt->bindParam(':n_contacto', $data->n_contacto);
			$stmt->bindParam(':descripcion', $data->descripcion);
			$stmt->bindParam(':fecha_registro', $data->fecha_registro);
			$stmt->bindParam(':estado', $data->estado);
			$stmt->bindParam(':radicado', $data->radicado);
			$stmt->bindParam(':empresa', $data->empresa);
	
			$stmt->execute();
	
			// Verifica si se hizo la inserción con éxito
			if ($stmt->rowCount() > 0) {
				return true; // Inserción exitosa
			} else {
				return false; // Fallo en la inserción
			}
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



	/**segmentos */
	public function ObtenerSegmento()
	{
		try {
			$sql = "SELECT * FROM segmentos";
			$stmt = $this->pdo2->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			return false;
		}
	}

	public function VerSegmento($id)
	{
		try {
			$sql = "SELECT * FROM segmentos WHERE id=:id ";
			$stmt = $this->pdo2->prepare($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			return false;
		}
	}


	public function RegistrarSegmento($seg)
	{
		try {

			$stm = "INSERT INTO segmentos(nombre)VALUES(?)";
			$this->pdo2->prepare($stm)->execute(array($seg));
			$id_seg = $this->pdo->lastInsertId();
			return $seg;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function EditarSegmento($seg, $id)
	{
		try {
			$sql = "UPDATE segmentos SET nombre='$seg'
                  WHERE id = $id";
			$this->pdo2->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function QuitarSegmento($seg_id)
	{
		try {
			$sql = "DELETE FROM `segmentos` WHERE id = $seg_id";
			$this->pdo2->prepare($sql)->execute();
			return true;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function ReportePqrsf()
	{
		try {
			//Consulta para obtener los datos de la tabla PQRs	
			$query = "SELECT res.*, pqr.descripcion as solicitud
					FROM normalizacion_snu.pqrs pqr, respuestas res
					WHERE pqr.id= res.pqrs_id";
			$stmt = $this->pdo2->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,]);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			throw $e;
		}
	}



	public function UpdateDataFromExcel($data)
	{

		try {
			$updatedData = [];
			// Actualizar los datos en la base de datos MySQL
			$sql = "UPDATE respuestas SET accion = :accion, respuesta = :respuesta, clasificacion_id=:clasificacion_id WHERE id =:id";
			$stmt = $this->pdo2->prepare($sql);
			$stmt->bindParam(':id', $data[0]);
			$stmt->bindParam(':accion', $data[3]);
			$stmt->bindParam(':respuesta', $data[5]);
			$stmt->bindParam(':clasificacion_id', $data[6]);
			$stmt->execute();

			// Verificar si se actualizó al menos una fila
			if ($stmt->rowCount() > 0) {
				// Consultar los datos actualizados
				$consulta = $this->pdo2->prepare("SELECT * FROM respuestas WHERE id = :id");
				$consulta->bindParam(':id', $data[0]);
				$consulta->execute();
				$datosActualizados = $consulta->fetch();

				// Almacenar los datos actualizados en el array
				$updatedData = $datosActualizados;
			}

			return "Datos Actualizados Con Exito"; // Devolver los datos actualizados
		} catch (Exception $e) {
			return 'Error al leer el archivo Excel: ' . $e->getMessage();
		}
	}


	/** ESTADISTICAS */
	/** Número total de PQRSF desglosado por categoría de acción en un período de 6 meses */
	public function TotalPorCategoria()
	{
		try {
			$sql = "SELECT s.nombre as segmento, p.tipo_peticion, COUNT(p.id) AS total_pqrsf
			FROM respuestas r
			JOIN normalizacion_snu.pqrs p ON r.pqrs_id = p.id
			JOIN segmentos s ON r.accion =s.id
			WHERE p.fecha_registro >= CURDATE() - INTERVAL 6 MONTH
			GROUP BY r.accion";
			$stmt = $this->pdo2->prepare($sql);
			// $stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e;
		}
	}
	public function TotalSatisfacion()
	{
		try {
			$empresa_id = $_SESSION['datos_cliente']->id;
			$sql = "SELECT estado_cliente, COUNT(id) AS total_satisfacciones
			FROM satisfacions
			WHERE empresa_id=:id
			GROUP BY estado_cliente";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $empresa_id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e;
		}
	}

	public function PromedioAsignacion()
	{
		try {
			$empresa_id = $_SESSION['datos_cliente']->id;
			$sql = "SELECT AVG(TIMESTAMPDIFF(DAY, p.fecha_registro, p.f_asignacion)) AS tiempo_creacion_asignacion 
			FROM pqrs p 
			WHERE p.f_asignacion IS NOT NULL AND p.fecha_registro >= CURDATE() - INTERVAL 6 MONTH
			AND p.url=:id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':id', $empresa_id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e;
		}
	}
	public function PromedioRespuesta()
	{
		try {
			$empresa_id = $_SESSION['datos_cliente']->id;
			$sql = "SELECT AVG(TIMESTAMPDIFF(DAY, p.f_asignacion, r.fecha)) AS tiempo_asignacion_resolucion
			FROM normalizacion_snu.pqrs p
			JOIN respuestas r ON p.id = r.pqrs_id
			WHERE p.f_asignacion IS NOT NULL AND r.fecha IS NOT NULL AND p.fecha_registro >= CURDATE() - INTERVAL 6 MONTH			
			AND p.url=:id";
			$stmt = $this->pdo2->prepare($sql);
			$stmt->bindParam(':id', $empresa_id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			echo $e;
		}
	}

	/** consultas para el perfil*/
	function PqrsfAsignadasTotal($usuario)
	{
		$sql = "SELECT count(id) as total FROM `pqrs` WHERE `estado` != 'cerrado' AND `responsable` LIKE :usuario";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':usuario', '%' . $usuario . '%');  // Agregamos % al principio y al final
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result->total;
	}

	function PqrsfAsignadasAbierta($usuario)
	{
		$sql = "SELECT * FROM `pqrs` WHERE `estado` != 'cerrado' AND `responsable` LIKE :usuario";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':usuario', '%' . $usuario . '%');  // Agregamos % al principio y al final
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $result;
	}
}
