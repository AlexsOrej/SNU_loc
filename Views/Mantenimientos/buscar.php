<?
// print_r($mantenimientos); 
?>
<div class="responsive">
    <table id="tableMan" class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;"> Codigo Plan</th>
                <th style="text-align: center;"> Codigo item</th>
                <th style="text-align: center;"> Item</th>
                <th style="text-align: center;"> Descripción Mantenimiento</th>
                <th style="text-align: center;"> Estado</th>
                <th style="text-align: center;"> Detalles</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($mantenimientos as $value) : ?>
                <tr>                    
                    <td style="text-align: center;" > <?= $value->codigo ?></td>
                    <td style="text-align: center;" > <?= $value->id ?></td>
                    <td>
                        <?= $value->nombre ?><br>
                        <span class='label bg-cyan rounded-pill'> <?= $value->ubicacion ?></span>
                    </td>
                    <td width="25%"><?= strtolower($value->descripcion) ?></td>
                    <td width="10%" style="text-align: center;">
                        <?php
                        if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == '' and $value->est_verificacion == '') {
                            echo "<span class='label bg-blue-grey rounded-pill'>Planeado</span><br>";
                            echo $value->fecha;
                        }
                        if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == '') {
                            echo "<span class='label bg-light-blue rounded-pill'>Ejecucion</span><br>";
                            echo $value->fecha;
                        }
                        if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == 'verificacion') {
                            echo "<span class='label bg-green rounded-pill'>Verificado</span><br>";
                            echo $value->fecha;
                        }
                        ?>
                    </td>

                    <td> <?php
                            if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == '' and $value->est_verificacion == '') {
                                echo "Esperado para ejecución";
                            }
                            if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == '') {
                                echo $value->detalles;
                                echo "<span class='label bg-green rounded-pill'>Detalles:</span>";
                                echo $value->recomendacion;
                            }
                            if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == 'verificacion') {
                                echo "<span class='label bg-green rounded-pill'>Detalles:</span>";
                                echo $value->detalles;
                                echo "<br><span class='label bg-green rounded-pill'>Recomendación:</span>";
                                echo $value->recomendacion;
                                echo "<br><span class='label bg-green rounded-pill'>Verificación:</span>";
                                echo $value->verificacion;
                            }
                            ?></td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</div>