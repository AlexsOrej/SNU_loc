<div class="col-md-12">

    <div class="card">
        <div class="panel-heading">
            <h3 class="panel-title">Ingresar los Id´s a trasladar</h3>
        </div>
        <div class="panel-body">
            <?php
            echo  isset($_REQUEST['true']) ?  "<script>
        Swal.fire({
            icon: 'success',
            title: 'El traslado se registro con éxito!!',
            showConfirmButton: false,
            timer: 1500
        }, )
        setTimeout(function() {
             window.location = '?c=traslados&a=index';
           //  window.location.reload(1);
        }, 2000)
        </script>" : "";
            ?>
            <div class=" col-md-12">

                <div class="form-group">
                    <label for="textarea" class="col-sm-2 control-label">Digitar Id´s</label>
                    <div class="col-sm-12">
                        <textarea name="numero" id="numero" class="form-control" rows="3" required="required"></textarea>
                    </div>
                </div>

                <!-- <div class=" col-md-6">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label for="">Elige la sede</label>
                            <select name="ubicacion" id="ubicacion" class="form-control">
                                <option value=" ">Seleccionar</option>
                                <?php foreach ($sedes as $sede) : ?>
                                    <option value="<?= $sede->id ?>"><?= utf8_encode($sede->nombre)  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="form-group form-float">
                        <label for="">Elegir la Ubicación</label>
                        <div class="form-line" id="sede">
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="panel-body" id="resultado"></div>
        </div>
    </div>
</div>

<script>
    $('#numero').on('keyup', function() {
        var id = document.getElementById("numero").value
        var val = id.substr(-1);
        var val2 = id.substr(-2);
       

        if ((parseInt(val) || val>=0) && (id.length > 0) ) {
            $.ajax({
                type: "POST",
                url: '?c=traslados&a=productoxids',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                    $('#respuesta').html("");
                }
            });
        } else {
           if(id.length == 0){
           $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Esperando Id</p> </div>");
           }else{
            if( (val != ",") || (val2 == ",,")|| (val == ",,,") ){
                $('#resultado').html("  <div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p><h5 class='text-center alert alert-danger'>Separalos con una ' , '(coma) ejemplo(1,2,3)</h5></div>");
            } else {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Esperando Id</p> </div>");
            }
        }}
    });
</script>
