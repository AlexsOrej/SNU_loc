<?php

use Complex\Functions;

class Estadistica
{
    private $pdo;
    private $pdo01;
    public $id;
    public $ip;
    public $url;
    public $navegador;
    public $usuario;
    public $fecha_hora;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
            $this->pdo01 = Database::StartUp01();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Est()
    {
        /* echo "<h1>Estadisticas del sitio:</h1>";
        //Recuperar informacion del visitante de la variabler globa $_SERVER
        echo "<h4>nombre de la pagina web actual</h4>";
        echo $_SERVER['PHP_SELF'];
        echo "<h4>Pagina web de donde viene el visitante</h4>";
        echo $_SERVER['HTTP_REFERER'];
        echo "<h4> Nombre del navegador</h4>";
        echo $_SERVER['HTTP_USER_AGENT'];
        echo "<h4>Direccion Ip del visitante</h4>";
        echo $_SERVER['REMOTE_ADDR'];
        echo date("Y-m-d h:i:sa");*/
    }

    public function getUserIpAddress()
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ip_addresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip_address = end($ip_addresses);
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        if (filter_var($ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
            return $ip_address;
        }

        return '?';
    }

    public function Add(Estadistica $data)
    {
        try {
            $stm = "INSERT INTO estadisticas(ip,url, navegador, usuario, fecha_hora )
            VALUES(?,?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->ip,
                $data->url,
                $data->navegador,
                $data->usuario,
                $data->fecha_hora
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Get()
    {
        try {
            $user = $_SESSION['user']->FullName;
            $stm = $this->pdo->prepare("SELECT  MAX(fecha_hora) AS ULTIMA, estadisticas.* FROM  estadisticas WHERE usuario= '$user'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Index()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM  estadisticas WHERE usuario not in ('alexsander Orejuela','DIANA GARZON')  ORDER BY fecha_hora asc");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    function IngresosPorUsuario()
    {
        $sql = "SELECT e.usuario, COUNT(*) AS cantidad, cl.nombre, cl.id as cliente_id
    FROM estadisticas e
    JOIN usuarios u ON e.usuario = CONCAT(u.nombres, ' ', u.apellidos)
    JOIN clientes cl ON u.cliente_id = cl.id
    WHERE e.url = 'c=clientes&a=verificar' 
    /* AND e.fecha_hora BETWEEN :start_date AND :end_date */
    GROUP BY e.usuario
    ORDER BY cantidad DESC, nombre DESC";
        // $start_date = '2023-05-23';
        // $end_date = '2023-09-23';
        $smt = $this->pdo01->prepare($sql);
        $smt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $smt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $smt->execute();
        return $smt->fetchAll(PDO::FETCH_OBJ);
    }

    function IngresosPorUsuarioFecha($start_date, $end_date)
    {
        $sql = "SELECT e.usuario, COUNT(*) AS cantidad, cl.nombre, cl.id as cliente_id
    FROM estadisticas e
    JOIN usuarios u ON e.usuario = CONCAT(u.nombres, ' ', u.apellidos)
    JOIN clientes cl ON u.cliente_id = cl.id
    WHERE e.url = 'c=clientes&a=verificar' 
     AND e.fecha_hora BETWEEN :start_date AND :end_date 
    GROUP BY e.usuario
    ORDER BY cantidad DESC, nombre DESC";
        // $start_date = '2023-05-23';
        // $end_date = '2023-09-23';
        $smt = $this->pdo01->prepare($sql);
        $smt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $smt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $smt->execute();
        return $smt->fetchAll(PDO::FETCH_OBJ);
    }


    public function UsoPorUsuarios($dias)
    {
        try {

            $dias = intval($dias); // Asegura que $dias sea un número entero

            $hoy = date('Y-m-d');
            $fechaInicio = date('Y-m-d', strtotime("-$dias days", strtotime($hoy)));

            $sql = "SELECT e.usuario, COUNT(*) AS cantidad, cl.nombre
            FROM estadisticas e
            JOIN usuarios u ON e.usuario = CONCAT(u.nombres, ' ', u.apellidos)
            JOIN clientes cl ON u.cliente_id = cl.id
            WHERE e.url = 'c=clientes&a=verificar' 
            AND e.fecha_hora >= :fecha_inicio
            GROUP BY e.usuario
            ORDER BY cantidad DESC, nombre DESC
            LIMIT 10";
            $smt = $this->pdo01->prepare($sql);
            $smt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
            $smt->execute();
            return $smt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }


    function TotalVisitas()
    {
        try {

            $sql = "SELECT (SELECT COUNT(id) FROM normalizacion_snu.estadisticas) AS cantidad, MIN(fecha_hora) AS desde, MAX(fecha_hora) AS hasta FROM estadisticas WHERE url !='https://calidadsnu.com/snu/?c=clientes&a=index'";
            $smt = $this->pdo01->prepare($sql);
            $smt->bindParam(':fecha_inicio', $fechaInicio, PDO::PARAM_STR);
            $smt->execute();
            return $smt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    function IngresosUltimosSieteDias()
    {
        $sql = "SELECT 
                (SELECT COUNT(id) FROM estadisticas WHERE fecha_hora >= NOW() - INTERVAL 7 DAY) AS cantidad,
                NOW() - INTERVAL 7 DAY AS desde,
                MAX(fecha_hora) AS hasta 
            FROM 
                estadisticas 
            WHERE 
                url != 'https://calidadsnu.com/snu/?c=clientes&a=index'
                AND fecha_hora >= NOW() - INTERVAL 7 DAY";
        $smt = $this->pdo01->prepare($sql);
        $smt->execute();
        return $smt->fetch(PDO::FETCH_OBJ);
    }

    function IngresosDelDiaActual()
    {
        $sql = "SELECT 
                COUNT(id) AS cantidad 
            FROM 
                estadisticas 
            WHERE 
                url != 'https://calidadsnu.com/snu/?c=clientes&a=index'
                AND DATE(fecha_hora) = CURDATE()";
        $smt = $this->pdo01->prepare($sql);
        $smt->execute();
        return $smt->fetch(PDO::FETCH_OBJ);
    }
    /**CONSULTAS PARA EL DASHBOARD
     * ----------------------------
     */
    /**TOTAL DE INDICADORES */
    public function TotalIndicadores()
    {
        $sql = "SELECT COUNT(*) FROM indicadors";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function IndCumplidos()
    {
        try {
            $sql = "SELECT COUNT(*) AS IndicadoresAlcanzados
                    FROM indicadors i
                    INNER JOIN metas m ON i.id = m.indicador_id
                    INNER JOIN datos d ON i.id = d.indicador_id AND m.id = d.meta_id
                    WHERE 
                    d.fecha_aplicacion >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                    AND 
                        CASE m.comparativo
                            WHEN '<' THEN d.resultado < m.valor
                            WHEN '>' THEN d.resultado > m.valor
                            WHEN '<=' THEN d.resultado <= m.valor
                            WHEN '>=' THEN d.resultado >= m.valor
                        END";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function IndxProcesos()
    {
        try {
            $sql = "SELECT p.NombreProceso, p.Iniciales, COUNT(i.id) AS CantidadIndicadores
            FROM indicadors i
            INNER JOIN procesos p ON i.proceso_id = p.id
            GROUP BY p.id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function MetaxProcesos()
    {
        try {
            $sql = "SELECT COUNT(DISTINCT i.id) AS cantidad_indicadores_alcanzaron_meta, p.Iniciales AS Iniciales
            FROM indicadors i
            JOIN datos d ON i.id = d.indicador_id
            JOIN metas m ON i.id = m.indicador_id
            JOIN procesos p ON p.id = i.proceso_id
            WHERE 
              CASE 
                WHEN m.comparativo = '<' THEN d.resultado < m.valor
                WHEN m.comparativo = '>' THEN d.resultado > m.valor
                WHEN m.comparativo = '<=' THEN d.resultado <= m.valor
                WHEN m.comparativo = '>=' THEN d.resultado >= m.valor
              END
            GROUP BY p.Iniciales;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function AccionxProcesos()
    {
        try {
            $sql = "SELECT p.Iniciales, COUNT(DISTINCT i.id) AS cantidad_indicadores_sin_acciones
            FROM procesos p
            LEFT JOIN metas m ON p.id = m.indicador_id
            LEFT JOIN indicadors i ON m.indicador_id = i.id
            LEFT JOIN datos d ON i.id = d.indicador_id
            LEFT JOIN accions a ON d.id = a.dato_id
            WHERE a.id IS NULL
            GROUP BY p.Iniciales;";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function TiempoSessiones($f1, $f2)
    {
        try {
            $sql = "CALL CalculaDiferenciaTiempo('$f1','$f2')";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function ObtenerInformacionClientesUsuarios($f1, $f2)
    {
        try {
            $sql = "CALL ObtenerEstadisticasUsuarios('$f1','$f2')";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function ObtenerEstadisticasServicios($f1, $f2, $c)
    {
        try {
            $c != 0 ? $sql = "CALL ObtenerEstadisticasServicios('$f1','$f2', '$c')" :
                $sql = "CALL ObtenerEstadisticasServiciosTodos('$f1','$f2')";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function EstadisticasxEmpresaSessiones()
    {
        try {
            $sql = "SELECT * FROM EstadisticasxEmpresa";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function ObtenerInfoCliente($c)
    {
        try {
            $sql = "CALL ObtenerInfoCliente('$c')";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //************************************ CONSULTAS DE USOS POR CLIENTE *********************************//

    function TotalInicioSession($inicio, $fin, $cliente)
    {
        try {
            $sql = "SELECT COUNT(e.controlador) as total 
            FROM estadisticasUso e 
                 JOIN usuarios u ON e.usuario = u.id 
            AND u.cliente_id=:id               
            AND e.fecha_hora BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $cliente);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            return false;
        }
    }


    function UltimoInicioSession($inicio, $fin, $cliente)
    {
        try {
            $sql = "SELECT MAX(fecha_hora) as ultima 
            FROM estadisticas e 
            JOIN usuarios u ON e.usuario = CONCAT(u.nombres,' ',u.apellidos) 
            AND u.cliente_id=:id
            AND e.fecha_hora BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $cliente);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->ultima;
        } catch (PDOException $e) {
            return false;
        }
    }


    function Squema($cliente)
    {
        try {

            $sql0 = 'SELECT squema FROM `squemas` where cliente_id=:id';
            $stmt = $this->pdo->prepare($sql0);
            $stmt->bindParam(':id', $cliente);
            $stmt->execute();
            $bd_cliente = $stmt->fetch(PDO::FETCH_OBJ);
            $squema = $bd_cliente->squema;
            return $squema;
        } catch (PDOException $e) {
            return false;
        }
    }


    function TotalAccesoModulos($inicio, $fin, $cliente)
    {
        $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT COUNT(e.id) as total
            FROM $squema.estadisticasUso e                
                INNER JOIN normalizacion_snu.controllers c 
                        ON e.controlador=c.controller 
                JOIN normalizacion_snu.ofertas ofer 
                        ON c.modulo_id= ofer.id 
                WHERE e.fecha_hora BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    function UsuariosActivos($id)
    {

        try {
            $sql = "SELECT COUNT(u.id) as total 
                FROM usuarios u  
                WHERE u.estado=1
                 AND cliente_id=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    function UsuariosConActividad($inicio, $fin, $cliente)
    {
        $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT COUNT(DISTINCT e.usuario) as total 
            FROM $squema.estadisticasUso e 
            WHERE e.fecha_hora BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    function UsuarioConMayorActividad($inicio, $fin, $cliente)
    {
        $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT COUNT(DISTINCT e.usuario) as total 
            FROM $squema.estadisticasUso e 
            WHERE e.fecha_hora BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    function ModulosActivos($inicio, $fin, $cliente)
    {
        // $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT COUNT(DISTINCT id) as total FROM servicios_cliente 
            WHERE estado=1 
            AND cliente_id=:cliente 
            AND f_inicio BETWEEN :inicio AND :fin";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            print_r($e);
        }
    }
    function UsuarioConMasactividad($inicio, $fin, $cliente)
    {
        // $squema = $this->Squema($cliente);
        // echo  $inicio, $fin, $cliente;
        try {
            $sql = "SELECT COUNT(e.usuario) as total, r.rol, CONCAT(u.nombres,' ',u.apellidos) as usuario
            FROM estadisticasUso e 
            JOIN usuarios u ON e.usuario = u.id 
            JOIN rols r ON u.rol_id = r.id 
            WHERE e.fecha_hora BETWEEN :inicio AND :fin
            AND u.cliente_id=:cliente
            GROUP BY e.usuario 
            ORDER BY total 
            DESC LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e) {
            print_r($e);
        }
    }
    //************************************ CONSULTAS DE USOS POR MODULO *********************************//

    function obtenerParametrosDeURL($url)
    {
        // Obtener las partes de la URL
        $urlParseada = parse_url($url);
        // print_r($urlParseada);
        // Inicializar un array para almacenar los parámetros
        $parametros = array();

        // Verificar si hay una cadena de consulta en la URL
        if (isset($urlParseada['query'])) {
            // Parsear la cadena de consulta y obtener los pares clave-valor
            parse_str($urlParseada['query'], $parametros);
        } else {
            parse_str($urlParseada['path'], $parametros);
        }

        return $parametros;
    }
    public function IdUsuario($usuario)
    {
        try {

            $sql0 = "SELECT id FROM usuarios u where CONCAT(u.nombres,' ',u.apellidos)=:nombre";
            $stmt = $this->pdo->prepare($sql0);
            $stmt->bindParam(':nombre', $usuario);
            $stmt->execute();
            $bd_cliente = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $bd_cliente->id;
            return $id;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function MigrarData($cliente)
    {
        $squema = $this->Squema($cliente);
        try {
            // Consulta para seleccionar datos de la tabla de origen
            $sqlSelect = "SELECT * FROM $squema.estadisticas";
            $stmtSelect = $this->pdo->query($sqlSelect);
            //////======/////    
            $sqlSelect0 = "SELECT * FROM $squema.estadisticasUso";
            $stmtSelect0 = $this->pdo->query($sqlSelect0);
            //////======/////        
            // Verificar si hay resultados
            if ($stmtSelect0->rowCount() == 0) {
                if ($stmtSelect->rowCount() > 0) {
                    // Iterar sobre los resultados y realizar la inserción en la tabla de destino
                    while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                        $url_param =  $this->obtenerParametrosDeURL($row['url']);
                        $columna1 = $row['ip'];
                        $columna2 =  isset($url_param['c']) ? $url_param['c'] : '0';
                        $columna3 = isset($url_param['a']) ? $url_param['a'] : '0';
                        $columna4 = $row['navegador'];
                        $columna5 =  $this->IdUsuario($row['usuario']) ? $this->IdUsuario($row['usuario']) : 0;
                        $columna6 = $row['fecha_hora'];

                        // Consulta para insertar en la tabla de destino
                        $sqlInsert = "INSERT INTO $squema.estadisticasUso (ip, controlador, accion,	navegador,usuario,fecha_hora) 
                                  VALUES (:ip, :controlador,:accion,:navegador,:usuario,:fecha_hora)";
                        $stmtInsert = $this->pdo->prepare($sqlInsert);
                        $stmtInsert->bindParam(':ip', $columna1);
                        $stmtInsert->bindParam(':controlador', $columna2);
                        $stmtInsert->bindParam(':accion', $columna3);
                        $stmtInsert->bindParam(':navegador', $columna4);
                        $stmtInsert->bindParam(':usuario', $columna5);
                        $stmtInsert->bindParam(':fecha_hora', $columna6);
                        $stmtInsert->execute();
                    }

                    echo "Datos transferidos con éxito.";
                } else {
                    echo "No se encontraron datos en la tabla de origen.";
                }
            } else {
                echo "Ya existen registros en la tabla de destino.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }







    function ModulosEstadistica($inicio, $fin, $cliente)
    {
        // $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT o.id, o.oferta 
            FROM servicios_cliente sc 
            JOIN ofertas o ON sc.servicio_id = o.id 
            WHERE sc.estado=1 
            AND sc.cliente_id=:cliente
            AND sc.f_inicio BETWEEN :inicio AND :fin 
            GROUP by sc.servicio_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    public function TodosUsuariosPorModulo($modulo, $inicio, $fin, $cliente)
    {

        try {
            $squema = $this->Squema($cliente);
            $sql = "SELECT COUNT(e.id) as total 
                    FROM $squema.estadisticasUso e 
                    INNER JOIN normalizacion_snu.controllers c 
                            ON e.controlador=c.controller 
                    JOIN normalizacion_snu.ofertas ofer 
                            ON c.modulo_id= ofer.id 
                    WHERE ofer.oferta= :modulo 
                    AND fecha_hora BETWEEN :inicio AND :fin";
            // Modificamos el parámetro :modulo para incluir los caracteres % en el valor
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':modulo', $modulo);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } catch (PDOException $e) {
            // Manejar la excepción adecuadamente, por ejemplo, loguear el error
            // error_log($e->getMessage());
            // return false;
            print_r($e);
        }
    }

    function UsuariosActivadosPorModulo($oferta, $cliente)
    {
        try {
            $squema = $this->Squema($cliente);
            $sql = "SELECT au.id, a.accion, c.controller, usu.id as user_id, usu.nombres as nom_user, COUNT(DISTINCT(au.usuario_id)) as cantidad, ofer.oferta
        FROM $squema.accion_usuarios au
        INNER JOIN normalizacion_snu.acciones a ON au.accion_id = a.id
        INNER JOIN normalizacion_snu.controllers c ON a.controller_id = c.id
        JOIN normalizacion_snu.usuarios usu ON au.usuario_id = usu.id
        JOIN normalizacion_snu.ofertas ofer ON ofer.id = c.modulo_id
        WHERE ofer.oferta=:oferta
        GROUP BY ofer.oferta";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':oferta', $oferta);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if (isset($result->cantidad)) {
                return $result->cantidad;
            } else {
                return '0';
            };

            // return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    function UsoUsuario($modulo, $cliente, $inicio, $fin)
    {
        try {
            $squema = $this->Squema($cliente);
            $sql = "SELECT
            COUNT(*) AS cantidad_usos,   
            c.controller,
            ofer.oferta,
            car.cargo,
            rls.rol,
            MAX(e.fecha_hora) AS ultima_fecha_hora,
            CONCAT(usu.nombres, ' ', usu.apellidos) AS usuarios
        FROM
        $squema.estadisticasUso e
        INNER JOIN normalizacion_snu.controllers c
        ON
            e.controlador = c.controller
        JOIN normalizacion_snu.ofertas ofer
        ON
            c.modulo_id = ofer.id
        JOIN normalizacion_snu.usuarios usu
        ON
            e.usuario = usu.id
        JOIN $squema.cargos car ON
            usu.cargo_id = car.id
        JOIN normalizacion_snu.rols rls
        ON
            usu.rol_id = rls.id
        WHERE
            ofer.oferta = :modulo AND fecha_hora BETWEEN :inicio AND :fin
        GROUP BY
            e.usuario,
            c.controller
        ORDER BY
            cantidad_usos
        DESC
        LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':modulo', $modulo);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if (isset($result->cantidad_usos)) {
                return $result;
            } else {
                return '0';
            };
        } catch (PDOException $e) {
            return false;
        }
    }


    public function DatosByUsuario($cliente, $inicio, $fin)
    {
        try {
            $squema = $this->Squema($cliente);
            $sql = "SELECT CONCAT(u.nombres, ' ', u.apellidos) AS colaborador,
                            u.created as creacion,
                            c.cargo, r.rol,
                            MAX(e.fecha_hora) AS ultimo 
            FROM usuarios u 
            JOIN $squema.cargos c ON u.cargo_id = c.id JOIN rols r ON u.rol_id = r.id 
            LEFT JOIN estadisticas e ON CONCAT(u.nombres, ' ', u.apellidos) = e.usuario 
            WHERE u.cliente_id = :cliente 
            AND u.estado = 1 
            AND e.fecha_hora BETWEEN :inicio AND :fin
            GROUP BY colaborador, c.cargo, r.rol 
            ORDER BY ultimo DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (isset($result)) {
                return $result;
            } else {
                return '0';
            };
        } catch (PDOException $th) {
            throw $th;
        }
    }

    public function UsoByUsuarioModulo($colaborador, $oferta, $cliente, $inicio, $fin)
    {
        $squema = $this->Squema($cliente);
        try {
            $sql = "SELECT e.usuario, COUNT(*) AS cantidad_usos, ofer.oferta 
        FROM $squema.estadisticas e 
        INNER JOIN normalizacion_snu.controllers c ON e.url LIKE CONCAT('%c=', c.controller, '%') 
        JOIN normalizacion_snu.ofertas ofer ON c.modulo_id= ofer.id 
        WHERE e.url LIKE '%c=%' AND ofer.oferta=:oferta 
        AND e.fecha_hora BETWEEN :inicio AND :fin
        AND e.usuario =:usuario 
        GROUP BY e.usuario,ofer.oferta 
        ORDER BY cantidad_usos DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':oferta', $oferta);
            $stmt->bindParam(':usuario', $colaborador);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            if (isset($result->cantidad_usos)) {
                return $result->cantidad_usos;
            } else {
                return '0';
            };
        } catch (PDOException $th) {
            throw $th;
        }
    }


    function UsoByRol($cliente, $inicio, $fin)
    {
        try {

            $sql = "SELECT r.rol, COUNT(e.usuario) as sessionesByrol 
            FROM rols r 
            JOIN usuarios u ON r.id=u.rol_id 
            JOIN estadisticasUso e on u.id= e.usuario 
            WHERE e.fecha_hora BETWEEN :inicio AND :fin 
            AND u.cliente_id=:cliente
            GROUP by r.rol";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $th) {
            throw $th;
        }
    }

    function UsoByRolActivos($rol, $cliente, $inicio, $fin)
    {
        try {
            $sql = "SELECT r.rol, COUNT(DISTINCT e.usuario) AS sessionesByRolActivo FROM rols r
            JOIN usuarios u ON r.id = u.rol_id
            LEFT JOIN estadisticas e ON CONCAT(u.nombres, ' ', u.apellidos) = e.usuario
            WHERE e.fecha_hora BETWEEN :inicio AND :fin 
            AND u.cliente_id = :cliente
            AND u.estado = 1
            AND r.rol=:rol
            GROUP BY r.rol";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if (isset($result->sessionesByRolActivo)) {
                return  $result->sessionesByRolActivo;
            } else {
                return '0';
            };
        } catch (PDOException $th) {
            throw $th;
        }
    }

    function calcularPorcentaje($valorActual, $valorTotal)
    {
        if ($valorTotal != 0) {
            $porcentaje = ($valorActual / $valorTotal) * 100;
            return number_format($porcentaje, 2) . '%';
        } else {
            // Manejar el caso en el que $valorTotal sea igual a cero para evitar la división por cero
            return 0;
        }
    }
}
