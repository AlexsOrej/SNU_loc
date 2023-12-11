<div class="card">
    <div class="header">
        <h2>DATOS POR USUARIO</h2>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover dataTable js-exportable03">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Cargo</th>
                        <th>Creación</th>
                        <th>Ultimo inicio de sesión</th>
                        <th>Documental</th>
                        <th>Indicadores</th>
                        <th>RH</th>
                        <th>RF</th>
                        <th>Eventos</th>
                        <th>PQRS</th>
                        <th>Riesgos</th>
                        <th>% de acceso a SNU</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($DatosByUsuario as $DatosByUsuarios) : ?>
                        <tr>
                            <td><?= $DatosByUsuarios->colaborador ?></td>
                            <td><?= $DatosByUsuarios->cargo ?></td>
                            <td><?= $DatosByUsuarios->creacion ?></td>
                            <td><?= $DatosByUsuarios->ultimo ?></td>
                            <td><?= $doc = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Documental', $cliente, $inicio, $fin); ?></td>
                            <td><?= $int = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Indicadores', $cliente, $inicio, $fin); ?></td>
                            <td><?= $th = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Talento Humano', $cliente, $inicio, $fin); ?></td>
                            <td><?= $rf = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Recurso Fisico', $cliente, $inicio, $fin); ?></td>
                            <td><?= $eve = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Eventos', $cliente, $inicio, $fin); ?></td>
                            <td><?= $pqr = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'PQRSF', $cliente, $inicio, $fin); ?></td>
                            <td><?= $ries = $this->estadisticas->UsoByUsuarioModulo($DatosByUsuarios->colaborador, 'Riesgos', $cliente, $inicio, $fin); ?></td>
                            <td><?
                                echo   $total_ingresos = $doc + $int + $th + $rf + $eve + $pqr + $ries;
                                echo '<br>'.  $this->estadisticas->calcularPorcentaje($total_ingresos, $_SESSION['totaliniciosession']);
                                ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>