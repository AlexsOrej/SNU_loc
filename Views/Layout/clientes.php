<?php require_once 'Models/Estadistica.php';
$data = new Estadistica();
$entrada = $data->Get();
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SNU sistema de normalización universal</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="Assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Range Slider Css -->
    <link href="Assets/plugins/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="Assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" />
    <!-- Waves Effect Css -->
    <link href="Assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="Assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="Assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Css -->
    <link href="Assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="Assets/css/themes/all-themes.css" rel="stylesheet" />
    <script src="Assets/plugins/jquery-datatable/extensions/Language/Spanish.json"></script>
    <!-- Jquery Core Js -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script async src="https://www.googletagmanager.com/gtag/js?id=G-C1M8CKX4E1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-C1M8CKX4E1');
</script>

<body class="theme">
    <!-- #END# Overlay For Sidebars -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <!-- <img src="images/user.png" width="48" height="48" alt="User" />-->
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucwords($_SESSION['user']->FullName) ?></div>
                    <!-- <div class="email">john.doe@example.com</div> -->
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menú de Navegacion</li>
                    <li>
                        <a href="?c=clientes&a=index">
                            <i class="material-icons">account_circle</i>
                            <span>Inicio</span>
                        </a>
                    </li>

                    <li>
                        <a href="?c=servicios&a=index">
                            <i class="material-icons">view_carousel</i>
                            <span>Universos</span>
                        </a>
                    </li>
                    <li>
                        <a href="?c=roles&a=index">
                            <i class="material-icons">contacts</i>
                            <span>Administrar Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="?c=permisos&a=index">
                            <i class="material-icons">phonelink_lock</i>
                            <span>Administrar Permisos</span>
                        </a>
                    </li>
                    <li>
                        <a href="?c=usuarios&a=indexadmin">
                            <i class="material-icons">account_circle</i>
                            <span>Administrar Usuarios</span>
                        </a>
                    </li>                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">query_stats</i>
                            <span>Estadisticas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=clientes&a=uso">General</a>
                            </li>
                            <li>
                                <a href="?c=clientes&a=usoindividual">Por Empresa</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?c=estadisticas&a=index">
                            <i class="material-icons">dvr</i>
                            <span>Registro Eventos</span>
                        </a>
                    </li>

                    <li>
                        <a href="?c=seguridad&a=logout">
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
                    &copy; 2016 - 2020 <a href="javascript:void(0);">Control De Cambios</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.2
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->

    </section>
    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-col-gray">
                <li>
                    <a href="javascript:void(0);">Administración</a>
                </li>
                <li class="active"><?= ucwords($_REQUEST['c']) ?></li>
                <li class="active"><?= ucwords($_REQUEST['a']) ?></li>
            </ol>
            <?php require_once 'Views/Layout/sessions.php';?>
