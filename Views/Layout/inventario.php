<?php
require_once 'Models/Estadistica.php';
require_once 'Models/Servicio.php';
$data = new Estadistica();
$entrada = $data->Get(); 
$servicio =new Servicio();
$servicios=$servicio->Servicio();
//print_r($servicios);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SNU sistema de normalización universal</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="Assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="Assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="Assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <!-- JQuery DataTable Css -->
    <link href="Assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Morris Chart Css
    <link href="Assets/plugins/morrisjs/morris.css" rel="stylesheet" />-->
    <!-- Custom Css -->
    <link href="Assets/css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="Assets/css/themes/all-themes.css" rel="stylesheet" />
    <link href="Assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="Assets/plugins/select2/dist/js/select2.min.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
    $('.selector').select2();
});
        // $(document).ready(function() {
        //     function disableBack() {
        //         window.history.forward()
        //     }
        //     window.onload = disableBack();
        //     window.onpageshow = function(e) {
        //         if (e.persisted)
        //             disableBack();
        //     }
        // });
    </script>
    <style>
        .imgbrand {
            padding: 10px;
            width: 78px;
            height: 78px;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .image {
            background-color: #F4F6F6;
            border-radius: 10%;
            box-shadow: 2px 2px 10px 2px gray;
        }
    </style>
</head>
 <!-- Google tag (gtag.js) -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-2KNSD09LYH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-2KNSD09LYH');
</script>
<style>
      @media print {
        body * {
          visibility: hidden;
        }
        section * {
          visibility: hidden;
        }
        #section-to-print, #section-to-print * {
          visibility: visible;
        }
        #section-to-print {
          position: absolute;
          left: 0;
          top: 0;
        }
      }
    </style>

<body class="theme">
    <!-- Page Loader 
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando los recursos</p>
        </div>
    </div>-->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
            </div><?require_once 'Views/Layout/servicios.php';?>        
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="Assets/img/uploads/colegio/<?php echo $_SESSION['datos_cliente']->filename ?>" width="90" height="90" alt="">
                </div>
                <div class="info-container"></div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo ucwords($_SESSION['user']->FullName) ?>
                        </div>
                        <div class="email"> <?= $entrada->ULTIMA ?></div>
                    </li>
                    <li class="active">
                        <a href="?c=clientes&a=inventario">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>                        </a>
                    </li>                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Configuración</span>
                        </a>
                        <ul class="ml-menu">
                           <li>
                                <a href="?c=usuarios&a=index2_usuarios">Usuarios</a>
                            </li>
                           <li>
                                <a href="?c=proveedores&a=index">Proveedores</a>
                            </li>
                             <li>
                                <a href="?c=categorias&a=index">Categorias</a>
                            </li>
                            <li>
                                <a href="?c=fabricantes&a=index">Fabricantes</a>
                            </li>
                            <li>
                                <a href="?c=estados&a=index">Estados</a>
                            </li>
                            <li>
                                <a href="?c=ubicaciones&a=index">Ubicaciones</a>
                            </li>
                            <li>
                                <a href="?c=sedes&a=index">Sedes</a>
                            </li>
                            <!-- <li>
                                <a href="?c=depreciacions&a=index">Depreciación</a>
                            </li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">important_devices</i>
                            <span>Productos</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href="?c=productos&a=consultar">Consultar</a>
                            </li>
                            <li>
                                <a href="?c=productos&a=crud">Registrar</a>
                            </li>
                            <li>
                                <a href="?c=productos&a=prestamos">Prestar/Salir</a>
                            </li>
                            <li>
                                <a href="?c=traslados&a=index">Trasladar</a>
                            </li>
                            <li>
                                <a href="?c=productos&a=bygrupo">Registro Por Grupo</a>
                            </li>
                        </ul>
                    </li>
                    <li>                        
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">autorenew</i>
                            <span>Rotativo</span>
                        </a>
                        <ul class="ml-menu">                            
                            <li>
                                <a href="?c=rotativos&a=configuracion">Configuración</a>
                            </li>
                            <li>
                               <a href="?c=rotativos&a=crud">Crear</a>
                           </li>                                                        
                            <li>
                                <a href="?c=rotativos&a=index">Registrar</a>
                            </li>
                             <li>
                                <a href="?c=rotativos&a=trasladar">Trasladar</a>
                            </li>                                                        
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_vertical_circle</i>
                            <span>Traslados</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href="?c=traslados&a=indexid">X Id's</a>
                            </li>                            
                            <li>
                                <a href="?c=traslados&a=index">X Ubicación</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">format_paint</i>
                            <span>Mantenimiento</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=mantenimientos&a=index">Consultar</a>
                            </li>                            
                        </ul>
                    </li>                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">fact_check</i>
                            <span>Informes</span>
                        </a>
                        <ul class="ml-menu"> 
                            <li>
                                <a href="Informes/infoCompleto.php">Completo</a>                              
                            </li>                            
                            <li>
                                <a href="?c=productos&a=reconteo">Reconteo</a>
                            </li>                            
                        </ul>
                        
                    </li>                    
                    <li class="header"></li>
                    <?php if ($_SESSION['user']->rol_id == 1) : ?>
                        <li>
                            <a href="?c=clientes&a=index">
                                <i class="material-icons col-red">donut_large</i>
                                <span>Menu Principal</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- <li>
                       <?php foreach($servicios as $value): ?>
                        <a href="<?=$value->dir?>">
                            <i class="material-icons">update</i>
                            <span><?=$value->oferta?></span>
                        </a>
                        <?php endforeach;?>
                    </li>                  -->

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!-- <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2022 <a href="javascript:void(0);">Firma - Calidadsg</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.2
                </div>
            </div> -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
    <section class="content">
        <div class="container-fluid">
        <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-col-gray">
                <li>
                    <a href="javascript:void(0);">Recursos Fisicos</a>
                </li>
                <li class="active"><?= ucwords($_REQUEST['c']) ?></li>
                <li class="active"><?= ucwords($_REQUEST['a']) ?></li>
            </ol>
            <?php require_once 'Views/Layout/sessions.php';?>
            
            