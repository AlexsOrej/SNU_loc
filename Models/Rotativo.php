<?php


class Rotativo
{
    private $pdo;
    public $id;
    public $nombre;
    public $lote;
    public $ref_presentacion;
    public $cantidad;
    public $unidad;
    public $costo_Unitario;
    public $total;
    public $proveedor;
    public $fecha_ingreso;
    public $fecha_caducidad;
    public $compra_id;
    public $estado;
    public $codigo_barras;
    public $ubicacion;
    public $stock_minimo;
    public $stock_maximo;
    public $tiempo_entrega;
    public $ultima_fecha_pedido;
    //--------------//
    public $tipo_movimiento;
    public $responsable;
    public $motivo;
    public $insumo_id;
    public $fecha;
    public $ubicacion_id;



    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Getinsumo($id)
    {
        $sql = "SELECT i.nombre, p.nombre_presentacion, t.tipo
          FROM insumos i
          JOIN normalizacion_snu.presentaciones p ON i.ref_presentacion = p.id
          JOIN normalizacion_snu.tipoinsumos t ON p.tipo = t.id
          WHERE i.id=$id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function Registrar(Rotativo $data)
    {
                  try {
                // Validar si el insumo ya existe
                $sql = "SELECT COUNT(*) FROM insumos WHERE nombre = :nombre";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':nombre', $data->nombre);
                $stmt->execute();
                $count = $stmt->fetchColumn();

                if ($count > 0) {
                    // El insumo ya existe, mostrar mensaje de error
                    echo"existe";
                    return;
                }
            
                // Crear la consulta INSERT

                $sql = "INSERT INTO insumos (nombre, ref_presentacion, unidad, costounitario, total, proveedor_id, f_ingreso, f_caducidad, estado, c_barras, ubicacion, stock_min, stock_max, tiempo_entrega, ultimo_pedido)
                    VALUES (:nombre, :ref_presentacion, :unidad, :costounitario, :total, :proveedor_id, :f_ingreso, :f_caducidad, :estado, :c_barras, :ubicacion, :stock_min, :stock_max, :tiempo_entrega, :ultimo_pedido)";
                
                // Preparar la consulta

                $stmt = $this->pdo->prepare($sql);            
                // Asignar los valores a los parámetros de la consulta
                $stmt->bindParam(':nombre', $data->nombre);
                $stmt->bindParam(':ref_presentacion', $data->ref_presentacion);
                $stmt->bindParam(':unidad', $data->unidad);
                $stmt->bindParam(':costounitario', $data->costo_Unitario);
                $stmt->bindParam(':total', $data->total);
                $stmt->bindParam(':proveedor_id', $data->proveedor);
                $stmt->bindParam(':f_ingreso', $data->fecha_ingreso);
                $stmt->bindParam(':f_caducidad', $data->fecha_caducidad);
                $stmt->bindParam(':estado', $data->estado);
                $stmt->bindParam(':c_barras', $data->codigo_barras);
                $stmt->bindParam(':ubicacion', $data->ubicacion);
                $stmt->bindParam(':stock_min', $data->stock_minimo);
                $stmt->bindParam(':stock_max', $data->stock_maximo);
                $stmt->bindParam(':tiempo_entrega', $data->tiempo_entrega);
                $stmt->bindParam(':ultimo_pedido', $data->ultima_fecha_pedido);
            
                // Ejecutar la consulta
                $stmt->execute();
            } catch (\Throwable $th) {
                // Manejo de excepciones
                echo "Error al insertar el registro: " . $th->getMessage();
            }
    }

