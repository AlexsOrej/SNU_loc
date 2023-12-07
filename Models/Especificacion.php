<?php
//nombrar la clase
class Especificacion
{
    // crear los atributos poner los mismo nombre de la tb

    private $pdo;
    public $producto_id;
    public $ubicacion_especifica;
    public $uso;
    public $clasificacion_riesgo;
    public $marca;
    public $modelo;
    public $material;
    public $color;
    public $lugar_origen;
    public $inicio_mantenimiento;
    public $frecu_mantenimiento;
    public $resolucion;
    public $presicion;
    public $bateria;
    public $reg_DIAN;
    public $rango_ini_calibracion;
    public $rango_fin_calibracion;
    public $rango_ini_medicion;
    public $rango_fin_medicion;
    public $tipo_certificado;
    public $link;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getProductoId()
    {
        return $this->producto_id;
    }

    public function getUbicacionEspecifica()
    {
        return $this->ubicacion_especifica;
    }

    public function getUso()
    {
        return $this->uso;
    }

    public function getClasificacionRiesgo()
    {
        return $this->clasificacion_riesgo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getMaterial()
    {
        return $this->material;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getLugarOrigen()
    {
        return $this->lugar_origen;
    }

    public function getInicioMantenimiento()
    {
        return $this->inicio_mantenimiento;
    }

    public function getFrecuMantenimiento()
    {
        return $this->frecu_mantenimiento;
    }

    public function getResolucion()
    {
        return $this->resolucion;
    }

    public function getPresicion()
    {
        return $this->presicion;
    }

    public function getBateria()
    {
        return $this->bateria;
    }

    public function getRegDIAN()
    {
        return $this->reg_DIAN;
    }

    public function getRangoIniCalibracion()
    {
        return $this->rango_ini_calibracion;
    }

    public function getRangoFinCalibracion()
    {
        return $this->rango_fin_calibracion;
    }

    public function getRangoIniMedicion()
    {
        return $this->rango_ini_medicion;
    }

    public function getRangoFinMedicion()
    {
        return $this->rango_fin_medicion;
    }

    public function getTipoCertificado()
    {
        return $this->tipo_certificado;
    }
    public function getLink()
    {
        return $this->link;
    }


    public function setProductoId($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function setUbicacionEspecifica($ubicacion_especifica)
    {
        $this->ubicacion_especifica = $ubicacion_especifica;
    }

    public function setUso($uso)
    {
        $this->uso = $uso;
    }   

    public function setClasificacionRiesgo($clasificacion_riesgo)
    {
        $this->clasificacion_riesgo = $clasificacion_riesgo;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setMaterial($material)
    {
        $this->material = $material;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setLugarOrigen($lugar_origen)
    {
        $this->lugar_origen = $lugar_origen;
    }

    public function setInicioMantenimiento($inicio_mantenimiento)
    {
        $this->inicio_mantenimiento = $inicio_mantenimiento;
    }

    public function setFrecuMantenimiento($frecu_mantenimiento)
    {
        $this->frecu_mantenimiento = $frecu_mantenimiento;
    }

    public function setResolucion($resolucion)
    {
        $this->resolucion = $resolucion;
    }

    public function setPresicion($presicion)
    {
        $this->presicion = $presicion;
    }

    public function setBateria($bateria)
    {
        $this->bateria = $bateria;
    }

    public function setRegDIAN($reg_DIAN)
    {
        $this->reg_DIAN = $reg_DIAN;
    }
    public function setLink($link)
    {
        $this->link = $link;
    }

    public function setRangoIniCalibracion($rango_ini_calibracion)
    {
        $this->rango_ini_calibracion = $rango_ini_calibracion;
    }

    public function setRangoFinCalibracion($rango_fin_calibracion)
    {
        $this->rango_fin_calibracion = $rango_fin_calibracion;
    }

    public function setRangoIniMedicion($rango_ini_medicion)
    {
        $this->rango_ini_medicion = $rango_ini_medicion;
    }

    public function setRangoFinMedicion($rango_fin_medicion)
    {
        $this->rango_fin_medicion = $rango_fin_medicion;
    }

    public function setTipoCertificado($tipo_certificado)
    {
        $this->tipo_certificado = $tipo_certificado;
    }    

    public function Obtener($id)
    {
        try {
            $sql = "SELECT * FROM especificaciones  WHERE id=:id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->execute();            
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Consultar($id)
    {
        try {
            $sql = "SELECT * FROM especificaciones  WHERE producto_id=:id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->execute();            
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function InsertarDatos(Especificacion $data)
    {
        print_r($data->getUbicacionEspecifica());
        $query = "INSERT INTO especificaciones (producto_id, ubicacion_especifica, uso, clasificacion_riesgo, marca, modelo, material, color, lugar_origen, inicio_mantenimiento, frecu_mantenimiento, resolucion, presicion, bateria, reg_DIAN, rango_ini_calibracion, rango_fin_calibracion, rango_ini_medicion, rango_fin_medicion, tipo_certificado, link) 
        VALUES (:producto_id, :ubicacion_especifica, :uso, :clasificacion_riesgo, :marca, :modelo, :material, :color, :lugar_origen, :inicio_mantenimiento, :frecu_mantenimiento, :resolucion, :presicion, :bateria, :reg_DIAN, :rango_ini_calibracion, :rango_fin_calibracion, :rango_ini_medicion, :rango_fin_medicion, :tipo_certificado, :link)
        ON DUPLICATE KEY UPDATE 
        ubicacion_especifica = VALUES(ubicacion_especifica),
        uso = VALUES(uso),
        clasificacion_riesgo = VALUES(clasificacion_riesgo),
        marca = VALUES(marca),
        modelo = VALUES(modelo),
        material = VALUES(material),
        color = VALUES(color),
        lugar_origen = VALUES(lugar_origen),
        inicio_mantenimiento = VALUES(inicio_mantenimiento),
        frecu_mantenimiento = VALUES(frecu_mantenimiento),
        resolucion = VALUES(resolucion),
        presicion = VALUES(presicion),
        bateria = VALUES(bateria),
        reg_DIAN = VALUES(reg_DIAN),
        rango_ini_calibracion = VALUES(rango_ini_calibracion),
        rango_fin_calibracion = VALUES(rango_fin_calibracion),
        rango_ini_medicion = VALUES(rango_ini_medicion),
        rango_fin_medicion = VALUES(rango_fin_medicion),
        tipo_certificado = VALUES(tipo_certificado),
        link = VALUES(link)
        ";
        // Preparar la consulta
        $statement = $this->pdo->prepare($query);
        // Vincular los parámetros de la consulta
        $producto_id = $data->getProductoId();
        $ubicacion_especifica = $data->getUbicacionEspecifica();
        $uso = $data->getUso();
        $clasificacion_riesgo = $data->getClasificacionRiesgo();
        $marca = $data->getMarca();
        $modelo = $data->getModelo();
        $material = $data->getMaterial();
        $color = $data->getColor();
        $lugar_origen = $data->getLugarOrigen();
        $inicio_mantenimiento = $data->getInicioMantenimiento();
        $frecu_mantenimiento = $data->getFrecuMantenimiento();
        $resolucion = $data->getResolucion();
        $presicion = $data->getPresicion();
        $bateria = $data->getBateria();
        $reg_DIAN = $data->getRegDIAN();
        $rango_ini_calibracion = $data->getRangoIniCalibracion();
        $rango_fin_calibracion = $data->getRangoFinCalibracion();
        $rango_ini_medicion = $data->getRangoIniMedicion();
        $rango_fin_medicion = $data->getRangoFinMedicion();
        $tipo_certificado = $data->getTipoCertificado();
        $link = $data->getLink();

        $statement->bindParam(':producto_id', $producto_id);
        $statement->bindParam(':ubicacion_especifica', $ubicacion_especifica);
        $statement->bindParam(':uso', $uso);
        $statement->bindParam(':clasificacion_riesgo', $clasificacion_riesgo);
        $statement->bindParam(':marca', $marca);
        $statement->bindParam(':modelo', $modelo);
        $statement->bindParam(':material', $material);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':lugar_origen', $lugar_origen);
        $statement->bindParam(':inicio_mantenimiento', $inicio_mantenimiento);
        $statement->bindParam(':frecu_mantenimiento', $frecu_mantenimiento);
        $statement->bindParam(':resolucion', $resolucion);
        $statement->bindParam(':presicion', $presicion);
        $statement->bindParam(':bateria', $bateria);
        $statement->bindParam(':reg_DIAN', $reg_DIAN);
        $statement->bindParam(':rango_ini_calibracion', $rango_ini_calibracion);
        $statement->bindParam(':rango_fin_calibracion', $rango_fin_calibracion);
        $statement->bindParam(':rango_ini_medicion', $rango_ini_medicion);
        $statement->bindParam(':rango_fin_medicion', $rango_fin_medicion);
        $statement->bindParam(':tipo_certificado', $tipo_certificado);
        $statement->bindParam(':link', $link);

        // Ejecutar la consulta
        $resultado = $statement->execute();

        // Devolver el resultado de la ejecución de la consulta
        return $resultado;
    }
}
