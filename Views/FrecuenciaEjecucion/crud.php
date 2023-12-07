<?php //print_r($tipo); ?>
<div class="row clearfix text-center">
            <form id="formCrud" name="formCrud">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $frec->nombre?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Descripcion</label>
                            <input type="text" id="descripcion" name="descripcion" value="<?php echo $frec->descripcion ?>" class="form-control">
                        </div>
                    </div>
                </div>        
               
                <div class="col-md-12">
                    <input type="hidden" id="id" name="id" value="<?php echo $frec->id ?>" class="form-control">
                    <input type="submit" id="guardar" value="Guardar" class="btn-guardar btn-block">
                </div>
            </form>
        </div>
<script>
    
   

    $(document).ready(function() {
       
        $('#formCrud').submit(function(e) {
            //alert("se ejecuta")
            e.preventDefault();
            var form = $(this);
            var isValid = true;

            var nombre = document.getElementById('nombre').value;
            var valor = document.getElementById('descripcion').value;
           
            if(nombre == ""){
               $('#nombre').css('border', '2px solid red');
               var isValid = false;
            }
            if(valor == ""){
               $('#descripcion').css('border', '2px solid red');
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
                    url: '?c=frecuenciaejecucion&a=crud', // Cambia esto por la URL de tu controlador
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