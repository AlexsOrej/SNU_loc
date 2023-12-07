<?php
echo __DIR__;
$path =  "Assets/plugins/";
$path2 = "Assets/css/";
$path3 = "Assets/js/";
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Bienvenido a SNU</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href=<?php echo $path . "bootstrap/css/bootstrap.css"; ?> rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href=<?php echo $path . "node-waves/waves.css"; ?> rel="stylesheet">
    <!-- Animation Css -->
    <link href=<?php echo $path . "animate-css/animate.css"; ?> rel="stylesheet">
    <!-- Morris Chart Css-->
    <link href=<?php echo $path . "morrisjs/morris.css"; ?> rel="stylesheet">
    <!-- Custom Css -->
    <link href=<?php echo $path2 . "styles.css"; ?> rel="stylesheet">
    <link href=<?php echo $path2 . "animate.css"; ?> rel="stylesheet">   
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href=<?php echo $path2 . "themes/all-themes.css"; ?> rel="stylesheet">
    <!-- Bootstrap Tagsinput Css -->
    <link href=<?php echo $path . "bootstrap-tagsinput/bootstrap-tagsinput.css"; ?> rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href=<?php echo $path . "bootstrap-select/css/bootstrap-select.css"; ?> rel="stylesheet">
    <!-- Multi Select Css -->
    <link href=<?php echo $path . "multi-select/css/multi-select.css"; ?> rel="stylesheet">

    <link href=<?php echo $path . "jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"; ?> rel="stylesheet">
    <!-- Sweet Alert Css -->
    <link href=<?php echo $path2 . "filter.css"; ?> rel="stylesheet">
    <link href=<?php echo $path . "sweetalert/sweetalert.css"; ?> rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <?php //echo $this->Html->script(array('https://www.gstatic.com/charts/loader.js', 'ajaxboostrap3.js')); ?>


</head>

<body class="theme-red">
    <!-- Top Bar :)-->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <?php
                if ($_SESSION['user']) {
                    echo '<a class="navbar-brand" href="index.html">' . $_SESSION['user']->cliente . '</a>';
                } else {
                    echo '<a class="navbar-brand" href="index.html">*****Control De Cambios*****</a>';
                }
                ?>

            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
<?php 

 $APP_WWW = dirname(__DIR__,2);
 


