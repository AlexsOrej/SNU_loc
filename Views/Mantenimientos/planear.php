<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="sede" class="col-sm-2">Sedes</label>
            <select name="sede_id" id="sede_id" class="form-control" required="required">
                <option value="">Seleccionar</option>
                <?php foreach ($sedes as $value) : ?>
                    <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
            <label for="categoria" class="col-sm-2">Categorias</label>
            <select name="categoria" id="categoria" class="form-control" required="required">
                <option value="">Seleccionar</option>
                <?php foreach ($categorias as $value) : ?>
                    <option value="<?= $value->id ?>"><?= utf8_encode($value->nombre)  ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="articulos" class="col-xs-4 col-sm-3 col-md-3 col-lg-3">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-3"><br>
            <button type="button" id="buscar" class="btn btn-info">
                <i class="glyphicon glyphicon-search"></i> Buscar
            </button>
        </div>
        <div id="resultado" class="col-xs-12 col-sm-14 col-md-12 col-lg-12"><br></div>
    </div>
    <script>
        $('#categoria').on('change', function() {
            var id = document.getElementById("categoria").value
            $.ajax({
                type: "POST",
                url: '?c=productos&a=bycategoria',
                data: {
                    cat_id: id
                },
                beforeSend: function() {
                    $('#articulos').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#articulos').html(resp);

                }
            });
        });

        $('#buscar').on('click', function() {
            var sede = document.getElementById("sede_id").value
            var articulo = document.getElementById("articulo").value
            if (($('#sede_id').val() != "") && ($('#articulo').val() != "")) {
                $.ajax({
                    type: "POST",
                    url: '?c=mantenimientos&a=xubicacion',
                    data: {
                        sede: sede,
                        articulo: articulo
                    },
                    success: function(resp) {
                        $('#resultado').html(resp);
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'No  hay parametros sussficentes para buscar, trata de nuevo',
                    timer: 1500
                }, )
            }
        });
    </script>