<div class="card">
    <div class="header">
        <h2>
            Editor De Documentos
            <small>Editor de texto diseñado para simplificar la creación y validación de contenido</small>
        </h2>
        <ul class="header-dropdown m-r--5"></ul>
    </div>
    <div class="body">
        <div class="row">
            <form name="form_editor" id="form_editor" method="post" action="?c=documentos&a=valdoconline">
                <div class="col-md-12">
                    <textarea id="ckeditor" name="ckeditor" value="">
                                <?= $onlinedocs->contenido ?>                             
                    </textarea>
                </div>
                <div class="col-md-12">
                    <input type="hidden" id="id" name="id" value="<?= $onlinedocs->id?>">
                    <input type="hidden" id="id_s" name="id_s" value="<?= $_REQUEST['id']?>">
                    <button type="submit" class="btn btn-success">Validar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- #END# CKEditor -->

</div>
<!-- Ckeditor -->
<!-- <script src="Assets/plugins/ckeditor/ckeditor.js"></script> -->
<!-- Ckeditor -->
<!-- <script src="Assets/js/pages/forms/editors.js"></script> -->
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
    

    var editor = CKEDITOR.replace('ckeditor', {
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