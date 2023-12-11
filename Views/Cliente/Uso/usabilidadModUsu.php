<div class="card">
    <div class="header">
        <h2>Usabilidad de modulos por usuarios</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable js-exportable02">
                <thead>
                    <tr>
                        <th>Modulos Activos</th>
                        <th>#Accesos al modulo de todos los usuarios</th>
                        <th># usuarios activados por modulo (que tenga al menos un permiso del modulo)</th>
                        <th>% Uso de modulos</th>
                        <th>Usuario que mas uso modulo</th>
                        <th>Rol</th>
                        <th>Cargo</th>
                        <th>Ultima vez que lo uso</th>
                        <th>Total de accesos</th>
                        <th>Controlador que mas uso en el modulo y que funcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ModulosEstadistica as $value) : ?>
                        <tr>
                            <td><?php echo $value->oferta ?></td>
                            <td>
                                <?php echo $valorActual =$this->estadisticas->TodosUsuariosPorModulo($value->oferta, $inicio, $fin, $cliente); ?>
                            </td>
                            <td>
                                <?php echo $this->estadisticas->UsuariosActivadosPorModulo($value->oferta, $cliente); ?>
                            </td>
                            <td>
                                <?php
                                echo $this->estadisticas->calcularPorcentaje($valorActual, $_SESSION['totalaccesomodulos']);
                                
                                 $UsoUsuario = $this->estadisticas->UsoUsuario($value->oferta, $cliente, $inicio, $fin);
                                // print_r($UsoUsuario);
                                ?>
                            </td>
                            <td>
                                <?php
                                echo isset($UsoUsuario->usuarios) ? $UsoUsuario->usuarios : '0';
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