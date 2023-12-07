<div class="card">
    <div class="header">        
    </div>
    <div class="body">
        <table id="autoreporte" class="table table-bordered">
            <thead>
                <tr class="active">
                    <th class='text-center'> No</th>
                    <th class='text-center'> proceso</th>
                    <th class='text-center'> Clasificación</th>
                    <th class='text-center'> Tipo </th>
                    <th class='text-center'> Fecha Registro</th>
                    <th class='text-center'> Registrado por</th>
                    <th class='text-center'> Lugar</th>
                    <th class='text-center'> Descripción</th>
                    <th class='text-center'> estado</th>
                    <th class="actions">Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autoreportes as $trabajadoresAsociado) : ?>
                    <tr>
                        <td class='text-center'><?php echo $trabajadoresAsociado->id1 ?>&nbsp;</td>
                        <td class='text-center'><?php echo $trabajadoresAsociado->proceso ?>&nbsp;</td>
                        <td class='text-center'><?php echo $trabajadoresAsociado->clasificacionIncidente; ?>&nbsp;</td>
                        <td class='text-justify' style='width: 200px;'><?php echo utf8_encode($trabajadoresAsociado->tipoIncidente); ?>&nbsp;</td>
                        <td class='text-center'><?php echo $trabajadoresAsociado->registro ?>&nbsp;</td>
                        <td class='text-center'><?php echo $trabajadoresAsociado->user ?>&nbsp;</td>
                        <td class='text-center'> <?php echo $trabajadoresAsociado->lugarEvento; ?>&nbsp;</td>
                        <td class='text-justify'><?php echo utf8_encode($trabajadoresAsociado->descEvento); ?>&nbsp;</td>
                        <td class='text-center'><?php echo $trabajadoresAsociado->estado; ?>&nbsp;</td>

                        <td style="vertical-align: middle;text-align: center;" class="actions">
                            <?php if ($trabajadoresAsociado->estado == 'En Tramite' || $trabajadoresAsociado->estado == 'Rechazado') : ?>
                                <button title="Botón para ver datos del evento" type="button" onclick="Ver('<?= $trabajadoresAsociado->id1 ?>')" style="border:none; background:white; color: #2596be" class="" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" title="" data-content="Al hacer clic, puede registrar las Características del Incidente. Al finalizar este proceso, el estado del incidente cambiará a revisión." data-original-title="Respuesta">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    <strong></strong>
                                </button>
                            <?php endif; ?>

                            <?php if ($trabajadoresAsociado->estado == 'Revisión') : ?>
                                <button title="Botón para ver datos del evento" type="button" onclick="Ver('<?= $trabajadoresAsociado->id1 ?>')" style="border:none; background:white; color: #2596be" class="" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="top" title="" data-content="Al hacer clic, puede registrar las observaciones necesarias y aprobar o rechazar el incidente. Si el incidente es rechazado, su estado volverá a estar en trámite; si es aprobado, el incidente quedará cerrado." data-original-title="Verificación">
                                    <i class="glyphicon glyphicon-check"></i>
                                    <strong></strong>
                                </button>
                            <?php endif; ?>

                            <?php if ($trabajadoresAsociado->estado == 'Aprobacion') : ?>
                                <button title="Botón para ver datos del evento" type="button" onclick="Ver('<?= $trabajadoresAsociado->id1 ?>')" style="border:none; background:white; color: #4CAF50" class="" data-toggle="tooltip" data-placement="bottom" title="Ver resumen del evento">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                    <strong></strong>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <script>
            $('#editar').on('click', function() {
                var autorep = document.getElementById("editar").value
                $.ajax({
                    type: "POST",
                    url: '?c=autoreportes&a=Responder',
                    data: {
                        autorep: autorep,
                    },
                    beforeSend: function() {
                        $('#resultado').html("<h5 class='text-center'>  Cargando Información</h5>");
                    },
                    success: function(resp) {
                        $('#resultado').html(resp);
                        $('#respuesta').html("");
                    }
                });
            });
        </script>