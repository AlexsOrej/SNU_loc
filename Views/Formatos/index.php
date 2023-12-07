<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
    <div class="list-group">
        <?php foreach ($procesos as $valor) : ?>
            <button type="button" onclick="Ver('<?= $valor->Iniciales ?>')" class="list-button" >
                <span class="list-icon"><?= substr($valor->NombreProceso, 0, 1) ?></span>
                <span class="list-text"><?= ucwords(strtolower($valor->NombreProceso)) ?></span>
            </button>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" id="index"></div>
<!-- #END# Bootstrap Default Buttons -->
<script>
    function Ver(val) {
        var id = val
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=formatos&a=verformato",
            beforeSend: function() {
                $('#index').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#index').html(resp);
            }
        });
    }
</script>


