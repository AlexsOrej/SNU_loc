<link href="Assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="Assets/plugins/select2/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<?php //print_r($kardex);
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
                                <?= ucwords($resultados[0]->nombre . ' ' . $resultados[0]->unidad_abreviatura) ?>
                            </stronger>
                            <? if ($movimientos) : ?>
                                <br>
                                <small>
                                    <?= $totalEntrada - $totalSalida . ' ' . utf8_encode($resultados[0]->nombre_presentacion) ?>
                                </small>
                                <br>
                                <small>
                                    <?= $movimientos[0]->total > $resultados[0]->stock_min && $movimientos[0]->total < $resultados[0]->stock_max ? '<span class="badge bg-teal">Buenas Existencias</span>' : ''; ?>
                                    <?= $movimientos[0]->total <= $resultados[0]->stock_min ? '<span class="badge bg-red">Pocas Existencia</span>' : ''; ?>
                                    <?= $movimientos[0]->total > $resultados[0]->stock_max ? '<span class="badge bg-orange">Sobre Existencia</span>' : ''; ?>
                                </small>
                            <? endif; ?>
                        </h3>
                        <!-- <div class="btn-group btn-group-lg" role="group" aria-label="">
                            <button onclick="Kardex('<?= $resultados[0]->id ?>','entrada')" data-toggle="modal" data-target="#modal-id" type="button" class="btn bg-teal  waves-effect "><i class="glyphicon glyphicon-retweet"></i> Traslado</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-8" style="align-items: center;">
                <div class="card">
                    <div class="body">
                        <?php
                        // print_r($totalSalidaUbicacion);
                        $totalPorUbicacion = array();

                        // Iterar sobre las entradas para obtener el total por ubicación
                        foreach ($totalEntradaUbicacion as $entrada) {
                            $ubicacionId = $entrada->ubicacion_id;
                            $sede = $entrada->ubi_nombre . ' ' . $entrada->sede;
                            $k_id = $entrada->idkardex;

                            if (!isset($totalPorUbicacion[$ubicacionId])) {
                                $totalPorUbicacion[$ubicacionId] = new stdClass();
                                $totalPorUbicacion[$ubicacionId]->ubicacion_id = $ubicacionId;
                                $totalPorUbicacion[$ubicacionId]->total_entradas = 0;
                                $totalPorUbicacion[$ubicacionId]->total_salidas = 0;
                                $totalPorUbicacion[$ubicacionId]->ubi = $sede;
                                $totalPorUbicacion[$ubicacionId]->k_id = $k_id;
                            }
                            $totalPorUbicacion[$ubicacionId]->total_entradas += $entrada->total_entradas;
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
                                $totalPorUbicacion[$ubicacionId]->ubi = $sede;
                            }
                            $totalPorUbicacion[$ubicacionId]->total_salidas += $salida->total_salidas;
                        }
                        // Iterar sobre las ubicaciones para mostrar los totales
                        echo "<h5>Existencias Por ubicación</h5>";
                        echo "<table class='table  table-bordered' id='tblkardex'>";
                        echo "<tr><th>Ubicación Sede</th><th>Cantidad</th></tr>";
                        foreach ($totalPorUbicacion as $ubicacion) {
                            !isset($ubicacion->k_id) ? $ubicacion->k_id = "" : $ubicacion->k_id;
                            $cantidad = $ubicacion->total_entradas - $ubicacion->total_salidas;
                            echo "<tr>
                                  <td>{$ubicacion->ubi}</td>
                                  <td>{$cantidad}</td>
                                    <td>                                  
                                        <button  class='btn efecto' onclick='abrirModal({$ubicacion->k_id},{$cantidad})'  data-toggle='modal' data-target='#modal-id'>
                                            <span class='initials'>
                                            <i class='material-icons' style='font-size: 14px;'>share</i>
                                            </span> 
                                            Mover
                                        </button>                                
                                    </td>
                                  </tr>";
                        }
                        echo "</table>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="respuesta">


            </div>
            <div class="modal-footer">
                <button type="button" id="guardar" name="guardar" class="btn btn-default"><i class="glyphicon glyphicon-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>



<script>
    function abrirModal(id, cantidad) {

        $('#cantidad').prop('max', id);

        $.ajax({
            url: "?c=rotativos&a=mover",
            type: "POST",
            data: {
                id: id,
                cantidad: cantidad
            },
            success: function(resp) {
                $('#respuesta').html(resp);

            }
        })


    }


    $(document).on('click', '#guardar', function(e) {
        var formData = new FormData($("#formtraslado")[0]);
        $.ajax({
            url: "?c=rotativos&a=mguardar",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Movimiento se registro con éxito',
                    timer: 1500,
                    showConfirmButton: false,
                }, )
                setTimeout(function() {
                    window.location.reload(1);
                }, 2000)
            }
        });
    });
</script>