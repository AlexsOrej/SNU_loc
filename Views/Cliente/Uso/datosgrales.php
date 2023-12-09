<div class="card">    
    <div class="header">
        <h2>DATOS GENERALES</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TOTAL INICIOS DE SESION A SNU</th>
                        <th>Total de accesos a todos los modulos </th>
                        <th>usuarios activados</th>
                        <th>usuarios con actividad</th>
                        <th>modulos activados</th>
                        <th>Fecha del Ultimo inicio</th>
                        <th>USUARIO QUE MAS INICIO SESION</th>
                        <th>ROL Del USUARIO QUE MAS INICIO SESION</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php print_r($totaliniciosession) ?></td>
                        <td><?php print_r($totalaccesomodulos) ?></td>
                        <td><?php print_r($usuariosactivos) ?></td>
                        <td><?php print_r($usuariosconactividad) ?></td>
                        <td><?php print_r($modulosactivos) ?></td>
                        <td><?php print_r($ultimoiniciosession) ?></td>
                        <td><?php print_r($usuarioconmasactividad->usuario) ?></td>
                        <td><?php print_r($usuarioconmasactividad->rol) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>