<?php //print_r($info); ?>
<form action="?c=solicitudes&a=Registrar0" method="post" name="formSolicitud1" id="formSolicitud1" enctype="multipart/form-data">
    <div class="row">
        <? if ($_REQUEST['TipoSolicitud'] == 'creacion') : ?>
            <input type="hidden" name="cod" id="cod" value="Codigo Automatico">
        <? endif; ?>

        <? if ($_REQUEST['TipoSolicitud'] == 'eliminacion' and $_REQUEST['modoSolicitud'] == 'local' and ($TipoDocumento == 'documento' or $TipoDocumento == 'formato' or $TipoDocumento == 'externo')) : ?>
            <div class="col-md-12">
                <label>Selecciona el <?= $TipoDocumento ?> </label>
                <select class="form-control show-tick" name="cod" id="cod">
                    <option value="">Seleccionar</option>
                    <? foreach ($info as $value) :
                        if ($TipoDocumento == 'documento') {
                            echo '<option value="' . $value->CodDocumento . '">' . $value->CodDocumento . '-' . $value->NomDocumento . '</option>';
                        }
                        if ($TipoDocumento == 'formato') {
                            echo '<option value="' . $value->CodFormato . '">' . $value->CodFormato . '-' . $value->NomFormato . '</option>';
                        }
                        if ($TipoDocumento == 'externo') {
                            echo '<option value="' . $value->codigo . '">' . $value->codigo . '-' . $value->nombre . '</option>';
                        }
                    endforeach; ?>
                </select>
            </div>
            <div class="col-md-12">
                <label>Justificación</label>
                <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
            </div>
        <? endif; ?>
        <!-- creacion/local/documento o ext-->
        <? if ($_REQUEST['TipoSolicitud'] == 'creacion' and $_REQUEST['modoSolicitud'] == 'local' and ($TipoDocumento == 'documento' or $TipoDocumento == 'externo')) : ?>
            <div class="col-md-4">
                <div class="form-line">
                    <label>Adjuntar Archivo</label>
                    <input type="file" name="filename" class='form-control' value="">
                    <input type="hidden" name="dir" class='form-control' value="">
                    <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
                </div>
            </div>
            <div class="col-md-8">
                <label>Justificación</label>
                <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
            </div>

        <? endif; ?>
        <!--FIN creacion/local/documento-->
        <!-- actualizacion/local/documento o ext -->
        <? if ($_REQUEST['TipoSolicitud'] == 'actualizacion' and $_REQUEST['modoSolicitud'] == 'local' and ($TipoDocumento == 'documento' or $TipoDocumento == 'externo')) : ?>
            <div style="vertical-align: middle;text-align: center;" class="col-md-12 text-center" id="error"></div>
            <div class="col-md-4">
                
                <div class="form-line">
                    <label>Adjuntar Archivo</label>
                    <input type="file" name="filename" class='form-control' value="">
                    <input type="hidden" name="dir" class='form-control' value="">
                    <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
                </div>
                <label>Descripción</label>
                <select class="form-control show-tick" name="cod" id="cod">
                    <option value="">Seleccionar</option>
                    <? foreach ($info as $value) :
                        if ($TipoDocumento == 'documento') {
                            echo '<option value="' . $value->CodDocumento . '">' . $value->CodDocumento . '-' . $value->NomDocumento . '</option>';
                        }
                        if ($TipoDocumento == 'formato') {
                            echo '<option value="' . $value->CodFormato . '">' . $value->CodFormato . '-' . $value->NomFormato . '</option>';
                        }
                        if ($TipoDocumento == 'externo') {
                            echo '<option value="' . $value->codigo . '">' . $value->codigo . '-' . $value->nombre . '</option>';
                        }
                    endforeach; ?>
                </select>
            </div>
            <div class="col-md-8">
                <label>Justificación</label>
                <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
            </div>
        <? endif; ?>
        <!--FIN actualizacion/local/documento -->
        <!-- creacion/online/documento -->
        <? if ($_REQUEST['TipoSolicitud'] == 'creacion' and $_REQUEST['modoSolicitud'] == 'online' and $TipoDocumento == 'documento') : ?>
            <div class="col-md-12">
                <div class="col-md-12">
                    <label>Justificación</label>
                    <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
                </div>
                <div class="col-md-12">
                    <label>Contenido del <?= $TipoDocumento ?></label>
                    <textarea cols="10" rows="10" id="contenido01" name="contenido01" class="ckeditor" value=""></textarea>
                </div>
                <div id="index1" class="col-md-12"></div>
            </div>
        <? endif; ?>
        <!-- FIN creacion/online/documento -->
        <!-- actualizacion/online/documento -->
        <? if ($_REQUEST['TipoSolicitud'] == 'actualizacion' and $_REQUEST['modoSolicitud'] == 'online' and $TipoDocumento == 'documento') : ?>
            <div class="col-md-12">
                <div class="col-md-4">
                    <label>Descripción</label>
                    <select class="form-control show-tick" name="cod" id="cod" onchange="Ver()">
                        <option value="">Seleccionar</option>
                        <? foreach ($info as $value) :
                            if ($TipoDocumento == 'documento') {
                                echo '<option value="' . $value->CodDocumento . '">' . $value->CodDocumento . '-' . $value->NomDocumento . '</option>';
                            }
                            if ($TipoDocumento == 'formato') {
                                echo '<option value="' . $value->CodFormato . '">' . $value->CodFormato . '-' . $value->NomFormato . '</option>';
                            }
                            if ($TipoDocumento == 'externo') {
                                echo '<option value="' . $value->codigo . '">' . $value->codigo . '-' . $value->nombre . '</option>';
                            }
                        endforeach; ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <label>Justificación</label>
                    <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
                </div>
                <div id="index1" class="col-md-12">
                    <label>Contenido del <?= $TipoDocumento ?></label>
                    <textarea cols="10" rows="10" id="contenido01" name="contenido01" class="ckeditor" value=""></textarea>
                </div>
            </div>
        <? endif; ?>
        <!--FIN actualizacion/online/documento -->
        <!-- ---------------------------------------------->
        <!-- FORMATOS -->
        <!-- creacion/local/formato -->
        <? if ($_REQUEST['TipoSolicitud'] == 'creacion' and $_REQUEST['modoSolicitud'] == 'local' and $TipoDocumento == 'formato') : ?>
            <div class="col-md-4">
                <div class="form-line">
                    <label>Adjuntar Archivo</label>
                    <input type="file" name="filename" class='form-control' value="">
                    <input type="hidden" name="dir" class='form-control' value="">
                    <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
                </div>
            </div>
            <div class="col-md-8">
                <label>Justificación</label>
                <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
            </div>
        <? endif; ?>
        <!--FIN creacion/local/formato -->
        <!-- actualizacion/local/formato -->
        <? if ($_REQUEST['TipoSolicitud'] == 'actualizacion' and $_REQUEST['modoSolicitud'] == 'local' and $TipoDocumento == 'formato') : ?>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="form-line">
                        <label>Adjuntar Archivo</label>
                        <input type="file" name="filename" class='form-control' value="">
                        <input type="hidden" name="dir" class='form-control' value="">
                        <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
                    </div>
                    <label>Descripción</label>
                    <select class="form-control show-tick" name="cod" id="cod">
                        <option value="">Seleccionar</option>
                        <? foreach ($info as $value) :
                            if ($TipoDocumento == 'documento') {
                                echo '<option value="' . $value->CodDocumento . '">' . $value->CodDocumento . '-' . $value->NomDocumento . '</option>';
                            }
                            if ($TipoDocumento == 'formato') {
                                echo '<option value="' . $value->CodFormato . '">' . $value->CodFormato . '-' . $value->NomFormato . '</option>';
                            }
                            if ($TipoDocumento == 'externo') {
                                echo '<option value="' . $value->codigo . '">' . $value->codigo . '-' . $value->nombre . '</option>';
                            }
                        endforeach; ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <label>Justificación</label>
                    <textarea name="Descripcion" id="Descripcion" placeholder="Debe contener la información necesaria y detallada de los ajustes solicitados en coherencia a la conveniencia y adecuación del sistema de gestión." id="Descripcion" cols="50" rows="5" class="form-control"></textarea>
                </div>
            </div>
        <? endif; ?>
        <div class="col-md-12">
            <input type="hidden" name="TipoDocumento" id="TipoDocumento" class="tipo" value="<?= $_REQUEST['TipoDocumento'] ?>">
            <input type="hidden" name="TipoSolicitud" id="TipoSolicitud" value="<?= $_REQUEST['TipoSolicitud'] ?>">
            <input type="hidden" name="modoSolicitud" id="modoSolicitud" value="<?= $_REQUEST['modoSolicitud'] ?>">
            <input type="hidden" name="Proceso" id="Proceso" value="<?= $_REQUEST['Proceso'] ?>">
            <input type="hidden" name="NombreSolicitante" id="NombreSolicitante" value="<?= ucwords($_REQUEST['NombreSolicitante']) ?>">
            <input type="hidden" name="FechaSolicitud" name="FechaSolicitud" value="<?= $_REQUEST['FechaSolicitud'] ?>">
            <input type="hidden" name="solicitud_id" id="solicitud_id" value="<?= $_REQUEST['solicitud_id'] ?>">
            <input type="submit" id="guardar0" class="btn btn-guardar" value="Guardar">

        </div>
    </div>
