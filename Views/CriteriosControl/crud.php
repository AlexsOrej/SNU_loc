<?php //print_r($probabilidad); ?>
<?php
$total = 0; 
foreach ($criterio as $value) :
        $total = $value->valor + $total;                      
endforeach; ?>
<div class="row clearfix text-center">
            <form id="formCrud" name="formCrud">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nivel->nombre?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="">Valor</label>
                            <input type="text" id="valor" name="valor" value="<?php echo $nivel->valor ?>" class="form-control">
                        </div>
                    </div>
                </div>        
                
                <div class="col-md-12">
                    <input type="hidden" id="id" name="id" value="<?php echo $nivel->id ?>" class="form-control">
                    <input type="hidden" id="total" name="total" value="<?php echo $total?>" class="form-control">
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
           var valor = document.getElementById('valor').value;
           var total = document.getElementById('total').value;
           var totalGeneral = parseInt(valor)+parseInt(total);
          
           console.log(totalGeneral);

           if(nombre == ""){
              $('#nombre').css('border', '2px solid red');
              var isValid = false;
           }
           if(valor == ""){
              $('#valor').css('border', '2px solid red');
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
               if(totalGeneral > 100){
                var diferencia = 100 - parseInt(totalGeneral);
                //alert("la suma del criterio "+valor+"% sobrepasa el limite por "+ diferencia+" que debe ser igual a 100%");
                Swal.fire({
                   icon: 'error',
                   title: "la suma del criterio "+valor+"% sobrepasa el limite por "+ diferencia+" que debe ser igual a 100%",
               });
                } else{
                    $.ajax({
                   url: '?c=criterioscontrol&a=crud', // Cambia esto por la URL de tu controlador
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
                          // window.location.reload();
                       }, 1500);
                   }
                });
                }
              
           }
       });
   });
  

    

</script>