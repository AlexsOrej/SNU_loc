<?php
require_once 'Models/Estadistica.php';
require_once 'Models/Servicio.php';
$data = new Estadistica();
$entrada = $data->Get();
$servicio = new Servicio();
$servicios = $servicio->Servicio();
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
    <!-- <link href="Assets/tour/css/bootstrap-tour.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Dropzone Css -->
    <link href="Assets/plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Animation Css -->
    <link href="Assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="Assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="Assets/css/style.css" rel="stylesheet">
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="Assets/css/themes/all-themes.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tour/0.12.0/css/bootstrap-tour.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Assets/echarts/dist/echarts.js"></script>
    <!-- Select2 -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> -->
 <script>
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
    <script src="https://cdn.ckeditor.com/4.20.2/standard-all/ckeditor.js">
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

<body class="theme">
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
            </div>
            <? require_once 'Views/Layout/servicios.php'; ?>
        </div>
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
                <div class="info-container">
                </div>
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
                        <a href="?c=clientes&a=dashboard">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="?c=informes&a=InformeDocumental">
                            <i class="material-icons">addchart</i>
                            <span>Informes</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Configuración</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=procesos&a=index_procesos"> 1- Procesos</a>
                            </li>
                            <li>
                                <a href="?c=cargos&a=index_cargos">2- Cargos</a>
                            </li>
                            <li>
                                <a href="?c=usuarios&a=index2_usuarios">3- Usuarios</a>
                            </li>
                            <!-- <li>
                                <a href="?c=permisos&a=index">4- Permisos</a>
                            </li> -->
                            <li>
                                <a href="?c=eventos&a=index_eventos">4- Eventos</a>
                            </li>
                            <li>
                                <a href="?c=notificaciones&a=index_notificaciones">5- Notificaciónes</a>
                            </li>
                            <li>
                                <a href="?c=enlaces&a=index_enlaces">6- Enlaces</a>
                            </li>
                            <li>
                                <a href="?c=solicitudes&a=asignargestion">7-Solicitudes</a>
                            </li>
                            <li>
                                <a href="?c=cartelera&a=listar">8-Cartelera</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Solicitudes</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=solicitudes&a=index">Consultar</a>
                            </li>
                            <li>
                                <a href="?c=solicitudes&a=online">Registrar</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Documentos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=documentos&a=index">Consultar</a>
                            </li>
                            <?php if ($_SESSION['user']->rol_id == 1 or $_SESSION['user']->rol_id == 2) : ?>
                                <li>
                                    <a href="?c=subirs&a=index">Subir</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Doc Externos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=doc_exts&a=index">Consultar</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Formatos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=formatos&a=index">Consultar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">Servicios</li>
                    <?php if ($_SESSION['user']->rol_id == 1) : ?>
                        <li>
                            <a href="?c=clientes&a=index">
                                <i class="material-icons col-red">donut_large</i>
                                <span>Menu Principal</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <!-- <li>
                        <?php foreach ($servicios as $value) : ?>
                            <a href="<?= $value->dir ?>">
                                <i class="material-icons">update</i>
                                <span><?= $value->oferta ?></span>
                            </a>
                        <?php endforeach; ?>
                    </li> -->
                </ul>
            </div>
            <!-- #Menu -->

        </aside>
        <!-- #END# Left Sidebar -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <ol class="breadcrumb breadcrumb-col-gray">
                <li><a href="javascript:void(0);">Documental</a></li>
                <li class="active"><?= ucwords($_REQUEST['c']) ?></li>
                <li class="active"><?= ucwords($_REQUEST['a']) ?></li>
            </ol>
            <?php
            require_once 'Views/Layout/sessions.php';
            ?>