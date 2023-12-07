<? require_once 'Views/Layout/serviciosperfil.php'; ?>
<!-- #Top Bar -->
<div class="row">
    <div class="col-md-3" style="margin-top: 20px; padding: 20px;">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <p class="text-center">
                    <h4><?php echo $this->usuario->saludarSegunHora(); ?></h4>
                    </p>
                    <img class="profile-user-img img-fluid img-circle" src="data:image/png;base64,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" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">
                    <?php echo ucwords($_SESSION['user']->FullName) ?>
                </h3>
                <p class="text-muted text-center"><?php echo ucwords($_SESSION['user']->rol) ?></p>
                <p class="text-muted text-center"><?= $entrada->ULTIMA ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-items" onclick="Solicitudes('<?php echo $_SESSION['user']->FullName ?>')">
                        <b>Solicitudes</b>
                        <a class="float-right">
                            <span class="badge bg-cyan"> <?php echo isset($totalsolicitudes->CantidadSolicitudes) ? $totalsolicitudes->CantidadSolicitudes : '0' ?> Realizadas
                            </span>
                        </a>
                    </li>
                    <li class="list-group-items" onclick="Pqrs('<?php echo $_SESSION['user']->FullName ?>')">
                        <b>Pqrsf</b>
                        <a class="float-right">
                            <span class="badge bg-pink"> <?= $totalpqrs ?> Asignadas</span>
                        </a>
                    </li>
                    <li class="list-group-items" onclick="Eventos('<?php echo $_SESSION['user']->user_id ?>')">
                        <b>Eventos</b>
                        <a class="float-right">
                            <span class="badge bg-teal"><?php echo $totaleventos ?> Reportados</span>
                        </a>
                    </li>
                    <li class="list-group-items" onclick="Indicadores('<?php echo $_SESSION['user']->user_id ?>')">
                        <b>Indicadores</b>
                        <a class="float-right">
                            <span class="badge bg-orange"><?= $totalindicadores ?> Asignados</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6" style="margin-top: 20px; padding: 20px; border-radius: 0% 0% 15% 15%;">
        <div class="card">
            <div class="header">
                <h2 class="text-center">📌INFORMACIÓN GENERAL</h2>
            </div>
            <div class="bodypost contenedor" id="detalle">
                <div class="body">
                    <?php
                    if ($cartelerasvigente) :
                        foreach ($cartelerasvigente as $value) : ?>
                            <!--- \\\\\\\Post-->
                            <div class="card">
                                <div class="header bg-cyan">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="ml-5">
                                                <div class="h5 m-0">Publicado por: <?= $value->usuario ?></div>
                                            </div>
                                            <div class="text-muted h7 mb-2"> <i class="glyphicon glyphicon-time"></i>
                                                <?= $this->cartelera->tiempoTranscurrido($value->fecha_registro); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <a class="card-link" href="#">
                                        <h5 class="card-title"><?php echo ucwords($value->titulo); ?></h5>
                                    </a>
                                    <p class="card-text text-justify">
                                        <?php
                                        $longitudMaxima = 500;
                                        $texto = $value->contenido;
                                        // Verificar la longitud del texto
                                        if (mb_strlen($texto) > $longitudMaxima) {
                                            // Obtener la porción del texto sin cortar las palabras
                                            $textoRecortado = mb_substr($texto, 0, $longitudMaxima);

                                            // Encontrar la última posición de un espacio en blanco dentro de la porción recortada
                                            $ultimaPosicionEspacio = mb_strrpos($textoRecortado, ' ');

                                            // Si se encontró un espacio, cortar en esa posición
                                            if ($ultimaPosicionEspacio !== false) {
                                                $textoRecortado = mb_substr($textoRecortado, 0, $ultimaPosicionEspacio);
                                            }

                                            // Agregar puntos suspensivos al final
                                            $textoRecortado .= '...';
                                        } else {
                                            // Si el texto es más corto que la longitud máxima, no es necesario recortar
                                            $textoRecortado = $texto;
                                        }

                                        // Imprimir el resultado
                                        echo $textoRecortado; ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a class="card-link" data-toggle="modal" href='#modal-id2' onclick="Texto('<?= $value->titulo ?>','<?= $texto ?>')"><i class="fa fa-gittip"></i>Leer Mas</a>
                                </div>
                            </div>
                            <!-- Post /////-->
                        <?php endforeach; ?>

                    <?php else : ?>
                        <div class="card">
                            <div class="header bg-cyan">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="ml-5">
                                        </div>
                                        <div class="text-muted h7 mb-2"> <i class="glyphicon glyphicon-time"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <p class="card-text text-justify">
                                    SIN INFORMACIÓN PARA MOSTRAR
                                </p>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3" style="margin-top: 20px; padding-top: 20px;">
        <div class="card">
            <div class="header text-center">
                <h2>🤖 Tips</h2>
            </div>
            <div class="body text-justify" id="tips">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titulo"></h4>
            </div>
            <div class="modal-body">
                <p id="contenidoModal" class="text-justify"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
