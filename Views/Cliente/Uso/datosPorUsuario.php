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