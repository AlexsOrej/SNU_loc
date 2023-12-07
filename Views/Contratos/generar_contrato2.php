   <style>
     body {
       font-family: Arial, sans-serif;
     }

     header {
       text-align: center;
       margin-bottom: 20px;
       display: flex;
       align-items: center;
       justify-content: center;
     }

     header img {
       max-width: 100px;
       margin-right: 10px;
     }

     .company-name {
       font-size: 24px;
       font-weight: bold;
     }

     .document-title {
       text-align: center;
       font-size: 28px;
       font-weight: bold;
       margin: 20px 0;
     }

     .contract-content {
       margin: 20px;
       background-color: #fff;
     }

     p {
       text-align: justify;
       text-transform: lowercase;
     }

     .signature {
       display: flex;
       justify-content: space-between;
     }

     .signature-section {
       flex-basis: 48%;
       /* Distribuye las secciones en un ancho del 48% cada una */
     }

     .signature-container {
       /* border: 1px solid #ccc; */
       padding: 10px;
       margin-bottom: 10px;
     }

     .signature-buttons {
       display: flex;
       justify-content: flex-start;
       margin-left: 5px;
     }

     #signatureContratante,
     #signatureContratado {
       border: 1px solid #ccc;
     }

     .section {
       border: 1px solid #ccc;
       padding: 20px;
       margin-bottom: 20px;
       background-color: #fff;
     }

     .section-title {
       font-size: 18px;
       font-weight: bold;
       margin-bottom: 10px;
     }

     .data-item {
       display: flex;
       margin-bottom: 10px;
     }

     .data-label {
       flex-basis: 40%;
       font-weight: bold;
     }

     .data-value {
       flex-basis: 60%;
     }
   </style>
   <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
   <?
    $firmaempleador =  $this->model->FirmaContrato($_REQUEST['id'], "contratante");
    $firmaempleado =  $this->model->FirmaContrato($_REQUEST['id'], "contratado");
    ?>

   <body >
     <?php
      // echo '<pre>';
      // print_r($datos);
      // // print_r($_SESSION['datos_cliente']);
      // echo '</pre>';
      ?>
     <div class="section" id="contrato">
       <button id="boton-imprimir">
         <span class="material-icons">
           local_printshop
         </span>
       </button>
       
        <div  class="cabecera" >
                <header >
                  <img class="logo_empresa" src="Assets/img/uploads/colegio/<?= $_SESSION['datos_cliente']->filename ?>" alt="Logo de la Compañía">
                  <div class="company-name"><?= $_SESSION['datos_cliente']->nombre ?></div>
                </header>
                <div class="document-title"><?= $datos->contrato ?></div>
                <hr>
                <div class="section-title">DATOS DEL CONTRATANTE:</div>
                <div class="data-item">
                  <div class="data-label">NOMBRE DEL EMPLEADOR:</div>
                  <div class="data-value"><?= $_SESSION['datos_cliente']->nombre ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">NIT:</div>
                  <div class="data-value"><?= $_SESSION['datos_cliente']->telefono ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">CORREO:</div>
                  <div class="data-value"><?= $_SESSION['datos_cliente']->correos ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">DOMICILIO:</div>
                  <div class="data-value"><?= $_SESSION['datos_cliente']->direccion ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">NOMBRE DEL AUTORIZADO:</div>
                  <div class="data-value"><?= $datos->encargadofirma ?></div>
                </div>
              
          
                <div class="section" id="contrato1">
                  <div class="section-title">DATOS DEL CONTRATADO:</div>
                  <div class="data-item">
                    <div class="data-label">NOMBRES y APELLIDOS:</div>
                    <div class="data-value"><?= $datos->nombre . ' ' . $datos->apellidos ?></div>
                  </div>
                  <div class="data-item">
                    <div class="data-label">DOMICILIO:</div>
                    <div class="data-value"><?= $datos->direccion ?></div>
                  </div>
                  <div class="data-item">
                    <div class="data-label">TELÉFONO FIJO – CELULAR :</div>
                    <div class="data-value"><?= $datos->celular ?></div>
                  </div>
                  <div class="data-item">
                    <div class="data-label">CORREO</div>
                    <div class="data-value"><?= $datos->correo ?></div>
                  </div>
                  <div class="data-item">
                    <div class="data-label">DOCUMENTO IDENTIDAD:</div>
                    <div class="data-value"><?= $datos->cedula ?></div>
                  </div>
                  <div class="data-item">
                    <div class="data-label">LUGAR Y FECHA DE NACIMIENTO:</div>
                    <div class="data-value"><?= $datos->LugarNacimiento . '/' . $datos->FechaNacimiento ?></div>
                  </div>
                </div>
             
              <div class="section" id="contrato2">
                <div class="section-title">DATOS DEL CONTRATO:</div>
                <div class="data-item">
                  <div class="data-label">TIPO DE CONTRATO:</div>
                  <div class="data-value"><?= $datos->cedula ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">CARGO A DESARROLLAR:</div>
                  <div class="data-value"><?= $datos->cargo ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">FECHA DE INICIO:</div>
                  <div class="data-value"><?= $datos->inicio_contrato ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">FECHA TERMINACIÓN:</div>
                  <div class="data-value"><?= $datos->duracion ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">LUGAR DE LAS ACTIVIDADES:</div>
                  <div class="data-value"><?= $datos->lugar ?></div>
                </div>
                <div class="data-item">
                  <div class="data-label">SALARIO MENSUAL:</div>
                  <div class="data-value"><?= $datos->valor ?></div>
                </div>
   
      
      
      
      
      
      
      
      
      <div class="cabecera">
              <div class="section" id="contrato3">
                        <div class="contract-content">
                          <p><?= $datos->contenido ?></p>
                          <div class="signature">
                            <? if ($firmaempleador == "") : ?>
                              <div class="signature-section">
                                <div class="signature-container">
                                  <canvas id="signatureContratante"></canvas>
                                </div>
                                <div class="data-label">
                                  <?= ucwords($datos->patron) ?><br>
                                  CC.<?= $datos->cc ?><br>
                                  <?= $_SESSION['datos_cliente']->nombre ?>
                                </div>
                                <div class="signature-buttons">
                                  <button id="saveContratante" class="btn btn-default"> Guardar</button>
                                  <button id="clearContratante" class="btn btn-default"> Borrar</button>
                                </div>
                              </div>
                            <? else : ?>
                              <div class="signature-section">
                                <div class="signature-container">
                                  <img src="Assets/firmas/<?= $firmaempleador->imgfirma ?>" alt="firma del contratante">
                                </div>
                                <div class="data-label">
                                  <?= ucwords($datos->patron) ?><br>
                                  CC.<?= $datos->cc ?><br>
                                  <?= $_SESSION['datos_cliente']->nombre ?><br>
                                  <?= $firmaempleador->fechafirma ?>
                                </div>
                              </div>
                            <? endif; ?>
                            <? if ($firmaempleado == "") : ?>
                              <div class="signature-section">
                                <div class="signature-container">
                                  <canvas id="signatureContratado"></canvas>
                                </div>
                                <div class="data-label"><?php
                                                          $nombreCompleto = ucwords($datos->nombre . ' ' . $datos->apellidos);
                                                          echo $nombreCompleto ?><br> CC.<?= $datos->cedula ?></div>
                                <div class="signature-buttons">
                                  <button id="saveContratado" class="btn btn-default">Guardar</button>
                                  <button id="clearContratado" class="btn btn-default">Borrar</button>
                                </div>
                              </div>
                            <? else : ?>
                              <div class="signature-section">
                                <div class="signature-container">
                                  <img class="firma" src="Assets/firmas/<?= $firmaempleado->imgfirma ?>" alt="firma del contratante"><br>

                                </div>
                                <div class="data-label"><?php
                                                          $nombreCompleto = ucwords($datos->nombre . ' ' . $datos->apellidos);
                                                          echo $nombreCompleto ?><br> CC.<?= $datos->cedula ?><br>
                                  <?= $firmaempleado->fechafirma ?>
                                </div>
                              </div>
                            <? endif; ?>

                          </div>
                        </div>
                  </div>
        </div>
          
   </body>

   </html>
   <? if ($firmaempleador == "") : ?>
     <script>
       var signaturePadContratante = new SignaturePad(document.getElementById('signatureContratante'));
       var clearContratanteButton = document.getElementById('clearContratante');
       clearContratanteButton.addEventListener('click', function() {
         signaturePadContratante.clear();
       });
       document.getElementById('saveContratante').addEventListener('click', function() {
         var signatureData = signaturePadContratante.toDataURL(); // Obtener la firma en formato de imagen base64
         saveSignatureToServer(signatureData, 'contratante');
       });
     </script>

   <? endif; ?>
   <? if ($firmaempleado == "") : ?>
     <script>
       var signaturePadContratado = new SignaturePad(document.getElementById('signatureContratado'));
       var clearContratadoButton = document.getElementById('clearContratado');
       clearContratadoButton.addEventListener('click', function() {
         signaturePadContratado.clear();
       });

       document.getElementById('saveContratado').addEventListener('click', function() {
         var signatureData = signaturePadContratado.toDataURL(); // Obtener la firma en formato de imagen base64
         saveSignatureToServer(signatureData, 'contratado');
       });
     </script>
   <? endif; ?>


   <script>


        // document.getElementById("boton-imprimir").addEventListener("click", function() {
        // var contenido = document.getElementById("contrato").innerHTML;
        // var contenido1 = document.getElementById("contrato1").innerHTML;
        // var contenido2 = document.getElementById("contrato2").innerHTML;
        // var contenido3 = document.getElementById("contrato3").innerHTML;
          
        // // Añadir CSS personalizado
        // var css = "<style>.cabecera{vertical-align: middle;text-align: center;}</style>";

        // var ventanaImpresion = window.open("", "_blank");
        // ventanaImpresion.document.write("<html><head><title>Impresión</title>" + css + "</head><body>" + contenido + contenido1 + contencio2 + contenido3 + "</body></html>");
        // ventanaImpresion.document.close();
        // ventanaImpresion.print();
        // });


     document.getElementById("boton-imprimir").addEventListener("click", function() {
       var contenido = document.getElementById("contrato").innerHTML;
       var contenido1 = document.getElementById("contrato1").innerHTML;
       var contenido2 = document.getElementById("contrato2").innerHTML;
       var contenido3 = document.getElementById("contrato3").innerHTML;
       var ventanaImpresion = window.open("", "_blank");
       var bootstrap ="<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>";
       
       
       var css ="<style>.cabecera{padding:5%; text-align: justify;} .signature-section{width:50%; float:left} .logo_empresa{width: 15% ;} </style>"
       ventanaImpresion.document.write("<html><head><title>Impresión</title>"+bootstrap+css+"</head><body>" + contenido + contenido1 + contenido2 + contenido3 + "</body></html>");
       ventanaImpresion.document.close();
       ventanaImpresion.print();
     });



     function saveSignatureToServer(data, type) {
       var contrato_id = "<?= $_REQUEST['id'] ?>";

       fetch('?c=contratacion&a=guardarfirma', {
         method: 'POST',
         body: JSON.stringify({
           contrato_id: contrato_id,
           signatureData: data,
           type: type
         }),
         headers: {
           'Content-Type': 'application/json'
         }
       }).then(response => {
         if (response.ok) {
           //  console.log('Firma guardada correctamente');
           Swal.fire({
             icon: 'success',
             title: 'Firma guardada correctamente',
             timer: 1500,
             showConfirmButton: false,
           }, )
           setTimeout(function() {
             window.location.reload();
           }, 1500)
           return response.json(); // Parsea la respuesta como JSON
         } else {
           console.error('Error al guardar la firma');
         }
       }).then(data => {
         // Aquí puedes mostrar el preview o hacer algo con la respuesta JSON
         console.log('Respuesta del servidor:', data);

       }).catch(error => {
         console.error('Ocurrió un error:', error);
       });
     }
   </script>