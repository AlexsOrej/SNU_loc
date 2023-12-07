<section>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/software_developer_icon_png_2_Transparent_Images.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" width="80" height="auto" alt="">
                        </div>
                        <div class="col-md-9">
                            <!-- <ul>
                                <li><?= $Pqrsf->id . ' ' . $Pqrsf->nombres ?></li>
                                <li><?= $Pqrsf->cedula ?></li>
                                <li><?= $persona->Correo ?></li>
                                <li><?= $persona->estado ?></li>
                            </ul> -->
                            <ul>
                                <li>Id</li>
                                <li>nombres</li><li>cedula</li><li>tipo_peticion</li><li>identificacion</li><li>correo</li><li>n_contacto</li>
                                <li>descripcion</li><li>fecha_registro</li><li>estado</li><li>radicado</li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-md-12 text-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" id="1" value="1" class="btn btn-secondary">H V</button>
                            <button type="button" id="2" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary">Familia</button>
                            <button type="button" id="3" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary">Formación</button>
                            <button type="button" id="4" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary">Afiliación</button>
                            <button type="button" id="5" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary">Doc</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body" id="resultado">

                </div>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body" id="resultado1">

                </div>
            </div>
        </div> -->
    </div>
</section>
<script>
    $('#1').on('click', function() {
        var id = document.getElementById("1").value
        $.ajax({
            type: "POST",
            url: '?c=personas&a=Procesar',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });
    $('#2').on('click', function() {
        var id = document.getElementById("2").value
        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=index',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });

    $('#3').on('click', function() {
        var id = document.getElementById("3").value
        $.ajax({
            type: "POST",
            url: '?c=nivelacademico&a=index',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });
    $('#4').on('click', function() {
        var id = document.getElementById("3").value
        $.ajax({
            type: "POST",
            url: '?c=afiliaciones&a=index',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });
</script>