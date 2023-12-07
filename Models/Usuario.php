<?php
class Usuario
{
    private $pdo;
    private $pdo2;
    public $id;
    public $nombres;
    public $apellidos;
    public $correos;
    public $identificacion;
    public $cliente_id;
    public $rol_id;
    public $cargo_id;
    public $email;
    public $squema_id;
    public $username;
    public $password;
    public $telefono;
    public $estado;
    public $created;
    public $modified;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp01();
            $this->pdo2 = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Index()
    {
        try {
            $stm = $this->pdo->prepare("SELECT usuarios.*, rols.rol, clientes.nombre AS cliente
            FROM  usuarios, rols, clientes
            WHERE
             clientes.id = usuarios.cliente_id
             AND usuarios.rol_id=rols.id
              ORDER BY clientes.nombre ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetUsuarios()
    {
        try {
            $id = $_SESSION['datos_cliente']->id;
            $stm = $this->pdo2->prepare("SELECT * FROM  normalizacion_snu.usuarios
             WHERE cliente_id='$id' AND estado=1");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getUsuario($id)
    {
        try {

            $sql = "SELECT * FROM usuarios WHERE id = $id";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Validar(Usuario $data)
    {
        try {

            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.usuarios WHERE identificacion='$data->identificacion' AND email='$data->email'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getProveedor()
    {

        try {
            $cliente_id = $_SESSION['datos_cliente']->id;
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.usuarios WHERE rol_id=4 AND cliente_id='$cliente_id' AND estado!=0 ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getFuncionario()
    {

        try {
            $cliente_id = $_SESSION['datos_cliente']->id;
            $stm = $this->pdo->prepare("SELECT * FROM  normalizacion_snu.usuarios WHERE rol_id IN (3,2) AND cliente_id='$cliente_id' AND estado!=0");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ClaveUpdate(Usuario $data)
    {
        try {
            $sql = "UPDATE normalizacion_snu.usuarios 
                SET 
                username = :username,
                password = :password
                WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':username', $data->username);
            $stmt->bindParam(':password', $data->password);
            $stmt->bindParam(':id', $data->id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Error al actualizar la contraseña del usuario: " . $e->getMessage());
        }
    }

    public function Registrar(Usuario $data)
    {
        try {
            $sql = "INSERT INTO normalizacion_snu.usuarios (nombres, apellidos, identificacion,telefono,cliente_id, cargo_id, email, rol_id, squema_id,username, password,estado,  created, modified) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->nombres,
                        $data->apellidos,
                        $data->identificacion,
                        $data->telefono,
                        $data->cliente_id,
                        $data->cargo_id,
                        $data->email,
                        $data->rol_id,
                        $data->squema_id = 0,
                        $data->username = $data->identificacion,
                        $data->password = md5($data->identificacion),
                        $data->estado,
                        $data->created = date('Y-m-d'),
                        $data->modified = date('Y-m-d')
                    )
                );
        } catch (PDOException $e) {
            // En caso de error, mostramos el mensaje de error y detenemos la ejecución del script
            die("Error al registrar usuario: " . $e->getMessage());
        }
    }

    public function Actualizar(Usuario $data)
    {

        try {
            $sql = "UPDATE normalizacion_snu.usuarios SET
             nombres='$data->nombres' , apellidos='$data->apellidos', 
              identificacion='$data->identificacion', telefono='$data->telefono', cliente_id='$data->cliente_id', 
              email='$data->email', rol_id='$data->rol_id',
               cargo_id='$data->cargo_id', estado='$data->estado'
                WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function  Autorizarcolaborador($u, $d)
    {
        try {
            $sql = "INSERT INTO formatos_restricion (usuario_id, formato_id) 
        VALUES (?, ?)";
            $this->pdo2->prepare($sql)->execute(array($u, $d));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ColaboradorAutorizado($id, $doc_id)
    {
        try {
            $sql = 'SELECT * FROM formatos_restricion WHERE usuario_id=:id AND formato_id=:f_id';
            $stmt = $this->pdo2->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':f_id', $doc_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if ($result != null)
                return true;
            else
                return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function FormatoRestringido($doc_id)
    {
        try {
            $sql = 'SELECT COUNT(*) FROM formatos_restricion WHERE formato_id=:f_id';
            $stmt = $this->pdo2->prepare($sql);
            $stmt->bindParam(':f_id', $doc_id);
            $stmt->execute();
            $resultCount = $stmt->fetchColumn();

            if ($resultCount > 0) {
                return 'privado';
            } else {
                return 'publico';
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function VerColaboradoresAutorizado($doc_id)
    {
        try {
            $sql = "SELECT fr.id as restricion_id, CONCAT(nsu.nombres,' ',nsu.apellidos) as  fullNombre
            FROM  normalizacion_snu.usuarios nsu,   formatos_restricion fr
            WHERE  fr.formato_id=:f_id
            AND  nsu.id= fr.usuario_id";
            $stmt = $this->pdo2->prepare($sql);
            $stmt->bindParam(':f_id', $doc_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function QuitarColaboradoresAutorizado($id)
    {
        try {
            $sql = "DELETE FROM `formatos_restricion` WHERE id=:id";
            $stmt = $this->pdo2->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function UrlVisitadas()
    {       
        try {
            $sql = "SELECT COUNT(url) as ingresos, url as id
            FROM estadisticas
            WHERE usuario LIKE '%" . $_SESSION['user']->FullName . "%'
              AND (`url` NOT LIKE '%perfilusuarios%' AND `url` NOT LIKE '%clientes%')
            GROUP BY url
            ORDER BY ingresos DESC
            LIMIT 3";
            $stm = $this->pdo2->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos:" . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



function saludarSegunHora() {
    date_default_timezone_set('America/Bogota'); 

    $hora = date('H');

    if ($hora < 12) {
        return "¡Buenos días!";
    } elseif ($hora < 18) {
        return "¡Buenas tardes!";
    } else {
        return "¡Buenas noches!";
    }
}

}
