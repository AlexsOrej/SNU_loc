<div class="col-md-4">
    <div class="card">
        <div class="panel-heading">
            <h3 class="panel-title">Panel de Busqueda</h3>
        </div>
        <div class="panel-body">
            <div class=" col-md-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <label for="">Buscar Por Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>
            </div>
            <div class=" col-md-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <label for="">Buscar Por Número</label>
                        <input type="number" name="numero" id="numero" class="form-control" min="1" max="15000">
                    </div>
                </div>
            </div>
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
</div>
<div class="col-md-8">
    <div class="col-md-12" id="contenedor">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Panel de Resultados</h3>
            </div>
            <div class="panel-body" id="resultado">

            </div>
        </div>
    </div>
</div>
<script>
    $('#nombre').on('keyup', function() {
        var id = document.getElementById("nombre").value
        if(id.length >= 4){
        try {
            $.ajax({
                url: '?c=productos&a=xnombre',
                data: {
                    id: id
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                    $('#respuesta').html("");
                }
            });
        } catch (error) {
            console.error(error)
        }
    }});

    $('#numero').on('keyup', function() {
        var id = document.getElementById("numero").value
        try {
            $.ajax({
                url: '?c=productos&a=xid',
                data: {
                    id: id
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                    $('#respuesta').html("");
                }
            });
        } catch (error) {
            console.error(error)
        }
    });

    $('#ubicacion').on('change', function() {
        var id = document.getElementById("ubicacion").value
        if (id > 0) {
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
        }
    });
</script>