<style>
    .contenedor {
        height: 500px;
        /* Altura deseada */
        overflow-y: scroll;
        /* Añade una barra de desplazamiento vertical si es necesario */
        border: 1px solid #ccc;
        /* Borde para visualización */
        padding: 10px;
        /* Espaciado interno */

    }


    /* Estilos para el footer de la card */
    .card-footer {
        background-color: #f8f9fa;
        /* Color de fondo */
        padding: 10px;
        /* Espaciado interno */
        border-top: 1px solid #dee2e6;
        /* Borde superior */
    }

    /* Opcional: Estilos para los enlaces dentro del footer */
    .card-footer a {
        color: #007bff;
        /* Color del enlace */
        text-decoration: none;
        /* Sin subrayado */
    }

    .card-footer a:hover {
        text-decoration: underline;
        /* Subrayado al pasar el cursor sobre el enlace */
    }



    .bodypost {
        background-color: #FAFAFA;
    }

    .h7 {
        font-size: 0.8rem;
    }

    .gedf-wrapper {
        margin-top: 0.97rem;
    }

    @media (min-width: 992px) {
        .gedf-main {
            padding-left: 4rem;
            padding-right: 4rem;
        }

        .gedf-card {
            margin-bottom: 2.77rem;
        }
    }

    /**Reset Bootstrap*/
    .dropdown-toggle::after {
        content: none;
        display: none;
    }

    .list-group-items {
        position: relative;
        display: block;
        padding: 1px;
        background-color: #fff;
        cursor: pointer;
        /* border: 1px solid rgba(0, 0, 0, .125); */
    }

    .list-group {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
        /* border-radius: .25rem; */

    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding-top: 15px;
        padding-left: 20px;
        padding-bottom: 15px;
        padding-right: 20px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    dl,
    ol,
    ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    ul {
        display: block;
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 5px;
        padding-inline-start: 40px;
    }

    .img-circle {
        border-radius: 50%;
    }

    .profile-user-img {
        border: 3px solid #adb5bd;
        margin: 0 auto;
        padding: 3px;
        width: 100px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    img {
        vertical-align: middle;
        border-style: none;
    }

    img {
        overflow-clip-margin: content-box;
        overflow: clip;
    }
</style>
<?php //print_r($_SESSION) ?>
<script>
    function Texto(titulo, text) {

        // Modifica el contenido del modal con la variable específica
        $('#titulo').text(titulo);
        $('#contenidoModal').text(text);
    };

    function Clave(id) {
        var val = id;
        $.ajax({
            type: "POST",
            url: '?c=usuarios&a=clave',
            data: 'id=' + val,
            beforeSend: function() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#detalle').html(resp);

            }
        });
    }

    function Editar(val) {
        $.ajax({
            type: "POST",
            url: '?c=usuarios&a=Registrar',
            data: 'id=' + val,
            beforeSend: function() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#detalle').html(resp);

            }
        });
    }

    function Solicitudes(id) {
        var id = id
        $.ajax({
            data: {
                usuario: id
            },
            type: "post",
            url: "?c=perfilusuarios&a=solicitudes",
            beforeSend: function() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(response) {
                $('#detalle').html(response)

            }
        })
    }

    function Pqrs(id) {
        $.ajax({
            data: {
                id: id
            },
            url: '?c=perfilusuarios&a=pqrs',
            beforeSend() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");

            },
            success(response) {
                $('#detalle').html(response)
            }
        })

    }

    function Eventos(id) {
        $.ajax({
            data: {
                id: id
            },
            url: '?c=perfilusuarios&a=evento',
            beforeSend() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");

            },
            success(response) {
                $('#detalle').html(response)
            }
        })

    }

    function Indicadores(id) {
        $.ajax({
            data: {
                id: id
            },
            url: '?c=perfilusuarios&a=indicador',
            beforeSend() {
                $('#detalle').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");

            },
            success(response) {
                $('#detalle').html(response)
            }
        })

    }
</script>


<script>
    function cargarContenido() {
        // Mostrar un mensaje mientras se espera la respuesta de la API
        $("#tips").html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
        $.ajax({
            url: '?c=perfilusuarios&a=ia', // Ruta de tu API PHP
            type: 'POST',
            success: function(response) {
                $("#tips").html(response);
            },
            error: function() {
                // Manejar errores
                $("#tips").html("Error al cargar la información");
            }
        });
    }

    // Llamar a la función al cargar la página
    $(document).ready(function() {
        cargarContenido();
    });
</script>