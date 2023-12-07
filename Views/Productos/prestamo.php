<div class="col-md-4">
    <div class="card">
        <div class="panel-heading">
            <h3 class="panel-title">Busqueda de Articulos
            </h3>
        </div>
        <div class="panel-body">            
            <div class=" col-md-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <label for="">Elige la sede</label>
                        <select name="ubicacion" id="ubicacion" class="form-control">
                            <option value=" ">Seleccionar</option>
                            <?php foreach ($sedes as $sede) : ?>
                                <option value="<?= $sede->id ?>"><?= $sede->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class=" col-md-12">
                <div class="form-group form-float">
                    <label for="">Elegir la Ubicación</label>
                    <div class="form-line" id="sede">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="panel-heading">
            <h3 class="panel-title">  Prestamos de Articulos</h3>
        </div>
        <div class="panel-body"><?php foreach ($prestados as $value) : ?>
            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                
                    <div class="panel-group" id="accordion_<?= $value->prestamoId ?>" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-success">
                            <div class="panel-heading" role="tab" id="headingOne_<?= $value->prestamoId ?>">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_<?= $value->id ?>" href="#collapseOne_<?= $value->prestamoId ?>" aria-expanded="false" aria-controls="collapseOne_<?= $value->prestamoId ?>">
                                        <?= $value->productoId . '-' . $value->nombre ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_<?= $value->prestamoId ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_<?= $value->prestamoId ?>">
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <td colspan="2" class="text-center"> <strong>Cons: </strong> <?= $value->num_prestamo ?></td>
                                            </tr>
                                            <tr>
                                                <th>Salida</th>
                                                <th>Entrada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $value->fecha_entrega ?></td>
                                                <td><?= $value->fecha_entrada ?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"><?= $value->carateristicas ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button"  onclick="Ver('<?=$value->prestamoId?>')"  class="btn btn-default"> Ver</button>
                                                        <button type="button"  onclick="Soporte('<?=$value->prestamoId?>')"  class="btn btn-default"> Soporte</button>
                                                        <button type="button"  onclick="Recibir('<?=$value->prestamoId?>')" class="btn btn-success">Devolución</button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div><?php endforeach; ?>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="col-md-12 card" id="contenedor">        
            <div class="card-body" id="resultado"></div>        
    </div>
</div>
<script>    
    $('#ubicacion').on('change', function() {
        var id = document.getElementById("ubicacion").value
        $.ajax({
            type: "POST",
            url: '?c=productos&a=descripcion',
            data: {
                sede_id: id
            },
            beforeSend: function() {
                $('#sede').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#sede').html(resp);
                $('#respuesta').html("");
            }
        });
    });

     function Ver(prestamoId) {
        //var prestamoId = document.getElementById("ver").value
        $.ajax({
            type: "POST",
            url: '?c=productos&a=verPrestamo',
            data: {
                prestamoId: prestamoId
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    };

	 function Recibir(prestamoId) {
        //var prestamoId = document.getElementById("ver").value
        $.ajax({
            type: "POST",
            url: '?c=productos&a=recibir',
            data: {
                prestamoId: prestamoId
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    };
    function Soporte(prestamoId) {
        //var prestamoId = document.getElementById("ver").value
        $.ajax({
            type: "POST",
            url: '?c=productos&a=soporteprestamo',
            data: {
                prestamoId: prestamoId
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    };
	
</script>