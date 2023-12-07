<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1px;
    }

    .grid-item {
        margin-bottom: 5px;
    }

    .full-width {
        grid-column: span 2;
    }


    .text-justify {
        text-align: justify;
    }

    .form-group textarea {
        width: 100%;
        /* Puedes ajustar el valor según tus necesidades */
        min-height: 100px;
        /* Puedes ajustar el valor según tus necesidades */
        resize: vertical;
        /* Permite redimensionar verticalmente, pero no horizontalmente */
    }
</style>
<div class="card">
    <div class="header">
        <h2>SOLICITUD N° <?php echo $pqrs->radicado ?></h2>
    </div>
    <div class="body">
        <div class="grid-container">
            <div class="grid-item">
                <span>Nombre Completo</span>
                <div class="form-group">
                    <label><?php echo $pqrs->nombres . ' ' . $pqrs->apellidos ?></label>
                </div>
            </div>
            <div class="grid-item">
                <span>Tipo Solicitud</span>
                <div class="form-group">
                    <label><?php echo $pqrs->tipo_peticion ?></label>
                </div>
            </div>
            <div class="grid-item">
                <span>Correo Electrónico</span>
                <div class="form-group">
                    <label><?php echo $pqrs->email ?></label>
                </div>
            </div>
            <div class="grid-item">
                <span>Número de Contacto</span>
                <div class="form-group">
                    <label><?php echo $pqrs->n_contacto ?></label>
                </div>
            </div>
            <div class="grid-item">
                <span>Fecha Registro</span>
                <div class="form-group">
                    <label><?php echo $pqrs->fecha_registro ?></label>
                </div>
            </div>
            <div class="grid-item">
                <span>Estado</span>
                <div class="form-group">
                    <label><?php echo $pqrs->estado ?></label>
                </div>
            </div>
            <div class="grid-item full-width">
                <span>Descripción</span>
                <div class="form-group">
                    <label class="text-justify"><?php echo $pqrs->descripcion ?></label>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="header">
        <h3 class="panel-title">REGISTRAR TRATAMIENTO</h3>
    </div>
    <div class="body">
        <form name="form_respuesta" id="form_respuesta" enctype="multipart/form-data">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Nombres *</label>
                        <input class="form-control show-tick" name="nombres" value="<?php echo $pqrs->nombres ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Apellidos *</label>
                        <input class="form-control show-tick" name="apellidos" value="<?php echo $pqrs->apellidos ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Identficación</label>
                        <input class="form-control show-tick" name="identificacion" value="<?php echo $pqrs->identificacion ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Correo </label>
                        <input class="form-control show-tick" name="email" value="<?php echo $pqrs->email ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Contacto *</label>
                        <input class="form-control show-tick" name="n_contacto" value="<?php echo $pqrs->n_contacto ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Proceso *</label>
                        <select class="form-control show-tick" name="proceso_id" required>
                            <option value="">Seleccionar</option>
                            <?php foreach ($procesos as $proceso) : ?>
                                <option <?= @$respuesta->proceso_id == $proceso->Iniciales ? 'selected' : '' ?> value="<?php echo $proceso->Iniciales ?>"><?php echo $proceso->Iniciales . '-' . $proceso->NombreProceso  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Clasificación *</label>
                        <?php $fecha = date('Y-m-d'); ?>
                        <select class="form-control show-tick" name="clasificacion_id" required>
                            <option value="">Seleccionar</option>
                            <option <?= @$respuesta->clasificacion_id == 'informacion' ? 'selected' : '' ?> value="informacion">Información</option>
                            <option <?= @$respuesta->clasificacion_id == 'soporte' ? 'selected' : '' ?> value="soporte">Soporte</option>
                            <option <?= @$respuesta->clasificacion_id == 'felicitacion' ? 'selected' : '' ?> value="felicitacion">Felicitación</option>
                            <option <?= @$respuesta->clasificacion_id == 'sugerencia' ? 'selected' : '' ?> value="sugerencia">Sugerencia</option>
                            <option <?= @$respuesta->clasificacion_id == 'reclamo' ? 'selected' : '' ?> value="reclamo">Reclamo</option>
                            <option <?= @$respuesta->clasificacion_id == 'queja' ? 'selected' : '' ?> value="queja">Queja</option>
                            <option <?= @$respuesta->clasificacion_id == 'peticion' ? 'selected' : '' ?> value="peticion">Petición</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Segmento</label>
                        <select class="form-control show-tick" name="accion" required>
                            <?php foreach ($segmento as $value) : ?>
                                <option <?= $value->id == $respuesta->accion ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Estado *</label>
                        <select class="form-control show-tick" name="estado" required>
                            <option value="">Seleccionar</option>
                            <!--<option value="abierto">Abierto</option>-->
                            <option value="revision" selected>Revisión</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Respuesta *</label>
                    <div class="form-line">
                        <!-- <textarea name="respuesta" class="form-control" required><?= @$respuesta->respuesta ?></textarea> -->
                        <textarea name="respuesta" id="contenido" class="ckeditor" height="50px" required><?= @$respuesta->respuesta ?></textarea>

                        <input name="pqrs_id" type="hidden" value="<?= $pqrs->id ?>">
                        <input name="respuesta_id" type="hidden" value="<?= $respuesta->id ?>">
                    </div>
                </div>
            </div>
            <input type="submit" id="guardar" value="Guardar" class="btn btn-guardar btn-block">
        </form>
    </div>
</div>
<!-- #END# Input -->
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('#form_respuesta').on('submit', function(e) {
            var editor = CKEDITOR.instances['contenido'].getData();
            e.preventDefault(); // Evitar que el formulario se envíe normalmente
            // var data = $(this).serialize();
            var data = $(this).serialize() + '&respuesta=' + encodeURIComponent(editor);

            $.ajax({
                type: "POST",
                url: "?c=pqrsf&a=AddRespuesta",
                data: data,
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'La respuesta fue registrada',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            //  window.location.reload();
                            cerrarModal()
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'HUBO UN ERROR, POR FAVOR INTENTA DE NUEVO',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        // No es necesario recargar la página en caso de error
                    }
                }
            });
        });
    });

    function cerrarModal() {
        $('#modal-id').modal('hide');
    }
</script>
<script>
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


    var editor = CKEDITOR.replace('contenido', {
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