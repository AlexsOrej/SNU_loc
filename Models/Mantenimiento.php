<?php
//nombrar la clase
class Mantenimiento

{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo; // atributo de la conexion a bd
    public $id; //atributo del objeto
    public $producto_id; //atributo del objeto
    public $user_id; //atributo del objeto
    public $verif_user_id; //atributo del objeto
    public $est_solicitud; //atributo del objeto
    public $est_ejecucion; //atributo del objeto
    public $est_verificacion; //atributo del objeto
    public $estado; //atributo del objeto
    public $codigo; //atributo del objeto
    public $responsable; //atributo del objeto
    public $responsable_id; //atributo del objeto
    public $descripcion; //atributo del objeto
    public $fecha; //atributo del objeto
    public $recomendacion; //atributo del objeto
    public $detalles; //atributo del objeto
    public $verificacion; //atributo del objeto
    public $created; //atributo del objeto
    public $modified; //atributo del objeto


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function IndexTodo()
    {
        try {

            $result = array();
            $FullName = $_SESSION['user']->FullName;
            $_SESSION['user']->rol_id != 4 ?
                $sql = "SELECT mantenimientos.*, productos.nombre as produNombre, productos.id as produId, carateristicas FROM  mantenimientos, productos WHERE  productos.id=mantenimientos.producto_id  GROUP BY codigo "
                : $sql = "SELECT mantenimientos.*, productos.nombre as produNombre, productos.id as produId, carateristicas FROM  mantenimientos, productos WHERE  productos.id=mantenimientos.producto_id AND responsable_id='$FullName' GROUP BY codigo";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Index($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT mantenimientos.*, productos.nombre as produNombre, productos.id as produId, carateristicas FROM  mantenimientos, productos WHERE est_solicitud='planeacion' AND productos.id=mantenimientos.producto_id AND codigo='$id'  ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function IndexPlan()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT count(id) as cantidad, mantenimientos.* 
            FROM  mantenimientos 
            WHERE est_solicitud='planeacion' 
            GROUP BY codigo ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function IndexPlanSinEjcutar()
    {
        try {
            $result = array();
            // $_SESSION['user']print_r($_SESSION['user']);
            $FullName = $_SESSION['user']->user_id;
            $_SESSION['user']->rol_id != 4 ?
                $sql = "SELECT count(id) as sinEjecutar, codigo 
            FROM  mantenimientos 
            WHERE est_solicitud='planeacion' AND (est_ejecucion!='ejecucion' or est_ejecucion IS NULL)
            GROUP BY codigo "
                :
                $sql = "SELECT count(id) as sinEjecutar, codigo 
            FROM  mantenimientos 
            WHERE est_solicitud='planeacion' AND (est_ejecucion!='ejecucion' or est_ejecucion IS NULL)
            AND responsable_id='$FullName'
            GROUP BY codigo ";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function IndexPlanCant()
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT count(id) as cantidad, mantenimientos.codigo as ejecutado
            FROM  mantenimientos 
            WHERE est_verificacion!='verificacion' 
            GROUP BY codigo");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function IndexPlanEjecutado()
    {
        try {
            $result = array();

            $FullName = $_SESSION['user']->FullName;
            $_SESSION['user']->rol_id != 4 ?
                $sql = "SELECT count(id) as cantidad, mantenimientos.* 
            FROM  mantenimientos 
            WHERE est_ejecucion='ejecucion' AND (est_verificacion!='verificacion' or est_verificacion IS NULL)
            GROUP BY codigo"
                : $sql = "SELECT count(id) as cantidad, mantenimientos.* 
            FROM  mantenimientos 
            WHERE est_ejecucion='ejecucion' AND (est_verificacion!='verificacion' or est_verificacion IS NULL)
            AND responsable_id='$FullName'
            GROUP BY codigo";

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Xproducto($id)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM   mantenimientos WHERE producto_id =$id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Consultar($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM mantenimientos WHERE id =$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Add(Mantenimiento $data)
    {
        try {
            $stm = "INSERT INTO mantenimientos(
            `producto_id`, 
            `user_id`, 
            `verif_user_id`, 
            `est_solicitud`,
            `est_ejecucion`,
            `est_verificacion`,
            `estado`,
            `codigo`,
             `responsable`,
             `responsable_id`,
             `descripcion`,
             `fecha`,
             `recomendacion`,
             `detalles`,
             `verificacion`,
             `created`,
             `modified` )
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->producto_id,
                $data->user_id,
                $data->verif_user_id,
                $data->est_solicitud,
                $data->est_ejecucion,
                $data->est_verificacion,
                $data->estado,
                $data->codigo,
                $data->responsable,
                $data->responsable_id,
                $data->descripcion,
                $data->fecha,
                $data->recomendacion,
                $data->detalles,
                $data->verificacion,
                $data->created = date('Y-m-d'),
                $data->modified = date('Y-m-d'),
            ));
            $id_cliente = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Quitar($id)
    {
        try {
            $sql = "DELETE FROM mantenimientos WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ValMant(Mantenimiento $data)
    {
        // print_r($data);
        try {
            $sql = "UPDATE  mantenimientos SET est_verificacion='$data->est_verificacion', 	verificacion='$data->verificacion', modified='$data->modified'  WHERE codigo = '$data->codigo'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Mantenimiento $data)
    {
        try {
            $sql = "UPDATE mantenimientos 
                SET 
                descripcion = :descripcion,
            recomendacion = :recomendacion,
            detalles = :detalles,
            verificacion = :verificacion,
            fecha = :fecha
                WHERE id =:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':descripcion', $data->descripcion);
            $stmt->bindParam(':recomendacion', $data->recomendacion);
            $stmt->bindParam(':detalles', $data->detalles);
            $stmt->bindParam(':verificacion', $data->verificacion);
            $stmt->bindParam(':fecha', $data->fecha);
            $stmt->bindParam(':id', $data->id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Actualización exitosa.";
            } else {
                echo "No se realizaron cambios. Los datos son idénticos a los existentes.";
            }
        } catch (PDOException $e) {
            echo "Error en la ejecución de la consulta: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
        }
    }

    public function  EjecMant(Mantenimiento $data)
    {
        // print_r($data);
        try {
            $sql = "UPDATE  mantenimientos SET est_ejecucion='$data->est_ejecucion', detalles='$data->detalles', recomendacion='$data->recomendacion', modified='$data->modified'  WHERE codigo = '$data->codigo' AND producto_id='$data->producto_id'";
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
    public function Cronograma($desde, $hasta, $ubicacion_id, $sede = NUll)
    {
        try {

            if ($ubicacion_id == "tlu") {
                $sql = "SELECT p.id, p.nombre, m.fecha, m.descripcion,
                m.est_solicitud, m.est_ejecucion, m.est_verificacion,
                m.codigo, m.recomendacion, m.detalles, m.verificacion,
                sedes.nombre AS sede, ubicacions.nombre AS ubicacion
         FROM productos p
         JOIN mantenimientos m ON p.id = m.producto_id
         JOIN ubicacions ON ubicacions.id = p.ubicacion_id
         JOIN sedes ON sedes.id = ubicacions.sede_id
         WHERE m.fecha BETWEEN :desde AND :hasta
         AND sedes.id = :sede_id
         ";
            } else {

                $sql = "SELECT p.id, p.nombre, m.fecha, m.descripcion,
                m.est_solicitud, m.est_ejecucion, m.est_verificacion,
                m.codigo, m.recomendacion, m.detalles, m.verificacion,
                s.nombre AS sede, u.nombre AS ubicacion
                FROM productos p
                JOIN mantenimientos m ON p.id = m.producto_id
                JOIN ubicacions u ON p.ubicacion_id = u.id
                JOIN sedes s ON u.sede_id = s.id
                WHERE m.fecha BETWEEN :desde AND :hasta";
            }
            if ($ubicacion_id != 0) {
                $sql .= " AND p.ubicacion_id = :ubicacion_id";
            }

            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':desde', $desde);
            $stm->bindParam(':hasta', $hasta);

            if ($ubicacion_id != 0) {
                $stm->bindParam(':ubicacion_id', $ubicacion_id);
            }

            if ($ubicacion_id == "tlu") {
                $stm->bindParam(':sede_id', $sede);
            }

            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    // public function Cronograma($desde, $hasta, $ubicacion_id, $sede = null)
    // {
    //     try {
    //         $sql = "SELECT p.id, p.nombre, m.fecha, m.descripcion,
    //             m.est_solicitud, m.est_ejecucion, m.est_verificacion,
    //             m.codigo, m.recomendacion, m.detalles, m.verificacion,
    //             s.nombre AS sede, u.nombre AS ubicacion
    //             FROM productos p
    //             JOIN mantenimientos m ON p.id = m.producto_id
    //             JOIN ubicacions u ON p.ubicacion_id = u.id
    //             JOIN sedes s ON u.sede_id = s.id
    //             WHERE m.fecha BETWEEN :desde AND :hasta";

    //         if ($ubicacion_id == "tlu" && $sede !== null) {
    //             $sql .= " AND s.id = :sede_id";
    //         }

    //         if ($ubicacion_id !== 0) {
    //             $sql .= " AND p.ubicacion_id = :ubicacion_id";
    //         }

    //         $stm = $this->pdo->prepare($sql);
    //         $stm->bindParam(':desde', $desde);
    //         $stm->bindParam(':hasta', $hasta);

    //         if ($ubicacion_id == "tlu" && $sede !== null) {
    //             $stm->bindParam(':sede_id', $sede);
    //         }

    //         if ($ubicacion_id !== 0) {
    //             $stm->bindParam(':ubicacion_id', $ubicacion_id);
    //         }

    //         $stm->execute();
    //         return $stm->fetchAll(PDO::FETCH_OBJ);
    //     } catch (PDOException $e) {
    //         throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
    //     }
    // }
}
