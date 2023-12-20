<?php


class Auditoria
{
    private $pdo;
    public $id;
    //programa
    public $cant_auditores;
    public $observaciones;
    public $alcances;
    public $criterios;
    public $objetivos;
    public $riesgos;
    public $metodo;
    public $fecha_inicio;
    public $fecha_fin;
    //plan
    public  $proceso_id;
    public  $horainicio;
    public  $horafin;
    public  $fecha;
    public  $auditorLider;
    public  $expertotecnico;
    public  $auditorapoyo;
    public  $liderproceso;
    public  $programa_id;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
            $this->verificarCrearTabla();
            $this->verificarCrearTabla0();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    private function verificarCrearTabla()
    {
        $tableName = 'auditorias';
        $sql = "SHOW TABLES LIKE :tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tableName', $tableName);
        $stmt->execute();
        $tableExists = $stmt->rowCount() > 0;
        if (!$tableExists) {
            // La tabla no existe, crea la tabla
            $this->crearTabla();
        }
    }
    private function verificarCrearTabla0()
    {
        $tableName = 'planauditorias';
        $sql = "SHOW TABLES LIKE :tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tableName', $tableName);
        $stmt->execute();
        $tableExists = $stmt->rowCount() > 0;
        if (!$tableExists) {
            // La tabla no existe, crea la tabla
            $this->crearTabla0();
        }
    }

