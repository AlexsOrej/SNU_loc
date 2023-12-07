<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Usuario.php';
require_once 'Models/Cargo.php';
require_once 'Models/Pqrsf.php';
require_once 'Models/Proceso.php';
require_once 'Models/Accion.php';
require_once 'Models/Solicitud.php';
require_once 'Models/Autoreporte.php';
require_once 'Models/Servicio.php';
require_once 'Models/Estadistica.php';
require_once 'Models/Indicador.php';
require_once 'Models/Cartelera.php';
require_once 'Models/ModelAi.php';


class PerfilusuariosController
{
    private $usuario;
    private $cargo;
    private $proceso;
    private $accion;
    private $solicitudes;
    private $eventos;
    private $pqrs;
    private $servicio;
    private $estadistica;
    private $indicador;
    private $cartelera;
    private $ai;

    public function __CONSTRUCT()
    {
        $this->usuario = new Usuario();
        $this->cargo = new Cargo();
        $this->proceso = new Proceso();
        $this->accion = new Accion();
        $this->solicitudes = new Solicitud();
        $this->eventos = new Autoreporte();
        $this->pqrs = new Pqrsf();
        $this->servicio = new Servicio();
        $this->estadistica = new Estadistica();
        $this->indicador = new Indicador();
        $this->cartelera = new Cartelera();
        $this->ai = new ModelAi();
    }


    function PerfilUsuario()
    {
        $_SESSION['ai'] = '';
        $servicios = $this->servicio->Servicio();
        $entrada = $this->estadistica->Get();
        $totalsolicitudes = $this->solicitudes->PerfilSolicitudesCantidad($_SESSION['user']->FullName);
        $totalpqrs = $this->pqrs->PqrsfAsignadasTotal($_SESSION['user']->FullName);
        $totaleventos = $this->eventos->EventosEnRevisionPorPersona($_SESSION['user']->user_id);
        $totalindicadores = count($this->indicador->IndicadorPorPersona($_SESSION['user']->user_id));
        $cartelerasvigente = $this->cartelera->Carteleravigente();
        $urlVisitadas = $this->usuario->UrlVisitadas();

        require_once 'Views/Layout/perfil.php';
        require_once 'Views/Perfil/perfil.php';
        require_once 'Views/Layout/foot.php';
    }

    function Solicitudes()
    {
        $solicitudes = $this->solicitudes->PerfilSolicitudesRealizadas($_REQUEST['usuario']);
        $solicitudesInforme = $this->solicitudes->PerfilSolicitudesInforme($_REQUEST['usuario']);
        require_once 'Views/Perfil/solicitudes.php';
        require_once 'Views/Layout/filtro.php';
    }

    function Pqrs()
    {
        $PqrsfAsignadasAbierta = $this->pqrs->PqrsfAsignadasAbierta($_SESSION['user']->FullName);
        // print_r($PqrsfAsignadasAbierta);
        require_once 'Views/Perfil/pqrsf.php';
        require_once 'Views/Layout/filtro.php';
    }
    function Evento()
    {
        $eventosAsignadas = $this->eventos->EventosPorPersona($_REQUEST['id']);
        // echo'<pre>';
        // print_r($eventosAsignadas);
        // echo'</pre>';
        require_once 'Views/Perfil/evento.php';
        require_once 'Views/Layout/filtro.php';
    }

    function Indicador()
    {
        $indicadoresAsignados = $this->indicador->IndicadorPorPersona($_REQUEST['id']);
        // echo'<pre>';
        // print_r($indicadoresAsignados);
        // echo'</pre>';
        require_once 'Views/Perfil/indicador.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function IA()
    {
        // $urlVisitadas = $this->usuario->UrlVisitadas();
        // $newArray = [];

        // foreach ($urlVisitadas as $item) {
        //     // Obtener el valor de 'c' de la URL
        //     $url_parts = parse_url($item->id);
        //     parse_str($url_parts['query'], $query_params);
        //     $c_value = isset($query_params['c']) ? $query_params['c'] : null;

        //     // Crear nuevo array con 'ingresos' y 'c'
        //     $newArray[] = [
        //         'cantidad' => $item->ingresos,
        //         'modulo' => $c_value,
        //     ];
        // }
        // // Imprimir el nuevo array
        // $preg = json_encode($newArray);
        // //print_r($url_parts);
        $cargo = $this->cargo->GetCargos($_SESSION['user']->cargo_id);
        if ($_SESSION['ai'] == "") {
            $texto = $this->ai->Ai($cargo->cargo);
        } else {
            $texto = $_SESSION['ai'];
        };
        // $texto = $_SESSION['tips'];
        // Dividir el texto en líneas
        $lineas = explode("\n", $texto);
        // Inicializar la nueva lista
        $nuevaLista = [];

        // Iterar sobre cada línea
        foreach ($lineas as $linea) {
            // Verificar si la línea contiene un número seguido de un punto
            if (preg_match('/^(\d+)\.\s*(.*)/', $linea, $matches)) {
                $indice = intval($matches[1]);
                $contenido = trim($matches[2]);
                $nuevaLista[] = ['indice' => $indice, 'contenido' => $contenido];
            }
        }
        foreach ($nuevaLista as $key => $value) {
            echo '<div class="card" style="border-radius:15px; color:black; background-color:#FFCC80">';
            echo  '<div class="body">';
            echo ' <p>';
            echo $value['contenido'];
            echo  '</p>
        </div></div></div>';
        }
    }
}
