<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Producto.php';
require_once 'Models/Traslado.php';
require_once 'Models/Sede.php';
require_once 'Models/Ubicacion.php';

//nombre la clase
class TrasladosController
{
    public function __CONSTRUCT()
    {
        $this->model = new Traslado();
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $sedes = new Sede();
        $sedes = $sedes->Index();

        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Traslados/index.php';
        require_once 'Views/Layout/foot.php';
       
    }
    public function Indexid()
    {
        $sedes = new Sede();
        $sedes = $sedes->Index();

        require_once 'Views/Layout/inventario.php';
        require_once 'Views/Traslados/indexid.php';
        require_once 'Views/Layout/foot.php';
       
    }

    public function Masivo()
    {
        $traslasdo = new Traslado();

        $_REQUEST['novedad'];
        $_REQUEST['ubicacion'];
        $sede_ubi = explode('/', $_REQUEST['ubicacion']);

        $sede = $sede_ubi[0];
        $ubicacion = $sede_ubi[1];

        $traslasdo->ubicacion_id = $ubicacion;
        $traslasdo->user_id = $_REQUEST['user_id'];
        $traslasdo->observacion = $_REQUEST['novedad'];
        $traslasdo->created = date('Y-m-d');
        $traslasdo->modified = date('Y-m-d');
        $traslasdo->sede_id = $sede;
        $i = 0;
        foreach ($_REQUEST['productos'] as $value) {
            # code...
            $traslasdo->producto_id =  $value;
            $this->model->Add($traslasdo);
            $i++;
        };

        echo"
        <script>
        window.location = '?c=traslados&a=index&true=1';       
        </script>
        ";

    }



    public function Descripcion()
    {
        $ubicacion = new Ubicacion();
        $ubicacions = $ubicacion->UbicacionxSede($_REQUEST['sede_id']);
?>
        <select name="ubicacion_id" id="ubicacion_id" class="form-control" required="required">';
            <option value="">Seleccionar</option>
            <?php foreach ($ubicacions as $value) : ?>
                <option value="<?= $value->id ?>"> <?= utf8_encode($value->nombre)  ?></option>
            <?php endforeach; ?>
        </select>

        <script>
            $('#ubicacion_id').on('change', function() {
                var id = document.getElementById("ubicacion_id").value
                $.ajax({
                    type: "POST",
                    url: '?c=traslados&a=ProductoxUbicacion',
                    data: {
                        ubicacion_id: id
                    },
                    beforeSend: function() {
                        $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
                    },
                    success: function(resp) {
                        $('#resultado').html(resp);
                        $('#respuesta').html("");
                    }
                });
            });
        </script>
<?php }


    public function ProductoxUbicacion()
    {

        $productos = new Producto();
        $productos = $productos->Xubicacion($_REQUEST['ubicacion_id']);
        $ubicaciones = $this->model->SedesUbicacion();        
        require_once 'Views/Traslados/xubicacion.php';
        require_once 'Views/Layout/filtro.php';
    }
    
    public function ProductoxIds()
    {

        $productos = new Producto();
        $productos = $productos->Xids($_REQUEST['id']);
        $ubicaciones = $this->model->SedesUbicacion();        
        require_once 'Views/Traslados/xubicacion.php';
        require_once 'Views/Layout/filtro.php';
    }



    public function Crud()
    {
        $traslado = new Traslado();
        $producto = new Producto();
        $producto = $producto->VerProducto($_REQUEST['producto_id']);
        $sede = new Sede();
        $sede = $sede->Index();
        $ubicacion = new Ubicacion();
        $ubicacion = $ubicacion->Index();

        isset($_REQUEST['id']) ? $traslado = $this->model->Xid($_REQUEST['id']) : '';
        require_once 'Views/Traslados/crud.php';
    }

    public function Registrar()
    {
        $traslasdo = new Traslado();
        $traslasdo->id = $_REQUEST['id'];
        $traslasdo->ubicacion_id = $_REQUEST['ubicacion_id'];
        $traslasdo->producto_id = $_REQUEST['producto_id'];
        $traslasdo->user_id = $_REQUEST['user_id'];
        $traslasdo->observacion = $_REQUEST['observacion'];
        $traslasdo->created = $_REQUEST['created'];
        $traslasdo->modified = $_REQUEST['created'];
        $traslasdo->sede_id = $_REQUEST['sede_id1'];
        $traslasdo->id > 0
            ? $this->model->Edit($traslasdo) :
              $this->model->Add($traslasdo);
    }

    public function Delete()
    {
        $this->model->Delete($_REQUEST['id']);
    }
}
