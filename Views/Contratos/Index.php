<section>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel de Busqueda</h3>
                </div>
                <hr>
                <div class="panel-body text-center">
                    <div class="col-md-4 col-md-offset-2">
                        <label><i class="glyphicon glyphicon-search"></i> Buscar x Nombre/CC</label>
                        <input type="search" onkeyup="Buscar()" class="form-control" name="buscar" id="buscar">
                    </div>
                    <div class="col-md-4">
                        <label><i class="glyphicon glyphicon-search"></i> Buscar x Estado</label>
                        <select name="estado" onchange="BuscarEst()" id="estado" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="1">Aspirantes</option>
                            <option value="2">Seleccionados</option>
                            <option value="3">Contratados</option>
                            <option value="4">Rechazado</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="resultado">
        </div>
    </div>
</section>
<script>
    function Buscar() {
        var data = document.getElementById("buscar").value
        var long = data.length;
        if (long >= 4) {
            $.ajax({
                type: "POST",
                url: '?c=contratacion&a=buscar',
                data: {
                    data: data
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });

        } else {

            $('#cargando').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
        }

    }

    function BuscarEst() {
        var data = document.getElementById("estado").value

        if (data > 0) {
            $.ajax({
                type: "POST",
                url: '?c=contratacion&a=buscarEst',
                data: {
                    data: data
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });

        } else {

            $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
        }

    }

    function Contratar(data) {
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=contratar',
            data: {
                id: data
            },            
            success: function(resp) {
                $('#resultado').html(resp);
            }
        });
    }
</script>