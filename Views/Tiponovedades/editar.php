<form id="form_tipo" class="form_tipo" method="POST">
    <div class="form-group">
        <div class="form-line">
            <label for="">Novedad</label>
            <input name="id" id="id" value="<?= $tipo->id ?>" type="hidden" class="form-control" placeholder="" />
            <input name="evento" id="evento" value="<?= $tipo->evento ?>" type="text" class="form-control" placeholder="" />
        </div>
    </div>
    <div class="form-group">
        <div class="form-line">
            <label for="">Tipo</label>          
            <select name="tipo" id="tipo"  value="<?= $tipo->tipo ?>" class="form-control">
               <option value=""  <?=$tipo->tipo==0?'selected':'' ?> >Seleccionar</option>
               <option value="1" <?=$tipo->tipo==1?'selected':'' ?> >Novedad</option>
               <option value="2" <?=$tipo->tipo==2?'selected':'' ?> >Ausentismo</option>
            </select>  
        </div>
    </div>
    <div class="col-md-12">
        <button id="botonenviar" type="button" class="btn btn-primary btn-block">Guardar</button>
    </div>
</form>
<script>
      $(document).ready(function() {
            $('#botonenviar').click(function() {
                  if (($('#evento').val() != "")) {
                        var datos = $('#form_tipo').serialize();
                        $.ajax({
                              type: "POST",
                              url: "?c=tiponovedades&a=crud",
                              data: datos,
                              success: function(r) {
                                    if (r == 1) {
                                          alert("Fallo al agregar");
                                    } else {
                                          Swal.fire({
                                                icon: 'success',
                                                title: 'BIEN HECHO!!',
                                                timer: 1500
                                          }, )
                                          setTimeout(function() {
                                                window.location.reload();
                                          }, 2000)
                                    }
                              }
                        });
                  } else {
                        Swal.fire({
                              icon: 'error',
                              title: 'El campo evento es obligatorio',
                              timer: 1500
                        }, )
                  }
                  return false;
            });
});      
</script>