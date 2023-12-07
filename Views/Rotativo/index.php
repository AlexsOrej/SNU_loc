<div class="col-md-12">    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    INSUMOS
                </div>
                <div class="body ">
                    <div class="row">
                        <div class="col-md-12" id="resultado" style="align-items: center;">
                            <div class="body" style="align-content: center;" id="salidas"  >
                                <table id="tablerot" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Insumo</th>
                                            <th>Presentación</th>
                                            <th style="text-align: center;">Stock minimo</th>
                                            <th style="text-align: center;">Stock maximo</th>
                                            <th style="text-align: center;">Stock actual</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?  foreach ($resultados as $value) : ?>
                                            <tr>
                                                <td><?= ucwords($value->nombre) . ' ' . $value->unidad_abreviatura  ?></td>
                                                <td><?= ucwords($value->nombre_presentacion) ?></td>
                                                <td style="text-align: center;"><?= $value->stock_min ?></td>
                                                <td style="text-align: center;"><?= $value->stock_max ?></td>
                                                <td style="text-align: center;">
                                                    <? $stock_actual = $this->model->GetTotalEntradaInsumo($value->id) - $this->model->GetTotalSalidaInsumo($value->id); ?>
                                                    <?php if (($stock_actual < $value->stock_min) or ($stock_actual <= '0') or $stock_actual == $value->stock_min) : ?>
                                                        <!-- <i class="glyphicon glyphicon-arrow-down" style="color: red;"></i> -->
                                                        <a href="" class="" style="color: red;">
                                                            <span class="initials glyphicon glyphicon-arrow-down" style="background-color: red;"></span>
                                                            <strong><?= $stock_actual ?></strong>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (($stock_actual > $value->stock_min and $stock_actual < $value->stock_max) or $stock_actual == $value->stock_max) : ?>
                                                        <a href="" class="" style="color: green;">
                                                            <span class="initials glyphicon glyphicon-ok" style="background-color: green;"></span>
                                                            <strong><?= $stock_actual ?></strong>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if ($stock_actual > $value->stock_max) : ?>
                                                        <!-- <i class="glyphicon glyphicon-arrow-up" style="color: orange;"></i>  -->
                                                        <a href="" class="btn efecto" style="color: orange;">
                                                            <span class="initials glyphicon glyphicon-arrow-up" style="background-color: orange;"></span>
                                                            <strong><?= $stock_actual ?></strong>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="vertical-align: middle;text-align: center;">
                                                    <a href="?c=rotativos&a=kardex&id=<?= $value->id  ?>" class="" title="Botón para registrar movimientos del insumo"><i class="glyphicon glyphicon-plus"></i></a>
                                                </td>
                                            </tr>
                                        <? endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#buscar').click(function() {
            const nombre = $("#nombre").val();
            const id = $("#id").val();
            $.ajax({
                type: "POST",
                url: '?c=rotativos&a=buscar',
                data: {
                    nombre: nombre,
                    id: id
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });
        });
        $('#registrar').click(function() {
            const nombre = $("#nombre").val();
            const id = $("#id").val();
            $.ajax({
                type: "POST",
                url: "?c=rotativos&a=crud",
                data: {
                    nombre: nombre,
                    id: id
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    miDiv.classList.add('slide-down');
                    $('#resultado').html(resp);
                }
            });
        });
    });

    function Salida(id) {
        $.ajax({
            url: '?c=rotativos&a=kardex',
            data: {
                id: id
            },
            method: "POST",
            beforeSend: function() {
                $('#salidas').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#salidas').html(resp);
            }
        })
    }
    $(document).ready(function() {});
</script>