<?php
//nombrar la clase
require_once 'Models/Cargo.php';
require_once 'Models/Oferta.php';
require_once 'Models/Usuario.php';
class Notificacion
{
  // crear los atributos poner los mismo nombre de la tb

  private $pdo; // atributo de la conexion a bd
  public $id; //atributo del objeto
  public $modulo_id; //atributo del objeto
  public $usuario_id; //atributo del objeto
  public $proceso_id;
  public $email;
  public $accion;


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

      $sql = "";
      if ($_REQUEST['a'] == 'pqrsf') {
        $sql = "SELECT n.id,n.usuario_id,n.email, n.accion, modulo_id, ofertas.oferta
      FROM  notificaciones n ,normalizacion_snu.ofertas 
      WHERE modulo_id=ofertas.id 
      AND modulo_id=5";
      }

      if ($_REQUEST['a'] == 'index' or $_REQUEST['a'] = "Registrar0") {
        $sql = "SELECT n.id,n.usuario_id,n.email, n.accion, modulo_id, ofertas.oferta
      FROM  notificaciones n ,normalizacion_snu.ofertas 
      WHERE modulo_id=ofertas.id 
      AND modulo_id=1";
      }

      $stm = $this->pdo->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  public function AsignadosPqrs()
  {
    try {
      $sql = "SELECT n.usuario_id as user
      FROM  notificaciones n  
      WHERE modulo_id=5";
      $stm = $this->pdo->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }



  public function Registrar(Notificacion $data)
  {
    try {
      $stm = "INSERT INTO notificaciones(modulo_id, usuario_id, proceso_id, email, accion) 
                  SELECT ?, ?, ?, ?, ? FROM dual 
                  WHERE NOT EXISTS (
                      SELECT 1 FROM notificaciones 
                      WHERE modulo_id = ? AND usuario_id = ? AND proceso_id = ? AND email = ? AND accion = ?
                  ) LIMIT 1";

      $stmt = $this->pdo->prepare($stm);
      $stmt->execute([
        $data->modulo_id,
        $data->usuario_id,
        $data->proceso_id,
        $data->email,
        $data->accion,
        $data->modulo_id,
        $data->usuario_id,
        $data->proceso_id,
        $data->email,
        $data->accion
      ]);

      if ($stmt->rowCount() > 0) {
        // La inserción se realizó correctamente, no hay registros duplicados       
        $id = $this->pdo->lastInsertId();
        echo 'La inserción se realizó correctamente, no hay registros duplicados';
      } else {
        // Ya existe una notificación igual, no se realizó la inserción
        echo 'Ya existe una notificación igual, no se realizó la inserción';
      }
    } catch (Exception $e) {
      echo false;
      die($e->getMessage());
    }
  }

  public function Actualizar(Notificacion $data)
  {
    try {
      $sql = "UPDATE notificaciones SET accion='$data->accion'  WHERE id = $data->id";
      $this->pdo->prepare($sql)->execute();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  public function Ver($id)
  {
    try {
      $result = array();
      $sql = "SELECT * FROM  notificaciones WHERE id=$id";
      $stm = $this->pdo->prepare($sql);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  public function Eliminar($id)
  {
    try {
      $sql = "DELETE FROM `notificaciones` WHERE id = $id";
      $this->pdo->prepare($sql)->execute();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }


  public function NotificacionAsignado($accion, $iniciales)
  {    
    try {
      $sql = "SELECT n.usuario_id, n.email, p.Iniciales, p.NombreProceso 
      FROM  notificaciones n, procesos p 
      WHERE n.proceso_id=p.id
      AND
         n.accion like '%$accion%'
      AND
         p.Iniciales='$iniciales' ";
      $stm = $this->pdo->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $th) {
      throw $th;
    }
  }

  public function Quitar($usuario, $id)
  {
    try {
      $sql = "DELETE FROM notificaciones 
      WHERE modulo_id = '$id'
      AND usuario_id = '$usuario' 
      AND proceso_id = 0";
      $stm = $this->pdo->prepare($sql);
      $stm->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
