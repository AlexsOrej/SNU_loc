<?php
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Sessioncheck.php';
require_once 'Models/Rotativo.php';

class RotativoController
{
    private $rol;
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Rotativo();
        
    }


    public function Index()
    {
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Ausentismo/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Buscar()
    {
        $alm = new Ausentismo();
        if (isset($_REQUEST['ausentismo_id'])) {
            $alm = $this->model->GetAusentismoUpdate($_REQUEST['ausentismo_id']);
        }
        $ausentimos = $this->model->GetAusentismo($_REQUEST['data']);
        //  print_r($ausentimos);
        $tnoveda = $this->model->Tiponovedad();
        require_once 'Views/Ausentismo/buscar.php';
    }
    public function Crud()
    {
        $aus = new Ausentismo();
        $aus->id = $_REQUEST['id'];
        $aus->personal_id = $_REQUEST['personal_id'];
        $aus->tipo_ausencia_id = $_REQUEST['tipo_ausencia_id'];
        $aus->cie10 = $_REQUEST['cie10'];
        $aus->diagnostico = $_REQUEST['diagnostico'];
        $aus->organo_sistema = $_REQUEST['organo_sistema'];
        // $aus->mes_evento = $_REQUEST['mes_evento'];
        // $aus->dia_evento = $_REQUEST['dia_evento'];
        $aus->dias_calendario_ausente = $_REQUEST['dias_calendario_ausente'];
        $aus->horas_ausente_real = $_REQUEST['horas_ausente_real'];
        $aus->incap_genarada_por = $_REQUEST['incap_genarada_por'];
        $aus->nom_ips = $_REQUEST['nom_ips'];
        $aus->nom_profesional = $_REQUEST['nom_profesional'];
        $aus->observaciones = $_REQUEST['observaciones'];
        $aus->soporte_original = $_REQUEST['soporte_original'];
        $aus->f_inicio = $_REQUEST['f_inicio'];
        $aus->f_fin = $_REQUEST['f_fin'];
        $aus->id > 0 ?
            $aus->Update($aus) :
            $aus->CreateAusentismo($aus);
    }

    public function Update()
    {
    }
    public function Delete()
    {
    }

    function obtenerDiferenciaDias($fechaInicio, $fechaFin)
    {
        // Convertir las fechas a objetos de tipo DateTime
        $fechaInicio = new DateTime($fechaInicio);
        $fechaFin = new DateTime($fechaFin);

        // Calcular la diferencia en días entre las dos fechas
        $diferencia = $fechaInicio->diff($fechaFin);
        $diferenciaDias = $diferencia->days;

        // Obtener el nombre del mes y el día de la fecha de inicio
        $nombreMes = $fechaInicio->format("F");
        $dia = $fechaInicio->format("l");

        // Devolver la diferencia en días y el nombre del mes y el día
        return "La diferencia entre las fechas es de $diferenciaDias días. La fecha de inicio es $dia, $nombreMes.";
    }

    public function cie10()
    {
        $cie10 = $this->model->Cie10($_REQUEST['cie10']);
        echo '<div class="col-sm-4">
            <div class="form-group">
                <div class="form-line">
                    <label>Diagnostico</label>
                    <input name="diagnostico" id="diagnostico" value="' . $cie10->descripcion . '" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="form-line">
                    <label>Organo/Sistema</label>
                    <input name="organo_sistema" id="organo_sistema" value="' . $cie10->nombre_capitulo . '" type="text" class="form-control" placeholder="" />
                </div>
            </div>
        </div>';
    }
}