?>
                    <!-- #END# Tasks -->
                    <li class="pull-right"> <a href="<?php echo $APP_WWW . 'users/edit/' . $id . '/' . $rol ?>" class="js-right-sidebar btn btn-success" title="Perfil de Usuario"><i class="material-icons">supervised_user_circle</i><?php echo $_SESSION['user']->FullName ?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div style="margin-left: 80px">
                    <?php
                  /*  if ($_SESSION['user']) {
                        echo $this->Html->image('uploads/colegio/filename/' . $datos['Colegio']['filename'], array('alt' => $datos['Colegio']['nombre'], 'width' => '110', 'height' => '110'));
                    } else {
                        echo $this->Html->image('uploads/colegio/filename/ProgBasica_10_1.jpg', array('alt' => 'Subir Imagen', 'width' => '110', 'height' => '110'));
                    }*/
                    ?>

                </div>

            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu" style="font-size: 5px !important;">
                <ul class="list">
                    <li class="header">Menú de Navegacion</li>
                    <li class="active">
                        <a href="<?php echo $APP_WWW . 'solicitudes/tablero' ?>">
                            <i class="material-icons">account_balance</i>
                            <span>RESUMEN</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                            <i class="material-icons">devices_other</i>
                            <span>Solicitudes</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <li>
                                    <a href="<?php echo $APP_WWW . 'solicitudes/datossolicitud' ?>">Registrar</a>
                                </li>
                                <li>
                                    <a href="<?php echo $APP_WWW . 'solicitudes/indexes' ?>">Consultar</a>
                                </li>

                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                            <i class="material-icons">devices_other</i>
                            <span>Autoreporte</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <li>
                                    <a href="https://api.calidadsg.com/documental/TbProcesoNoconformes/add">Registro de evento</a>
                                </li>
                                <li>
                                    <a href="https://api.calidadsg.com/documental/TbProcesoNoconformes/buscar">Consulta de eventos</a>
                                </li>

                                <li>
                                    <a href="https://api.calidadsg.com/documental/tb_condiciones/indexes">Consolidado de eventos</a>
                                </li>
                                <li>
                                    <a href="https://api.calidadsg.com/documental/categoriaeventos/index1">Clasificación de eventos</a>
                                </li>
                        

                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                            <i class="material-icons">devices_other</i>
                            <span>Documentos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>

                                <li>
                                    <a href="<?php echo $APP_WWW . 'documentos/index1' ?>">Consultar</a>
                                </li>
                                <li>
                                    <a href="https://api.calidadsg.com/upload/?emp=<?php echo $datos['Colegio']['nombre'] ?>">Subir</a>
                                </li>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                            <i class="material-icons">devices_other</i>
                            <span>Documentos Externos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <!--<li>
                                        <a href="<?php echo $APP_WWW . 'SgcDocumentos/add' ?>">Registrar</a>
                                    </li>-->
                                <li>
                                    <a href="<?php echo $APP_WWW . 'sgcexternos/index1' ?>">Consultar</a>
                                </li>

                            </li>
                        </ul>
                    </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                        <i class="material-icons">devices_other</i>
                        <span>Formatos</span>
                    </a>

                    <ul class="ml-menu">
                        <!--<li>
                                <li>
                                    <a href="<?php echo $APP_WWW . 'formatos/add' ?>">Registrar</a>
                                </li>-->
                        <li>
                            <a href="<?php echo $APP_WWW . 'formatos/index1' ?>">Consultar</a>
                        </li>

                </li>
                </ul>
                <ul class="ml-menu">
                    <!--<li>
                                <li>
                                    <a href="<?php echo $APP_WWW . 'formatos/add' ?>">Registrar</a>
                                </li>-->
                    <li>
                        <a href="<?php echo $APP_WWW . 'pqrs/index1' ?>"></a>
                    </li>


                    </li>
                </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                        <i class="material-icons">devices_other</i>
                        <span>Indicadores</span>
                    </a>
                    <ul class="ml-menu">
                        <li>


                        <li>
                            <a href="<?php echo $APP_WWW . 'indicadors/index1' ?>">Configurar</a>
                        </li>
                        <li>
                            <a href="<?php echo $APP_WWW . 'indicadors/buscar' ?>">Registrar</a>
                        </li>
                        <li>
                            <a href="<?php echo $APP_WWW . 'indicadors/dash' ?>"> Consultar</a>
                        </li>

                </li>
                </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <!--<a href="<?php echo $APP_WWW . 'productos/buscarindsede/' ?>">-->
                        <i class="material-icons">devices_other</i>
                        <span>Acciones</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                        <li>
                            <a href="<?php echo $APP_WWW . 'acpms/gestion' ?>">Gestionar</a>
                        </li>
                </li>
                </ul>
                </li>


                <li>
                    <a href="<?php echo $APP_WWW . 'pqrs/index1' ?>">
                        <i class="material-icons">account_circle</i>
                        <span>PQRSF</span>
                    </a>
                </li>

                <?php if ($rol == 4 or $rol == 1) : ?>
                    <li>
                        <a href="<?php echo $APP_WWW . 'users/index1' ?>">
                            <i class="material-icons">account_circle</i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $APP_WWW . 'cargos/index1' ?>">
                            <i class="material-icons">account_circle</i>
                            <span>Cargos</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $APP_WWW . 'procesos/index1' ?>">
                            <i class="material-icons">account_circle</i>
                            <span>Procesos</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($rol == 4) : ?>
                    <li>
                        <a href="<?php echo $APP_WWW . 'colegios/index' ?>">
                            <i class="material-icons">home</i>
                            <span>Menu Principal</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="<?php echo $APP_WWW . 'users/logout' ?>">
                        <i class="material-icons">close</i>
                        <span>SALIR</span>
                    </a>
                </li>
                </ul>



            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2022 <a href="javascript:void(0);">Firma - Calidadsg</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.2
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="contents small" style="overflow-x: hidden;">
              
             
