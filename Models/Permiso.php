<?php
class Permiso
{

    private $pdo;
    public $id;
    public $rol;
    public $estado;
    public $accion_id;
    public $proceso_id;
    public $usuario_id;
    public $created;
    public $modified;

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
            $stm = $this->pdo->prepare("SELECT * FROM normalizacion_snu.rols WHERE id != 1");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ValidarAcceso($c, $a, $u)
    {
        try {
            echo $c;
            echo $a;
            echo $u;
            $estado = 'activo';
            $consulta = 'SELECT accion_usuarios.*, acciones.* FROM normalizacion_snu.acciones, accion_usuarios                       
                         WHERE                          
                         acciones.controller = :controlador AND
                         acciones.accion = :accion AND
                         accion_usuarios.usuario_id = :usuario_id AND       
                         accion_usuarios.estado = :estado';
            $sentencia = $this->pdo->prepare($consulta);
            $sentencia->bindParam(':controlador', $c, PDO::PARAM_INT);
            $sentencia->bindParam(':accion', $a, PDO::PARAM_INT);
            $sentencia->bindParam(':usuario_id', $u, PDO::PARAM_INT);
            $sentencia->bindParam(':estado', $estado);
            $sentencia->execute();
            $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }
    public function Permiso()
    {
        try {
            $id = $_REQUEST['id'];
            $stm = $this->pdo->prepare("SELECT * FROM permisos_ WHERE tipo_usuarios=$id ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener()
    {
        try {
            $id = $_REQUEST['id'];
            $stm = $this->pdo->prepare("SELECT * FROM permisos_ WHERE id=$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function AddEdit()
    {
    }
    public function Registrar($rol)
    {
        $created = date('Y-m-d');
        $modified = date('Y-m-d');
        try {
            $stm = "INSERT INTO normalizacion_snu.rols(rol, created, modified )
                VALUES(?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array($rol, $created, $modified));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Permiso $data)
    {

        try {
            $sql = "UPDATE permisos_ SET crear='$data->crear', leer='$data->leer', actualizar='$data->actualizar', borrar='$data->borrar' WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getRol($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM normalizacion_snu.rols WHERE id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Delete()
    {
    }

    public function validar($modulo, $tipo)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM permisos_ WHERE modulo = :modulo and tipo_usuarios = :tipo");
            $stm->bindParam(':modulo', $modulo, PDO::PARAM_STR);
            $stm->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Modulos()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM normalizacion_snu.ofertas");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function VerUsuario($id)
    {
        try {
            $sql = "SELECT * FROM normalizacion_snu.usuarios WHERE id = :id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Puedes manejar el error de manera adecuada aquí,
            // como loguearlo o mostrar un mensaje al usuario.
            // También puedes lanzar una excepción personalizada si lo prefieres.
            // throw new Excepcion("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    
    public function GetControlAccion($accion_id, $usuario_id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM accion_usuarios  WHERE accion_id=:accion_id AND usuario_id = :usuario_id");
            $stm->bindParam(':accion_id', $accion_id);
            $stm->bindParam(':usuario_id', $usuario_id);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Control($mod_id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM normalizacion_snu.controllers  WHERE modulo_id=:modulo_id  ");
            $stm->bindParam(':modulo_id', $mod_id);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Accion($con_id)
    {
        try {
            $sql = "SELECT a.*, c.controller AS modulo 
            FROM normalizacion_snu.acciones AS a 
            JOIN normalizacion_snu.controllers AS c ON a.controller_id = c.id 
            WHERE a.controller_id IN ($con_id)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerDatos($usuario_id)
    {
        try {
            $sql = "SELECT c.id AS controller_id, c.controller, a.id AS accion_id, a.accion, a.nombre, au.estado, au.usuario_id, au.id as auid
            FROM normalizacion_snu.controllers c
            INNER JOIN normalizacion_snu.acciones a ON a.controller_id = c.id
            LEFT JOIN accion_usuarios au ON au.accion_id = a.id 
            WHERE au.usuario_id = '$usuario_id'
            AND au.estado!='inactivo'
            ORDER BY controller_id, accion_id, au.id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function AddControlAccion($accion_id, $usuario_id, $estado)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT estado FROM accion_usuarios WHERE accion_id = :id_accion AND usuario_id = :id_usuario");
            $stmt->bindParam(':id_accion', $accion_id);
            $stmt->bindParam(':id_usuario', $usuario_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if ($result['estado'] != $estado) {
                    $stmt = $this->pdo->prepare("UPDATE accion_usuarios SET estado = :estado WHERE 	accion_id = :id_accion AND usuario_id = :id_usuario");
                    $stmt->bindParam(':id_accion', $accion_id);
                    $stmt->bindParam(':id_usuario', $usuario_id);
                    $stmt->bindParam(':estado', $estado);
                    $stmt->execute();
                }
            } else {

                $stmt = $this->pdo->prepare("INSERT INTO accion_usuarios (accion_id, usuario_id, estado) VALUES (:id_accion, :id_usuario, :estado)");
                $stmt->bindParam(':id_accion', $accion_id);
                $stmt->bindParam(':id_usuario', $usuario_id);
                $stmt->bindParam(':estado', $estado);
                $stmt->execute();
            }
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Quitar($accion_id)
    {
        $estado = 'inactivo';
        try {
            $stmt = $this->pdo->prepare("UPDATE accion_usuarios SET estado = :estado WHERE 	id = :id");
            $stmt->bindParam(':id', $accion_id);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Quitarproceso($procesousuario_id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM usuario_proceso WHERE id = :procesousuario_id");
            $stmt->bindParam(':procesousuario_id', $procesousuario_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            // o mostrar un mensaje de error al usuario
        }
    }




    public function AsignarProcesoAdd(Permiso $procesos)
    {
        try {

            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM usuario_proceso WHERE proceso_id = :proceso_id AND usuario_id = :id_usuario");
            $stmt->execute(['proceso_id' => $procesos->proceso_id, 'id_usuario' => $procesos->usuario_id]);
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                // Ya existe un registro con el mismo usuario y proceso, no se hace nada
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO usuario_proceso (proceso_id, usuario_id) VALUES (:proceso_id, :id_usuario)");
                $stmt->bindParam(':proceso_id', $procesos->proceso_id);
                $stmt->bindParam(':id_usuario', $procesos->usuario_id);
                $stmt->execute();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function IndexUsuarioProceso($usuario_id)
    {
        try {
            $sql = "SELECT procesos.NombreProceso,procesos.id AS procesos_id , usuario_proceso.id AS usuario_proceso_id
             FROM usuario_proceso
             INNER JOIN procesos ON usuario_proceso.proceso_id = procesos.id
             WHERE usuario_proceso.usuario_id = $usuario_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    function verificarAccionControllerUsuario($accion, $controller, $usuario) {     
     
        // Consulta SQL
        $consulta = "SELECT au.id, a.accion, c.controller
                     FROM accion_usuarios au
                     INNER JOIN normalizacion_snu.acciones a ON au.accion_id = a.id
                     INNER JOIN normalizacion_snu.controllers c ON a.controller_id = c.id
                     WHERE au.usuario_id = ? AND au.estado = 'activo'
                     AND a.accion = ? AND c.controller = ?";
        
        // Preparar la consulta
        $stmt = $this->pdo->prepare($consulta);
        
        // Asignar los parámetros
        $stmt->bindParam(1, $usuario);
        $stmt->bindParam(2, $accion);
        $stmt->bindParam(3, $controller);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Si hay al menos un resultado, retornar true, de lo contrario, retornar false
        return count($resultados) > 0;
       // return $resultados;
    }
    
    function CheckSessionExpiry() {
        $inactive = 1800; // tiempo de inactividad en segundos (30 minutos)
        $session_time = $_SESSION['session_time'] ?? time();
        $time_diff = time() - $session_time;      
        if (($time_diff > $inactive) or (!isset($_SESSION))) {
          // destruir sesión y redirigir al login
          session_unset();
          session_destroy();      
          // emitir mensaje con SweetAlert y redirigir al login
        echo "<script>
         alert('La sesión ha expirado por inactividad,\\nPor favor, inicie sesión nuevamente');
         window.location = '?c=seguridad&a=Logout';                  
         </script>";
          exit;
        } else {
          $_SESSION['session_time'] = time();
        }
      }     
    
}
