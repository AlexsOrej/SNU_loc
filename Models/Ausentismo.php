<?php

class Ausentismo
{
    private $pdo;
    public $id;
    public $personal_id;
    public $tipo_ausencia_id;
    public $cie10;
    public $diagnostico;
    public $organo_sistema;
    public $dias_calendario_ausente;
    public $horas_ausente_real;
    public $incap_genarada_por;
    public $nom_ips;
    public $nom_profesional;
    public $observaciones;
    public $soporte_original;
    public $f_inicio;
    public $f_fin;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function CreateAusentismo(Ausentismo $data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO ausentismos (personal_id, tipo_ausencia_id, cie10, diagnostico, organo_sistema, dias_calendario_ausente, horas_ausente_real, incap_genarada_por, nom_ips, nom_profesional, observaciones, soporte_original, f_inicio, f_fin)
                                     VALUES (:personal_id, :tipo_ausencia_id, :cie10, :diagnostico, :organo_sistema,  :dias_calendario_ausente, :horas_ausente_real, :incap_genarada_por, :nom_ips, :nom_profesional, :observaciones, :soporte_original, :f_inicio, :f_fin)");
        $stmt->bindParam(':personal_id', $data->personal_id);
        $stmt->bindParam(':tipo_ausencia_id', $data->tipo_ausencia_id);
        $stmt->bindParam(':cie10', $data->cie10);
        $stmt->bindParam(':diagnostico', $data->diagnostico);
        $stmt->bindParam(':organo_sistema', $data->organo_sistema);
        $stmt->bindParam(':dias_calendario_ausente', $data->dias_calendario_ausente);
        $stmt->bindParam(':horas_ausente_real', $data->horas_ausente_real);
        $stmt->bindParam(':incap_genarada_por', $data->incap_genarada_por);
        $stmt->bindParam(':nom_ips', $data->nom_ips);
        $stmt->bindParam(':nom_profesional', $data->nom_profesional);
        $stmt->bindParam(':observaciones', $data->observaciones);
        $stmt->bindParam(':soporte_original', $data->soporte_original);
        $stmt->bindParam(':f_inicio', $data->f_inicio);
        $stmt->bindParam(':f_fin', $data->f_fin);
        $stmt->execute();
    }

    public function Update(Ausentismo $data)
    {
        //print_r($data);
        try {
        $sql = "UPDATE `ausentismos` SET 
            `tipo_ausencia_id`=:tipo_ausencia_id,
            `cie10`=:cie10,
            `diagnostico`=:diagnostico,
            `organo_sistema`=:organo_sistema,
            `dias_calendario_ausente`=:dias_calendario_ausente,
            `horas_ausente_real`=:horas_ausente_real,
            `incap_genarada_por`=:incap_genarada_por,
            `nom_ips`=:nom_ips,
            `observaciones`=:observaciones,
            `nom_profesional`=:nom_profesional,
            `soporte_original`=:soporte_original,
            `f_inicio`=:f_inicio,
            `f_fin`=:f_fin
             WHERE id=:id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo_ausencia_id', $data->tipo_ausencia_id);
            $stmt->bindParam(':cie10', $data->cie10);
            $stmt->bindParam(':diagnostico', $data->diagnostico);
            $stmt->bindParam(':organo_sistema', $data->organo_sistema);
            $stmt->bindParam(':dias_calendario_ausente', $data->dias_calendario_ausente);
            $stmt->bindParam(':horas_ausente_real', $data->horas_ausente_real);
            $stmt->bindParam(':incap_genarada_por', $data->incap_genarada_por);
            $stmt->bindParam(':nom_ips', $data->nom_ips);
            $stmt->bindParam(':observaciones', $data->observaciones);
            $stmt->bindParam(':nom_profesional', $data->nom_profesional);
            $stmt->bindParam(':soporte_original', $data->soporte_original);
            $stmt->bindParam(':f_inicio', $data->f_inicio);
            $stmt->bindParam(':f_fin', $data->f_fin);
            $stmt->bindParam(':id', $data->id);

            $stmt->execute();
        } catch (PDOException $th) {
            throw $th;
        }
    }

    public function ReadAusentismo()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM ausentismos WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function GetAusentismo($data)
    {
        $sql = "SELECT ausentismos.*,  ausentismos.id AS ausentismosid,
                CONCAT(personal.nombre,' ',personal.apellidos) As full_name, 
                personal.cedula,
                personal.id AS personaid,
                tipo_novedades.evento,
                tipo_novedades.id as tn_id
                FROM personal                
                LEFT JOIN ausentismos ON ausentismos.personal_id = personal.id  
                LEFT JOIN tipo_novedades ON ausentismos.tipo_ausencia_id = tipo_novedades.id  
                WHERE personal.nombre like '%$data%' or personal.cedula = '$data' or personal.apellidos like '%$data%'";



        $stmt = $this->pdo->prepare($sql);
        //$stmt->bindParam(":cedula", $data);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function ObtenerAusentismo($data)
    {
        $sql = "SELECT ausentismos.*,  ausentismos.id AS ausentismosid,
        CONCAT(personal.nombre,' ',personal.apellidos) As full_name, 
        personal.cedula,
        personal.id AS personaid,
        tipo_novedades.evento,
        tipo_novedades.id as tn_id
                FROM personal                
                LEFT JOIN ausentismos ON ausentismos.personal_id = personal.id  
                LEFT JOIN tipo_novedades ON ausentismos.tipo_ausencia_id = tipo_novedades.id  
                WHERE ausentismos.id=:id
                ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $data);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    public function DiasxTipo()
    {
        $sql = "SELECT tn.evento, SUM(a.dias_calendario_ausente) AS total_dias_ausente
     FROM ausentismos AS a
     JOIN tipo_novedades AS tn ON a.tipo_ausencia_id = tn.id
     WHERE tn.tipo = 2
     GROUP BY tn.evento";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function Cie10($id)
    {

        try {
            $sql = "SELECT codigo, descripcion, nombre_capitulo 
            FROM normalizacion_snu.cie10
            WHERE codigo='$id'";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            // Enviar un mensaje de error al registro
            error_log("Error en la consulta Cie10: " . $e->getMessage());

            // Lanzar una excepción personalizada para manejarla en otro lugar
            throw new \Exception("No se pudo obtener la información de Cie10. Por favor, inténtelo de nuevo más tarde.");
        }
    }
    public function Tiponovedad()
    {
        try {
            $sql = "SELECT id,evento FROM  tipo_novedades WHERE tipo=2";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            // Enviar un mensaje de error al registro
            error_log("Error en la consulta  tipo_novedades: " . $e->getMessage());

            // Lanzar una excepción personalizada para manejarla en otro lugar
            throw new \Exception("No se pudo obtener la información de tipo_novedades. Por favor, inténtelo de nuevo más tarde.");
        }
    }

    public function Borrar($id){
        try {
            $sql = "DELETE FROM `ausentismos` WHERE id = $id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
          error_log($e);
        }
    }
}
