<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 font-13">  
            
            <div class="list-group">
                <?php foreach ($procesos as $valor) : ?>
                    <button type="button" onclick="Ver('<?= $valor->Iniciales ?>')" class="list-button">
                        <span class="list-icon"><?= substr($valor->NombreProceso, 0, 1) ?></span>
                        <span class="list-text"><?= ucwords(strtolower($valor->NombreProceso)) ?></span>
                    </button>
                <?php endforeach; ?>
            </div>    
</div>
<div class="col-lg-10 col-md-10 col-sm-10" id="index"></div>
<!-- #END# Bootstrap Default Buttons -->
<script type="text/javascript">
    function Ver(valor) {
        var id = valor
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=documentos&a=verdocumentos",
            beforeSend: function() {
                $('#index').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(data) {
                $('#index').html(data);
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
</script>
