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
<div class="card">
    <div class="header">
        <h2>Usabilidad de modulos por usuarios</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>MODULOS ACTIVOS</th>
                        <th>#Accesos al modulo DE TODOS LOS USUARIOS </th>
                        <th># usuarios activados por modulo (que tenga al menos un permiso del modulo)</th>
                        <th>% Uso de modulos (#Accesos al modulo DE TODOS LOS USUARIOS / total de accesos a los modulos) </th>
                        <th>USUARIO QUE MAS USO EL MODULO</th>
                        <th>TIPO DE USUARIO (ROL) DEL QUE MAS USO EL MODULO</th>
                        <th>CARGO DEL QUE MAS USO EL MODULO</th>
                        <th>Ultima vez que uso el modulo EL USUARIO QUE MAS USO EL MODULO</th>
                        <th>Total de accesos del usuario que mas uso el modulo</th>
                        <th>Controlador que mas uso en el modulo y que funcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ModulosEstadistica as $value) : ?>
                        <tr>
                            <td><?php echo $value->oferta ?></td>
                            <td>
                                <?php print_r($this->estadisticas->TodosUsuariosPorModulo($value->oferta, $inicio, $fin, $cliente)); ?>
                            </td>
                            <td>
                                <?php print_r($this->estadisticas->UsuariosActivadosPorModulo($value->oferta, $cliente)); ?>
                            </td>
                            <td>
                                <?php
                                $UsoUsuario = $this->estadisticas->UsoUsuario($value->oferta, $cliente, $inicio, $fin);
                                // print_r($UsoUsuario);
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($UsoUsuario->usuario) ? $UsoUsuario->usuario : '0';
                                ?>
                            </td>
                            <td>
                                <?php

                                echo isset($UsoUsuario->rol) ? $UsoUsuario->rol : 0;
                                ?>
                            </td>
                            <td>
                                <?php

                                echo  isset($UsoUsuario->cargo) ? $UsoUsuario->cargo : 0;
                                ?>
                            </td>

                            <td>
                                <?php

                                echo  isset($UsoUsuario->ultima_fecha_hora) ? $UsoUsuario->ultima_fecha_hora : 0;
                                ?>
                            </td>
                            <td>
                                <?php

                                echo  isset($UsoUsuario->cantidad_usos) ?  $UsoUsuario->cantidad_usos : 0;
                                ?>
                            </td>
                            <td>
                                <?php

                                echo  isset($UsoUsuario->controller) ?  $UsoUsuario->controller : 0;
                                ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="header">
        <h2>DATOS POR USUARIO</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NOMBRES Y APELLIDOS</th>
                        <th>CARGO</th>
                        <th>Cuando fue creado el usuario</th>
                        <th>Ultimo inicio de sesion del usuario</th>
                        <th>% de acceso a SNU (Total inicio de sesion del usuario/ TOTAL INICIOS DE SESION A SNU DE LA EMPRESA)</th>
                        <th>TOTAL DE ACCESO MODULOS DOCUMENTAL</th>
                        <th>INDICADORES</th>
                        <th>RH</th>
                        <th>RF</th>
                        <th>EVENTOS</th>
                        <th>PQRS</th>
                        <th>RIESGOS</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($DatosByUsuario as $DatosByUsuarios) : ?>
                        <tr>
                            <td><?= $DatosByUsuarios->colaborador ?></td>
                            <td><?= $DatosByUsuarios->cargo ?></td>
                            <td><?= $DatosByUsuarios->creacion ?></td>
                            <td><?= $DatosByUsuarios->ultimo ?></td>
                            <td><? ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Documental', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Indicadores', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Talento Humano', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Recurso Fisico', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Eventos', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'PQRSF', $cliente, $inicio, $fin); ?></td>
                            <td><?= $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Riesgos', $cliente, $inicio, $fin); ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="header">
        <h2>Uso por rol</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>TIPO DE USUARIO (ROL)</th>
                        <th># USUARIOS ACTIVADOS que iniciaron sesion</th>
                        <th># INICIO SE SESION POR ROL (cuantas veces ese rol inicio sesion)</th>
                        <th>% inicio de sesion por rol (inicios de sesionpor rol / total de inicios de sesion) </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($UsoByRol as $UsoByRols) : ?>
                        <tr>
                            <td><?= $UsoByRols->rol ?></td>
                            <td><?=$this->estadisticas->UsoByRolActivos($UsoByRols->rol,$cliente, $inicio, $fin) ?></td>
                            <td><?= $UsoByRols->sessionesByrol ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
