<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SNU-EVENTOS</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Registro de Eventos">
    <meta name="author" content="Registro de Eventos">
    <meta name="generator" content="Registro de Eventos">
    <title>Registro de Eventos</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/checkout/">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Estilos de la imagen */
        img {
            width: 72px;
            /* Ajusta el ancho de la imagen */
            height: 72px;
            /* Ajusta la altura de la imagen */
            /* border-radius: 80%;*/
            /* Aplica bordes redondeados */
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);*/
            /* Agrega una sombra */
        }

        /* Animación */
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
                /* Rotación inicial */
            }

            100% {
                transform: rotate(360deg);
                /* Rotación completa */
            }
        }

        /* Aplicar la animación a la imagen */
        img {
            animation: rotate 4s infinite linear;
            /* Aplica la animación de rotación */
        }



        /* Estilos de la imagen */
        .img-3d {
            width: 300px;
            /* Ajusta el ancho de la imagen */
            height: 300px;
            /* Ajusta la altura de la imagen */
            perspective: 1000px;
            /* Define la perspectiva */
        }

        /* Contenedor para aplicar la transformación 3D */
        .img-3d .img-container {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            /* Mantiene la transformación 3D en los elementos hijos */
            animation: rotate 9s infinite linear;
            /* Aplica la animación de rotación */
        }

        /* Imagen frontal */
        .img-3d .front-img {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: translateZ(150px);
            /* Traslada la imagen hacia adelante */
        }

        /* Imagen trasera */
        .img-3d .back-img {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: translateZ(-150px) rotateY(180deg);
            /* Traslada la imagen hacia atrás y la rota 180 grados */
        }

        /* Animación */
        @keyframes rotate {
            0% {
                transform: rotateY(0deg);
                /* Rotación inicial */
            }

            100% {
                transform: rotateY(360deg);
                /* Rotación completa */
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/css/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light"><div class="container">
    <div class="py-2 text-center">
        <?php
        $ruta = 'https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $imagen->filename;
        ?>
        <img class="d-block mx-auto mb-4" src="<?= $ruta ?>" alt="" width="72" height="72">
        <h2>Registro de Eventos</h2>
        <p class="text-muted">
            Esta herramienta ayuda a identificar, documentar y abordar situaciones en las que los servicios brindados no cumplen con los estándares establecidos, así como los actos y condiciones que pueden representar riesgos para la seguridad.
        </p>
    </div>
   
        <div class="row">
            <div class="col-md-12 order-md-1">
                <div class="card">
                    <div class="card-body">

                        <h4 class="mb-3">Evento</h4>
                        <form class="needs-validation" id="formautoreporte" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Proceso Vinculado</label>
                                    <select name="proceso" id="proceso" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($procesos as $proceso) : ?>
                                            <option value="<?= $proceso->id ?>"><?= $proceso->NombreProceso ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="responsable"></div>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Clasificación del evento</label>
                                    <select name="evento" id="evento" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($clasificacion_eventos as $value) : ?>
                                            <option value="<?= $value->sigla ?>"><?= $value->sigla . ' ' . $value->nombreevento ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="cat_evento"></div>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Sede y área del evento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                                            </svg></span>
                                    </div>
                                    <input type="text" class="form-control" id="lugarEvento" name='lugarEvento' placeholder="Digita el lugar Exacto del evento" required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Digita el lugar Exacto del evento
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Descripción del evento <span class="text-muted">(Requerido)</span></label>
                                <textarea name="descEvento" id="descEvento" class="form-control" rows="3" required="required"></textarea>
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Nombre Completo</label>
                                <input type="text" class="form-control" id="usuario" name='usuario' placeholder="Digitar Nombre Completo" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar" type="button">Registrar Evento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="my-1 pt-1 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2023 Fcalidadsg</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form-validation.js"></script>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('#proceso').on('change', function() {
        var proc = document.getElementById("proceso").value
        $.ajax({
            type: "POST",
            url: '?c=evento&a=proceso_reponsable&cliente=<?php echo $_REQUEST['cliente'] ?>',
            data: {
                proceso: proc,
            },
            beforeSend: function() {
                $('#responsable').html("<h5 class='text-center'>  Cargando Información</h5>");
            },
            success: function(response) {
                $('#responsable').html(response);
                $('#respuesta').html("");
            }
        });
    });
    $('#evento').on('change', function() {
        var sigla = document.getElementById("evento").value
        $.ajax({
            type: "POST",
            url: '?c=evento&a=evento&cliente=<?php echo $_REQUEST['cliente'] ?>',
            data: {
                sigla: sigla,
            },
            beforeSend: function() {
                $('#cat_evento').html("<h5 class='text-center'>  Cargando Información</h5>");
            },
            success: function(resp) {
                $('#cat_evento').html(resp);
                $('#').html("");
            }
        });
    });

    $(document).on('click', '#guardar', function(e) {
        if (($('#proceso').val() != "") && ($('#evento').val() != "") && ($('#lugarEvento').val() != "") && ($('#descEvento').val() != "")) {
            var formData = new FormData($("#formautoreporte")[0]);
            $.ajax({
                url: "?c=evento&a=Registrar&cliente=<?php echo $_REQUEST['cliente'] ?>",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!' + response,
                        timer: 1200,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload();
                    }, 1501)
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Recuerda que todos los campos son obligatorios',
                timer: 1200
            }, )
        }
    });
</script>