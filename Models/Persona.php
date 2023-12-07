<?php
//nombrar la clase

class Persona
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $nombre;
    public $apellidos;
    public $correo;
    public $telefono_fijo;
    public $celular;
    public $rol_id;
    public $sexo;
    public $cedula;
    public $expedicion;
    public $rh;
    public $grupo;
    public $LugarNacimiento;
    public $FechaNacimiento;
    public $direccion;
    public $barrio;
    public $FechaRegistro;
    public $estado;
    public $estado_civil;
    public $nom_contacto_emergencia;
    public $num_contacto_emergencia;
    public $edad_pension;
    public $tiempo_pension;
    public $ciudad_recidencia;
    public $estrato;
    public $cargo_jefe_id;
    public $nivel_educativo;
    public $profesion;
    public $uec;
    public $fec;
    public $ued;
    public $fed;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Index()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  personal ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetPersona($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM  personal WHERE id=$id  ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Persona $data)
    {
        try {
            $sql = "INSERT INTO personal (
                `nombre`, `apellidos`, `correo`, `telefono_fijo`,
                `celular`, `rol_id`, `Sexo`, `cedula`, `expedicion`,
                `rh`, `LugarNacimiento`, `FechaNacimiento`,
                `direccion`, `Barrio`, `FechaRegistro`, `estado`,
                `estado_civil`, `nom_contacto_emergencia`,
                `num_contacto_emergencia`, `edad_pension`,
                `tiempo_pension`, `ciudad_recidencia`, `estrato`,
                `cargo_jefe_id`, `nivel_educativo`, `profesion`,
                `uec`, `fec`, `ued`, `fed`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) 
                ON DUPLICATE KEY UPDATE cedula = $data->cedula";
            $this->pdo->prepare($sql)->execute(
                array(
                    $data->nombre,
                    $data->apellidos,
                    $data->correo,
                    $data->telefono_fijo,
                    $data->celular,
                    $data->rol_id,
                    $data->sexo,
                    $data->cedula,
                    $data->expedicion,
                    $data->rh,
                    $data->LugarNacimiento,
                    $data->FechaNacimiento,
                    $data->direccion,
                    $data->barrio,
                    $data->FechaRegistro,
                    $data->estado,
                    $data->estado_civil,
                    $data->nom_contacto_emergencia,
                    $data->num_contacto_emergencia,
                    $data->edad_pension,
                    $data->tiempo_pension,
                    $data->ciudad_recidencia,
                    $data->estrato,
                    $data->cargo_jefe_id,
                    $data->nivel_educativo,
                    $data->profesion,
                    $data->uec,
                    $data->fec,
                    $data->ued,
                    $data->fed
                )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Persona $data)
    {
        try {
            $rh =   $data->rh . '-' . $data->grupo;
            $FechaNacimiento = isset($data->FechaNacimiento) ? $data->FechaNacimiento : "0000-00-00";
            $sql = "UPDATE personal
            SET nombre='$data->nombre',
            apellidos='$data->apellidos', 
            correo='$data->correo', 
            telefono_fijo='$data->telefono_fijo', 
            celular='$data->celular', 
            sexo='$data->sexo',           
            cedula='$data->cedula', 
            expedicion='$data->expedicion',
            rh='$rh',           
            LugarNacimiento='$data->LugarNacimiento',
            FechaNacimiento='$FechaNacimiento',
            ciudad_recidencia='$data->ciudad_recidencia',
            direccion='$data->direccion',
            barrio='$data->barrio',
            estado_civil='$data->estado_civil',
            nom_contacto_emergencia='$data->nom_contacto_emergencia',
            num_contacto_emergencia='$data->num_contacto_emergencia',
            nivel_educativo='$data->nivel_educativo',
            profesion='$data->profesion'
            WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Delete()
    {
        try {
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**CONSULTAS DASHBOARD */

    public function Activos()
    {
        try {
            //code...
            $sql = "SELECT COUNT(*) FROM personal WHERE estado = '1'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function Inactivos()
    {
        try {
            //code...
            $sql = "SELECT COUNT(*) FROM personal WHERE estado = '0'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function TotalPersonas()
    {
        try {
            //code...
            $sql = "SELECT COUNT(DISTINCT cedula)
            FROM personal
            JOIN persona_contratos ON personal.id = persona_contratos.persona_id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function TotalPersonasEdad()
    {
        try {
            //code...
            $sql = "SELECT TIMESTAMPDIFF(YEAR, FechaNacimiento, CURDATE()) AS edad, COUNT(*) 
            FROM personal
            JOIN persona_contratos ON personal.id = persona_contratos.persona_id
            GROUP BY edad";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function PromedioEdad()
    {
        try {
            //code...
            $sql = "SELECT AVG(TIMESTAMPDIFF(YEAR, FechaNacimiento, CURDATE())) AS edad_promedio 
            FROM personal
            JOIN persona_contratos ON personal.id = persona_contratos.persona_id
            ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function PorEstrato()
    {
        try {
            //code...
            $sql = "SELECT AVG(TIMESTAMPDIFF(YEAR, FechaNacimiento, CURDATE())) AS edad_promedio 
            FROM personal
            JOIN persona_contratos ON personal.id = persona_contratos.persona_id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function PorNivelEducativo()
    {
        try {
            //code...
            $sql = "SELECT nivel_educativo, COUNT(cedula) 
            FROM personal 
            JOIN persona_contratos ON personal.id = persona_contratos.persona_id
            GROUP BY estrato, nivel_educativo";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


   public function PorSexo($GENERO,$VALUE)
    {
        try {
            $sql = "SELECT COUNT(id) as '$GENERO' FROM `personal` WHERE `estado` LIKE '3' AND Sexo='$VALUE' ORDER BY `Sexo`";

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Throwable $th) {
            throw $th;
        }
    }





    function PorEstratoYEducacion()
    {
        $sql = "SELECT  nivel_educativo, COUNT(*)as Cantidad 
        FROM personal 
        JOIN persona_contratos ON personal.id = persona_contratos.persona_id
        GROUP BY nivel_educativo";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    function PorAusentismo()
    {
        // Consulta para obtener los datos
        $sql = "SELECT tn.evento, COUNT(n.id) as cantidad_novedades
                FROM tipo_novedades tn
                INNER JOIN novedades n ON tn.id = n.tipo_id
                GROUP BY tn.evento";
        // Ejecución de la consulta y obtención de los resultados
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function PorEstadoCivil()
    {
        $stmt = $this->pdo->prepare("SELECT estado_civil, COUNT(*) as count 
        FROM personal 
        JOIN persona_contratos ON personal.id = persona_contratos.persona_id
        GROUP BY estado_civil");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function PorEstratoSocial()
    {
        $stmt = $this->pdo->prepare("SELECT estrato, COUNT(*) as total 
        FROM         
        personal
        JOIN persona_contratos ON personal.id = persona_contratos.persona_id
        GROUP BY estrato");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function DiasAusencia()
    {
        $stmt = $this->pdo->prepare("SELECT SUM(dias_calendario_ausente) AS total_dias_ausente 
        FROM ausentismos");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function DiasAusenciaxtipo()
    {
        $stmt = $this->pdo->prepare("SELECT a.tipo_ausencia_id, SUM(dias_calendario_ausente) AS total_ausencias, n.id, n.evento, n.tipo 
        FROM ausentismos a 
        JOIN  tipo_novedades n ON a.tipo_ausencia_id = n.id 
        WHERE n.tipo = 2 
        GROUP BY a.tipo_ausencia_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function AusenciaxMes()
    {
        $stmt =  $this->pdo->query("SET lc_time_names = 'es_ES';");
        $stmt = $this->pdo->prepare("SELECT MONTHNAME(f_inicio) AS mes, COUNT(*) AS total_ausencias 
        FROM ausentismos 
        WHERE f_inicio BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND CONCAT(YEAR(CURDATE()), '-12-31')
        GROUP BY MONTHNAME(f_inicio)
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function AusenciaxDiagnostico()
    {
        $stmt = $this->pdo->prepare("SELECT MONTHNAME(f_inicio) AS mes, COUNT(*) AS total_ausencias 
        FROM ausentismos 
        WHERE f_inicio BETWEEN CONCAT(YEAR(CURDATE()), '-01-01') AND CONCAT(YEAR(CURDATE()), '-12-31')
        GROUP BY MONTHNAME(f_inicio)");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Estado()
    {
        $stmt = $this->pdo->prepare("SELECT id, status FROM stados");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function ActualizarEstado($usuario_id, $estadoId)
    {

        try {
            $sql = "UPDATE `personal` SET `rol_id` = '$estadoId' WHERE `personal`.`id` =$usuario_id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    
    
    
    
    

}

