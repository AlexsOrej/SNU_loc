<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Mantenimiento.php';
require_once 'Models/Producto.php';
require_once 'Models/Sede.php';
require_once 'Models/Ubicacion.php';
require_once 'Models/Usuario.php';
require_once 'Models/Categoria.php';


class MantenimientosController
{
    private $rol;
    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Mantenimiento();
    }

    public function Index()
    {

        $_SESSION['rol'] != 'proveedor' ? require_once 'Views/Layout/inventario.php' : require_once 'Views/Layout/inventarioP.php';
        $sede = new Sede();
        $sedes = $sede->Index();

        require_once 'Views/Mantenimientos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function IndexTodo()
    {
        $plan = $this->model->IndexTodo();
        require_once 'Views/Mantenimientos/indextodo.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Editar()
    {
        $mantenimiento = $this->model->Consultar($_REQUEST['mantenimiento_id']);
        require_once 'Views/Mantenimientos/editar.php';
    }
    public function Actualizar()
    {
        $mantenimiento = new Mantenimiento();
        $mantenimiento->id = $_REQUEST['id'];
        $mantenimiento->descripcion = $_REQUEST['descripcion'];
        $mantenimiento->recomendacion = $_REQUEST['recomendacion'];
        $mantenimiento->detalles = $_REQUEST['detalles'];
        $mantenimiento->verificacion = $_REQUEST['verificacion'];
        $mantenimiento->fecha = $_REQUEST['fecha'];
        $mantenimiento->Actualizar($mantenimiento);
    }

    public function Planear()
    {
        $sede = new Sede();
        $sedes = $sede->Index();
        $categoria = new Categoria();
        $categorias = $categoria->Index();
        // $byNombre= new Producto();
        // $byNombres= $byNombre->ByNombre();
        require_once 'Views/Mantenimientos/planear.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Descripcion()
    {
        $ubicacion = new Ubicacion();
        $ubicacions = $ubicacion->UbicacionxSede($_REQUEST['sede_id']); ?>
        <select name="ubicacion_id" id="ubicacion_id" class="form-control" required="required">';
            <option value="">Seleccionar</option>
            <?php foreach ($ubicacions as $value) : ?>
                <option value="<?= $value->id ?>"> <?= $value->nombre ?></option>
            <?php endforeach; ?>
        </select>

        <script>
            $('#ubicacion_id').on('change', function() {
                var id = document.getElementById("ubicacion_id").value
                $.ajax({
                    type: "POST",
                    url: '?c=mantenimientos&a=xUbicacion',
                    data: {
                        ubicacion_id: id
                    },
                    success: function(resp) {
                        $('#resultado').html(resp);

                    }
                });
            });
        </script>
<?php }



    public function xUbicacion()
    {
        $producto = new Producto();
        $productos = $producto->ByNomMa($_REQUEST['sede'], $_REQUEST['articulo']);
        $usuarios = new Usuario();
        $proveedors = $usuarios->getProveedor();
        $funcionarios = $usuarios->getFuncionario();
        require_once 'Views/Mantenimientos/xUbicacion.php';
        require_once 'Views/Layout/filtro.php';
    }


    public function Registrar()
    {

        $mant = new Mantenimiento();
        $mant->user_id = $_REQUEST['user_id'];
        $mant->est_solicitud = 'planeacion';
        $mant->estado = '1';
        $mant->responsable = $_REQUEST['encargado'];
        $mant->responsable_id = $_REQUEST['responsable_id'];
        $mant->codigo = mt_rand(1, 100000);
        $mant->descripcion = $_REQUEST['descr'];
        $mant->fecha = $_REQUEST['fecha'];
        $num = count($_REQUEST['productos']);
        $i = 0;
        if ($num > 0) {
            foreach ($_REQUEST['productos'] as $value) {
                # code...
                $mant->producto_id =  $value;
                $this->model->Add($mant);
                $i++;
            };
            echo "
        <script>
        window.location = '?c=mantenimientos&a=index&true=1';       
        </script>";
        } else {
            echo "
        <script>
        window.location = '?c=mantenimientos&a=index&true=2';       
        </script>";
        }
    }

    public function ejecutar()
    {
        $mantenimientos = $this->model->IndexPlan();
        $indexPlanSinEjcutar = $this->model->IndexPlanSinEjcutar();
        require_once 'Views/Mantenimientos/ejecutar.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Verificar()
    {
        $mantenimientos = $this->model->IndexPlanCant();
        $mant_ejecutados = $this->model->IndexPlanEjecutado();
        require_once 'Views/Mantenimientos/verificar.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Elementos()
    {
        $mantenimientos = $this->model->Index($_REQUEST['codigo']);
        require_once 'Views/Mantenimientos/elementos.php';
    }
    public function Crud()
    {
        $mantenimientos = $this->model->Index($_REQUEST['id_mant']);
        require_once 'Views/Mantenimientos/crud.php';
    }
    public function CrudValidar()
    {
        $mantenimientos = $this->model->Index($_REQUEST['id_mant']);
        require_once 'Views/Mantenimientos/crudValidar.php';
    }
    public function EjecMant()
    {
        //print_r($_REQUEST);
        $mant = new Mantenimiento();
        $mant->codigo = $_REQUEST['codigo'];
        $mant->est_ejecucion = $_REQUEST['est_ejecucion'];
        $mant->modified = $_REQUEST['modified'];
        $mant->detalles = $_REQUEST['detalles'];
        $mant->recomendacion = $_REQUEST['recomendacion'];

        $num = count($_REQUEST['productos']);
        $i = 0;
        if ($num > 0) {
            foreach ($_REQUEST['productos'] as $value) {
                # code...
                $mant->producto_id =  $value;
                $this->model->EjecMant($mant);
                $i++;
            };
            echo "
        <script>
        window.location = '?c=mantenimientos&a=index&true=1';       
        </script>";
        } else {
            echo "
         <script>
         window.location = '?c=mantenimientos&a=index&true=2';       
         </script>";
        }
    }

    public function ValiMant()
    {
        //print_r($_REQUEST);
        $mant = new Mantenimiento();
        $mant->codigo = $_REQUEST['codigo'];
        $mant->est_verificacion = $_REQUEST['est_verificacion'];
        $mant->modified = $_REQUEST['modified'];
        $mant->verificacion = $_REQUEST['verificacion'];


        $this->model->ValMant($mant);
        echo "
        <script>
        window.location = '?c=mantenimientos&a=index&true=1';       
        </script>";
    }
    public function Quitar()
    {
        $this->model->Quitar($_REQUEST['productoId']);
    }

    public function Buscar()
    {
        $mantenimientos = $this->model->Cronograma($_REQUEST['desde'], $_REQUEST['hasta'], $_REQUEST['ubicacion'], $_REQUEST['sede']);
        require_once 'Views/Mantenimientos/buscar.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Ubicacion()
    {

        $ubicacion = new Ubicacion();
        $ubicaciones = $ubicacion->UbicacionxSede($_REQUEST['sede_id']);
        echo ' <div class="form-group">
                                        <div class="form-line">
                                            <label>Ubicación</label>
                                            <select name="ubicacion" id="ubicacion" class="form-control" required="required">';
                                            echo '<option value="tlu">Todas las ubicaciones</option>';
        foreach ($ubicaciones as $value) :
            echo '<option value="' . $value->id . '">' . $value->nombre . '</option>';
        endforeach;
        echo '  </select>
                                        </div>
                                    </div>';
    }
}
