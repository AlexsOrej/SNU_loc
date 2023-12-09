<?php
//require_once 'Models/Sessioncheck.php';
require_once 'Models/Model.php';
require_once 'Models/Cliente.php';
require_once 'Models/Servicio.php';
require_once 'Models/Seguridad.php';
require_once 'Models/Solicitud.php';
require_once 'Models/Permiso.php';
require_once 'Models/Producto.php';
require_once 'Models/Grafico.php';
require_once 'Models/Ausentismo.php';
require_once 'Models/Persona.php';
require_once 'Models/Subir.php';
require_once 'Models/Rotativo.php';
require_once 'Models/Proveedor.php';
require_once 'Models/Ubicacion.php';
require_once 'Models/Sede.php';
require_once 'Models/Usuario.php';
require_once 'Models/Estadistica.php';

class ClientesController
{
    private $rotativo;
    private $model;
    private $insumos;
    private $proveedor;
    private $ubicacion;
    private $sede;
    private $usuario;
    private $serviciosInfo;
    private $estadisticas;

    public function __CONSTRUCT()
    {
        $this->insumos = new Model();
        $this->model = new Cliente();
        $this->rotativo = new Rotativo();
        $this->proveedor = new Proveedor();
        $this->ubicacion = new Ubicacion();
        $this->sede = new Sede();
        $this->usuario = new Usuario();
        $this->serviciosInfo = new Servicio();
        $this->estadisticas = new Estadistica();

        $this->insumos->Tblnovedad('novedades');
        $this->insumos->Tbltiponovedades('tipo_novedades');
        $this->insumos->TblPersonal('personal');
        $this->insumos->TblProveedor('proveedores');
        $this->insumos->TblInsumos('insumos');
        $this->insumos->TblUnidades('unidades_medida');
        $this->insumos->Tblkardex('kardex');
        $this->insumos->TblUsuarioRotativo('usuario_rotativo');
        $this->insumos->Tbltipoinsumo_asignado('tipoinsumo_asignado');
        $this->insumos->Tblubicacion_asignado('ubicacion_asignado');
        $this->insumos->TblEspecificaciones('especificaciones');
        $this->insumos->ModelgestionSolicitud('gestion_solicitudes');
        $this->insumos->TblCarteleras('carteleras');
    }

    public function Menu()
    {
        require_once 'Views/Layout/menu.php';
    }



    /** verifica que tipo de usuario */
    public function Verificar()
    {
        $clientes = new Cliente();
        $servicio = new Servicio();

        // Obtener el id del cliente
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $_SESSION['cliente_id'];

        // Obtener la información del servicio asociado al cliente
        $serv = $servicio->ValidarServicio($id);
        //print_r($serv);
        if (empty($serv)) {
            // Devolver un valor de fracaso
            return false;
        } else {
            // Obtener la información del cliente
            $clientes = $this->model->upClienteValidar($id);
            $_SESSION['datos_cliente'] = $this->model->upCliente($id);
            $_SESSION['squema'] = $clientes->squema;
            // Devolver un valor de éxito            
            echo "<script>    
            //  alert('El sistema esta veficando la informacion del cliente');        
                 window.location.href = '$serv->dir';
                </script>";
            return true;
        }
    }

