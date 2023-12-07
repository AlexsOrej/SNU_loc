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
                            <div class="body" style="align-content: center;" id="salidas">
                                <table id="tablerot" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Presentación</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? foreach ($resultados as $value) : ?>
                                            <tr>
                                                <td><?= ucwords(utf8_encode($value->nombre) . '' . $value->unidad_abreviatura) ?></td>
                                                <td><?= ucwords(utf8_encode($value->nombre_presentacion)) ?></td>
                                                <td>
                                                    <a href="?c=rotativos&a=insumoxubicacion&id=<?= $value->id ?>" class="" title="Botón para cambiar de ubicación del insumos">
                                                        <i class="material-icons">autorenew</i><span></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <? endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- </div> -->
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