<?php // print_r($impactos); ?>

<div  style="border:solid 1px #ECECEC; padding:3%;" class="row clearfix text-center">
            <form style="padding:5%;" id="formCrud" name="formCrud" class="border">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre Riesgo</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nivel->nombre?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Descripcion Riesgo</label>
                            <textarea  rows="1" cols="33" id="descripcion" name="descripcion" value="" class="form-control"><?php echo $nivel->descripcion ?></textarea>
                        </div>
                    </div>
                </div>   
                 
                <div class="col-md-6">
                  <label for="opciones">Impacto:</label>
                  <select class="form-control show-tick" name="impacto" id='impacto' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($impactos as $data) : ?>
                              <option value="<?php echo $data->id ?>"><?php echo $data->valor." | ".$data->nombre ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div>  
                <div class="col-md-6">
                  <label for="opciones">Probabilidad:</label>
                  <select class="form-control show-tick" name="probabilidad" id='probabilidad' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($probabilidad as $sgc) : ?>
                              <option value="<?php echo $sgc->id ?>"><?php echo $sgc->valor." | ".$sgc->nombre ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div>  
                <div class="col-md-6">
                <label>Clasificacion</label>
                      <select class="form-control show-tick" name="clasificacion" id='clasificacion' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($clasificacion as $sgc) : ?>
                              <option value="<?php echo $sgc->id ?>"><?php echo $sgc->nombre?> </option>
                          <?php endforeach; ?>
                      </select>
                </div>
                <div style="margin-bottom: 100px;" class="col-md-6">
                  <label for="opciones">Proceso:</label>
                  <select class="form-control show-tick" name="proceso" id='proceso' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($procesos as $sgc) : ?>
                              <option value="<?php echo $sgc->id ?>"><?php echo $sgc->Iniciales." | ". $sgc->NombreProceso ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div>  
                <div style="margin-bottom: 15px;" class="col-md-6">
                  <label for="opciones">Tiene control?</label>
                  <select class="form-control show-tick" name="control" id='control' required>
                              <option value="">-- Seleccionar --</option>
                              <option value="si">Si</option>
                              <option value="no">No</option>
                  </select>
                </div>  

                <div class="" id="controles"></div>
               
     
                <div class="col-md-12">
                    <input type="hidden" id="id" name="id" value="<?php echo $nivel->id ?>" class="form-control">
                    <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['user']->FullName ?>" class="form-control">
                    <input style="margin-top: 50px;" type="submit" id="guardar" value="Guardar" class="btn-guardar btn-block">
                </div>
            </form>
        </div>
<script>
    
   
    $('#control').on('change', function() {
        var control = document.getElementById("control").value
        
        $.ajax({
            type: "POST",
            url: '?c=controles&a=mostrarControles',
            data: {
                control: control
            },
            beforeSend: function() {
                $('#controles').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#controles').html(resp);
            }
        });
    });                        
    $(document).ready(function() {
       
        $('#formCrud').submit(function(e) {
            //alert("se ejecuta")
            e.preventDefault();
            var form = $(this);
            var isValid = true;

            var nombre = document.getElementById('nombre').value;
            var descripcion = document.getElementById('descripcion').value;
            var impacto = document.getElementById('impacto').value;

           


            if(nombre == ""){
               $('#nombre').css('border', '2px solid red');
               var isValid = false;
            }
            if(descripcion == ""){
               $('#descripcion').css('border', '2px solid red');
               var isValid = false;
            }
            if(impacto == ""){
               $('#impacto').css('border', '2px solid red');
               var isValid = false;
            }

            // Verificar si hay campos vacíos
            form.find(':input.required').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // Romper el bucle si se encuentra un campo vacío
                }
            });

            // Si algún campo está vacío, muestra un mensaje de error
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, completa todos los campos del formulario.',
                });
            } else {
                // Si no hay campos vacíos, enviar el formulario con AJAX
                $.ajax({
                    url: '?c=riesgos&a=crud', // Cambia esto por la URL de tu controlador
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Maneja la respuesta aquí
                        Swal.fire({
                            icon: 'success',
                            title: response,
                            //timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            //window.location.reload();
                        }, 1500);
                    }
                });
            }
        });
    });

    

</script>