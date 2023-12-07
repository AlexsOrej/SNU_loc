<section>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ">
                    <div class="row">
                        <div style="text-aling: left;" class="col-sm-4 text-start">
                            <a style="margin-left:5%" class="btn bg-orange" href="?c=seleccion&a=index">Volver</a>
                        </div>
                        <div class="col-sm-8">
                             PERFIL DEL TRABAJADOR

                        </div>

                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example" style="width: auto;">
                            <!-- <button type="button" id="1" value="1" class="btn btn-secondary">H V</button> -->
                            <button type="button" id="2" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary"><i class="material-icons" style="color:orange">supervisor_account</i> Familia</button>
                            <button type="button" id="3" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary"><i class="material-icons" style="color:orange">school</i> Formación</button>
                            <button type="button" id="4" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary"><i class="material-icons" style="color:orange">medical_services</i>Afiliación</button>
                            <button type="button" id="docs" value="<?= $_REQUEST['id'] ?>" class="btn btn-secondary"><i class="material-icons" style="color:orange">picture_as_pdf</i>Soportes</button>
                        </div>
                    </div>
                    <div class="col-md-12 image-area">
                        <!-- <div class="col-md-2"></div> -->
                        <div class="col-md-4 card profile-card align-center">
                            <div class="content-area ">
                                <table class="table">
                                    <tr>
                                        <th colspan="5">
                                            <div class="col-md-4">
                                                <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/software_developer_icon_png_2_Transparent_Images.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" width="80" height="auto" alt="">
                                            </div>
                                            <h3><?= ucwords($persona->nombre) ?>
                                                <br> <small><?= ucwords($persona->apellidos) ?></small>
                                            </h3>
                                        </th>
                                    </tr>
                                </table>
                                <table class="table table-bordered" style="width: min-content;">
                                    <tr>
                                        <th>Identificación
                                        <td><?= $persona->cedula ?></td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Correo
                                        <td style="width: 200px; height: 50px; overflow: hidden; word-wrap: break-word;"><?=$texto_envuelto = wordwrap($persona->correo, 20, "<br>", true);?></td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Estado
                                        <td><?
                                            if ($persona->rol_id == '1') {
                                                echo '<span class="label label-info">Aspirante</span>';
                                            }
                                            if ($persona->rol_id == '2') {
                                                echo '<span class="label label-info">Seleccionado</span>';
                                            }
                                            if ($persona->rol_id == '3') {
                                                echo '<span class="label label-info">Contratado</span>';
                                            }
                                            if ($persona->rol_id == '4') {
                                                echo '<span class="label label-info">Rechazado</span>';
                                            }
                                            ?>
                                        </td>
                                        </th>
                                    <tr>
                                        <th>Dirección
                                        <td><?= $persona->direccion ?></td>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Barrio
                                        <td><?= $persona->Barrio ?></td>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <!-- Tabs With Icon Title -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <a href="" data-toggle="tab">
                                                <i class="material-icons" style="color: orange;">info_outline</i>
                                            </a><span>INFORMACIÓN</span>
                                        </div>
                                        <div class="body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#home_with_icon_title" data-toggle="tab">
                                                        <i class="material-icons" style="color:orange">supervisor_account</i> Grupo Familiar
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                                        <i class="material-icons" style="color:orange">school</i> Formación
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                                        <i class="material-icons" style="color:orange">picture_as_pdf</i> Seguridad Social
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                                          <i class="material-icons" style="color:orange">picture_as_pdf</i> Soportes
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                                    <b>Grupo Familiar</b>
                                                    <p>
                                                    <ul>
                                                        <? foreach ($familia as $fami) : ?>
                                                            <li><?= $fami->nombre . ' ' . $fami->apellidos . ' <span class="label label-warning">' . $fami->parentesco ?></span></li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                    </p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                                    <b>Formación</b>
                                                    <p>
                                                    <ul>
                                                        <? foreach ($formacion as $form) : ?>
                                                            <li><?= $form->nivel . ' -' . $form->curso_vigilancia . ' <span class="label label-info">' . $form->estudio ?></span></li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                    </p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                                    <b>Seguridad Social</b>
                                                    <p>
                                                    <ul>
                                                        <?
                                                        //print_r($afiliacion);
                                                        foreach ($afiliacion as $afil) : ?>
                                                            <li><?= '<strong>EPS: </strong>' . $afil->eps . '<br> <strong>ARL: </strong> ' . $afil->arl . '<br> <strong>FONDO: </strong> ' . $afil->fondo ?></li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                    </p>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                                    <b>Soportes</b>
                                                    <p>
                                                    <div class="panel-body">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_cedula.pdf';
                                                                    if (file_exists($nombre_fichero)) { ?>
                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_cedula.pdf" title="Cedula" data-toggle="popover" data-trigger="hover" data-content="Ver cedula" target="_blank">Cedula(150%)</a>
                                                                    <?php
                                                                    } else {
                                                                        //  echo "<strong>El Documento cedula no existe</strong>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--cedula-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <?php

                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_eps_afp.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_eps_afp.pdf" title="Certificado EPS/Fondo de Pensiones" data-toggle="popover" data-trigger="hover" data-content="Certificado EPS/Fondo de Pensiones" target="_blank">EPS/Pensiones</a>

                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>El Documento Certificado EPS/Fondo de Pensiones no existe</strong>";
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--eps-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_policia.pdf';
                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_policia.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Policia</a>

                                                                    <?php
                                                                    } else {
                                                                        //  echo "<strong>El archivo de Policia no existe</strong>";
                                                                    }

                                                                    ?>




                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--policia-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_contraloria.pdf';
                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_contraloria.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Contraloria</a>

                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>El archivo de contraloria no existe</strong>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--contralo-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php

                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_procuraduria.pdf';
                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_procuraduria.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Procuradoria</a>

                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>El archivo de Procuradoria no existe</strong>";
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--procura-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_ref_laboral.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_ref_laboral.pdf" title="Referencia laboral" data-toggle="popover" data-trigger="hover" data-content="Referencia laboral" target="_blank">Referencia laboral</a>

                                                                    <?php
                                                                    } else {
                                                                        //  echo "<strong>Referencia laboral no existe</strong>";
                                                                    }

                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--laboral-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_acta.pdf';
                                                                    if (file_exists($nombre_fichero)) { ?>
                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_acta.pdf" title="Diploma bachiller" data-toggle="popover" data-trigger="hover" data-content="Diploma bachiller" target="_blank">Acta bachiller</a>
                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>Acta no existe</strong>";
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--acta-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_diploma.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>

                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_diploma.pdf" title="Diploma bachiller" data-toggle="popover" data-trigger="hover" data-content="Diploma bachiller" target="_blank">Diploma bachiller</a>

                                                                    <?php
                                                                    } else {
                                                                        //   echo "<strong>Diploma no existe</strong>";
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--diploma-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_facademico.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>


                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_facademico.pdf" title="formacion Academica" data-toggle="popover" data-trigger="hover" data-content="Formación Academica" target="_blank">Formación Academica</a>

                                                                    <?php
                                                                    } else {
                                                                        //echo "<strong>Formaci贸n academica no existe</strong>";
                                                                    }

                                                                    ?>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/Assets/soportes/' . $persona->cedula . '/file_militar.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>


                                                                        <a href="Assets/soportes/Assets/soportes/<?php echo $persona->cedula; ?>/file_militar.pdf" title="Libreta Militar" data-toggle="popover" data-trigger="hover" data-content="Libreta Militar" target="_blank">Libreta Militar</a>

                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>Libreta Militar no existe</strong>";
                                                                    }

                                                                    ?>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--libreta-->
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">

                                                                    <?php
                                                                    $nombre_fichero = 'Assets/soportes/' . $persona->cedula . '/file_servicios.pdf';

                                                                    if (file_exists($nombre_fichero)) { ?>


                                                                        <a href="Assets/soportes/<?php echo $persona->cedula; ?>/file_servicios.pdf" title="Libreta Militar" data-toggle="popover" data-trigger="hover" data-content="Libreta Militar" target="_blank">Servicios Publicos</a>

                                                                    <?php
                                                                    } else {
                                                                        // echo "<strong>Servicios Publicos no existe</strong>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--recibo-->
                                                    </div>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #END# Tabs With Icon Title -->
                        </div>
                    </div>
                    <div class="col-md-12" id="resultado">
                    </div>
                    <div class="modal fade" id="gfamiliar" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header"></div>
                                <div class="modal-body" id="result"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-guardar" data-dismiss="modal">CERRAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    $('#1').on('click', function() {
        // var id = document.getElementById("1").value
        var id = <?= $_REQUEST['id'] ?>;
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
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
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
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });
    $('#4').on('click', function() {
        var id = document.getElementById("4").value
        $.ajax({
            type: "POST",
            url: '?c=afiliaciones&a=index',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });
    $('#docs').on('click', function() {
        var id = document.getElementById("docs").value
        $.ajax({
            type: "POST",
            url: '?c=soportes&a=indexnew',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });

    $('#user_id').on('click', function() {
        var id = document.getElementById("user_id").value
        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=crud',
            data: {
                user_id: id
            },
            beforeSend: function() {
                $('#result').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#result').html(resp);

            }
        });
    });
    $('#editar').on('click', function() {
        var id = document.getElementById("editar").value
        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=crud',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#result').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#result').html(resp);

            }
        });
    });
</script>