    public function VerificarP()
    {
        $clientes = new Cliente();
        $servicio = new Servicio();
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        } else {
            $id = $_SESSION['cliente_id'];
        }
        $serv = $servicio->ValidarServicio($id);
        if (empty($serv)) {
            echo "<script>  
            alert('Advertencia NO hay servicios asociados a este cliente, asocialos y trata de nuevo');          
                window.location.href = 'https://calidadsnu.com/';
                </script>";
        } else {
            if (isset($_SESSION['cliente_id'])) {
                $_SESSION['datos_cliente'] = $this->model->upCliente($_SESSION['cliente_id']);
                $clientes = $this->model->upClienteValidar($_SESSION['cliente_id']);
                $_SESSION['squema'] = $clientes->squema;
                echo "<script>            
                window.location.href = '?c=mantenimientos&a=index';
                </script>";
            }
        }
    }

    //** dashboard */

    public function Index()
    {
        unset($_SESSION['datos_cliente']);
        require_once 'Views/Layout/clientes.php';
        $totalvisitas = $this->estadisticas->TotalVisitas();
        $totalvisitas7dias = $this->estadisticas->IngresosUltimosSieteDias();
        $totalvisitasdiaActual = $this->estadisticas->IngresosDelDiaActual();
        $ingresosporusuario = $this->estadisticas->IngresosPorUsuario();
        /** */
        $cliente = new Cliente();
        $clientes = $cliente->getCliente();
        $servicios = $cliente->getServiciosActivosPorCliente();
        $usuarios = $cliente->getUsuariosActivosPorCliente();
        $serviciosInfo = $this->serviciosInfo->ModulosVencidos();
        /** */

        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Porusuario()
    {
        $estadistica = $this->estadisticas->UsoPorUsuarios($_REQUEST['dias']);
        // print_r($estadistica);
        echo json_encode($estadistica);
    }

    public function Uso()
    {

        $clientes = $this->model->getCliente();
        $EstadisticasSessiones = $this->estadisticas->EstadisticasxEmpresaSessiones();

        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Cliente/uso.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }



    public function UsoIndividual()
    {

        $clientes = $this->model->getCliente();
        $EstadisticasSessiones = $this->estadisticas->EstadisticasxEmpresaSessiones();

        require_once 'Views/Layout/clientes.php';
        require_once 'Views/Cliente/usoindividual.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function UsoIndividualResultado()
    {


        $cliente = $_REQUEST['clientes'];
        $inicio = $_REQUEST['startDate'];
        $fin = $_REQUEST['endDate'];
        // $this->estadisticas->MigrarData($cliente);
        $totaliniciosession = $this->estadisticas->TotalInicioSession($inicio, $fin, $cliente);
        $totalaccesomodulos = $this->estadisticas->TotalAccesoModulos($inicio, $fin, $cliente);        
        $usuariosactivos = $this->estadisticas->UsuariosActivos($cliente);
        $usuariosconactividad = $this->estadisticas->UsuariosConActividad($inicio, $fin, $cliente);
        $modulosactivos = $this->estadisticas->ModulosActivos($inicio, $fin, $cliente);
        $ultimoiniciosession = $this->estadisticas->UltimoInicioSession($inicio, $fin, $cliente);
        $usuarioconmasactividad = $this->estadisticas->UsuarioConMasactividad($inicio, $fin, $cliente);
        $ModulosEstadistica = $this->estadisticas->ModulosEstadistica($inicio, $fin, $cliente);
        $DatosByUsuario = $this->estadisticas->DatosByUsuario($cliente, $inicio, $fin);        
        $UsoByRol = $this->estadisticas->UsoByRol($cliente, $inicio, $fin);        
        require_once 'Views/Cliente/usoindividualresultado.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function FiltroServicio()
    {
        $f1 = $_REQUEST['startDate'];
        $f2 = $_REQUEST['endDate'];
        $c = $_REQUEST['clientes'];
        $tiempo_Sesiones = $this->estadisticas->TiempoSessiones($f1, $f2, $c);
        $clientes_usuarios = $this->estadisticas->ObtenerInformacionClientesUsuarios($f1, $f2);
        $obtener_servicios = $this->estadisticas->ObtenerEstadisticasServicios($f1, $f2, $c);

        $ObtenerInfoCliente[] = '';
        if ($c > 0) {
            $ObtenerInfoCliente = $this->estadisticas->ObtenerInfoCliente($c);
            $ingresosporusuario = $this->estadisticas->IngresosPorUsuarioFecha($f1, $f2);
        }
        // print_r($obtener_servicios);

        require_once 'Views/Cliente/filtro_servicio.php';
        require_once 'Views/Layout/filtro.php';
    }


















    public function Dashboard()
    {
        $solicitud = new Solicitud();
        $grafico = new Grafico();
        $solicitudes = $solicitud->SolicitudesTotal();
        $si = $solicitud->SolicitudesSi();
        $no = $solicitud->SolicitudesNo();
        $rev = $solicitud->SolicitudesRev();
        $vacias = $solicitud->SolicitudesVacias();
        $solbymesdoc = $grafico->SolByMesDoc();
        $solbymesform = $grafico->SolByMesForm();
        $solbymesext = $grafico->SolByMesExt();
        $solbymesprocesos = $grafico->SolByProceso();

        $spx = array();
        foreach ($solbymesprocesos as $sxps) {
            $spx[] = array(
                'name' => $sxps->Proceso,
                'value' => $sxps->total
            );
        }

        $autoreportesByPro = $grafico->AutoreportesByEvento();
        $abp = array();
        foreach ($autoreportesByPro as $abps) {
            $abp[] = array(
                'name' => $abps->tipo,
                'value' => $abps->total
            );
        }
        $eventosByEstado = $grafico->EventosByEstado();
        $eventosByProceso = $grafico->EventosByProceso();
        $eventosByEmpresa = $grafico->EventosByEmpresa();
        $docbyProceso = $grafico->DocbyProceso();

        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/dashboard.php';
        require_once 'Views/Layout/footer.php';
    }

    public function Inventario()
    {
        $producto = new Producto();
        $grafico = new Grafico();
        $productos = $producto->Informe();
        $totaProductos = $grafico->TotalActivos();
        $mantPendientes = $grafico->MantPendientes();
        $prestamos = $grafico->Prestamos();
        $estados = $grafico->ActivoEstado();

        foreach ($estados as $estAct) {
            $estadoActivos[] = $estAct->estado;
            $totalActivos[] = $grafico->ObtenerPorcentaje($estAct->total, $totaProductos->total);
        }

        $activosBysede = $grafico->ActivoBySede();
        $abs = array();

        foreach ($activosBysede  as $abss) {
            $abs[] = array(
                'name' => $abss->sede,
                'value' => $abss->total
            );
        }

        $mantenimientos = $grafico->Mantenimientos();
        $mantCumplido = $grafico->MantCumplido();
        $mantPendientes = $grafico->MantPendientes();
        $mantPlaneado = $grafico->MantPlaneado();
        $mantverificado = $grafico->Mantverificado();
        $mantSinEjecutar = $grafico->MantSinEjecutar();
        //** rotativo  */  
        $dataRotaUbiMov = $this->rotativo->getUbicacionesMovimientos();
        $datosRotaGasto = $this->rotativo->obtenerIngresosEgresosMensuales();
        $datosRotainsumos = $this->rotativo->obtenerInsumos();


        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Productos/index.php';
        require_once 'Views/Layout/footer.php';
    }

    public function Talento()
    {
        $solicitud = new Solicitud();
        $grafico = new Grafico();
        $persona = new Persona();
        $totalpersonal = $persona->TotalPersonas();
        $activos = $persona->Activos();
        $inactivos = $persona->Inactivos();
        $PromedioEdad = $persona->PromedioEdad();
        $PorSexom = $persona->PorSexo('masculino', '1');
        $PorSexof = $persona->PorSexo('femenino', '2');

        $PorEstratoYEducacion = $persona->PorEstratoYEducacion();
        $PorAusentismo = $persona->PorAusentismo();
        $aus = array();

        foreach ($PorAusentismo as $pa) {
            $aus[] = array(
                'name' => $pa->evento,
                'value' => $pa->cantidad_novedades
            );
        }
        $PorEstadoCivil = $persona->PorEstadoCivil();
        $PorEstratoSocial = $persona->PorEstratoSocial();
        $DiasAusencia = $persona->DiasAusencia();
        $DiasAusenciaxtipo = $persona->DiasAusenciaxtipo();
        $ausxtipo = array();
        foreach ($DiasAusenciaxtipo as $dat) {

            $ausxtipo[] = array(
                'name' => $dat->evento,
                'value' => $dat->total_ausencias
            );
        }

        $AusenciaxMes = $persona->AusenciaxMes();
        $ausxmes = array();
        foreach ($AusenciaxMes as $axm) {

            $ausxmes[] = array(
                'name' => $axm->mes,
                'value' => $axm->total_ausencias
            );
        }
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Seleccion/dashboard.php';
        require_once 'Views/Layout/footer.php';
    }
    //** dashboard */
    /**gestion del clientes */
    public function Crud()
    {
        $clientes = new Cliente();
        if (isset($_REQUEST['id'])) {
            $clientes = $this->model->upCliente($_REQUEST['id']);
        }
        require_once 'Views/Cliente/crud.php';
    }

    public function Registrar()
    {
        $clientes = new Cliente();
        $clientes->id = $_REQUEST['id'];
        $clientes->nombre = $_REQUEST['nombre'];
        $clientes->telefono = $_REQUEST['telefono'];
        $clientes->direccion = $_REQUEST['direccion'];
        $clientes->fechainicio = date('Y-m-d');
        $clientes->direccion = $_REQUEST['direccion'];
        $clientes->rector = $_REQUEST['rector'];
        $clientes->correos =  $_REQUEST['correos1'] . '~' . $_REQUEST['correos2'];
        $clientes->rect_telefono = $_REQUEST['rect_telefono'];
        //$clientes->salario = $_REQUEST['salario'];
        $nombCliente = strtolower(str_replace(" ", "", $clientes->nombre));
        /*manejando la img*/
        $clientes->id > 0 ?
            $this->model->Actualizar($clientes) :
            $this->model->Registrar($clientes);
    }

    public function Auth()
    {
        // require_once 'Views/Seguridad/error.php';
    }
    public function SubirImg()
    {
        $subir = new Subir();
        $this->model->ActualizarLogo($_FILES['file']['name'], $_REQUEST['cliente_id']);
        $logo = $subir->SubirLogo();
    }
}
