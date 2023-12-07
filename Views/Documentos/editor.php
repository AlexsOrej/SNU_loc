<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Editor De Documentos
                        <small>Editor de texto diseñado para simplificar la creación de contenido del <?=$_REQUEST['modo']?></small>
                    </h2>
                    <ul class="header-dropdown m-r--5"></ul>
                </div>
                <div class="body">
                    <div class="row">
                    <form name="form_editor" id="form_editor" method="post"  action="?c=documentos&a=Regdocumento" >
                        <div class="col-md-12">
                            <textarea id="ckeditor" name="ckeditor" value="">                              
                                <h3><strong> 1. OBJETIVO</strong></h3>
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                          
                                <h3><strong>2. ALCANCE</strong></h3>
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                          
                                <h3><strong>3. RESPONSABLES</strong></h3>
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                          
                                <h3><strong>4. DEFINICIONES</strong></h3>
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                          
                                <h3><strong>5. ACTIVIDADES</strong></h3>                             
                                <p>Maecenas quis ante ante. Nunc adipiscing rhoncus rutrum. Pellentesque adipiscing urna mi, ut tempus lacus ultrices ac. Pellentesque sodales, libero et mollis interdum, dui odio vestibulum dolor, eu pellentesque nisl nibh quis nunc. Sed porttitor leo adipiscing venenatis vehicula. Aenean quis viverra enim. Praesent porttitor ut ipsum id ornare.</p>
                            </textarea>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" id="ids" name="ids" value="<?php echo $_REQUEST['id_so']?>">
                            <input type="hidden" id="modo" name="modo" value="<?php echo $_REQUEST['modo']?>">                           
                         
                            <button type="submit" class="btn btn-success">crear</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CKEditor -->
</div>
<script>
 $(document).on('click', '#crear', function(e) {     
    var datos = $('#form-aspirante').serialize();        
        $.ajax({
            url: "?c=documentos&a=Regdocumento",
            type: "POST",
            data: datos,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                }, )
                setTimeout(function() {
                    //  window.location = '?c=documentos&a=editor&ids='+numSolicitud+'&modo='+modoTipo;
                    // window.location.reload(1);
                }, 2000)
            }
        });
    });
    var editor = CKEDITOR.replace('ckeditor', {
        readOnly: true
    });
    editor.on('contentDom', function() {
        var editable = editor.editable();
        editable.attachListener(editable, 'click', function(evt) {
            var link = new CKEDITOR.dom.elementPath(evt.data.getTarget(), this).contains('a');
            if (link && evt.data.$.button != 2 && link.isReadOnly()) {
                window.open(link.getAttribute('href'));
            }
        }, null, null, 15);
    });
</script>
