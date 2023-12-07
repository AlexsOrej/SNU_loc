<?php
$usuario_contable = $_SESSION['user']->username;
$cliente = "calidadsg";
$fecha = date('Y-m-d h:i');
$hash = md5($cliente . $usuario_contable . $fecha);
?>
<div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="Views\Usuarios\Manual_usuario_SNU.pdf" target="_blank" class="btn">
                <span class="initials bg-cyan" style="font-size: 16px; line-height: 1.5">
                    <strong>?</strong>
                </span>
                <span class="list-text" style="margin-left: -2px;">Manual de Usuario</span>
            </a>
        </li>
        <?php foreach ($servicios as $value) : ?>
            <? if ($value->estado == 1) : ?>
                <li>
                    <a href="<?= $value->oferta == "Contable" ? $value->url . 'l=' . $usuario_contable . '&t=' . $hash : $value->dir ?>" <?= $value->oferta == "Contable" ? "target='_blank'" : "" ?> class="btn  efecto">
                        <span class=" <?= $value->oferta == "Contable" ? '' : 'initials'; ?>">
                            <?= $value->oferta == "Contable" ? "<img src='Assets/images/logo-pp.png' alt=''  height='20' width='20'>" : substr($value->oferta, 0, 1) ?>
                        </span>
                        <span class="list-text" style="margin-left: -2px;"><?= ucwords(strtolower($value->oferta)) ?></span>
                    </a>
                </li>
            <? else : ?>
                <li>
                    <a href="?c=seguridad&a=adquirir" class="btn  efecto">
                        <span class="initials"><?= substr($value->oferta, 0, 1) ?></span>
                        <span class="list-text" style="margin-left: -2px;"><?= ucwords(strtolower($value->oferta)) ?></span>
                    </a>
                </li>
            <? endif; ?>
        <?php endforeach; ?>
        <!-- Call Search -->
        <li><a href="?c=seguridad&a=Logout" class="btn-circle"><span><i class="glyphicon glyphicon-off"></i></span></a></li>
        <!-- #END# Call Search -->        
    </ul>
</div>
<!-- <img src='Assets/images/logo-pp.png' alt=''  height='' width=''> -->
<style>
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
    }

    ;

    .efecto {
        background-color: #02BAE5;
    }

    ;

    .efecto:hover {
        background-color: #333;
        color: #fff;
    }
</style>
