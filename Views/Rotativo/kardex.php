<link href="Assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="Assets/plugins/select2/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<?php //print_r($kardex);
$total = $totalEntrada - $totalSalida;
?>
<!-- <div id="mov"></div> -->
<div class="card">
    <div class="header bg-teal">
        INSUMO
    </div>
    <div class="body">
        <div class="row">
            <div class="col-md-4">
                <div class="card  card-primary">
                    <div class="body">
                        <h3>
                            <stronger>
                                <?= ucwords(utf8_encode($resultados[0]->nombre) . ' ' . $resultados[0]->unidad_abreviatura) ?>
                            </stronger>
                            <? if ($movimientos) : ?>
                                <br>
                                <small>
                                    <?= $totalEntrada - $totalSalida . ' ' . utf8_encode($resultados[0]->nombre_presentacion) ?>
                                </small>
                                <br>
                                <small>
                                    <span class="badge <?= $total >= $resultados[0]->stock_min && $total <= $resultados[0]->stock_max ? 'bg-teal' : ($total < $resultados[0]->stock_min ? 'bg-red' : 'bg-orange') ?>">
                                        <?= $total >= $resultados[0]->stock_min && $total <= $resultados[0]->stock_max ? 'Buenas Existencias' : ($total < $resultados[0]->stock_min ? 'Pocas Existencias' : 'Sobre Existencia') ?>
                                    </span>
                                </small>
                            <? endif; ?>
                        </h3>
                        <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button onclick="Kardex('<?= $resultados[0]->id ?>','entrada')" data-toggle="modal" data-target="#modal-id" type="button" class="btn bg-teal  waves-effect "><i class="glyphicon glyphicon-download"></i> Entrada</button>
                            <button onclick="Kardex('<?= $resultados[0]->id ?>','salida')" data-toggle="modal" data-target="#modal-id" type="button" class="btn bg-teal  waves-effect "><i class="glyphicon glyphicon-upload"></i> Salida</button>
                        </div>
                    </div>
                </div>
                <div class="card card-outline card-primary">
                    <div class="body">
                        <?php
                        $totalPorUbicacion = array();
                        // Iterar sobre las entradas para obtener el total por ubicación
                        foreach ($totalEntradaUbicacion as $entrada) {
                            $ubicacionId = $entrada->ubicacion_id;
                            $sede = $entrada->ubi_nombre . ' ' . $entrada->sede;;
                            if (!isset($totalPorUbicacion[$ubicacionId])) {
                                $totalPorUbicacion[$ubicacionId] = new stdClass();
                                $totalPorUbicacion[$ubicacionId]->ubicacion_id = $ubicacionId;
                                $totalPorUbicacion[$ubicacionId]->total_entradas = 0;
                                $totalPorUbicacion[$ubicacionId]->total_salidas = 0;
                            }
                            $totalPorUbicacion[$ubicacionId]->total_entradas += $entrada->total_entradas;
                            $totalPorUbicacion[$ubicacionId]->ubi = $sede;
                        }

                        // Iterar sobre las salidas para obtener el total por ubicación
                        foreach ($totalSalidaUbicacion as $salida) {

                            $ubicacionId = $salida->ubicacion_id;
                            $sede = $salida->ubi_nombre . ' ' . $salida->sede;
                            if (!isset($totalPorUbicacion[$ubicacionId])) {
                                $totalPorUbicacion[$ubicacionId] = new stdClass();
                                $totalPorUbicacion[$ubicacionId]->ubicacion_id = $ubicacionId;
                                $totalPorUbicacion[$ubicacionId]->total_entradas = 0;
                                $totalPorUbicacion[$ubicacionId]->total_salidas = 0;
                            }

                            $totalPorUbicacion[$ubicacionId]->total_salidas += $salida->total_salidas;
                            $totalPorUbicacion[$ubicacionId]->ubi = $sede;
                        }

                        // Iterar sobre las ubicaciones para mostrar los totales
                        echo "<h5>Existencia actual por ubicación</h5>";
                        echo "<table class='table  table-bordered'>";
                        echo "<tr><th>Ubicación Sede</th><th>Cantidad</th></tr>";
                        foreach ($totalPorUbicacion as $ubicacion) {
                            $cantidad = $ubicacion->total_entradas - $ubicacion->total_salidas;
                            echo "<tr><td>{$ubicacion->ubi}</td><td>{$cantidad}</td></tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="align-items: center;">
                <div class="card">
                    <div class="body">
                        <table class="table table-bordered" id="tblkardex" style="width: auto;">
                            <thead>
                                <tr>
                                    <th>Lote </th>
                                    <th>Cantidad </th>
                                    <th>Existencias </th>
                                    <th>Ubicación </th>
                                    <th>Registra/Recibe </th>
                                    <th>Fecha Mov </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                // print_r($movimientos);
                                foreach ($movimientos as $fila) :
                                    $label = "";
                                    $fila->tipo_movimiento == 'salida' ? $label = 'bg-red' : $label = 'bg-green';
                                ?>
                                    <tr>
                                        <td> <?= $fila->lote ?>
                                        <td>
                                            <span class="badge <?= $label ?>">
                                                <?= $fila->cantidad . ' ' . ucwords($fila->tipo_movimiento) ?>
                                            </span>
                                        </td>
                                        <td><?= $fila->total ?> </td>
                                        <td><?= $fila->nombre ?> </td>
                                        <td><?= $fila->responsable ?> </td>
                                        <td> <?= $fila->fecha ?></td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="mov">

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                <!-- <button type="button" class="btn btn-primary">Guardar</button> -->
                <button type="button" id="k_guardar" name="k_guardar" class="btn-guardar"><i class="glyphicon glyphicon-save"></i> Registrar</button>

            </div>
        </div>
    </div>
</div>
<script>
    function Kardex(id, tipo) {
        $.ajax({
            url: "?c=rotativos&a=KardexCrud",
            data: {
                id: id,
                tipo: tipo
            },
            type: "POST",
            success: function(resp) {
                $('#mov').html(resp);
            }
        })
    };
</script>
