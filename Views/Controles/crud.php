<?php // print_r($_SESSION['user']->FullName); ?>
<div style="border:solid 1px #ECECEC; padding:5%;" class="row clearfix text-center">
            <form id="formCrud" name="formCrud">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nivel->nombre?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Descripcion Control</label>
                            <textarea  rows="1" cols="33" id="descripcion" name="descripcion" value="" class="form-control"><?php echo $nivel->descripcion ?></textarea>
                        </div>
                    </div>
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Diseño</label>
                            <input type="text" id="diseño" name="diseño" value="<?php echo $nivel->nombre?>" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- Menus desplegables -->
                <div class="col-md-6">
                  <label for="opciones">Tipo Control:</label>
                  <select class="form-control show-tick" name="tipo_control" id='tipo_control' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($tipo_control as $data) : ?>
                              <option value="<?php echo $data->id ?>"><?php echo $data->nombre ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div>  
                <div class="col-md-6">
                  <label for="opciones">Tipo Ejecucion:</label>
                  <select class="form-control show-tick" name="tipo_ejecucion" id='tipo_ejecucion' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($tipoEjecucion as $data) : ?>
                              <option value="<?php echo $data->id ?>"><?php echo $data->nombre ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div> 

                <div style="margin-top: 15px; margin-bottom: 15px;" class="col-md-6">
                  <label for="opciones">Frecuencia Ejecucion:</label>
                  <select class="form-control show-tick" name="frecuencia_ejecucion" id='frecuencia_ejecucion' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($frecuenciaEjecucion as $data) : ?>
                              <option value="<?php echo $data->id ?>"><?php echo $data->nombre ?> </option>
                          <?php endforeach; ?>
                  </select>
                </div> 
                <div style="margin-top: 15px; margin-bottom: 15px;" class="col-md-6">
                  <label for="opciones">Proceso</label>
                  <select class="form-control show-tick" name="proceso" id='proceso' required>
                          <option value="">-- Seleccionar --</option>
                          <?php foreach ($procesos as $value) : ?>
                            <option value="<?= $value->id?>"><?= $value->Iniciales.' '.$value->NombreProceso?></option>
                          <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-sm-6" id="responsable"> </div>
                      
                <div class="col-md-12">
                    <input type="hidden" id="documentado" name="documentado" value="<?php echo $_SESSION['user']->FullName?>">
                    <input type="hidden" id="evidencia" name="evidencia" value="<?php //echo $controles->id ?>" class="form-control">
                    <input type="hidden" id="id" name="id" value="<?php //echo $controles->id ?>" class="form-control">
                    <input style="margin-top:30px" type="submit" id="guardar" value="Guardar" class="btn-guardar btn-block">
                </div>
            </form>
        </div>
<script>
    
    $('#proceso').on('change', function() {
        var proceso = document.getElementById("proceso").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=Asignar_responsable',
            data: {
                proceso: proceso
            },
            beforeSend: function() {
                $('#responsable').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#responsable').html(resp);
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
            //var valor = document.getElementById('descripcion').value;
           


            if(nombre == ""){
               $('#nombre').css('border', '2px solid red');
               var isValid = false;
            }
            // if(valor == ""){
            //    $('#descripcion').css('border', '2px solid red');
            //    var isValid = false;
            // }

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
                    url: '?c=controles&a=crud', // Cambia esto por la URL de tu controlador
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Maneja la respuesta aquí
                        console.log(response);
                        Swal.fire({
                            icon: 'success',
                            title: response,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                });
            }
        });
    });

    

</script>