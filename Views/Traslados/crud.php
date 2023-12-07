<div class="panel panel-success" >    
          <div class="panel-heading">
                <h3 class="panel-title">Selecionar la nueva ubicación</h3>
          </div>
          <div class="panel-body">            
 <div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Sede</label>
                <select class="form-control" id="sede_id1" name="sede_id1">
                <option value="">Seleccionar</option>
                    <?php foreach ($sede as $value) : ?>
                        <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div  class="col-md-6">
        <div class="form-group form-float">
                    <label for="">Elegir la Nueva Ubicación</label>
                    <div class="form-line" id="ubicacion1">
                    </div>
                </div>
        </div>
        <div class="col-md-12"><label for="">Observación</label>
            <div class="form-group">                
                 <textarea name="observacion" id="observacion" rows="5" cols="80"  ></textarea>
              </div>
        </div> 
        <div class="col-md-12">
        <input type="hidden" id="id" name="id" value="" class="form-control">           
            <input type="hidden" id="producto_id" name="producto_id" value="<?php echo $_REQUEST['producto_id'] ?>" class="form-control">
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d') ?>" class="form-control">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['rol_id'] ?>" class="form-control">
            <input type="button" id="guardar" value="Guardar" class="btn btn-guardar btn-block">
        </div>
    </form>
</div>
</div>

          </div>
    </div>

<script>
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formCrud").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=traslados&a=Registrar",
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 2000
                }, )
                setTimeout(function() {
                //    $("#contenedor").load(" #contenedor");
                }, 2000)
            }

        })
    });

    $('#sede_id1').on('change', function() {
        var id = document.getElementById("sede_id1").value
        $.ajax({
            type: "POST",
            url: '?c=ubicaciones&a=descripcion',
            data: {
                sede_id: id
            },
            beforeSend: function(resp) {
                $('#ubicacion1').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#ubicacion1').html(resp);
                $('#respuesta').html("");
            }
        });
    });


</script>