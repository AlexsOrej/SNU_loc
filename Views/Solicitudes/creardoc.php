<!-- #END# CPU Usage -->
<?
$almacenamiento = "";
$proteccion = "";
$preservacion = "";
$asignados;
if (!empty($pre)) {
    $almacenamiento = $pre->Almacenamiento;
    $proteccion = $pre->proteccion;
    $preservacion = $pre->preservacion;
}
?>
<div class="card">
    <div class="header">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12">
                <h2>VALIDACIÓN DE CAMBIOS</h2>
            </div>
        </div>
    </div>
    <div class="body">
        <form method="post" name="formResponder" id="formResponder" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <input type="hidden" name="sol_id" value="<?= $_REQUEST['id'] ?>">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Estado de la Solicitud</label>
                                <select name="Aprobado" onchange="Estado(this)" class="form-control" required>
                                    <option value="vacio">Seleccionar :)</option>
                                    <?php
                                    foreach ($asignados as $asignado) {
                                        if ($asignado->actividad == 'revisar') {
                                            echo '<option value="re">En revisión</option>';
                                        }
                                        if ($asignado->actividad == 'aprobar') {
                                            echo '<option value="si">Aprobado</option>';
                                            echo '<option value="no">No Aprobado</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div id="AprobadoV"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Revisión respecto a la conveniencia y adecuación del sistema de gestión:</label>
                                <input type="text" name="Observaciones" id="Observaciones" class="form-control" value="">
                            </div>
                        </div>
                        <div id="Observacionesv"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha Revisión/Aprobación</label>
                                <input type="date" name="EjecucionCambio" id="EjecucionCambio" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div id="EjecucionCambiov"></div>
                    </div>
                </div>
                <?php if ($solicitud->TipoSolicitud != 'creacion') : ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Codigo</label>
                                <?php
                                $consecutivo = '';
                                $numCod = $separada[2] + 1;
                                $consecutivo = $separada[0] . '-' . $separada[1] . '-' . $numCod;
                                ?>
                                <input type="text" name="CodDocumento" id="CodDocumento" class="form-control" value="<?= $consecutivo ?>">
                            </div>
                        </div>
                        <div id="CodDocumentov"></div>
                    </div>
                <?php else : ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Codigo</label>
                                <?
                                $consecutivo = "";
                                if (isset($pre->CodDocumento)) {
                                    $numCodpro = explode('-', $pre->CodDocumento);
                                    @$ult = $numCodpro[2] + 1;
                                    $consecutivo =  $numCodpro[0] . '-' . $numCodpro[1] . '-00' . $ult;
                                }
                                ?>
                                <input type="text" name="CodDocumento" id="CodDocumento" class="form-control" value="<?= @$consecutivo ?>">
                            </div>
                        </div>
                        <div id="CodDocumentov"></div>
                    </div>
                <?php endif; ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre Documento</label>
                            <input type="text" name="NomDocumento" id="NomDocumento" class="form-control">
                        </div>
                    </div>
                    <div id="NomDocumentov"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Almacenamiento</label>
                            <input type="text" name="Almacenamiento" id="Almacenamiento" class="form-control" value="<?= $almacenamiento ?>">
                        </div>
                    </div>
                    <div id="Almacenamientov"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Protección</label>
                            <input type="text" name="proteccion" id="proteccion" class="form-control" value="<?= $proteccion ?>">
                        </div>
                    </div>
                    <div id="proteccionv"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Preservación</label>
                            <input type="text" name="preservacion" id="preservacion" class="form-control" value="<?= $preservacion ?>">
                        </div>
                    </div>
                    <div id="preservacionv"></div>
                </div>
                <? if ($solicitud->TipoSolicitud == 'creacion') : ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Elaboración</label>
                                <input type="date" name="Emision" id="Emision" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div id="Emisionv"></div>
                    </div>
                <? endif; ?>
                <? if ($solicitud->TipoSolicitud == 'actualizacion' or $solicitud->TipoSolicitud == 'eliminacion') : ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Act. y/o anulación: </label>
                                <input type="date" name="Actualizacion" id="Actualizacion" class="form-control" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>
                <? endif; ?>
                <div class="col-sm-6">
                    <div class="form-group">
                        <? if (empty($onlinedocs)) : ?>
                            <div class="form-line">
                                <label>Documento.pdf</label>
                                <? $tipo = 'hidden' ?>
                            </div>
                            <input type="file" name="filename" id="filename" class="form-control">
                        <? else : ?>
                            <input type="hidden" name="filename" id="filename" value="">
                        <? endif; ?>
                        <input type="hidden" name="dir" id="dir" class="form-control">
                        <input type="hidden" name="Proceso" id="Proceso" class="form-control" value="<?= $solicitud->Proceso ?>">
                        <input type="hidden" name="Version" id="Version" class="form-control" value="1">
                        <input type="hidden" name="TipoSolicitud" id="TipoSolicitud" class="form-control" value="<?= $solicitud->TipoSolicitud ?>">
                        <div id="bar"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="button" id="guardar" class="btn btn-success" value="Validar">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function Estado(selectElement) {
        var Aprobado = selectElement.value; // Obtener el valor del elemento seleccionado
        if (Aprobado === 'revision') {
            $("#CodDocumento").val('En Proceso'); // Establecer el texto del elemento con el ID "CodDocumento" como 'No Aplica'
            $("#NomDocumento").val('En Proceso'); // Establecer el texto del elemento con el ID "CodDocumento" como 'No Aplica'

        }

        if (Aprobado === 'no') {
            $("#CodDocumento").val('No Aprobado'); // Establecer el texto del elemento con el ID "CodDocumento" como 'No Aplica'
            $("#NomDocumento").val('No Aprobado'); // Establecer el texto del elemento con el ID "CodDocumento" como 'No Aplica'

        }

        if (Aprobado === 'si') {
            $("#CodDocumento").val("<?= @$consecutivo ?>"); // Establecer el texto del elemento con el ID "CodDocumento" como 'No Aplica'
            $("#NomDocumento").val("");
        }
    }

    $(document).on('click', '#guardar', function(e) {

        var formData = new FormData($("#formResponder")[0]);
        var file = formData.get('filename');

        var Observaciones = formData.get('Observaciones');
        var Aprobado = formData.get('Aprobado');
        var NomDocumento = formData.get('NomDocumento');
        var Aprobado = formData.get('Aprobado')

        if (Observaciones === '' || NomDocumento === '' || Aprobado === 'vacio') {
            Swal.fire({
                icon: 'error',
                title: 'Diligencia todos los campos',
                timer: 1500,
                showConfirmButton: false,
            }, )
        } else {
            $.ajax({
                url: "?c=solicitudes&a=GestionDocumento",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    let timerInterval
                    Swal.fire({
                        title: 'REGISTRANDO',
                        html: 'Creando el formato <b></b> milisegundo restantes',
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            // console.log('I was closed by the timer')
                        }
                    })
                },
                success: function(response) {
                    console.log(response);
                    // $('#bar').html("<div class='text-center'><span class='label label-success'>Cargado con exito</span></div>");
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        text: response,
                        showConfirmButton: false,
                        // timer: 1500
                    }, )
                    setTimeout(function() {
                        window.location = '?c=solicitudes&a=index';
                    }, 2000)
                }
            });
        }
    });
</script>