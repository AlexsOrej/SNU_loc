<?php
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Sessioncheck.php';
require_once 'Models/Rotativo.php';
require_once 'Models/Proveedor.php';
require_once 'Models/Ubicacion.php';
require_once 'Models/Sede.php';
require_once 'Models/Usuario.php';


class RotativosController
{
    private $model;
    private $insumos;
    private $proveedor;
    private $ubicacion;
    private $sede;
    private $usuario;
    public function __CONSTRUCT()
    {
        $this->model = new Rotativo();
        $this->insumos = new Model();
        $this->proveedor = new Proveedor();
        $this->ubicacion = new Ubicacion();
        $this->sede = new Sede();
        $this->usuario = new Usuario();
        $this->insumos->TblInsumos('insumos');
        $this->insumos->TblUnidades('unidades_medida');
        $this->insumos->Tblkardex('kardex');
        $this->insumos->TblUsuarioRotativo('usuario_rotativo');
        $this->insumos->Tbltipoinsumo_asignado('tipoinsumo_asignado');
        $this->insumos->Tblubicacion_asignado('ubicacion_asignado');
        $this->ubicacion->Index();
    }


    public function Configuracion()
    {

        $sede = $this->sede->Index();
        $usuarios = $this->usuario->GetUsuarios($_SESSION['datos_cliente']->id);
        $asignados = $this->model->UsuarioAsignado();
        $tipoinsumoasignados = $this->model->TipoInsumoAsignado();
        $ubicacionesignados = $this->model->UbicacionAsignado();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/configuracion.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
        
    }

