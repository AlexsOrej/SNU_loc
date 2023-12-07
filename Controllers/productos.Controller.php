 <?php
    // importar los modelos necesarios
    require_once 'Models/Sessioncheck.php';
    require_once 'Models/database.php';
    require_once 'Models/Producto.php';
    require_once 'Models/Fabricante.php';
    require_once 'Models/Categoria.php';
    require_once 'Models/Sede.php';
    require_once 'Models/Ubicacion.php';
    require_once 'Models/Mantenimiento.php';
    require_once 'Models/Prestamo.php';
    require_once 'Models/Prestamo.php';
    require_once 'Models/Especificacion.php';

    //nombre la clase
    class ProductosController
    {
        public $model;
        public function __CONSTRUCT()
        {
            $this->model = new Producto();
        }
        /*crear los metodos necesarios*/
        public function Index()
        {
            $productos = $this->model->Informe();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/index.php';
            require_once 'Views/Layout/foot.php';
        }


        public function Consultar()
        {
            $sede = new Sede();
            $sedes = $sede->Index();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/consulta.php';
            require_once 'Views/Layout/foot.php';
        }


        public function ProductoxUbicacion()
        {
            $productos = $this->model->Xubicacion($_REQUEST['ubicacion_id']);
            require_once 'Views/Productos/xubicacion.php';
            require_once 'Views/Layout/filtro.php';
        }

        public function ProductoxPrestamo()
        {
            $productos = $this->model->Xubicacion($_REQUEST['ubicacion_id']);
            require_once 'Views/Productos/xubicacionPrestamo.php';
        }

        public function Crud()
        {
            $producto = new Producto();
            $fabricante = new Fabricante();
            $fabricantes = $fabricante->Index();
            $categoria = new Categoria();
            $categorias = $categoria->Index();
            $sede = new Sede();
            $sedes = $sede->Index();
            $ubicacion = new Ubicacion();
            $ubicacions = $ubicacion->Index();
            if (isset($_REQUEST['id'])) {
                $producto = $this->model->Producto($_REQUEST['id']);
            }
            if (isset($_REQUEST['idproducto'])) {
                $producto = $producto->Producto($_REQUEST['idproducto']);
                require_once 'Views/Productos/crud.php';
            } else {
                require_once 'Views/Layout/inventario.php';
                require_once 'Views/Productos/crud.php';
                require_once 'Views/Layout/foot.php';
            }
        }

        public function ByGrupo()
        {
            $producto = new Producto();
            $fabricante = new Fabricante();
            $fabricantes = $fabricante->Index();
            $categoria = new Categoria();
            $categorias = $categoria->Index();
            $sede = new Sede();
            $sedes = $sede->Index();
            $ubicacion = new Ubicacion();
            $ubicacions = $ubicacion->Index();

            if (isset($_REQUEST['id'])) {
                $producto = $this->model->Producto($_REQUEST['id']);
            }

            if (isset($_REQUEST['idproducto'])) {
                $producto = $producto->Producto($_REQUEST['idproducto']);
                require_once 'Views/Productos/crud.php';
            } else {
                require_once 'Views/Layout/inventario.php';
                require_once 'Views/Productos/bygrupo.php';
                require_once 'Views/Layout/foot.php';
            }
        }


        public function Estado()
        {
            $producto = new Producto();

            if (isset($_REQUEST['id'])) {
                $producto = $producto->Producto($_REQUEST['id']);
            }

            require_once 'Views/Productos/estado.php';
        }

        public function Reg_Estado()
        {
            $producto = new Producto();
            $producto->id = $_REQUEST['id'];
            $producto->estado_id = $_REQUEST['estado_id'];
            $this->model->EditEstado($producto);
        }


        public function Registrar()
        {
            $producto = new Producto();
            $producto->id = $_REQUEST['id'];
            $producto->usuario_id = $_REQUEST['usuario_id'];
            $producto->factura = $_REQUEST['factura'];
            $producto->proveedor = $_REQUEST['proveedor'];
            $producto->categoria_id = $_REQUEST['categoria_id'];
            $producto->fabricante_id = $_REQUEST['fabricante_id'];
            $producto->nombre = $_REQUEST['nombre'];
            $producto->carateristicas = $_REQUEST['carateristicas'];
            $producto->serie = $_REQUEST['serie'];
            $producto->adquisicion = $_REQUEST['adquisicion'];
            $producto->preciocosto = $_REQUEST['preciocosto'];
            $producto->fechacompra = $_REQUEST['fechacompra'];
            $producto->sede_id = $_REQUEST['sede_id'];
            $producto->ubicacion_id = $_REQUEST['ubicacion_id'];
            $producto->estado_id = $_REQUEST['estado_id'];
            $producto->cantidad = 1;
            $producto->created = date('Y-m-d');
            $producto->modified = date('Y-m-d');

            if($_FILES['filename']['name']){
                $producto->filename = $_FILES['filename']['name'];
                $producto->dir = 'Assets/productos/' . $_SESSION['datos_cliente']->nombre . '/';
            }else{
                $producto->filename = $_REQUEST['file_actual'];
            }
           

          echo  $producto->id > 0 ?
                $result =  $this->model->Edit($producto)
                :   $result = $this->model->Add($producto);
            $this->model->SubirImg();
           
        }


        public function RegistrarByGrupo()
        {
            $producto = new Producto();
            $producto->id = $_REQUEST['id'];
            $producto->usuario_id = $_REQUEST['usuario_id'];
            $producto->factura = $_REQUEST['factura'];
            $producto->proveedor = $_REQUEST['proveedor'];
            $producto->categoria_id = $_REQUEST['categoria_id'];
            $producto->fabricante_id = $_REQUEST['fabricante_id'];
            $producto->nombre = $_REQUEST['nombre'];
            $producto->carateristicas = $_REQUEST['carateristicas'];
            $producto->serie = $_REQUEST['serie'];
            $producto->adquisicion = $_REQUEST['adquisicion'];
            $producto->preciocosto = $_REQUEST['preciocosto'];
            $producto->fechacompra = $_REQUEST['fechacompra'];
            $producto->sede_id = $_REQUEST['sede_id'];
            $producto->ubicacion_id = $_REQUEST['ubicacion_id'];
            $producto->estado_id = $_REQUEST['estado_id'];
            $producto->cantidad = 1;
            $producto->created = date('Y-m-d');
            $producto->modified = date('Y-m-d');
            $producto->filename = $_FILES['filename']['name'];
            $producto->dir = 'Assets/productos/' . $_SESSION['datos_cliente']->nombre . '/';
            for ($i = 0; $i < $_REQUEST['cantidad']; $i++) {
                $this->model->Add($producto);
             }
            $this->model->SubirImg();
             echo   $_REQUEST['cantidad'];
        }


        public function ConsultaByGrupo()
        {
            $bygrupo = new Producto();
            $result = $bygrupo->ConsultaByGrupo($_REQUEST['can']);
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/consultabygrupo.php';
            require_once 'Views/Layout/foot.php';
            require_once 'Views/Layout/filtro.php';
        }

        public function Descripcion()
        {
            $ubicacion = new Ubicacion();
            $ubicacions = $ubicacion->UbicacionxSede($_REQUEST['sede_id']);
    ?>
         <select name="ubicacion_id" id="ubicacion_id" class="form-control" required="required">';
             <option value="">Seleccionar</option>
             <?php foreach ($ubicacions as $value) : ?>
                 <option value="<?= $value->id ?>"> <?= utf8_encode($value->nombre)   ?></option>
             <?php endforeach; ?>
         </select>
         <script>
             $('#ubicacion_id').on('change', function() {
                 var id = document.getElementById("ubicacion_id").value
                 if (id > 0) {
                     $.ajax({
                         type: "POST",
                         url: '?c=productos&a=ProductoxUbicacion',
                         data: {
                             ubicacion_id: id
                         },
                         beforeSend: function() {
                             $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
                         },
                         success: function(resp) {
                             $('#resultado').html(resp);

                         }
                     });
                 }
             });
         </script>
 <?php  }

        public function Ver()
        {
            unset($_SESSION['id_producto']);
            if (isset($_SESSION['id_producto']) or isset($_GET['id'])) {
                $id = $_SESSION['id_producto'];
            } else {

                $id = $_REQUEST['id'];
            }
            $producto = $this->model->VerProducto($id);
            $mantenimiento = new Mantenimiento();
            $mantenimientos = $mantenimiento->Xproducto($id);
            require_once 'Views/Productos/ver.php';
        }



        public function Xnombre()
        {
            $productos = $this->model->VerProducto($_REQUEST['id']);
            require_once 'Views/Productos/xnombre.php';
            require_once 'Views/Layout/filtro.php';
        }

        public function Xid()
        {
            if (isset($_REQUEST['id']) & $_REQUEST['id'] > 0) {
                $producto = $this->model->VerProducto($_REQUEST['id']);
                if ($producto) {
                    require_once 'Views/Productos/xid.php';
                } else {
                    // require_once 'Views/Productos/xid0.php';
                }
            }
        }
        public function Xids()
        {
            if (isset($_REQUEST['id']) & $_REQUEST['id'] > 0) {
                $producto = $this->model->VerProducto($_REQUEST['id']);
                if ($producto) {
                    require_once 'Views/Productos/xid.php';
                } else {
                    // require_once 'Views/Productos/xid0.php';
                }
            }
        }
        public function Ficha()
        {


            if (isset($_REQUEST['id']) & $_REQUEST['id'] > 0) {
                $producto = $this->model->VerProducto($_REQUEST['id']);
                $mantenimiento = new Mantenimiento();
                $mantenimientos = $mantenimiento->Xproducto($_REQUEST['id']);
                $especificacion = new Especificacion();
                $especificaciones = $especificacion->Consultar($_REQUEST['id']);

                if ($producto) {
                    require_once 'Views/Layout/inventario.php';
                    require_once 'Views/Productos/ver.php';
                    require_once 'Views/Layout/footer.php';
                    require_once 'Views/Layout/filtro.php';
                } else {
                    // require_once 'Views/Productos/xid0.php';
                }
            }
        }



        public function Prestamos()
        {
            $sedes = new Sede();
            $sedes = $sedes->Index();
            $prestamos = new Prestamo();
            $prestados = $prestamos->Index();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/prestamo.php';
            require_once 'Views/Layout/foot.php';
        }

        public function Prestar()
        {
            require_once 'Views/Productos/prestar.php';
        }
        public function addPrestamo()
        {
            $prestamo = new Prestamo();
            $prestamo->id = $_REQUEST['id'];
            $prestamo->num_prestamo = $_REQUEST['cons'];
            $prestamo->producto_id = $_REQUEST['producto_id'];
            $prestamo->fecha_entrega = $_REQUEST['fechaEntrega'];
            $prestamo->nombre_bene = $_REQUEST['nombres'];
            $prestamo->apellido_bene = $_REQUEST['apellidos'];
            $prestamo->identificacion_bene = $_REQUEST['identificacion'];
            $prestamo->num_contacto = $_REQUEST['contacto'];
            $prestamo->correo = $_REQUEST['correo'];
            $prestamo->tipo_bene = $_REQUEST['beneficiario'];
            $prestamo->tipo = $_REQUEST['tramite'];
            $prestamo->barrio = $_REQUEST['barrio'];
            $prestamo->ubicacion_bene = $_REQUEST['direccion'];
            $prestamo->funcionario = $_REQUEST['funcionario'];
            $prestamo->observaciones = $_REQUEST['observaciones'];
            $prestamo->id > 0 ? $prestamo->Devolucion($prestamo) : $prestamo->Add($prestamo);
        }
        public function verPrestamo()
        {
            $prestamo = new Prestamo();
            $prestamos = $prestamo->getPrestamo($_REQUEST['prestamoId']);
            require_once 'Views/Productos/verprestamo.php';
        }
        public function Recibir()
        {
            $prestamo = new Prestamo();
            $prestamos = $prestamo->getPrestamo($_REQUEST['prestamoId']);
            require_once 'Views/Productos/recibir.php';
        }
        public function AddRecibir()
        {
            $prestamos = new Prestamo();
            $prestamos->dellate_entrada = $_REQUEST['dellate_entrada'];
            $prestamos->fecha_entrada = $_REQUEST['fecha_entrada'];
            $prestamos->tipo = $_REQUEST['tipo'];
            $prestamos->id = $_REQUEST['id'];

            $prestamos->Devolucion($prestamos);
        }

        public function SoportePrestamo()
        {
            $prestamo = new Prestamo();
            $prestamos = $prestamo->getPrestamo($_REQUEST['prestamoId']);
            require_once 'Views/Productos/soporte_prestamo.php';
        }
        public function Impresion()
        {
            $prestamo = new Prestamo();
            $prestamos = $prestamo->getPrestamo($_REQUEST['prestamoId']);
            require_once 'Views/Productos/impresion.php';
        }

        public function ByCategoria()
        {
            $byNombres = $this->model->ByNombre($_REQUEST['cat_id']);
            require_once 'Views/Productos/bynombre.php';
        }

        public function InfoByCompleto()
        {
            $infoByCompleto = $this->model->InfoByCompleto();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/infobycompleto.php';
            require_once 'Views/Layout/foot.php';
            require_once 'Views/Layout/filtro.php';
        }

        public function Reconteo()
        {

            if (isset($_REQUEST['ubicacion_id'])) {
                $reconteo = $this->model->Reconteo($_REQUEST['ubicacion_id']);
            }
            $sede = new Sede();
            $sedes = $sede->Index();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/reconteo.php';
            require_once 'Views/Layout/foot.php';
            require_once 'Views/Layout/filtro.php';
        }

        public function ImpresionRe()
        {
            $reconteo = $this->model->Reconteo($_REQUEST['ubicacion_id']);

            $sede = new Sede();
            $sedes = $sede->Index();
            require_once 'Views/Layout/inventario.php';
            require_once 'Views/Productos/impresion.php';
            require_once 'Views/Layout/foot.php';
        }
    }
