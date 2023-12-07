<?php
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Ausentismo.php';
require_once 'Models/Sessioncheck.php';
require_once 'Models/Tiponovedad.php';


class AusentismosController
{
    private $rol;
    private $model;
    public function __CONSTRUCT()
    {
        $auModel = new Model();
        $this->model = new Ausentismo();
        $auModel->TblAusentismo('ausentismos');
    }


    public function Index()
    {
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Ausentismo/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Buscar()
    {
       
        $ausentimos = $this->model->GetAusentismo($_REQUEST['data']);
        //  print_r($ausentimos);
        $alm = new Ausentismo(); 
       
        $tnoveda = $this->model->Tiponovedad();
        require_once 'Views/Ausentismo/buscar.php';
    }

    public function DatosUsuario()
    {
        $alm=new Ausentismo();
        $ausentimos = $this->model->GetAusentismo($_REQUEST['dato']);
        //print_r($ausentimos);
        $tnoveda = $this->model->Tiponovedad();
        if($ausentimos){
            //print_r($ausentimos);
            $cadena ="<div class=row>
            <div class=col-sm-12>
            <h3>".$ausentimos[0]->full_name."</h3>
            <p style='background:orange' class='badge bg-primary' ><b>Cedula: </b>".$ausentimos[0]->cedula."</p>
            </div>
            <div class=col-sm-6>
        
            </div>
            </div>";
            echo $cadena;
        }else{
            echo "<div class=col-sm-12><h4> No hay registros</h4> </div>";
        }
       


        
    }

    public function Crud()
    {
        // if ($_REQUEST['id'] > 0){
        //     //para editar 
        //     $diagnostico = $_REQUEST['diagnostico_mod'];
        //     $organo_sistema = $_REQUEST['organo_mod'];
        // }else{
        //      $diagnostico = $_REQUEST['diagnostico'];
        //      $organo_sistema = $_REQUEST['organo_sistema'];
        // }

        $diagnostico = $_REQUEST['diagnostico'];
        $organo_sistema = $_REQUEST['organo_sistema'];

        $aus = new Ausentismo();
        $aus->id = $_REQUEST['id'];
        $aus->personal_id = $_REQUEST['personal_id'];
        $aus->tipo_ausencia_id = $_REQUEST['tipo_ausencia_id'];
        $aus->cie10 = $_REQUEST['cie10'];
        $aus->diagnostico = $diagnostico;
        $aus->organo_sistema = $organo_sistema;
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

    public function Editar()
    {
       
       $Ausentismo =  $this->model->ObtenerAusentismo($_REQUEST['ausentismo_id']);
        echo json_encode($Ausentismo);
        
    }


    public function Borrar()
    {
        $this->model->Borrar($_REQUEST['id-eliminar']);
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
        if($cie10){

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
        }else{
            echo '<div class="col-sm-8">
            <div class="form-group">
                <div class="form-line">
                    
                    <label>Nota</label>
                    <input  style="color:#EB2A2A" class="form-control" type="text" readonly value="El codigo cie10 registrado no existe">
                    
                </div>
            </div>
        </div>';
        }
    }
}
