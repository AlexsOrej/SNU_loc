<?php
require_once 'Models/Estadistica.php';
require_once 'Models/Servicio.php';
$data = new Estadistica();
$entrada = $data->Get();
$servicio = new Servicio();
$servicios = $servicio->Servicio();
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
    <link rel="stylesheet" href="Assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="Assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="Assests/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Morris Chart Css
    <link href="Assets/plugins/morrisjs/morris.css" rel="stylesheet" />-->
    <!-- Custom Css -->
    <link href="Assets/css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="Assets/css/themes/all-themes.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            function disableBack() {
                window.history.forward()
            }
            window.onload = disableBack();
            window.onpageshow = function(e) {
                if (e.persisted)
                    disableBack();
            }
        });
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
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-2KNSD09LYH');
</script>
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
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <li><a href="?c=seguridad&a=Logout" class="btn-circle"><span><i class="glyphicon glyphicon-off"></i></span></a></li>
                <!-- #END# Call Search -->
            </ul>
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
                    <li class="header"></li>
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
            <!--#Footer-->
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
                <?php require_once 'Views/Layout/sessions.php'; ?>