</form>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script>

</script>
<script type="text/javascript">
    const form = document.querySelector('#formSolicitud1');
    // Add a submit event listener
    form.addEventListener('submit', (event) => {
        // Prevent the form from submitting
        event.preventDefault();
        var myElement = document.getElementById('cod'),
            myElementValue = myElement.value;
        var myElement2 = document.getElementById('Descripcion'),
            myElementValue2 = myElement2.value;
        if (myElementValue === '') {
            alert('Debe seleccionar un item de lista');
        } else {
            var ver1 = 'ok'
        }
        if (myElementValue2 === '') {
            alert('Debe Digitar la justificación');
        } else {
            var ver2 = 'ok'
        }
        if (ver1 == 'ok' && ver2 == 'ok') {
            form.submit();
        }
    });

    $('#cod').on('change', function() {
    var codigo = $(this).val();
    var online;
    //alert(codigo);

    $.ajax({
        url: '?c=solicitudes&a=comprobarDoc',
        type: 'GET',
        data: { codigo : codigo },
        beforeSend: function(xhr){
        xhr.setRequestHeader('Cache-Control', 'no-cache, must-revalidate');
        },
        success: function(response) {
            online = response;
            console.log('Success:', response);
            console.log('valido:', online);
            $('#error').html(response);
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        },
        complete: function() {
            var doc = document.getElementById('doc_online_actual').value;
            if (doc === "online"){
               $('#guardar0').css('display','none')
            }
        }
    });

   
    


    });

    function Ver() {
        var cod = document.getElementById("cod").value
        $.ajax({
            type: "POST",
            url: '?c=solicitudes&a=InfoDoc',
            data: {
                id: cod,
            },
            beforeSend: function() {
                $('#index1').html("<h5 class='text-center'> <img src='Assets/images/gifs/cargando-loading-026.gif'> Cargando Información</h5>");
            },
            success: function(data) {
                $('#index1').html(data);
            }
        });
    }

   


    CKEDITOR.addCss(
        'body.document-editor { margin: 0.5cm auto; border: 1px #D3D3D3 solid; border-radius: 5px; background: white; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }' +
        'body.document-editor, div.cke_editable { width: 700px; padding: 1cm 2cm 2cm; } ' +
        'body.document-editor table td > p, div.cke_editable table td > p { margin-top: 0; margin-bottom: 0; padding: 4px 0 3px 5px;} ' +
        'blockquote { font-family: sans-serif, Arial, Verdana, "Trebuchet MS", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; } '
    );

    CKEDITOR.config.exportPdf_options = {
        header_html: '<div class="styled"></div>',
        footer_html: '<div class="styled-counter"><span class="pageNumber"></span></div>',
        header_and_footer_css: '.styled { font-weight: bold; padding: 10px; } .styled-counter { font-size: 1em; color: hsl(0, 0%, 60%); }',
        margin_top: '2cm',
        margin_left: '2cm',
        margin_right: '2cm',
        margin_bottom: '2cm'
    }
    

    var editor = CKEDITOR.replace('contenido01', {
        filebrowserBrowseUrl: '?c=explorador&a=index',
        filebrowserWindowWidth: '640',
        filebrowserWindowHeight: '480',
        readOnly: false,
        height: 400,
        // extraPlugins: 'easyimage,colorbutton,font,justify,print,tableresize,liststyle,pagebreak,exportpdf',
        extraPlugins: 'image2,colorbutton,font,justify,print,tableresize,liststyle,pagebreak,exportpdf',
        // removePlugins: 'image',
        removeDialogTabs: 'link:advanced',
        language: 'es',
        uiColor: '#F5F5F5',
        toolbar: [{
                name: 'various',
                items: ['Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'Subscript', 'Superscript']
            },

            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'BidiLtr', 'BidiRtl', 'Language']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink']
            },
            {
                name: 'align',
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {
                name: 'insert',
                items: ['Image', 'upload', 'EasyImageUpload', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            {
                name: 'document',
                items: ['PageBreak']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
        ],
    });
</script>
