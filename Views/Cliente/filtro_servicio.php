<div class="table-responsive">
    <div class="header">
        <h2>Modulos de los Clientes</h2>
    </div>
    <div class="body">
        <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">
            <thead>
                <tr style="width: min-content;">
                    <th>Cliente</th>
                    <th>Mod Activos</th>
                    <th>Mod Inactivos</th>
                    <th>Mod Total</th>
                    <th>Usu Activos</th>
                    <th>Usu Inactivos</th>
                    <th>Usu Total</th>
                </tr>
            </thead>
            <tbody style="width: min-content;">
                <?php foreach ($obtener_servicios as $estadistica) : ?>
                    <tr>
                        <td>
                            <?php echo $estadistica->cliente; ?>
                            <br>Inicio: <?php echo $estadistica->finicio; ?>
                        </td>
                        <td><?php echo $estadistica->activo; ?></td>
                        <td><?php echo $estadistica->inactivo; ?></td>
                        <td><?php echo $estadistica->total; ?></td>
                        <td><?php echo $estadistica->totalactivos; ?></td>
                        <td><?php echo $estadistica->totalinactivos; ?></td>
                        <td><?php echo $estadistica->total_usuarios; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($_REQUEST['clientes'] > 0) : ?>
            <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">
                <thead>
                    <tr style="width: min-content;">
                        <th>Modulo</th>
                        <th>Fecha Activacion</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody style="width: min-content;">
                    <?php foreach ($ObtenerInfoCliente as $ObtenerInfo) : ?>
                        <tr>
                            <td><?php echo $ObtenerInfo->modulo; ?></td>
                            <td><?php echo $ObtenerInfo->finicio; ?></td>
                            <td><?php echo $ObtenerInfo->m_estado; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table id="informeEstadistica" class="table table-bordered table-hover dataTable js-exportable01">
                <thead>
                    <tr style="width: min-content;">
                        <th>Usuario</th>
                        <th>Inicios de Sesión</th>
                    </tr>
                </thead>
                <tbody style="width: min-content;">
                    <?php foreach ($ingresosporusuario as $ingresos) :
                        if ($ingresos->cliente_id == $_REQUEST['clientes']) : ?>
                            <tr>
                                <td><?php echo $ingresos->usuario; ?></td>
                                <td><?php echo $ingresos->cantidad; ?></td>
                            </tr>
                    <?php endif;
                    endforeach; ?>
                </tbody>
            </table>
        <?php
            // echo '<pre>sessiones por año';
            // print_r($ingresosporusuario);
            // echo '</pre>';

        endif; ?>
    </div>
</div>