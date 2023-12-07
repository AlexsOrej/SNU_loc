<?php
$usuario_contable = $_SESSION['user']->username;
$cliente = "calidadsg";
$fecha = date('Y-m-d h:i');
$hash = md5($cliente . $usuario_contable . $fecha);
// print_r($servicios);
?>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.html"></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <?php foreach ($servicios as $value) : ?>
                    <?php if ($value->estado == 1) : ?>
                        <li>
                            <a href="<?= $value->oferta == "Contable" ? "{$value->url}l={$usuario_contable}&t={$hash}" : $value->dir ?>" <?= $value->oferta == "Contable" ? "target='_blank'" : "" ?> class="btn efecto">
                                <span <?= $value->oferta == "Contable" ? "" : "class='initials'" ?>>
                                    <?= $value->oferta == "Contable" ? "<img src='Assets/images/logo-pp.png' alt='' height='20' width='20'>" : htmlspecialchars(substr($value->oferta, 0, 1)) ?>
                                </span>
                                <span class="list-text" style="margin-left: -2px;"><?= ucwords(strtolower(htmlspecialchars($value->oferta))) ?></span>
                            </a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="?c=seguridad&a=adquirir" class="btn efecto">
                                <span class="initials"><?= htmlspecialchars(substr($value->oferta, 0, 1)) ?></span>
                                <span class="list-text" style="margin-left: -2px;"><?= ucwords(strtolower(htmlspecialchars($value->oferta))) ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <!-- #END# Call Search -->
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        position: fixed;
        top: 10px;
        left: 219px;
    }

    @media only screen and (max-width: 600px) {
        .navbar {
            width: 100%;
            left: 0;
            /* Ajuste para ocupar toda la pantalla */
            border-radius: 0;
            /* Elimina el redondeo de las esquinas */
        }
    }

    @media only screen and (min-width: 601px) and (max-width: 1024px) {
        .navbar {
            width: 100%;
            left: 0;
            /* Ajuste para ocupar toda la pantalla */
            border-radius: 0;
            /* Elimina el redondeo de las esquinas */
        }
    }

    @media only screen and (min-width: 1025px) {
        .navbar {
            width: 84.3%;
            border-radius: 15px;
            /* Restaura el redondeo para pantallas más grandes */
        }
    }

    .initials {
        display: inline-block;
        font-size: 1rem;
        line-height: 2.0;
        width: 20px;
        height: 20px;
        background-color: #FF5600;
        color: #FFFFFF;
        text-align: center;
        vertical-align: middle;
        border-radius: 50%;
        font-weight: bold;
        margin-right: 2px;
    };

    .efecto {
        background-color: #02BAE5;
    };

    .efecto:hover {
        background-color: #333;
        color: #fff;
    }
</style>