    public function Actualizar(Rotativo $data)
    {
        # code...
    }
    public function Buscar($nombre)
    {
        if (is_numeric($nombre)) {
            $where_clause = "insumos.id = '$nombre'";
        } elseif (!empty($nombre)) {
            $where_clause = "insumos.nombre LIKE '%$nombre%'";
        } else {
            $where_clause = "1=1";
        }

        $sql = "SELECT 
                unidades_medida.nombre AS unidad_nombre,
                unidades_medida.abreviatura AS unidad_abreviatura,
                normalizacion_snu.presentaciones.nombre_presentacion,
                normalizacion_snu.presentaciones.tipo,
                insumos.id,
                insumos.nombre,
                insumos.cantidad,
                insumos.unidad,
                insumos.f_ingreso,               
                insumos.stock_min, 
                insumos.stock_max                                          
                FROM 
                insumos               
                JOIN unidades_medida ON insumos.unidad = unidades_medida.id
                LEFT JOIN normalizacion_snu.presentaciones ON insumos.ref_presentacion = normalizacion_snu.presentaciones.id
                WHERE 
                $where_clause";

        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    public function BuscarMov($id)
    {

        $sql = "SELECT kardex.id, kardex.tipo_movimiento, kardex.cantidad, kardex.motivo, kardex.responsable, kardex.fecha, kardex.lote,kardex.caducidad,ubicacions.nombre,
        CASE 
            WHEN kardex.tipo_movimiento = 'entrada' THEN kardex.cantidad 
            ELSE -kardex.cantidad 
        END AS cambio,
        (SELECT SUM(CASE 
                        WHEN tipo_movimiento = 'entrada' THEN cantidad 
                        ELSE -cantidad 
                    END) 
            FROM kardex AS k2 
            WHERE k2.insumo_id = kardex.insumo_id 
                AND k2.id <= kardex.id) AS total
        FROM kardex, ubicacions
        WHERE kardex.insumo_id = '$id'
        AND ubicacions.id=kardex.ubicacion_id
        ORDER BY kardex.id, kardex.fecha asc";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function Unidades()
    {
        $sql = "SELECT * FROM unidades_medida";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function Kregistrar(Rotativo $data)
    {

        try {
            $sql = "INSERT INTO kardex (`insumo_id`, `tipo_movimiento`, `cantidad`, `costo_unitario`, `total`, `fecha`, `ubicacion_id`, `proveedor_id`, `responsable`, `lote`, `caducidad`)
                    VALUES (:insumo_id,:tipo_movimiento,:cantidad,:costo_unitario,:total,:fecha,:ubicacion_id,:proveedor_id,:responsable,:lote,:caducidad)";

            $stmt = $this->pdo->prepare($sql);
            // Bind de los parámetros
            $stmt->bindValue(':insumo_id', $data->insumo_id);
            $stmt->bindValue(':tipo_movimiento', $data->tipo_movimiento);
            $stmt->bindValue(':cantidad', $data->cantidad);
            $stmt->bindValue(':costo_unitario', $data->costo_Unitario);
            $stmt->bindValue(':total', $data->total);
            $stmt->bindValue(':fecha', $data->fecha);
            $stmt->bindValue(':ubicacion_id', $data->ubicacion_id);
            $stmt->bindValue(':proveedor_id', $data->proveedor);
            $stmt->bindValue(':responsable', $data->responsable);
            $stmt->bindValue(':lote', $data->lote);
            $stmt->bindValue(':caducidad', $data->fecha_caducidad);
            $stmt->execute();
        } catch (\Throwable $th) {
            print_r('Error al guardar en la base de datos: ' . $th->getMessage());
        }
    }

    public function Tipoinsumos()
    {
        $sql = "SELECT * FROM normalizacion_snu.tipoinsumos";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function Tipoinsumosasignado()
    {
        $sql = "SELECT * FROM tipoinsumo_asignado WHERE estado=1";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function Presentaciones($tipo)
    {
        $sql = "SELECT * FROM normalizacion_snu.presentaciones 
                WHERE tipo='$tipo' 
                ORDER BY nombre_presentacion ASC";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AsignarRotativo($usuario_id, $estado)
    {
        $sql = "INSERT INTO usuario_rotativo (usuario_id, estado) 
        VALUES (:usuario_id, :estado) 
        ON DUPLICATE KEY UPDATE estado = :estado;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }

    public function UsuarioAsignado()
    {
        $sql = "SELECT * FROM  usuario_rotativo WHERE estado=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Asignartipoinsumo($id,$tipo, $estado)
    {
        try {
            $this->pdo->beginTransaction();
    
            $tipo_insumo_value = $tipo; // Reemplaza esto con el valor correcto
            $id_value = $id;
            $estado_value = $estado;
    
            $existing_id = null;
    
            $check_existing_sql = "SELECT id FROM tipoinsumo_asignado WHERE id = :id";
            $check_existing_stmt = $this->pdo->prepare($check_existing_sql);
            $check_existing_stmt->bindParam(':id', $id_value);
            $check_existing_stmt->execute();
    
            if ($check_existing_stmt->rowCount() > 0) {
                $existing_id = $id_value;
            }
    
            if ($existing_id !== null) {
                $update_sql = "UPDATE tipoinsumo_asignado SET estado = :estado WHERE id = :id";
                $update_stmt = $this->pdo->prepare($update_sql);
                $update_stmt->bindParam(':id', $id_value);
                $update_stmt->bindParam(':estado', $estado_value);
                $update_stmt->execute();
            } else {
                $insert_sql = "INSERT INTO tipoinsumo_asignado (id, tipo_insumo, estado) VALUES (:id, :tipo_insumo, :estado)";
                $insert_stmt = $this->pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':id', $id_value);
                $insert_stmt->bindParam(':tipo_insumo', $tipo_insumo_value);
                $insert_stmt->bindParam(':estado', $estado_value);
                $insert_stmt->execute();
            }
    
            $this->pdo->commit();
        } catch (PDOException $th) {
            $this->pdo->rollBack();
            echo $th;
        }
    }
    

    public function TipoInsumoAsignado()
    {
        $sql = "SELECT * FROM  tipoinsumo_asignado WHERE estado=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**ubicacion */

    public function AsignarUbicacion($ubicacion_id, $estado)
    {
        $sql = "INSERT INTO  ubicacion_asignado (ubicacion_id, estado) 
        VALUES (:ubicacion_id, :estado) 
        ON DUPLICATE KEY UPDATE estado = :estado;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':ubicacion_id', $ubicacion_id);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
    }

    public function UbicacionAsignado()
    {
        $sql = "SELECT ubicacion_id FROM ubicacion_asignado WHERE estado = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }
    public function UbicacionAsignad01()
    {
        $sql = "SELECT ubicacions.nombre, ubicacions.id, sedes.nombre as sede
        FROM ubicacions,`ubicacion_asignado`, sedes
        WHERE ubicacion_asignado.ubicacion_id=ubicacions.id 
        AND ubicacions.sede_id=sedes.id
        AND estado=1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public   function getDataKardex($id)
    {
        try {
            $sql = "SELECT 
          k.insumo_id,
          k.lote,
          k.tipo_movimiento,
          k.cantidad,
          k.ubicacion_id,
          k.costo_unitario,
          k.total
           FROM 
          kardex k
          WHERE insumo_id= '$id'";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public   function getKardex($id)
    {
        try {
            $sql = "SELECT 
          k.insumo_id,
          k.lote,
          k.tipo_movimiento,
          k.cantidad,
          k.ubicacion_id,
          SUM(CASE k.tipo_movimiento WHEN 'entrada' THEN k.cantidad ELSE 0 END) AS cantidad_entradas,
          SUM(CASE k.tipo_movimiento WHEN 'salida' THEN k.cantidad ELSE 0 END) AS cantidad_salidas,
          (
            SELECT 
              IFNULL(SUM(cantidad), 0) 
            FROM 
              kardex 
            WHERE 
              insumo_id = k.insumo_id AND 
              lote = k.lote AND 
              tipo_movimiento = 'entrada' AND 
              fecha <= k.fecha
          ) - SUM(CASE k.tipo_movimiento WHEN 'salida' THEN k.cantidad ELSE 0 END) AS cantidad_disponible
        FROM 
          kardex k
        WHERE insumo_id= '$id'
        
        GROUP BY 
         k.ubicacion_id
        ORDER BY 
          k.ubicacion_id ASC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public   function getKardex01($id)
    {
        try {
            $sql = "SELECT 
          k.id,
          k.insumo_id,
          k.lote,
          k.tipo_movimiento,
          k.cantidad,
          k.ubicacion_id,
          SUM(CASE k.tipo_movimiento WHEN 'entrada' THEN k.cantidad ELSE 0 END) AS cantidad_entradas,
          SUM(CASE k.tipo_movimiento WHEN 'salida' THEN k.cantidad ELSE 0 END) AS cantidad_salidas,
          (
            SELECT 
              IFNULL(SUM(cantidad), 0) 
            FROM 
              kardex 
            WHERE 
              insumo_id = k.insumo_id AND 
              lote = k.lote AND 
              tipo_movimiento = 'entrada' AND 
              fecha <= k.fecha
          ) - SUM(CASE k.tipo_movimiento WHEN 'salida' THEN k.cantidad ELSE 0 END) AS cantidad_disponible
        FROM 
          kardex k
        WHERE k.id= '$id'
        ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_OBJ);
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //*=============OBTENIENDO RESULTADOS DE ENTRADAS Y SALIDAS==============*/

    public function GetTotalEntradaInsumo($insumo_id)
    {
        $sql = "SELECT  SUM(cantidad) AS total_entradas 
        FROM kardex 
        WHERE insumo_id = :insumo_id AND tipo_movimiento = 'entrada'
        GROUP BY insumo_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':insumo_id', $insumo_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_COLUMN);
        return $results;
    }

    public function GetTotalSalidaInsumo($insumo_id)
    {
        $sql = "SELECT  SUM(cantidad) AS total_salidas 
        FROM kardex 
        WHERE insumo_id = :insumo_id AND tipo_movimiento = 'salida'
        GROUP BY insumo_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':insumo_id', $insumo_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_COLUMN);
        return $results;
    }
    public function GetTotalEntradaInsumoUbicacion($insumo_id)
    {
        $sql = "SELECT kardex.id as idkardex, ubicacion_id, ubicacions.nombre as ubi_nombre, sedes.nombre as sede, SUM(cantidad) AS total_entradas 
        FROM kardex, ubicacions, sedes
        WHERE insumo_id = :insumo_id 
        AND tipo_movimiento = 'entrada'
        AND kardex.ubicacion_id=ubicacions.id
        AND ubicacions.sede_id=sedes.id
        GROUP BY ubicacion_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':insumo_id', $insumo_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function GetTotalSalidaInsumoUbicacion($insumo_id)
    {
        $sql = "SELECT  kardex.id as idkardex, ubicacion_id, ubicacions.nombre as ubi_nombre, sedes.nombre as sede, SUM(cantidad) AS total_salidas 
        FROM kardex, ubicacions, sedes
        WHERE insumo_id = :insumo_id 
        AND tipo_movimiento = 'salida'
        AND kardex.ubicacion_id=ubicacions.id
        AND ubicacions.sede_id=sedes.id
        GROUP BY ubicacion_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':insumo_id', $insumo_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    //**============Insumos por cada ubicacion============== */

    public function InsumosxUbicacion($ubicacion_id)
    {
        $sql = "SELECT insumos.nombre as insumo_nombre, ubicacions.nombre AS nom_ubi, kardex.* 
        FROM `kardex`, insumos, ubicacions 
        WHERE `ubicacion_id` = :ubicacion_id 
        AND insumos.id=kardex.insumo_id 
        AND ubicacions.id=kardex.ubicacion_id 
        GROUP BY insumo_id        
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':ubicacion_id', $ubicacion_id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    public function Mguardar($k_id, $n_cantidad, $cantidad_act, $tipo, $n_ubicacion, $o_ubicacion)
    {

        $n_total = $cantidad_act - $n_cantidad;

        $sql_inserta = "INSERT INTO kardex (insumo_id, tipo_movimiento, cantidad, costo_unitario, total, fecha, ubicacion_id, proveedor_id, responsable, lote, caducidad)
    SELECT insumo_id, '$tipo', $n_cantidad AS cantidad, costo_unitario, $n_cantidad * costo_unitario AS total, NOW() AS fecha, '$n_ubicacion' AS ubicacion_id, proveedor_id, responsable, lote, caducidad
    FROM kardex
    WHERE id = $k_id";

        $stmt = $this->pdo->prepare($sql_inserta);
        $stmt->execute();

        $sql_actualiza = "UPDATE `kardex` SET `cantidad` = '$n_total' WHERE `kardex`.`id` = $k_id;";
        $stmt = $this->pdo->prepare($sql_actualiza);
        $stmt->execute();
    }
    /**=================DASH ROTATIVO============= */
    function getUbicacionesMovimientos()
    {
        $sql = "SELECT ubicacions.nombre, 
                SUM(CASE WHEN tipo_movimiento = 'entrada' THEN 1 ELSE 0 END) AS entradas, 
                SUM(CASE WHEN tipo_movimiento = 'salida' THEN 1 ELSE 0 END) AS salidas
                FROM kardex
                JOIN ubicacions ON kardex.ubicacion_id = ubicacions.id
                GROUP BY ubicacions.nombre
                ORDER BY SUM(CASE WHEN tipo_movimiento = 'entrada' THEN 1 ELSE 0 END) + SUM(CASE WHEN tipo_movimiento = 'salida' THEN 1 ELSE 0 END) DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function obtenerIngresosEgresosMensuales()
    {
        $sql = "SELECT YEAR(kardex.fecha) AS anio, MONTH(kardex.fecha) AS mes, 
                SUM(CASE WHEN kardex.tipo_movimiento = 'entrada' THEN kardex.total ELSE 0 END) AS total_ingresos, 
                SUM(CASE WHEN kardex.tipo_movimiento = 'salida' THEN kardex.total ELSE 0 END) AS total_egresos
                FROM kardex
                GROUP BY YEAR(kardex.fecha), MONTH(kardex.fecha)";
        $stmt = $this->pdo->query($sql);
        $resultado = array();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $fila;
        }
        return $resultado;
    }

    public function obtenerInsumos()
    {
        $stmt = $this->pdo->prepare("SELECT 
          insumos.nombre AS nombre,
          SUM(kardex.cantidad) AS cantidad_actual,
          insumos.stock_min,
          insumos.stock_max
      FROM kardex
      JOIN insumos ON kardex.insumo_id = insumos.id
      GROUP BY insumos.id
      HAVING cantidad_actual <= insumos.stock_min;
      ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
