<div class="card">
    <div class="header">Registrar Pqrs</div>
    <div class="body">
        <form method="POST" name="formPqrs" id="formPqrs" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombres</label>
                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Empresa</label>
                            <input type="text" class="form-control" name="empresa" id="empresa" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Correo</label>
                            <input type="text" class="form-control" name="correo" id="correo" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Número de Contacto</label>
                            <input type="text" class="form-control" name="n_contacto" id="n_contacto" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Tipo Solicitud</label>
                            <select name="tipo_peticion" id="tipo_peticion" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option value="informacion">Información</option>
                                <option value="soporte">Soporte</option>
                                <option value="felicitacion">Felicitación</option>
                                <option value="sugerencia">Sugerencia</option>
                                <option value="reclamo">Reclamo</option>
                                <option value="queja">Queja</option>
                                <option value="peticion">Petición</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea id="contenido" class="ckeditor" height="50px" required><?= @$respuesta->respuesta ?></textarea>

                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
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

    $(document).ready(function() {
        $("#formPqrs").submit(function(event) {
            var editor = CKEDITOR.instances['contenido'].getData();
            event.preventDefault(); // Evitar que el formulario se envíe normalmente            
            var formData = $(this).serialize() + '&descripcion=' + encodeURIComponent(editor);
            $.ajax({
                data: formData,
                type: "post",
                url: "?c=pqrsf&a=addpqrs",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        text: response,
                        timer: 3000
                    });
                    setTimeout(function() {
                        window.location.href="?c=pqrsf&a=index";                        
                    }, 3000)
                }
            });
        });
    });
</script>