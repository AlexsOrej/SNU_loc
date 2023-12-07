<?php //print_r($comprobar); ?>
<div class="row">
    <form action="" id="form_tipo" name="form_tipo" enctype="multipart/form-data">
        <div class="col-md-12 text-center">
            <label class="form-check-label">Tipo de Contrato</label>
            <input class="form-control" type="text" name="tipo" id="tipo" value="<?= $tipo->nombre ?>">
            <div id="val"></div>
        </div>
        <?php
      
            if($comprobar['contratos'] >= 1  && $tipo->contenido != null){ 
        ?>
        <div class="col-md-12">
            <p style="color:#EB2A2A; padding: 3%;"><span class="badge" style="background-color: #EB2A2A;"> Aviso: </span> El contrato tiene un trabajador asociado, no lo puede modificar </p>
        </div>
        <?php }else{?>
        <div class="col-md-12 text-center">
            <br>
            <label class="form-check-label mt-5">Contenido Contrato</label> 
            <textarea name="contenido" id="contenido" class="ckeditor"><?= $tipo->contenido ?></textarea>
            <div id="val"></div>
        </div>
        <?php } ?>
        <div class="col-md-12 text-center"><br>
            <input class="" type="hidden" name="id" id="id" value="<?= $tipo->id ?>">
            <input class="btn-guardar btn-block" type="button" name="guardar" id="guardar" value="Guardar">
        </div>
    </form>

</div>
<script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
<script>
    // function cargarTexto(){
    //     var text = document.getElementById('texto').value;
    //     alert(text)
    //     CKEDITOR.instances['contenido'].setData( text );
    // }

    $(document).on('click', '#guardar', function(e) {
        var tipo = document.getElementById('tipo').value;
        var id = document.getElementById('id').value;
        var editor = CKEDITOR.instances['contenido'].getData(); 
       //alert(tipo);

        if ($('#tipo').val() == '') {
            $('#val').html("<i class='text-danger'>Escriba el tipo de contrato\n</i>");
        } else {
            //var data = $("#form_tipo").serialize();
            var data = {
                tipo: tipo,
                id: id,
                contenido: editor
            };
            $.ajax({
                data: data,
                type: "post",
                url: "?c=tipocontratos&a=Crud",
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'BIEN HECHO!!',
                        timer: 1500
                    }, )
                    setTimeout(function() {
                        window.location.reload();
                    }, 1501)
                }
            })
        }
    });
   
   
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












