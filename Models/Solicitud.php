<?php

class Solicitud
{
    private $pdo;
    public $id;
    public $NombreSolicitante;
    public $FechaSolicitud;
    public $Proceso;
    public $TipoSolicitud;
    public $Codigo;
    public $VersionCambiar;
    public $TipoDocumento;
    public $Descripcion;
    public $EjecucionCambio;
    public $Aprobado;
    public $Observaciones;
    public $filename;
    public $dir;
    //ASINACION
    public $usuario;
    public $actividad;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //fin dashboard//
    public function SolicitudesTotal()
    {
        try {

            $stm = $this->pdo->prepare("SELECT count(id)as total FROM solicitudes WHERE  Proceso!='so'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Error de conexión en el modelo: ' . $e->getMessage();
            exit;
            die($e->getMessage());
        }
    }

    public function SolicitudesSi()
    {
        try {

            $stm = $this->pdo->prepare("SELECT count(id) as total FROM solicitudes WHERE Aprobado ='si' AND Proceso != 'so' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function SolicitudesNo()
    {
        try {

            $stm = $this->pdo->prepare("SELECT count(id) as total FROM solicitudes WHERE Aprobado ='no' AND Proceso != 'so'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function SolicitudesRev()
    {
        try {

            $stm = $this->pdo->prepare("SELECT count(id)as total FROM solicitudes WHERE Aprobado ='revision' AND Proceso!='so'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SolicitudesMax()
    {
        try {

            $stm = $this->pdo->prepare("SELECT MAX(id)as ULTIMA FROM solicitudes where Proceso!='so'");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function SolicitudesVacias()
    {
        try {

            $stm = $this->pdo->prepare("SELECT count(id)as total FROM solicitudes WHERE Aprobado ='' AND Proceso!='so' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //fin dashboard//
    //GESTION DE SOLICITUDES//
    public function Solicitudes()
    {
        try {
            $stm = $this->pdo->prepare("SELECT S.id,
                                               S.NombreSolicitante,
                                               S.FechaSolicitud,
                                               S.Proceso,
                                               S.TipoSolicitud,
                                               S.Codigo,
                                               S.VersionCambiar,
                                               S.TipoDocumento,
                                               S.Descripcion,
                                               S.EjecucionCambio,
                                               S.Aprobado,
                                               S.Observaciones,
                                               S.filename,
                                               S.dir,
                                               d.id as online_id                                              
                                        FROM solicitudes S
                                        LEFT OUTER JOIN doc_online d ON d.solicitud_id=S.id
                                        WHERE Proceso!='so'");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetSolicitud($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM solicitudes WHERE id='$id' ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Solicitud $data)
    {
        // print_r($data);

        try {
            $stm = "INSERT INTO solicitudes(NombreSolicitante, FechaSolicitud, Proceso, TipoSolicitud, Codigo, VersionCambiar, TipoDocumento, Descripcion, EjecucionCambio, Aprobado,Observaciones,filename, dir)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->NombreSolicitante,
                $data->FechaSolicitud,
                $data->Proceso,
                $data->TipoSolicitud,
                $data->Codigo,
                $data->VersionCambiar = 0,
                $data->TipoDocumento,
                $data->Descripcion,
                $data->EjecucionCambio = '0000-00-00',
                $data->Aprobado,
                $data->Observaciones = '',
                $data->filename,
                $data->dir
            ));
            $id = $this->pdo->lastInsertId();
            $_SESSION['ult_sol'] = $id;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Solicitud $data)
    {
        //print_r($data);
        try {

            $sql = "UPDATE solicitudes SET NombreSolicitante='$data->NombreSolicitante', FechaSolicitud='$data->FechaSolicitud',Proceso='$data->Proceso',
              	   TipoSolicitud='$data->TipoSolicitud', Codigo='$data->Codigo', VersionCambiar='$data->VersionCambiar', TipoDocumento='$data->TipoDocumento',
                   Descripcion='$data->Descripcion',EjecucionCambio='$data->EjecucionCambio',Aprobado='$data->Aprobado',Observaciones='$data->Observaciones'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActualizaGestion(Solicitud $data)
    {
        // print_r($data);
        try {

            $sql = "UPDATE solicitudes SET 
              	   Codigo='$data->Codigo',EjecucionCambio='$data->EjecucionCambio',Aprobado='$data->Aprobado',Observaciones='$data->Observaciones',  VersionCambiar='$data->VersionCambiar'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Descripcion($TipoDocumento, $proceso, $TipoSolicitud)
    {
        if ($TipoDocumento == 'documento' and $TipoSolicitud == 'creacion') {
            echo '<div class="col-sm-3">
                <div class="form-group">                    
                        <label></label>
                        <input type="text" name="Codigo" id="Codigo" value="Codigo Automatico" class="form-control" required>
                </div>
            </div>';
        }

        if ($TipoDocumento == 'documento' and ($TipoSolicitud == 'actualizacion' or $TipoSolicitud == 'eliminacion')) {

            try {

                $stm = $this->pdo->prepare("SELECT CodDocumento, NomDocumento FROM documentos WHERE Proceso ='$proceso'");
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                ///print_r($result);

            } catch (Exception $e) {
                die($e->getMessage());
            }
            echo '<div class="col-sm-3">
            <div class="form-group">
                <div class="form-line">
                    <label>Descripción</label>
                    <select name="Codigo" id="Codigo" class="form-control">';
            foreach ($result as $value) {
                echo   '<option value="' . $value->CodDocumento . '">' . $value->CodDocumento . '-' . $value->NomDocumento . '</option>';
            }
            echo '</select> 
             </div>
            </div>
           </div>';
        }

        if ($TipoDocumento == 'formato' and $TipoSolicitud == 'creacion') {
            echo '<div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Descripción</label>
                        <input type="text" name="Codigo" id="Codigo" value="Codigo Automatico" class="form-control" required>
                    </div>
                </div>
            </div>';
        }

        if ($TipoDocumento == 'formato' and ($TipoSolicitud == 'actualizacion' or $TipoSolicitud == 'eliminacion')) {

            try {

                $stm = $this->pdo->prepare("SELECT CodFormato, NomFormato FROM formatos WHERE Proceso ='$proceso'");
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                ///print_r($result);

            } catch (Exception $e) {
                die($e->getMessage());
            }
            echo '<div class="col-sm-3">
            <div class="form-group">
                <div class="form-line">
                    <label>Descripción</label>
                    <select name="Codigo" id="Codigo" class="form-control">';
            foreach ($result as $value) {
                echo '<option value="' . $value->CodFormato . '">' . $value->CodFormato . '-' . $value->NomFormato . '</option>';
            }
            echo '</select> 
             </div>
            </div>
           </div>';
        }


        if ($TipoDocumento == 'externo' and $TipoSolicitud == 'creacion') {

            echo '<div class="col-sm-3">
                <div class="form-group">
                    <div class="form-line">
                        <label>Descripción</label>
                        <input type="text" name="Codigo" id="Codigo" value="Codigo Automatico" class="form-control" required>
                    </div>
                </div>
            </div>';
        }
        if ($TipoDocumento == 'externo' and ($TipoSolicitud == 'actualizacion' or $TipoSolicitud == 'eliminacion')) {

            try {

                $stm = $this->pdo->prepare("SELECT codigo, nombre FROM sgcexternos WHERE Proceso ='$proceso'");
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                ///print_r($result);

            } catch (Exception $e) {
                die($e->getMessage());
            }
            echo '<div class="col-sm-3">
            <div class="form-group">
                <div class="form-line">
                    <label>Descripción</label>
                    <select name="Codigo" id="Codigo" class="form-control">';
            foreach ($result as $value) {
                echo   '<option value="' . $value->codigo . '">' . $value->codigo . '-' . $value->nombre . '</option>';
            }
            echo '</select> 
             </div>
            </div>
           </div>';
        }
    }

    public function DescripcionLine()
    {
    }
    public function GetInfo($proceso, $tbl)
    {
        switch ($tbl) {
            case 'documento':
                # code...
                $columnas = "CodDocumento, NomDocumento";
                $tabla = "documentos";
                break;
            case 'formato':
                # code...
                $columnas = "CodFormato, NomFormato";
                $tabla = "formatos";
                break;
            case 'externo':
                # code...
                $columnas = "codigo, nombre";
                $tabla = "sgcexternos";
                break;
        }
        try {
            $sql = "SELECT $columnas FROM " . $tabla . "  WHERE Proceso ='$proceso'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //FIN GESTION DE SOLICITUDES//

    public function GetRespuesta($proceso, $tabla)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM " . $tabla . " WHERE Proceso=:proceso");
            $stm->execute(array(':proceso' => $proceso));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetDocInfoOnline($solicitud)
    {
        try {
            $sql = "SELECT doc_on.contenido, doc.*
       FROM solicitudes as sol, doc_online as doc_on, documentos as doc 
       WHERE sol.id=doc_on.solicitud_id
       AND sol.Codigo=doc.CodDocumento
       AND doc.CodDocumento='$solicitud'";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    function compare_strings($str1, $str2)
    {
        $difference = strcmp($str1, $str2);
        echo "La diferencia entre las cadenas es: " . $difference;
    }

    function compare_strings1($str1, $str2)
    {
        $difference = xdiff_string_diff($str1, $str2);
        echo "Las diferencias entre las cadenas son: " . $difference;
    }

    function getAsignados()
    {
        try {
            $sql = "SELECT 
                       gs.id, gs.actividad, p.NombreProceso, p.Iniciales, CONCAT(u.nombres, ' ', u.apellidos) as colaborador
                    FROM 
                        gestion_solicitudes gs 
                    JOIN  procesos p  ON  gs.proceso_id = p.id
                    JOIN  normalizacion_snu.usuarios u ON gs.usuario_id = u.id";

            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Manejar el error de manera adecuada, puedes registrar o mostrar el mensaje de error
            echo $e->getMessage();
        }
    }

    function getAsignadosProceso($Proceso, $id_usuario)
    {
        try {
            $sql = "SELECT 
                   gs.id, gs.actividad, p.NombreProceso, p.Iniciales, CONCAT(u.nombres, ' ', u.apellidos) as colaborador, u.id as colaborador_id
                FROM 
                    gestion_solicitudes gs 
                JOIN  procesos p  ON  gs.proceso_id = p.id
                JOIN  normalizacion_snu.usuarios u ON gs.usuario_id = u.id        
                WHERE p.Iniciales = :proceso
                AND u.id=:usuario_id";

            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':proceso', $Proceso, PDO::PARAM_STR);
            $stm->bindParam(':usuario_id', $id_usuario, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Manejar el error de manera adecuada, puedes registrar o mostrar el mensaje de error
            echo $e->getMessage();
        }
    }


    public function addAsignacion(Solicitud $data)
    {
        try {
            $stm = "INSERT INTO gestion_solicitudes(usuario_id, proceso_id, actividad)
            VALUES(?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->usuario,
                $data->Proceso,
                $data->actividad
            ));
            $id = $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function deleteAsignacion($id)
    {
        try {
            $stm = "DELETE FROM `gestion_solicitudes` WHERE id = :id";
            $stmt = $this->pdo->prepare($stm);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    function PerfilSolicitudesRealizadas($usuario)
    {
        try {
            $sql = "SELECT * FROM `solicitudes` WHERE `NombreSolicitante`=:solicitante";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':solicitante', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        } catch (PDOException $e) {
            throw $e;
        }
    }
    

    function PerfilSolicitudesInforme($usuario)
    {
        try {
            $sql = "SELECT TipoDocumento as td, TipoSolicitud as ts , Aprobado as estado, COUNT(*) AS CantidadSolicitudes 
            FROM solicitudes 
            WHERE NombreSolicitante=:solicitante 
            GROUP BY NombreSolicitante, TipoDocumento, TipoSolicitud, Aprobado";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':solicitante', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        } catch (PDOException $e) {
            throw $e;
        }
    }
    function PerfilSolicitudesCantidad($usuario)
    {
        try {
            $sql = "SELECT COUNT(*) AS CantidadSolicitudes 
            FROM solicitudes 
            WHERE NombreSolicitante=:solicitante 
            GROUP BY NombreSolicitante";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':solicitante', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ); 
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function comprobarDoc($codigo)
  {
    try {
      $sql = "SELECT CodDocumento, filename FROM documentos where CodDocumento='" . $_REQUEST['codigo'] . "'";
      $stmt = $this->pdo->prepare($sql);
      //$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
