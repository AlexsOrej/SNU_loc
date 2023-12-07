<div class="row clearfix ">
    <div class="col-md-12 resultados">
        <div class="row" id="resultados">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons col-cyan">face</i>
                    </div>
                    <div class="content">
                        <div class="text">SOLICITANTE</div>
                        <div class="number"><?
                        $nombre = explode(" ", $_SESSION['user']->FullName);
                        echo  count($nombre)>=4 ? ucwords($nombre[0].' '.$nombre[3]): ucwords($nombre[0].' '.$nombre[1]) ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons col-teal">email</i>
                    </div>
                    <div class="content">
                        <div class="text">SOLICITUD</div>
                        <div class="number"><?= $ultima_solicitud->ULTIMA + 1 ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-4 hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons col-pink">access_alarm</i>
                    </div>
                    <div class="content">
                        <div class="text">FECHA SOLICITUD</div>
                        <div class="number"><?= date('Y-m-d') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h2>
                            FORMA DE LA SOLICITUD
                            <small>Solicitud para el control de cambios</small>
                        </h2>
                    </div>
                    <div class="body">
                        <form method="post" name="formSolicitud" id="formSolicitud" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tipo de Información</label>
                                    <select class="form-control show-tick" name="TipoDocumento" id="TipoDocumento" required>
                                        <option value="">Seleccionar</option>
                                        <option value="documento">Documento</option>
                                        <option value="formato">Formato</option>
                                        <option value="software">Software</option>
                                        <option value="externo">Externo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Proceso Solicitante</label>
                                    <select class="form-control show-tick" name="Proceso" id='Proceso' required>
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($procesos as $sgc) : ?>
                                            <option value="<?php echo $sgc->Iniciales ?>"><?= ucwords(strtolower($sgc->NombreProceso))   ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Tipo Solicitud</label>
                                    <select class="form-control show-tick" name="TipoSolicitud" id="TipoSolicitud" required>
                                        <option value="">Seleccionar</option>
                                        <option value="creacion">Creación</option>
                                        <option value="actualizacion">Actualización</option>
                                        <option value="eliminacion">Eliminación</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label id="label" >Modo Ejecución</label>
                                    <select class="form-control show-tick" name="modoSolicitud" id="modoSolicitud" required>
                                        <option value="">Seleccionar</option>
                                        <option value="local">Subir Archivo</option>
                                        <option value="online">Elaborar Online</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="NombreSolicitante" id="NombreSolicitante" value="<?= ucwords($_SESSION['user']->FullName) ?>">
                                    <input type="hidden" name="FechaSolicitud" name="FechaSolicitud" value="<?= date('Y-m-d') ?>">
                                    <input type="hidden" name="Codigo" id="Codigo" value="">
                                    <input type="hidden" name="solicitud_id" id="solicitud_id" value="<?= $ultima_solicitud->ULTIMA + 1 ?>">
                                    <input title="Botón para continuar con la creacion de la solicitud" type="button" id="ver" class="btn btn-guardar" value="Continuar">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATOS DE LA SOLICITUD
                            <small>Solicitud para el control de cambios</small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="index" id="index"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#ver').on('click', function() {
        var formData = $("#formSolicitud").serialize();
        $.ajax({
            type: "POST",
            url: '?c=solicitudes&a=DescripcionLine',
            data: formData,
            beforeSend: function() {
                $('#index').html("<h5 class='text-center'><img src='Assets/images/gifs/cargando-loading-026.gif'> Cargando Información</h5>");
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    });
    // Get the two select elements
    const select0 = document.querySelector('#TipoSolicitud');
    const select1 = document.querySelector('#TipoDocumento');
    const select2 = document.querySelector('#modoSolicitud');
    select0.addEventListener('change', () => {
        const selectedValue0 = select0.value; 
        const selectedValue = select1.value; 
        if (selectedValue0 != 'eliminacion' ) {          
            $('#modoSolicitud').show();
            $('#label').show();
        }else{
            $('#modoSolicitud').hide();
            $('#label').hide();
            $("#modoSolicitud").val("local");
        }
    })
    // Add an event listener to the first select
    select1.addEventListener('change', () => {
        // Get the value of the first select
        const selectedValue = select1.value;
        // If the value is "disabled", disable the second select
        if (selectedValue === 'formato' || selectedValue === 'externo' || selectedValue === 'software') {
            $('#modoSolicitud').hide();
            $('#label').hide();
        } else {
            // Otherwise, enable the second select
            select2.disabled = false;
            $("#modoSolicitud").val("");
            $('#modoSolicitud').show();
            $('#label').show();
        }
    });
</script>