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
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
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
    <!-- Ckeditor 
<script src="Assets/plugins/ckeditor/ckeditor.js"></script>-->
    <!-- Ckeditor -->
    <!-- <script src="Assets/js/pages/forms/editors.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> -->
    <!-- <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.20.2/standard-all/ckeditor.js"></script>

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
        .mapa{
            border:none;
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
                        <a href="?c=riesgos&a=dashboard">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Configuracion</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=procesos&a=index_procesos_riesgos">
                                   
                                    <span>Procesos</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=impactos&a=index">
                                    
                                    <span>Impactos</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=probabilidad&a=index">
                                    
                                    <span>Probabilidad</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=nivelriesgos&a=index">
                                    
                                    <span>Nivel Riesgo</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=Clasificacionriesgo&a=index">
                                    
                                    <span>Clasificacion Riesgo</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=causas&a=index">
                                    
                                    <span>Causas</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=consecuencias&a=index">
                                    
                                    <span>Consecuencias</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=tipoca&a=index">
                                    <span>Tipo Causa</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=causacategoria&a=index">
                                    
                                    <span title="Categoria de las causas">Causa categoria</span>
                                </a>
                            </li>
                            <b> config Controles</b>
                            <li>
                                <a href="?c=tipocontrol&a=index">
                                    
                                    <span title="Categoria de las causas">Tipos de control</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=frecuenciaejecucion&a=index">
                                    
                                    <span title="Categoria de las causas">Frecuencia ejecucion</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=tipoejecucion&a=index">
                                    
                                    <span title="Categoria de las causas">Frecuencia ejecucion</span>
                                </a>
                            </li>

                        </ul>
                    </li>                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment_late</i>
                            <span>Riesgos</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=riesgos&a=index">
                                   
                                    <span> Consultar</span>
                                </a>
                            </li>
                           
                        </ul>
                    </li> 
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">check_circle</i>
                            <span>Controles</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="?c=controles&a=index">
                                   
                                    <span>Registrar</span>
                                </a>
                            </li>
                            <li>
                                <a href="?c=criterioscontrol&a=index">
                                    <!-- <i class="material-icons">report_problem</i> -->
                                    <span>Calificacion Control</span>
                                </a>
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