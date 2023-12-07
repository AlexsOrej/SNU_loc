<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Especificacion.php';

//nombre la clase
class EspecificacionesController
{
    public $model;
    public function __CONSTRUCT()
    {
        $this->model = new Especificacion();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {

        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Add()
    {
        $especificacion=new Especificacion();
        if(isset($_REQUEST['especicacion_id'])){
            $especificacion=$especificacion->Obtener($_REQUEST['especicacion_id']);
        }   
        require_once 'Views/Especificaciones/crud.php';
    }
    public function Registrar()
    {
        if (isset($_POST)) {
            $especificacion = new Especificacion();
            $especificacion->setProductoId($_POST['producto_id']);
            $especificacion->setUbicacionEspecifica($_POST['ubicacion_especifica']);
            $especificacion->setUso($_POST['uso']);
            $especificacion->setClasificacionRiesgo($_POST['clasificacion_riesgo']);
            $especificacion->setMarca($_POST['marca']);
            $especificacion->setModelo($_POST['modelo']);
            $especificacion->setMaterial($_POST['material']);
            $especificacion->setColor($_POST['color']);
            $especificacion->setLugarOrigen($_POST['lugar_origen']);
            $especificacion->setInicioMantenimiento($_POST['inicio_mantenimiento']);
            $especificacion->setFrecuMantenimiento($_POST['frecu_mantenimiento']);
            $especificacion->setResolucion($_POST['resolucion']);
            $especificacion->setPresicion($_POST['presicion']);
            $especificacion->setBateria($_POST['bateria']);
            $especificacion->setRegDIAN($_POST['reg_DIAN']);
            $especificacion->setRangoIniCalibracion($_POST['rango_ini_calibracion']);
            $especificacion->setRangoFinCalibracion($_POST['rango_fin_calibracion']);
            $especificacion->setRangoIniMedicion($_POST['rango_ini_medicion']);
            $especificacion->setRangoFinMedicion($_POST['rango_fin_medicion']);
            $especificacion->setTipoCertificado($_POST['tipo_certificado']);
            $especificacion->setLink($_POST['link']);

            $resultado = $this->model->InsertarDatos($especificacion);

            if ($resultado) {
                echo "Los datos se han insertado correctamente en la base de datos.";
            } else {
                echo "Ha ocurrido un error al insertar los datos en la base de datos.";
            }
        }
    }
}