    private function crearTabla()
    {
        $sql = "CREATE TABLE auditorias (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cant_auditores VARCHAR(50) NOT NULL,
            observaciones VARCHAR(255) NOT NULL,
            alcances VARCHAR(255) NOT NULL,
            criterios VARCHAR(255) NOT NULL,
            objetivos VARCHAR(255) NOT NULL,
            riesgos VARCHAR(255) NOT NULL,
            metodo VARCHAR(255) NOT NULL,
            tipo_auditoria VARCHAR(50) NOT NULL,
            fecha_inicio date NOT NULL,
            fecha_fin date NOT NULL
        )";
        $this->pdo->exec($sql);
    }

    private function crearTabla0()
    {
        $sql = "CREATE TABLE planauditorias (
            id INT AUTO_INCREMENT PRIMARY KEY,
            proceso_id INT NOT NULL,
            programa_id INT NOT NULL,
            horainicio TIME NOT NULL,
            horafin TIME NOT NULL,
            fecha date NOT NULL,
            auditorLider INT NOT NULL,
            expertotecnico INT NOT NULL,
            auditorapoyo INT NOT NULL,
            liderproceso INT NOT NULL)";
        $this->pdo->exec($sql);
    }


    public function Index()
    {
        try {
            $sql = 'SELECT * FROM auditorias';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function IndexPrograma($programa_id)
    {
        try {
            $sql = "SELECT a.*,p.id,horainicio,horafin,fecha,  CONCAT(pro.Iniciales,'-',pro.NombreProceso) as proceso,
              CONCAT(u.nombres,' ',u.apellidos) as auditorLider,
              CONCAT(u1.nombres,' ',u1.apellidos) as expertotecnico,
              CONCAT(u2.nombres,' ',u2.apellidos) as auditorapoyo,
              CONCAT(u3.nombres,' ',u3.apellidos) as liderproceso
                    FROM planauditorias p
                    JOIN auditorias a ON a.id=p.programa_id
                    JOIN procesos pro ON pro.id=p.proceso_id
                    JOIN normalizacion_snu.usuarios u ON u.id=p.auditorLider
                    JOIN normalizacion_snu.usuarios u1 ON u1.id=p.expertotecnico
                    JOIN normalizacion_snu.usuarios u2 ON u2.id=p.auditorapoyo
                    JOIN normalizacion_snu.usuarios u3 ON u3.id=p.liderproceso
                    WHERE p.programa_id=:programa_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':programa_id', $programa_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }


    public function ObtenerPrograma($planauditoria_id)
    {
        try {
            $sql = "SELECT a.*,p.id,horainicio,horafin,fecha,  CONCAT(pro.Iniciales,'-',pro.NombreProceso) as proceso,
              CONCAT(u.nombres,' ',u.apellidos) as auditorLider,
              CONCAT(u1.nombres,' ',u1.apellidos) as expertotecnico,
              CONCAT(u2.nombres,' ',u2.apellidos) as auditorapoyo,
              CONCAT(u3.nombres,' ',u3.apellidos) as liderproceso
                    FROM planauditorias p
                    JOIN auditorias a ON a.id=p.programa_id
                    JOIN procesos pro ON pro.id=p.proceso_id
                    JOIN normalizacion_snu.usuarios u ON u.id=p.auditorLider
                    JOIN normalizacion_snu.usuarios u1 ON u1.id=p.expertotecnico
                    JOIN normalizacion_snu.usuarios u2 ON u2.id=p.auditorapoyo
                    JOIN normalizacion_snu.usuarios u3 ON u3.id=p.liderproceso
                    WHERE p.id=:planauditoria_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':planauditoria_id', $planauditoria_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function Registrar(Auditoria $data)
    {
        try {
            $sql = "INSERT INTO auditorias (cant_auditores, observaciones, alcances, criterios, objetivos,riesgos, metodo, fecha_inicio,fecha_fin)
            VALUES (:cant_auditores,:observaciones,:alcances,:criterios,:objetivos,:riesgos,:metodo,:fecha_inicio,:fecha_fin)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':cant_auditores', $data->cant_auditores);
            $stmt->bindParam(':observaciones', $data->observaciones);
            $stmt->bindParam(':criterios', $data->criterios);
            $stmt->bindParam(':alcances', $data->alcances);
            $stmt->bindParam(':objetivos', $data->objetivos);
            $stmt->bindParam(':metodo', $data->metodo);
            $stmt->bindParam(':riesgos', $data->riesgos);
            $stmt->bindParam(':fecha_fin', $data->fecha_fin);
            $stmt->bindParam(':fecha_inicio', $data->fecha_inicio);
            $exito = $stmt->execute();
            if ($exito) {
                echo "La inserción se realizó correctamente.";
            } else {
                echo "Error en la inserción: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    public function RegistrarPlan(Auditoria $data)
    {
        try {
            $sql = "INSERT INTO planauditorias (proceso_id,programa_id,horainicio,horafin, fecha, auditorLider,expertotecnico,auditorapoyo,liderproceso)
            VALUES (:proceso_id,:programa_id ,:horainicio, :horafin, :fecha, :auditorLider, :expertotecnico, :auditorapoyo, :liderproceso)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':proceso_id', $data->proceso_id);
            $stmt->bindParam(':programa_id', $data->programa_id);
            $stmt->bindParam(':horainicio', $data->horainicio);
            $stmt->bindParam(':horafin', $data->horafin);
            $stmt->bindParam(':fecha', $data->fecha);
            $stmt->bindParam(':auditorLider', $data->auditorLider);
            $stmt->bindParam(':expertotecnico', $data->expertotecnico);
            $stmt->bindParam(':auditorapoyo', $data->auditorapoyo);
            $stmt->bindParam(':liderproceso', $data->liderproceso);
            $exito = $stmt->execute();
            $plan_id =  $this->pdo->lastInsertId();
            if ($exito) {
                $response = array(
                    "mensaje" => "La inserción se realizó correctamente.",
                    "plan_id" => $plan_id
                );

                // O si prefieres JSON
                $json_response = json_encode($response);

                // Puedes imprimir o devolver la respuesta según tus necesidades
                echo $json_response;
            } else {
                echo "Error en la inserción: " . implode(", ", $stmt->errorInfo());
            }
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    public function ObtenerPorRequisito($idrequisito)
    {
        $sql = "SELECT * FROM debes WHERE idrequisito = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idrequisito);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Obtener($idSeccion)
    {
        $sql = "SELECT * FROM secciones WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idSeccion);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function Actualizar(Auditoria $data)
    {
        $sql = "UPDATE secciones
                SET numero = :numero, titulo = :titulo
                WHERE id = :idSeccion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data->id);
        $stmt->bindParam(':numero', $data->numero);
        $stmt->bindParam(':titulo', $data->titulo);
        return $stmt->execute();
    }

    public function ActualizarPlan(Auditoria $data)
    {
        $sql = "UPDATE secciones
                SET numero = :numero, titulo = :titulo
                WHERE id = :idSeccion";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $data->id);
        $stmt->bindParam(':numero', $data->numero);
        $stmt->bindParam(':titulo', $data->titulo);
        return $stmt->execute();
    }

    public function Eliminar($id)
    {
        $sql = "DELETE FROM secciones WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idSeccion', $id);
        return $stmt->execute();
    }


    /**listar requisitos asignados */
    public function ListaRequisitos($idPlan)
    {
        $sql = "SELECT  n.version,s.numero,titulo, r.numero,r.descripcion
        FROM requisitoplan rp
       JOIN requisitos r  on rp.idRequisito=r.id
       JOIN secciones s on r.idseccion=s.id
       JOIN normas n on s.idNorma=n.id
        WHERE idPlan = :id
        ORDER BY rp.idRequisito";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idPlan);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
