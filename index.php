 <?php
  date_default_timezone_set('America/Bogota');
  //mostrar errores
  // if ($_SESSION['rol'] == 'root') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  // }
  
  //mostrar errores
  //autocargar de modelos
  /**TODO IMPLEMETAR LA AUTO CARGA DE MODELOS*/
  require_once 'Models/database.php';
  require_once 'Models/Estadistica.php';
  require_once 'Models/Permiso.php';
  require_once 'Models/Model.php';
  //tiempo de inactividad
  $check = new Permiso();
  $check->CheckSessionExpiry();
  //tiempo de inactividad

  //registro de la actividad
  if (isset($_SESSION['user'])) :
    $data = new Estadistica();
    $data->Est();
    $data->url = $_SERVER['PHP_SELF'];
    $model = new Model();
    $model->TblEstaditicasUso();


    if (isset($_REQUEST['c'])) {
      $data->controlador =  $_REQUEST['c'];
      $data->accion =  $_REQUEST['a'];
    }


    $data->navegador = $_SERVER['HTTP_USER_AGENT'];
    $data->fecha_hora = date("Y-m-d h:i:g");
    $data->ip = $data->getUserIpAddress();
    $data->usuario = $_SESSION['user']->user_id;
    $_SESSION['rol'] != 'root' ? $datas = $data->Add($data) : '';
   // $datas = $data->Add($data);
    
  endif;
  //registro de la actividad
  $controller = 'seguridad';
  // Todo esta lógica hara el papel de un FrontController
  if (!isset($_REQUEST['c'])) {
    require_once "Controllers/$controller.Controller.php";
    $controller = ucwords($controller) . "Controller";
    $controller = new $controller;
    $controller->Index();
  } else {
    $permisos = new Permiso();
    //Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Instanciamos el controlador
    require_once "Controllers/$controller.Controller.php";
    $controller = ucwords($controller) . "Controller";
    $controller = new $controller;
    $excludedActions = ['comprobarDoc', 'clave', 'ia', 'index_eventos', 'indicador', 'pqrs', 'solicitudes', 'perfilusuario', 'QuitarDocumento', 'GuardarSoporte', 'InformeResultadoPqrs', 'InformeResultado', 'notificarcontrato', 'SubirSoporte', 'PersonalSoporte', 'cambioestado', 'informar', 'quitar', 'consolidado2', 'Gestion', 'registrar_pqrsf', 'QuitarAutorizado', 'autorizar_colaborador', 'indice', 'Procesoquitar', 'edit', 'ClaveUpdate', 'CrudMeta', 'Cargos', 'Edit', 'subirSoporte', 'soporte', 'versoporte', 'crudsatisfacion', 'editar', 'consultaByGrupo', 'presentaciones', 'mguardar', 'mover', 'insumoxubicacion', 'kguardar', 'asigna_ubicacion', 'descripcion01', 'asigna_usuario', 'asigna_tipoinsumo', 'AddDatos', 'info', 'cie10', 'RegistrarByGrupo', 'impresionre', 'reconteo', 'verificarP', 'ConsultaByGrupo', 'Reg_Estado', 'AddRespuesta', 'InfoDoc', 'Subir', 'GetNovedadPersona', 'historial1', 'UploadFoto', 'gestion0', 'getfirma', 'firmar', 'EstadoAsp', 'buscarest', 'ValiMant', 'crudValidar', 'EjecMant', 'elementos', 'valdoconline', 'BuscarResp', 'evento', 'proceso_reponsable', 'registrar', 'Guardar', 'guardar', 'IndexTodo', 'productoxids', 'xubicacion', 'bycategoria', 'buscar', 'ubicacion', 'tipo', 'addAsignar', 'Asignar_responsable', 'GestionDocext', 'GestionFormato', 'asignarprocesoadd', 'AsignarProceso', 'crud', 'estado', 'ver', 'xnombre', 'xid', 'masivo', 'ProductoxUbicacion', 'Logout', 'verificar', 'index', 'AccionGuardar', 'add', 'dashboard', 'talento', 'inventario', 'Crud', 'DescripcionLine', 'Registrar0', 'editor_validar', 'GestionDocumento', 'descripcion', 'Registrar'];
    if (isset($_SESSION['user']) and $_SESSION['rol'] !== 'root') :
      $in = $permisos->verificarAccionControllerUsuario($_REQUEST['a'], $_REQUEST['c'], $_SESSION['user']->user_id);
      if ($in == 0 && !in_array($_REQUEST['a'], $excludedActions)) :
        // Llama la accion
        require_once "Controllers/seguridad.Controller.php";
        $controller = "SeguridadController";
        $controller = new $controller;
        $accion = 'error';
      endif;
    endif;
    call_user_func(array($controller, $accion));
  }