    public function Index()
    {
        $nombre = '';
        $resultados = $this->model->Buscar($nombre);
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/index.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Crud()
    {
        $unidades = $this->model->Unidades();
        $proveedores =  $this->proveedor->Index();
        // $tipoinsumo = $this->model->Tipoinsumos();
        $tipoinsumo = $this->model->Tipoinsumosasignado();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/registro.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Buscar()
    {
        $resultados = $this->model->Buscar($_REQUEST['nombre']);
        $proveedores =  $this->proveedor->Index();
        require_once 'Views/Rotativo/buscar.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Registrar()
    {
        $insumo = new Rotativo();
        $insumo->id = $_REQUEST['id'];
        $insumo->nombre = $_REQUEST['nombre'];
        // $insumo->lote = $_REQUEST['lote'];
        $insumo->ref_presentacion = $_REQUEST['ref_presentacion'];
        // $insumo->cantidad = $_REQUEST['cantidad'];
        $insumo->unidad = $_REQUEST['unidad'];
        // $insumo->costo_Unitario = $_REQUEST['costo_unitario'];
        // $insumo->total = $_REQUEST['total'];
        // $insumo->proveedor = $_REQUEST['proveedor'];
        $insumo->fecha_ingreso = $_REQUEST['fecha_ingreso'];
        // $insumo->fecha_caducidad = $_REQUEST['fecha_caducidad'];
        // $insumo->compra_id = $_REQUEST['compra_id'];
        // $insumo->estado = $_REQUEST['estado'];
        // $insumo->codigo_barras = $_REQUEST['codigo_barras'];
        // $insumo->ubicacion = $_REQUEST['ubicacion'];
        $insumo->stock_minimo = $_REQUEST['stock_minimo'];
        $insumo->stock_maximo = $_REQUEST['stock_maximo'];
        // $insumo->tiempo_entrega = $_REQUEST['tiempo_entrega'];
        // $insumo->ultima_fecha_pedido = $_REQUEST['ultima_fecha_pedido'];

        $insumo->id > 0 ? $insumo->Actualizar($insumo) : $insumo->Registrar($insumo);
    }
    public function Kardex()
    {
        isset($_REQUEST['nombre']) ? $id = $_REQUEST['nombre'] : $id = $_REQUEST['id'];
        $resultados = $this->model->Buscar($id);
        $movimientos = $this->model->BuscarMov($id);
        $kardex = $this->model->getKardex($id);
        $totalEntrada = $this->model->GetTotalEntradaInsumo($id);
        $totalSalida = $this->model->GetTotalSalidaInsumo($id);

        $totalEntradaUbicacion = $this->model->GetTotalEntradaInsumoUbicacion($id);
        $totalSalidaUbicacion = $this->model->GetTotalSalidaInsumoUbicacion($id);

        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/kardex.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function KardexCrud()
    {
        $proveedores =  $this->proveedor->Index();
        $ubicaciones =  $this->model->UbicacionAsignad01();
        $insumo =  $this->model->Getinsumo($_REQUEST['id']);
        $kardex =  $this->model->getDataKardex($_REQUEST['id']);
        $totalEntrada = $this->model->GetTotalEntradaInsumo($_REQUEST['id']);
        $totalSalida = $this->model->GetTotalSalidaInsumo($_REQUEST['id']);
        require_once 'Views/Kardex/crud.php';
    }
    public function kguardar()
    {
        $kardex = new Rotativo();
        $kardex->insumo_id = $_REQUEST['insumo_id'];
        $kardex->tipo_movimiento = $_REQUEST['tipo'];
        $kardex->cantidad = $_REQUEST['cantidad'];
        $kardex->costo_Unitario = $_REQUEST['costo_unitario'];
        if ($kardex->tipo_movimiento == 'salida') :
            $kardex->total = $kardex->cantidad * $kardex->costo_Unitario;
        else :
            $kardex->total = $_REQUEST['total'];
        endif;

        $kardex->lote = $_REQUEST['lote'];
        $kardex->fecha_caducidad = $_REQUEST['caducidad'];
        $kardex->ubicacion_id = $_REQUEST['ubicacion_id'];
        $kardex->proveedor = $_REQUEST['proveedor_id'];
        $kardex->responsable = $_REQUEST['responsable'];
        $kardex->fecha = date('Y-m-d H:i:s');

        $kardex->Kregistrar($kardex);
    }

    public function Presentaciones()
    {
       
        $presentaciones = $this->model->Presentaciones($_REQUEST['tipo']);
        $presentaciones;
        echo "<label for='ref_presentacion'>Presentación:</label>
       <select name='ref_presentacion' id='ref_presentacion' class='selector form-control'>
       <option value=''>Seleccionar</value>";
        foreach ($presentaciones as $value) {
            echo "<option value='$value->id'>" . utf8_encode($value->nombre_presentacion) . "</value>";
        }
        echo "</select>";
    }
    /**usuarios */
    public function Asigna_usuario()
    {
        $this->model->AsignarRotativo($_REQUEST['usuario'], $_REQUEST['estado']);
    }

    /**insumos */

    public function Asigna_tipoinsumo()
    {
       
        if ($_REQUEST["tipo"] == "clinicos") {
            $id = 1;
        } elseif ($_REQUEST["tipo"] == "oficina") {
            $id = 2;
        } else {
            $id = 3;
        }

        echo $this->model->Asignartipoinsumo($id, $_REQUEST["tipo"], $_REQUEST['estado']);
    }


    /*ubicaciones*/

    public function Asigna_ubicacion()
    {
        $this->model->AsignarUbicacion($_REQUEST['ubicacion_id'], $_REQUEST['estado']);
    }

    public function Trasladar()
    {

        $sede = $this->sede->Index();
        $nombre = '';
        $resultados = $this->model->Buscar($nombre);
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/trasladar.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }

    function InsumoXubicacion()
    {
        isset($_REQUEST['nombre']) ? $id = $_REQUEST['nombre'] : $id = $_REQUEST['id'];
        $resultados = $this->model->Buscar($id);
        $movimientos = $this->model->BuscarMov($id);
        $kardex = $this->model->getKardex($id);
        $totalEntrada = $this->model->GetTotalEntradaInsumo($id);
        $totalSalida = $this->model->GetTotalSalidaInsumo($id);
        $totalEntradaUbicacion = $this->model->GetTotalEntradaInsumoUbicacion($id);
        $totalSalidaUbicacion = $this->model->GetTotalSalidaInsumoUbicacion($id);
        $ubicaciones =  $this->model->UbicacionAsignad01();
        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Rotativo/insumoxubicacion.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }

    function mover()
    {

        $ubicaciones =  $this->model->UbicacionAsignad01();
        $kardex = $this->model->getKardex01($_REQUEST['id']);
        $totalEntrada = $this->model->GetTotalEntradaInsumo($_REQUEST['id']);
        $totalSalida = $this->model->GetTotalSalidaInsumo($_REQUEST['id']);
        require_once 'Views/Rotativo/mover.php';
    }
    public function Mguardar()
    {

        $o_ubicacion = $_REQUEST['old_ubicacion_id'];
        $n_ubicacion = $_REQUEST['ubicacion_id'];
        $n_cantidad = $_REQUEST['cantidad'];
        $k_id = $_REQUEST['k_id'];
        $tipo = $_REQUEST['tipo'];
        $cantidad_act = $_REQUEST['cantidad_act'];


        $this->model->Mguardar($k_id, $n_cantidad, $cantidad_act, $tipo, $n_ubicacion, $o_ubicacion);
    }
}
