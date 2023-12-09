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