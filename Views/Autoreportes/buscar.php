<div class="row clearfix">
    <input type="hidden" name="method" value="PUT">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    CONSULTAR EVENTOS
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">                                
                                <select name="est" id="est" class="form-control">
                                    <option value=" ">Seleccionar Estado</option>
                                    <option value="En Tramite">Tratamiento</option>
                                    <option value="Revisión">Revisión</option>
                                    <option value="Aprobacion">Verificado</option>
                                </select>
                            </div>
                        </div>
                    </div>                   
                </div>                
            </div>
            <div id="resultado"></div>
        </div>
    </div>
</div>
<script>
    function Ver(val) {
        var id = val
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=autoreportes&a=Responder",
            beforeSend: function() {
                $('#index').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
    }

    $('#est').on('change', function() {
        var estado = document.getElementById("est").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=BuscarResp',
            data: {
                estado: estado,
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    });

    $('#inci').on('change', function() {
        var inci = document.getElementById("inci").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=BuscarResp',
            data: {
                inci: inci,
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    });

    $('#editar').on('click', function() {
        var inci = document.getElementById("editar").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=BuscarResp',
            data: {
                inci: inci,
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    });

    $('#proceso').on('change', function(e) {
        var proceso = document.getElementById("proceso").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=BuscarResp',
            data: {
                proceso: proceso,
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    });
</script>