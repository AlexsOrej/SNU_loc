<div class="col-md-12">
    <div class="row">

        <div class="col-md-3">
            <div class="card">
                <div class="header">
                    <h2>
                        DETALLE
                        <!-- <small>List group items may be buttons instead of list items (that also means a parent <code>&lt;div&gt;</code> instead of an <code>&lt;ul&gt;</code>). No need for individual parents around each element. Don't use the standard <code>.btn</code> classes here.</small> -->
                    </h2>
                </div>                
                <div class="body">
                    <div class="list-group">
                        <button id="ig" type="button" class="list-group-item">Información General</button>
                        <button id="ps" type="button" class="list-group-item">Perfil Sociodemografico</button>
                        <button id="nf" type="button" class="list-group-item">Nucleo Familiar</button>
                        <button id="ia" type="button" class="list-group-item">Información Academica</button>
                        <button id="ss" type="button" class="list-group-item">Seguridad Social</button>
                        <button id="docs" type="button" class="list-group-item">Documentos</button>
                        <button id="hc" type="button" class="list-group-item">Historial de Contratación</button>
                        <button id="nov" type="button" class="list-group-item">Novedades</button>
                        <button id="status" type="button" class="list-group-item">Estado</button>
                    </div>
                </div>
                <!-- #END# Button Items -->
            </div>
        </div>
        <div class="card col-md-9 align-center bg-orange" id="respuesta0">
            <h3><?= $persona->nombre . ' ' . $persona->apellidos ?>
        </div>
        <div class="col-md-9" id="respuesta"></div>
        <div class="col-md-12" id="resultado"></div>
    </div>
</div>
<script>
    $('#ig').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=seleccion&a=gestion0',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#ps').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=sociodemografico&a=add',
            data: 'personal_id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#nf').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=index',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#ia').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=nivelacademico&a=index',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#ss').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=afiliaciones&a=index',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#docs').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=soportes&a=indexnew',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#hc').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=historial1',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#nov').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=novedades&a=GetNovedadPersona',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
    $('#status').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=personas&a=estado',
            data: 'id=' + <?= $_REQUEST['personal_id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                $('#respuesta0').hide(resp);
            }
        });
    });
</script>