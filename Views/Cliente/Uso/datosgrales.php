<div class="card">
    <div class="header">
        <h2>DATOS GENERALES</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable js-exportable">
                <thead>
                    <tr>                        
                        <th>Total de inicios de sesión</th>
                        <th>Total de accesos a todos los modulos </th>
                        <th>Usuarios activados</th>
                        <th>Usuarios con actividad</th>
                        <th>Modulos activados</th>
                        <th>Fecha del Ultimo inicio</th>
                        <th>Usuario que mas inicio session</th>                        
                        <th>Rol del usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            $_SESSION['totaliniciosession'] = $totaliniciosession;
                            echo $totaliniciosession ?></td>
                        <td><?php
                            $_SESSION['totalaccesomodulos'] = $totalaccesomodulos;
                            echo $totalaccesomodulos ?></td>
                        <td><?php echo $usuariosactivos ?></td>
                        <td><?php echo $usuariosconactividad ?></td>
                        <td><?php echo $modulosactivos ?></td>
                        <td><?php echo $ultimoiniciosession ?></td>
                        <td><?php echo $usuarioconmasactividad->usuario ?></td>
                        <td><?php echo $usuarioconmasactividad->rol ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>