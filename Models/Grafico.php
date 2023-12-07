<?php
class Grafico
{
    private $pdo;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /*Solicitudes aprobadas por mes */
    public function SolByMesDoc()
    {
        try {
            $stmt =  $this->pdo->query("SET lc_time_names = 'es_ES';");
            $stms = "SELECT CONCAT(MONTHNAME(FechaSolicitud)) AS MesSolicitud, COUNT(*) AS NumSolicitudes , TipoDocumento
            FROM solicitudes
            WHERE FechaSolicitud >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            AND TipoDocumento='documento'            
            GROUP BY MesSolicitud";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SolByMesForm()
    {
        try {
            $stmt =  $this->pdo->query("SET lc_time_names = 'es_ES';");
            $stms = "SELECT CONCAT(MONTHNAME(FechaSolicitud)) AS MesSolicitud, COUNT(*) AS NumSolicitudes , TipoDocumento
            FROM solicitudes
            WHERE FechaSolicitud >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            AND TipoDocumento='formato'            
            GROUP BY TipoDocumento , MesSolicitud ";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SolByMesExt()
    {
        try {
            $result = array();
            // $stms = "SELECT EjecucionCambio,COUNT(Aprobado) as total  FROM solicitudes WHERE Aprobado='si' AND TipoDocumento='externo' AND Proceso!='so' AND EjecucionCambio > NOW() - INTERVAL 6 MONTH  GROUP BY EjecucionCambio ORDER BY EjecucionCambio ASC ";
            $stms = "SELECT
            YEAR(EjecucionCambio) AS Ano,
            MONTH(EjecucionCambio) AS Mess,
            meses.mes,
            COUNT(Aprobado) AS total
        FROM
            solicitudes,
            normalizacion_snu.meses
        WHERE
            Aprobado = 'si' AND TipoDocumento = 'externo' AND Proceso != 'so' AND EjecucionCambio > NOW() - INTERVAL 6 MONTH AND MONTH(EjecucionCambio) = normalizacion_snu.meses.id
        GROUP BY
            Mess
        ORDER BY
            Mess ASC";

            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function DocbyProceso()
    {
        $sql = "SELECT p.Iniciales, COUNT(DISTINCT d.CodDocumento) AS NumDocumentos, COUNT(DISTINCT f.CodFormato) AS NumFormatos, COUNT(DISTINCT s.id) AS NumSGCExternos 
  FROM procesos p 
  LEFT JOIN documentos d ON p.Iniciales = d.Proceso 
  LEFT JOIN formatos f ON p.Iniciales = f.Proceso 
  LEFT JOIN sgcexternos s ON p.Iniciales = s.proceso 
  GROUP BY p.Iniciales";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SolByProceso()
    {
        try {
            $result = array();
            $stms = "SELECT DISTINCT(Proceso), COUNT(id) as total FROM `solicitudes` WHERE  Proceso!='so'   GROUP BY `Proceso`";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPorcentaje($cantidad, $total)
    {
        @$porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
        $porcentaje = round($porcentaje, 0);  // Quitar los decimales
        return $porcentaje;
    }

    public function AutoreportesByEvento()
    {

        try {
            $result = array();
            $stms = "
            SELECT COUNT(pnc.id) AS total, c.clasificacionIncidente as tipo, MONTH(pnc.fechaRegistro) AS MesReg
            FROM tb_proceso_noconformes AS pnc
            INNER JOIN tb_condiciones AS c ON pnc.TbCondiciones_id = c.id        
           GROUP BY tipo";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function AutoreportesByMes()
    {

        try {
            $result = array();
            $stms = "SELECT COUNT(tb_proceso_noconformes.id) AS total, tb_condiciones.clasificacionIncidente as tipo, MONTH(tb_proceso_noconformes.fechaRegistro) AS MesReg,meses.mes
                     FROM tb_proceso_noconformes,tb_condiciones, normalizacion_snu.meses
                     WHERE                    
                      tb_proceso_noconformes.TbCondiciones_id=tb_condiciones.id
                     AND tb_proceso_noconformes.fechaRegistro > NOW() - INTERVAL 6 MONTH
                     AND MONTH(tb_proceso_noconformes.fechaRegistro) = normalizacion_snu.meses.id
                    GROUP BY tipo";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosByEstado()
    {

        try {
            $result = array();
            $stms = "SELECT DISTINCT(estado) AS estados, COUNT(*)as total, meses.mes
            FROM tb_proceso_noconformes, normalizacion_snu.meses
            WHERE
                tb_proceso_noconformes.fechaRegistro > NOW() - INTERVAL 6 MONTH
            AND MONTH(tb_proceso_noconformes.fechaRegistro) = normalizacion_snu.meses.id
            GROUP BY mes
            ORDER BY fechaRegistro ASC";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosByProceso()
    {

        try {
            $result = array();
            $stms = "SELECT DISTINCT(proceso) AS proceso, COUNT(*)as total, meses.mes,  procesos.Iniciales As proceso
            FROM tb_proceso_noconformes, normalizacion_snu.meses,procesos
            WHERE
                tb_proceso_noconformes.fechaRegistro > NOW() - INTERVAL 6 MONTH
            AND MONTH(tb_proceso_noconformes.fechaRegistro) = normalizacion_snu.meses.id
            AND procesos.id=tb_proceso_noconformes.proceso
            GROUP BY mes
            ORDER BY fechaRegistro ASC";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function EventosByEmpresa()
    {
        try {
            $result = array();
            $stms = "SELECT procesos.Iniciales as proceso, COUNT(tb_proceso_noconformes.id) total FROM tb_proceso_noconformes, procesos WHERE procesos.id=tb_proceso_noconformes.proceso  GROUP by proceso";
            $stm = $this->pdo->prepare($stms);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*
RECURSOS FISICOS.
--------TODO--------
--------Cantidad de activos--------
*/

    public function TotalActivos()
    {
        try {
            $objs = "SELECT count(`productos`.`id`)as total           
        FROM
            `productos`
        JOIN `categorias` JOIN `fabricantes` JOIN `ubicacions` JOIN `sedes` JOIN `estados` WHERE
            (
                (
                    productos.`categoria_id` = categorias.`id`
                ) AND(
                    productos.`fabricante_id` = fabricantes.`id`
                ) AND(
                    productos.`ubicacion_id` = ubicacions.`id`
                ) AND(
                    productos.`estado_id` = `estados`.`id`
                ) AND(
                    productos.`sede_id` = sedes.`id`
                )
            )
        ORDER BY
            `productos`.`id`,
            `productos`.`sede_id` ASC,
            `productos`.`ubicacion_id`";
            // $objs = "SELECT COUNT(*) as total FROM productos";
            $obj = $this->pdo->prepare($objs);
            $obj->execute();
            $total = $obj->fetch(PDO::FETCH_OBJ);
            return  $total;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /**MANTENIMIENTO
     * TODO
     * cuenta los mantenimientos sin realizar
     */
    public function MantPendientes()
    {
        try {
            $objs = "SELECT COUNT(*)AS sinManteniento FROM mantenimientos WHERE est_solicitud=? AND est_ejecucion IS NULL AND est_verificacion IS NULL";
            $obj = $this->pdo->prepare($objs);
            $obj->execute(array('planeacion'));
            return   $obj->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Prestamos()
    {
        try {
            $objs = "SELECT COUNT(*)total_prestamos FROM `prestamos` WHERE tipo=?";
            $obj = $this->pdo->prepare($objs);
            $obj->execute(array('prestamo'));
            return $obj->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActivoEstado()
    {
        try {
            $cons = "SELECT COUNT(*) as total, estados.nombre as estado
                 FROM  productos
                 JOIN  estados
                 ON productos.estado_id = estados.id
                 GROUP by estado";
            $obj = $this->pdo->prepare($cons);
            $obj->execute();
            return $obj->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ActivoBySede()
    {
        try {
            $cons = "SELECT COUNT(*) as total, sedes.nombre as sede
        FROM  productos
        JOIN  sedes
        ON productos.sede_id = sedes.id
        GROUP by sede";
            $obj = $this->pdo->prepare($cons);
            $obj->execute();
            return $obj->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function MantCumplido()
    {
        try {
            /*--total cumplidas --*/
            $cons0 = "SELECT COUNT(*) cumplidas FROM `mantenimientos` WHERE est_verificacion IS NOT NULL ";
            $obj0 = $this->pdo->prepare($cons0);
            $obj0->execute();
            $obj00 =  $obj0->fetch(PDO::FETCH_OBJ);
            return $obj00;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function MantPlaneado()
    {
        try {

            /*--total Planeadas --*/
            $cons1 = "SELECT  COUNT(*) planeadas FROM `mantenimientos`";
            $obj1 = $this->pdo->prepare($cons1);
            $obj1->execute();
            $obj01 = $obj1->fetch(PDO::FETCH_OBJ);
            return $obj01;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function MantSinEjecutar()
    {
        try {

            /*--total sin ejecutar --*/
            $cons2 = "SELECT  COUNT(*) ejecutadas FROM `mantenimientos` WHERE est_ejecucion IS NOT NULL ";
            $obj2 = $this->pdo->prepare($cons2);
            $obj2->execute();
            $obj02 = $obj2->fetch(PDO::FETCH_OBJ);
            return $obj02;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Mantverificado()
    {
        try {
            /*--Todo --*/
            $cons3 = "SELECT COUNT(*) verficadas FROM `mantenimientos` WHERE est_verificacion IS NOT NULL";
            $obj3 = $this->pdo->prepare($cons3);
            $obj3->execute();
            $obj03 = $obj3->fetch(PDO::FETCH_OBJ);
            return $obj03;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Mantenimientos()
    {
      
        $sql = "SELECT
    COUNT(*) AS total,
    SUM(CASE WHEN est_solicitud IS NOT NULL AND est_solicitud <> '' AND est_ejecucion IS NULL AND est_verificacion IS NULL THEN 1 ELSE 0 END) AS Planeados,
    SUM(CASE WHEN est_solicitud IS NOT NULL AND est_solicitud <> '' AND est_ejecucion IS NOT NULL AND est_verificacion IS NULL THEN 1 ELSE 0 END) AS Ejecutados,
    SUM(CASE WHEN est_solicitud IS NOT NULL AND est_solicitud <> '' AND est_ejecucion IS NOT NULL AND est_verificacion IS NOT NULL AND est_verificacion <> '' THEN 1 ELSE 0 END) AS Verificados
  FROM
    mantenimientos
    ";
        $mtn = $this->pdo->prepare($sql);
        $mtn->execute();
        return  $mtn->fetch(PDO::FETCH_ASSOC);
    }
    /*--------------FIN RECURSOS FISICOS.*/
}
