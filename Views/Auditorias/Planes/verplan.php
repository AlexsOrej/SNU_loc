<?php
echo '<pre>';
print_r($listaRequisitos);
echo '</pre>';
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header">Plan Auditoria Por Proceso </div>
                <div class="body">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <?= $planauditoria->proceso ?><br>
                            <label class="muted">Lider del Proceso: </label> <?= $planauditoria->liderproceso ?>
                        </div>
                        <div class="panel-body">
                            <p><strong>Alcance:</strong> <?= $planauditoria->alcances ?></p>
                        </div>
                        <!-- Table -->
                        <table class="table table-bordered">
                            <thead class="bg-cyan">
                                <tr>
                                    <th colspan="">Fecha</th>
                                    <th colspan="">Inicio</th>
                                    <th colspan="">Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $planauditoria->fecha_inicio ?></td>
                                    <td><?= $planauditoria->horainicio ?></td>
                                    <td><?= $planauditoria->horafin ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead class="bg-cyan">
                                <tr>
                                    <th colspan="3">Objetivos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $planauditoria->objetivos ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-cyan">
                                    <th colspan="3">Riesgos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $planauditoria->riesgos ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-cyan">
                                    <th colspan="4">Participantes</th>
                                </tr>
                                <tr class="4">
                                    <th colspan="">Auditor Lider</th>
                                    <th colspan="">Auditor Apoyo</th>
                                    <th colspan="">Experto Técnico</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $planauditoria->auditorLider ?></td>
                                    <td><?= $planauditoria->expertotecnico ?></td>
                                    <td><?= $planauditoria->auditorapoyo ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($listaRequisitos) : ?>
                        <div class="card panel-info">
                            <div class="header">
                                <h3 class="panel-title">
                                    DESCRIPCIÓN DE ACTIVIDADES
                                </h3>
                                <h3 class=""></h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                $agrupado = array();

                                // Recorrer el array original y agrupar por versión y título
                                foreach ($listaRequisitos as $item) {
                                $version = $item->version;
                                $titulo = $item->titulo;

                                // Verificar si la versión ya existe en el array agrupado
                                if (!isset($agrupado[$version])) {
                                $agrupado[$version] = array();
                                }

                                // Verificar si el título ya existe en la versión actual
                                if (!isset($agrupado[$version][$titulo])) {
                                $agrupado[$version][$titulo] = array();
                                }

                                // Agregar el número y descripción al grupo correspondiente
                                $agrupado[$version][$titulo][] = array('numero' => $item->numero, 'descripcion' => $item->descripcion);
                                }

                                // Mostrar la lista
                                foreach ($agrupado as $version => $titulos) {
                                echo '<h3>' . $version . '</h3>';
                                echo '<ul>';
                                    foreach ($titulos as $titulo => $items) {
                                    echo '<li>' . $titulo . ':';
                                        echo '<ul>';
                                            foreach ($items as $item) {
                                            echo '<li>' . $item['numero'] . ' - ' . $item['descripcion'] . '</li>';
                                            }
                                            echo '</ul>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }

                                ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <p>Selecciona la norma y los requisitos para auditar</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">Selecciona la norma y los numerales</div>
                <div class="body">
                    <table class="table table-bordered">
                        <thead class="thead">
                            <tr>
                                <th>Versión</th>
                                <th>Descripción</th>
                                <th>Actualización</th>
                                <th>Numerales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($normas as $norma) : ?>
                                <tr>
                                    <td><?php echo $norma->version ?></td>
                                    <td><?php echo $norma->descripcion ?></td>
                                    <td><?php echo $norma->ultima_actualizacion ?></td>
                                    <td>
                                        <input type="radio" name="norma" id="norma<?php echo $norma->id ?>" value="<?php echo $norma->id ?>">
                                        <label for="norma<?php echo $norma->id ?>"></label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    <div id="numerales">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', 'input[name="norma"]', function() {
        var valorNorma = $('input[name="norma"]:checked').val();
        if (valorNorma) {

            $.ajax({
                data: {
                    id: valorNorma
                },
                type: "post",
                url: "?c=secciones&a=obtenerseccion",
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(response) {
                    $('#numerales').html(response);

                }
            });
        } else {
            $('#numerales').html("elige una norma");
        }
    });
</script>