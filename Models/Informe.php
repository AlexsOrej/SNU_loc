<?php

class Informe
{
    private $pdo;
    public $id;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function getCambioDocumental($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM informes WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getSolictudesCambio($desde, $hasta)
    {
        try {
            $sql = "SELECT
                        s.TipoSolicitud, s.TipoDocumento,
                        COUNT( s.`TipoDocumento`) AS cantidad    
                    FROM
                        solicitudes s
                        WHERE s.FechaSolicitud BETWEEN ? AND ? 
                    GROUP BY
                        s.TipoSolicitud, s.TipoDocumento;
                    ORDER BY TipoDocumento";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);

            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return json_encode($resultados);
        } catch (PDOException $e) {
            // En lugar de 'die', maneja el error adecuadamente, puedes lanzar una excepción
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    public function getSolictudesXproceso($desde, $hasta)
    {
        try {
            $sql = "SELECT Proceso, COUNT(DISTINCT id) as cantidad 
        FROM solicitudes 
        WHERE FechaSolicitud BETWEEN ? AND ?  
        AND Proceso !='so'
        GROUP BY Proceso
        ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return json_encode($resultados);
        } catch (PDOException $e) {
            // En lugar de 'die', maneja el error adecuadamente, puedes lanzar una excepción
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    public function getPromRespuesta($desde, $hasta)
    {
        try {
            $sql = " SELECT TipoDocumento, 
                                ROUND(AVG(
                                    CASE 
                                        WHEN EjecucionCambio >= FechaSolicitud 
                                        THEN DATEDIFF(EjecucionCambio, FechaSolicitud) 
                                        ELSE 0 
                                    END
                                ), 2) AS TiempoPromedioRespuestaEnDias
                        FROM solicitudes
                        WHERE FechaSolicitud >= ? AND EjecucionCambio <= ?
                        GROUP BY TipoDocumento";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return json_encode($resultados);
        } catch (PDOException $e) {
            // En lugar de 'die', maneja el error adecuadamente, puedes lanzar una excepción
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    public function GetProcesoSinSolicitud($desde, $hasta)
    {
        try {
            $sql = "SELECT p.Iniciales, p.NombreProceso, p.tipo
            FROM procesos p
            LEFT JOIN (
                SELECT DISTINCT Proceso
                FROM solicitudes
                WHERE FechaSolicitud >= ? AND FechaSolicitud <= ?
            ) s ON p.Iniciales = s.Proceso
            WHERE s.Proceso IS NULL;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }


    public function ObtenerPorcentaje($total, $cantidad)
    {
        if ($total === 0) {
            return 0; // Evitar la división por cero
        }

        // Calcular el porcentaje
        $porcentaje = ($cantidad / $total) * 100;

        return $porcentaje;
    }




    /**REPORTE DE PQRSF */
    /**REPORTE DE PQRSF 
     * 
     * TODO
     * 1-Tiempo promedio de respuesta
     * 2-Segmentación de las solicitudes
     * 3-recurrencia
     * 4-cantidad de solicitudes sin satifiacion registrada
     * 
     */

    function TiempoRespuestaPqrs($desde, $hasta)
    {

        try {
            $sql = "SELECT
         p.tipo_peticion AS TipoSolicitud,
         ROUND(AVG(DATEDIFF(r.fecha, p.fecha_registro)), 1) AS PromedioTiempoRespuestaEnDias
     FROM
         normalizacion_snu.pqrs p
     INNER JOIN
         respuestas r ON p.id = r.pqrs_id
         WHERE p.fecha_registro BETWEEN ? and ?
     GROUP BY
         p.tipo_peticion";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $th) {
            throw $th;
        }
    }

    function Segmentacionpqrs($desde, $hasta)
    {
        try {
            $sql = "SELECT
           s.nombre AS Segmento,
           COUNT(r.pqrs_id) AS CantidadPQRS
       FROM
           segmentos s
       LEFT JOIN
           respuestas r ON s.id = r.accion
           WHERE r.fecha BETWEEN ? and ?
       GROUP BY
           s.nombre
       ORDER BY
           s.nombre";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $th) {
            throw $th;
        }
    }
    function SegTipoPqrs($desde, $hasta)
    {
        try {
            $sql = "SELECT
           s.nombre AS Segmento,
           p.tipo_peticion AS tipo,
           COUNT(r.pqrs_id) AS CantidadPQRS
       FROM
           segmentos s
       
       LEFT JOIN
           respuestas r ON s.id = r.accion
           LEFT JOIN
           normalizacion_snu.pqrs p ON r.pqrs_id = p.id
           WHERE r.fecha BETWEEN ? and ?
       GROUP BY
           s.nombre
       ORDER BY           
           p.tipo_peticion,
           s.nombre";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$desde, $hasta]);
            // Utiliza fetchAll para obtener todas las filas que coinciden, no solo una
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $th) {
            throw $th;
        }
    }


    /**REPORTE DE PQRSF */
}
