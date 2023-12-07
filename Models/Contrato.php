<?php
class Contrato
{
	private $pdo;
	public $id;
	public $usuario_id;
	public $cargo_id;
	public $duracion;
	public $tipo_contrato;
	public $inicio_contrato;
	public $valor;
	public $registro;
	public $cliente_id;
	public $aux_trans;
	public $obra_id;
	public $sexo;
	public $grupo;
	public $tresidencia;
	public $lugar;
	public $manual;
	public $contrato;
	public $barrio;
	public $notiContrato;
	public $encargadofirma;
	public $usuario;


	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Cliente()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM clientes");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Historico($user_id)
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT usuario_cargo.*,cargos.nombre AS cargo,contratos.nombre as tcontrato,clientes.razonsocial,obras.nombre as obras
			                            FROM  usuario_cargo,cargos,contratos,clientes,obras
			                            WHERE
			                                usuario_cargo.usuario_id=$user_id
			                            AND usuario_cargo.cargo_id=cargos.id
			                            AND usuario_cargo.tipo_contrato=contratos.id
			                            AND usuario_cargo.cliente_id=clientes.id
			                            AND usuario_cargo.obra_id=obras.id
			                            ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Cargo()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM cargos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function TipoContrato()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tipo_contratos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Obra()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM obras");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ByCc($id)
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT personal.id,nombre,apellidos,cedula,FechaRegistro,rol_id, stados.status 
			FROM personal,stados 
			WHERE cedula like'%$id%' 
			AND stados.id=personal.rol_id 
			ORDER BY cedula");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ByEst($id)
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT personal.id,nombre,apellidos,cedula, FechaRegistro,rol_id, stados.status 
			FROM personal,stados 
			WHERE rol_id ='$id' 
			AND stados.id=personal.rol_id 
			ORDER BY cedula");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function PlantaPersonal()
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT personal.id, 
			CONCAT(nombre,' ',apellidos) as nombre, cedula,
			CONCAT( celular,'-',telefono_fijo) AS contacto,correo, FechaRegistro,rol_id, stados.status, sexo,
			CONCAT(direccion,' ',Barrio) AS direccion, 
			persona_contratos.inicio_contrato, persona_contratos.duracion, cargos.cargo
			FROM personal,stados,persona_contratos,cargos 
			WHERE rol_id IN(3,5,6)  
			AND stados.id=personal.rol_id
			AND persona_contratos.persona_id=personal.id
			AND persona_contratos.cargo_id=cargos.id
			GROUP BY cedula
			ORDER BY cedula");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ByNa($id)
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT personal.id,nombre,apellidos,cedula, FechaRegistro,rol_id, stados.status 
			                            FROM personal, stados 
										WHERE (nombre like'%$id%' 
										OR apellidos like'%$id%') 
										AND stados.id=personal.rol_id 
										ORDER BY Nombre");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function EstadoAsp(Persona $data)
	{
		try {
			$sql = "UPDATE personal 
		SET  rol_id='$data->rol_id',
		 nombre='$data->Nombre'
		,apellidos='$data->Apellido'
		,correo='$data->Correo'
		,celular='$data->celular'
		,cedula='$data->cedula'
		,expedicion='$data->expedicion'
		,FechaNacimiento='$data->FechaNacimiento'
		,direccion='$data->direccion'
		,Barrio='$data->Barrio'
		,telefono_fijo='$data->telefono_fijo'
		,FechaRegistro=Now()
		WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function obtener_estructura_directorios($ruta)
	{
		// Se comprueba que realmente sea la ruta de un directorio
		if (is_dir($ruta)) {
			// Abre un gestor de directorios para la ruta indicada
			$gestor = opendir($ruta);

			// Recorre todos los elementos del directorio
			while (($archivo = readdir($gestor)) !== false) {
				$ruta_completa = $ruta . "/" . $archivo;

				// Se muestran todos los archivos y carpetas excepto "." y ".."
				if ($archivo != "." && $archivo != "..") {
					// Si es un directorio se recorre recursivamente
					if (is_dir($ruta_completa)) {
						echo "<li>" . $archivo . "</a></li>";
						$this->obtener_estructura_directorios($ruta_completa);
					} else {
						echo "<li> <a href=" . $ruta_completa . " target='_blank'>" . $archivo . "</a></li>";
					}
				}
			}
			// Cierra el gestor de directorios
			closedir($gestor);
		} else {
			echo "No es una ruta de directorio valida<br/>";
		}
	}

	public function Historial($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT persona_contratos.*, cargos.cargo, tipo_contratos.nombre AS contrato, tipo_contratos.contenido AS contenido 
			FROM persona_contratos, tipo_contratos, cargos 
			WHERE persona_contratos.tipo_contrato = tipo_contratos.id 
			AND persona_contratos.cargo_id = cargos.id 
			AND persona_id=?");
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function GetContrato($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT persona_contratos.*, persona_contratos.contrato AS notiContrato, cargos.cargo, tipo_contratos.nombre AS contrato, tipo_contratos.contenido AS contenido 
			FROM persona_contratos, tipo_contratos, cargos 
			WHERE persona_contratos.tipo_contrato = tipo_contratos.id 
			AND persona_contratos.cargo_id = cargos.id 
			AND persona_contratos.id=?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function GetContratoNotificacion($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT persona_contratos.*, 
			persona_contratos.contrato AS notiContrato, cargos.cargo, 
			tipo_contratos.nombre AS contrato, 
			tipo_contratos.contenido AS contenido,
			CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS firmante,
			usuarios.email AS correofirmante,
			CONCAT(personal.nombre,' ',personal.apellidos) AS Colaborador,
			personal.correo AS correocolaborador
			FROM persona_contratos, tipo_contratos, cargos, normalizacion_snu.usuarios,personal 
			WHERE persona_contratos.tipo_contrato = tipo_contratos.id 
			AND persona_contratos.cargo_id = cargos.id 
			AND persona_contratos.encargadofirma = usuarios.id 
			AND persona_contratos.persona_id = personal.id 
			AND persona_contratos.id=?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function HistorialInfo($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT persona_contratos.*, cargos.cargo, tipo_contratos.nombre AS contrato, tipo_contratos.contenido AS contenido, procesos.NombreProceso 
			FROM persona_contratos, tipo_contratos, cargos, procesos 
			WHERE persona_contratos.tipo_contrato = tipo_contratos.id 
			AND persona_contratos.cargo_id = cargos.proceso_id 
			AND procesos.id = cargos.id 
			AND persona_id=?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo->prepare("DELETE FROM usuario_cargo WHERE id ='$id'");
			$stm->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Actualizar($data)
	{
		try {
			//print_r($data);
			$sql = "UPDATE persona_contratos SET  
                cargo_id = :cargo_id,
                duracion = :duracion,
                tipo_contrato = :tipo_contrato,
                inicio_contrato = :inicio_contrato,
                valor = :valor,
                aux_trans = :aux_trans,
                lugar = :lugar,
                manual = :manual,
                contrato = :contrato
                WHERE id = :id";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':cargo_id', $data->cargo_id);
			$stmt->bindParam(':duracion', $data->duracion);
			$stmt->bindParam(':tipo_contrato', $data->tipo_contrato, PDO::PARAM_INT);
			$stmt->bindParam(':inicio_contrato', $data->inicio_contrato);
			$stmt->bindParam(':valor', $data->valor);
			$stmt->bindParam(':aux_trans', $data->aux_trans);
			$stmt->bindParam(':manual', $data->manual);
			$stmt->bindParam(':contrato', $data->contrato);
			$stmt->bindParam(':lugar', $data->lugar);
			$stmt->bindParam(':id', $data->id);
			$result =  $stmt->execute();

			if ($result) {
				echo 'Los datos del contrato de actualizaron con éxito';
			} else {
				echo 'Los datos del contrato de  no se actualizaron con éxito';
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Contrato $data)
	{
		// print_r($data);
		try {
			$sql = "INSERT INTO persona_contratos (persona_id, cargo_id, duracion, tipo_contrato, inicio_contrato, valor, aux_trans, registro, usuario, lugar, manual, contrato,encargadofirma) 
		        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$this->pdo->prepare($sql)->execute(
				array(
					$data->usuario_id,
					$data->cargo_id,
					$data->duracion,
					$data->tipo_contrato,
					$data->inicio_contrato,
					$data->valor,
					$data->aux_trans,
					$data->registro,
					$data->usuario,
					$data->lugar,
					$data->manual,
					$data->contrato,
					$data->encargadofirma

				)
			);
			$sql0 = "UPDATE personal SET  rol_id='3'  WHERE id = '$data->usuario_id'";
			$this->pdo->prepare($sql0)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function GenerarContrato($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT persona_contratos.*, persona_contratos.contrato as notiContrato ,cargos.cargo,tipo_contratos.nombre as contrato, tipo_contratos.contenido, personal.* , CONCAT(usuarios.nombres,' ',usuarios.apellidos) as patron, usuarios.identificacion as cc
			FROM persona_contratos, tipo_contratos, cargos, personal, normalizacion_snu.usuarios usuarios
			WHERE
			persona_contratos.tipo_contrato=tipo_contratos.id
			AND			
			persona_contratos.persona_id=personal.id
			AND			
			persona_contratos.encargadofirma=usuarios.id
			AND			
			persona_contratos.cargo_id=cargos.id
			AND			
			persona_contratos.id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function FirmaContrato($contrato_id,$firmante)
	{
		try {
			$stm = $this->pdo->prepare("SELECT imgfirma,fechafirma FROM contrato_firmas WHERE
			contrato_id= ? AND firmante=? ");
			$stm->execute(array($contrato_id, $firmante));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Firmar($contrato_id, $imgfirma= null, $fechafirma= null,$firmante= null)
	{
		try {
			$sql = "
				INSERT INTO contrato_firmas (contrato_id, imgfirma, fechafirma, firmante)
				VALUES (?, ?, ?, ?)";
						
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(array($contrato_id, $imgfirma, $fechafirma, $firmante));
			return;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}

	//------------------------------//
	public function Novedades($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT novedades.*, cargos.nombre as cargo, obras.nombre as obras,tiponovedad.novedad 
			                               FROM novedades, tiponovedad, cargos, obras
			                               WHERE usuariocargo_id = ?
			                               AND tiponovedad.id=novedades.tipo_id
			                               AND cargos.id=novedades.cargo_id
			                               AND obras.id=novedades.obra_id
			                               ");
			$stm->execute(array($id));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Contrato()
	{

		try {
			$stm = $this->pdo->prepare("SELECT usuario_cargo.*,cargos.nombre as cargo,contratos.nombre as contrato_tipo,clientes.razonsocial,obras.nombre as obra
	                                            FROM 
	                                                 usuario_cargo,cargos,contratos,clientes,obras
	                                            WHERE
	                                                usuario_cargo.cargo_id=cargos.id
	                                            AND usuario_cargo.tipo_contrato=contratos.id
	                                            AND usuario_cargo.cliente_id=clientes.id
	                                            AND usuario_cargo.obra_id= obras.id
	                                            ORDER BY  usuario_cargo.usuario_id
	                                            ");



			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {

			die($e->getMessage());
		}
	}

	public function Usuario_con()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT usuarios.id,Nombre,Apellido,cedula FROM usuarios WHERE estado= 1");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Usuario_sin()
	{
		try {
			$result = array();

			$stm = $this->pdo->prepare("SELECT *
                                          FROM usuarios
                                          WHERE id NOT IN (SELECT usuario_id FROM usuario_cargo)");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	function validarFechas($fechaInicio, $fechaFin)
	{
		$fecha1 = DateTime::createFromFormat('Y-m-d', $fechaInicio);
		$fecha2 = DateTime::createFromFormat('Y-m-d', $fechaFin);

		if (!$fecha1 || !$fecha2) {
			return false; // Al menos una de las fechas no es válida
		}

		return true; // Ambas fechas son válidas
	}


	function calcularDiferenciaFechas($fechaInicio, $fechaFin)
	{
		$contrato = new Contrato();
		if ($contrato->validarFechas($fechaInicio, $fechaFin)) {
			$fecha1 = new DateTime($fechaInicio);
			$fecha2 = new DateTime($fechaFin);

			$diferencia = $fecha1->diff($fecha2);

			return $diferencia->days;
		} else {
			return false; // Las fechas no son válidas
		}
	}
}
