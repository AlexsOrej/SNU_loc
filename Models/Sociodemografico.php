<?php
//nombrar la clase
class Sociodemografico
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id;
    public $personal_id;
    public $dependientes;
    public $cuantas_personas_vive;
    public $alergias;
    public $cual_alergia;
    public $medio_transporte;
    public $tiempo_desplazamiento;
    public $uso_tiempo_libre;
    public $otros_trabajos;
    public $fuma;
    public $licor;
    public $realiza_ejercicio;    
    public $fecha_registro;    

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();  
            $model= new Model();
            $model->ModelSociodemografico();

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function CalcularEdad($fecha_nacimiento)
    {
        $fecha_actual = date("Y-m-d");
        $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
        $edad = date_diff(date_create($fecha_nacimiento), date_create($fecha_actual));
        $edad->format('%y');
    }

    public function GetPerfil01()
    {
        try {

            $sql = "SELECT personal.*,afiliaciones.eps,arl,fondo,caja FROM personal
            LEFT JOIN  afiliaciones ON personal.id=afiliaciones.usuario_id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            // Create the Excel file
            $fileName = 'PlantaPersonal.xls';
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");           
            header("Content-Disposition: attachment; filename=" . $fileName);
            $excelFile = fopen($fileName, 'w+');
            // Write the table data to the Excel file
            $contrato = new Contrato();
            echo "<table border='1'>
             <thead>
                 <tr>
                     <th>No</th>
                     <th>Identificacion</th>
                     <th>F Expedición</th>
                     <th>Nombres</th>                                        
                     <th>Sexo</th> 
                     <th>Estado</th>                   
                     <th>Tipo Sangre</th>
                     <th>Estado Civil</th>   
                     <th>Cargo</th>   
                     <th>Proceso</th>   
                     <th>Tipo Contrato</th>   
                     <th>Fecha</th>
                     <th>Antigueda</th>
                     <th>Estado Del Contrato</th>
                     <th># Celular</th>
                     <th>Nombre Contacto Emergencia</th>
                     <th>Telefono Contacto Emergencia</th>
                     <th>Fecha De Nacimiento</th>
                     <th>Lugar De Nacimiento</th>
                     <th>Edad</th>
                     <th>Edad Para Pension</th>
                     <th>Tiempo Para Pension</th>
                     <th>Ciudad Residencia</th>
                     <th>Direccion</th>
                     <th>Barrio</th>
                     <th>Estrato</th>
                     <th>Correo</th>
                     <th>Cargo jefe inmediato</th>
                     <th>Nivel educativo</th>
                     <th>Profesión</th>
                     <th>EPS</th>
                     <th>AFP</th>
                     <th>ARL</th>
                     <th>Fondo de cesantias</th>
                     <th>Ultima evaluacion de competecias</th>
                     <th>Fecha evaluacion de competecias</th>
                     <th>Ultima evaluacion de desempeño</th>
                     <th>Fecha evaluacion de desempeño</th>                    
                </tr>
            </thead>
            <tbody>";
            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {
                if ($row->FechaNacimiento != "0000-00-00") {
                    $fecha_actual = date("Y-m-d");
                    $fecha_nacimiento = date("Y-m-d", strtotime($row->FechaNacimiento));
                    $edad = date_diff(date_create($fecha_nacimiento), date_create($fecha_actual));
                    $edadf = $edad->format('%y') . "Años";
                } else {
                    $edadf = "sin dato";
                }
                $row->estado == 0 ? $estado = 'Inactivo' : $estado = 'Activo';
                $contratos = $contrato->HistorialInfo($row->id);
                echo "<tr>
                     <td>" . $row->id . "</td>
                     <td>" . $row->cedula . "</td>
                     <td>" . $row->expedicion . "</td>
                     <td>" . $row->nombre . ' ' . $row->apellidos . "</td>
                     <td>" . $row->Sexo . "</td>
                     <td>" . $estado . " </td>
                     <td>" . $row->rh . "</td>                   
                     <td>" . $row->estado_civil . " </td>                    
                     <td>" . @$contratos->cargo . "</td>
                     <td>" . @$contratos->NombreProceso . "</td>                   
                     <td>" . @$contratos->contrato . "</td>
                     <td>" . @$contratos->inicio_contrato . "</td>                     
                     <td>antiguedad</td>
                     <td>estado del contrato</td>
                     <td>" . $row->celular . "</td>
                     <td>" . $row->nom_contacto_emergencia . " </td>
                     <td>" . $row->num_contacto_emergencia . " </td>                    
                     <td>" . $row->FechaNacimiento . "</td>
                     <td>" . $row->LugarNacimiento . "</td>
                     <td>" . $edadf . "</td> 
                     <td>" . $row->edad_pension . "</td>
                     <td>" . $row->tiempo_pension . "</td>
                     <td>" . $row->ciudad_recidencia . "</td>
                     <td>" . $row->direccion . "</td>
                     <td>" . $row->Barrio . "</td>
                     <td>" . $row->estrato . "</td>
                     <td>" . $row->correo . "</td>
                     <td>" . $row->cargo_jefe_id . "</td>
                     <td>" . $row->nivel_educativo . "</td>
                     <td>" . $row->profesion . "</td>
                     <td>" . $row->eps . "</td>
                     <td>" . $row->fondo . "</td>
                     <td>" . $row->arl . "</td>
                     <td>" . $row->caja . "</td>
                     <td>" . $row->uec . "</td>
                     <td>" . $row->fec . "</td>
                     <td>" . $row->ued . "</td>
                     <td>" . $row->fed . "</td>     
                   </tr>";
            }
            echo "</tbody>
         </table>";
            return $fileName;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetPerfil()
    {
        try {
            $sql = "SELECT personal.*,sociodemografico.* 
        FROM personal
        LEFT JOIN sociodemografico ON personal.id=sociodemografico.personal_id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            // Create the Excel file
            $fileName = 'perfilSocioDemografico.xls';
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=" . $fileName);
            $excelFile = fopen($fileName, 'w+');
            // Write the table data to the Excel file
            echo "<table border='1'>
             <thead>
                 <tr>
                     <th>No</th>
                     <th>Identificación</th>
                     <th>Nombres y Apellidos</th>
                     <th>Sexo</th>
                     <th>Tipo Vivienda</th>
                     <th>CUANTAS PERSONAS DEPENDE DEL TRABAJADOR?</th>
                     <th>CUANTAS PERSONAS VIVE?</th>
                     <th>USTED TIENE HIJOS MENORES DE 25 AÑOS?</th>                     
                     <th>ALERGIA</th>
                     <th>NORMALMENTE CUAL ES SU MEDIO DE TRANSPORTE</th>
                     <th>CUANTO TIEMPO TARDA EN DESPLAZARSE DE SU CASA AL INSTITUTO?</th>
                     <th>EN QUE USAS EL TIEMPO LIBRE?</th>
                     <th>TIENES OTRO TRABAJO O FORMA DE INGRESO ECONOMICO?</th>
                     <th>CONSUME CIGARRILLO?</th>
                     <th>CONSUME LICOR?</th>
                     <th>REALIZA DEPORTE O EJERCICIO O ACTIVIDAD FISICA?</th>
                 </tr>
             </thead>
             <tbody>";
            while ($row = $stm->fetch(PDO::FETCH_OBJ)) {
                //  print_r($row);
                echo "<tr>
                     <td>" . $row->id . "</td>
                     <td>" . $row->cedula . "</td>
                     <td>" . $row->nombre . ' ' . $row->apellidos . "</td>
                     <td>" . $row->Sexo . "</td>
                     <td>Aun no</td>
                     <td>" . $row->dependientes . "</td>
                     <td>" . $row->cuantas_personas_vive . "</td>
                     <td>hijos < 25</td>
                     <td>" . $row->alergias . ' ' . $row->cual_alergia . "</td>
                     <td>" . $row->medio_transporte . "</td>
                     <td>" . $row->tiempo_desplazamiento . "</td>
                     <td>" . $row->uso_tiempo_libre . "</td>
                     <td>" . $row->otros_trabajos . "</td>
                     <td>" . $row->fuma . "</td>
                     <td>" . $row->licor . "</td>
                     <td>" . $row->realiza_ejercicio . "</td>                                         
                 </tr>";
            }
            echo "</tbody>
         </table>";
            return $fileName;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Index($id)
    {
        try {
            $result = array();
            $create = "CREATE TABLE IF NOT EXISTS `sociodemografico` (
                `id` int(11) NOT NULL,
                `personal_id` int(11) NOT NULL,
                `dependientes` int(11) NOT NULL COMMENT 'CUANTAS PERSONAS DEPENDE DEL TRABAJADOR?',
                `cuantas_personas_vive` int(11) NOT NULL COMMENT 'CUANTAS PERSONAS VIVE?',
                `alergias` varchar(255) NOT NULL COMMENT 'si, no',
                `cual_alergia` varchar(255) NOT NULL COMMENT 'EN CASO QUE LA RESPUESTA ANTERIOR SEA AFIRMATIVA ESPECIFIQUE CUAL?',
                `medio_transporte` varchar(255) NOT NULL COMMENT 'NORMALMENTE CUAL ES SU MEDIO DE TRANSPORTE',
                `tiempo_desplazamiento` varchar(255) NOT NULL COMMENT 'CUANTO TIEMPO TARDA EN DESPLAZARSE DE SU CASA AL INSTITUTO?',
                `uso_tiempo_libre` varchar(255) NOT NULL COMMENT 'EN QUE USAS EL TIEMPO LIBRE?',
                `otros_trabajos` varchar(255) NOT NULL COMMENT 'TIENES OTRO TRABAJO O FORMA DE INGRESO ECONOMICO?',
                `fuma` varchar(255) NOT NULL COMMENT 'CONSUME CIGARRILLO?',
                `licor` varchar(255) NOT NULL COMMENT 'CONSUME LICOR?',
                `realiza_ejercicio` varchar(255) NOT NULL COMMENT 'REALIZA DEPORTE O EJERCICIO O ACTIVIDAD FISICA?',
                `fecha_registro` date NOT NULL

              ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
            $stm = $this->pdo->prepare($create);
            $stm->execute();
            $sql = "SELECT * FROM sociodemografico WHERE personal_id='$id'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Add(Sociodemografico $data)
    {
        try {

            $stm = "INSERT INTO sociodemografico(personal_id,dependientes,cuantas_personas_vive, alergias,cual_alergia,medio_transporte,
            tiempo_desplazamiento,uso_tiempo_libre,	otros_trabajos,fuma,licor,realiza_ejercicio)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($stm)->execute(
                array(
                    $data->personal_id,
                    $data->dependientes,
                    $data->cuantas_personas_vive,
                    $data->alergias,
                    $data->cual_alergia,
                    $data->medio_transporte,
                    $data->tiempo_desplazamiento,
                    $data->uso_tiempo_libre,
                    $data->otros_trabajos,
                    $data->fuma,
                    $data->licor,
                    $data->realiza_ejercicio
                )
            );
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Update(Sociodemografico $data)
    {
        try {
            $sql = "UPDATE sociodemografico SET personal_id='$data->personal_id', dependientes='$data->dependientes', cuantas_personas_vive='$data->cuantas_personas_vive',
                	alergias='$data->alergias', cual_alergia='$data->cual_alergia', medio_transporte='$data->medio_transporte', tiempo_desplazamiento='$data->tiempo_desplazamiento',
                    uso_tiempo_libre='$data->uso_tiempo_libre', otros_trabajos='$data->otros_trabajos',fuma='$data->fuma',realiza_ejercicio='$data->realiza_ejercicio'                                  
                    WHERE id = $data->id";
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
}
