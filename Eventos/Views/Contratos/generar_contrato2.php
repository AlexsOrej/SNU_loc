   <!DOCTYPE html>
   <html lang="es">

   <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Contratación</title>
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
   </head>
   <?php
    $firmaempleador =  $this->model->FirmaContrato($_REQUEST['id'], "contratante");
    $firmaempleado =  $this->model->FirmaContrato($_REQUEST['id'], "contratado");
    ?>

   <body>

     <?php
      //print_r($datos);
      if (isset($_POST['userInput']) && ($_POST['userInput'] == $datos->cc or $_POST['userInput'] == $datos->cedula)) : ?>
       <div class="section" id="contrato">
         <header>
           <img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/<?= $cliente->filename ?>" alt="Logo de la Compañía">
           <div class="company-name"><?= $cliente->nombre ?></div>
         </header>
         <div class="document-title"><?php echo $datos->contrato ?></div>
         <hr>
         <div class="section-title">DATOS DEL CONTRATANTE:</div>
         <div class="data-item">
           <div class="data-label">NOMBRE DEL EMPLEADOR:</div>
           <div class="data-value"><?= $cliente->nombre ?></div>
         </div>
         <div class="data-item">
           <div class="data-label">NIT:</div>
           <div class="data-value"><?= $cliente->telefono ?></div>
         </div>
         <div class="data-item">
           <div class="data-label">CORREO:</div>
           <div class="data-value"><?= $cliente->correos ?></div>
         </div>
         <div class="data-item">
           <div class="data-label">DOMICILIO:</div>
           <div class="data-value"><?= $cliente->direccion ?></div>
         </div>
         <div class="data-item">
           <div class="data-label">NOMBRE DEL AUTORIZADO:</div>
           <div class="data-value"><?= $datos->encargadofirma ?></div>
         </div>
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
       </div>
       <div class="section" id="contrato3">
         <div class="contract-content">
           <p><?= $datos->contenido; ?></p>
           <div class="signature">
             <?php
              // if (($firmaempleador == "") && ($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['userInput'] == $datos->cc)) {
              //     // Aquí puedes agregar el código para eliminar el contenido de $_POST si es necesario
              //     foreach ($_POST as $key => $value) {
              //         $_POST[$key] = '';
              //     }
              // }
              ?>

             <div class="signature-section">
               <?php if (($firmaempleador == "") && ($_POST['userInput'] == $datos->cc)) : ?>
                 <div class="signature-container">
                   <canvas id="signatureContratante"></canvas>
                 </div>
                 <div class="data-label">
                   <?= ucwords($datos->patron) ?><br>
                   CC.<?= $datos->cc ?><br>
                   <?= $cliente->nombre ?>
                 </div>
                 <div class="signature-buttons">
                   <button id="saveContratante" class="btn btn-default">Guardar</button>
                   <button id="clearContratante" class="btn btn-default">Borrar</button>
                 </div>
               <?php else : ?>
                 <?php if (($_POST['userInput'] == $datos->cc)) : ?>
                   <div class="signature-container">
                     <img src="https://calidadsnu.com/snu/Assets/firmas/<?= $firmaempleador->imgfirma ?>" alt="firma del contratante">
                   </div>
                   <div class="data-label">
                     <?= ucwords($datos->patron) ?><br>
                     CC.<?= $datos->cc ?><br>
                     <?= $cliente->nombre ?><br>
                     <?= $firmaempleador->fechafirma ?>
                   </div>
                 <?php endif; ?>
               <?php endif; ?>
             </div>
             <? if ($firmaempleado == "" && $_POST['userInput'] == $datos->cedula) : ?>
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
               <?php if (($_POST['userInput'] == $datos->cedula)) : ?>
                 <div class="signature-section">
                   <div class="signature-container">
                     <img src="https://calidadsnu.com/snu/Assets/firmas/<?= $firmaempleado->imgfirma ?>" alt="firma del contratado"><br>
                   </div>
                   <div class="data-label"><?php
                                            $nombreCompleto = ucwords($datos->nombre . ' ' . $datos->apellidos);
                                            echo $nombreCompleto ?><br> CC.<?= $datos->cedula ?><br>
                     <?= $firmaempleado->fechafirma ?>
                   </div>
                 </div>
               <? endif; ?>
             <? endif; ?>
           </div>
         </div>
       </div>
     <?php else : ?>
       <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
       <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <!------ Include the above in your HEAD tag ---------->

       <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

       <body>
         <div class="container">
           <div class="col-md-6 mx-auto text-center">
             <div class="header-title">
               <h1 class="wv-heading--title">
                 Bienvenid@
               </h1>
               <h3 class="wv-heading--subtitle">
                 Por favor digita tu documento identidad para continuar
               </h3>
             </div>
           </div>
           <div class="row">
             <div class="col-md-4 mx-auto">
               <div class="myform form ">
                 <form action="#" method="post" name="login">
                   <div class="form-group">
                     <input type="number" min="0" name="userInput" id="userInput" class="form-control my-input" placeholder="Identificación">
                   </div>
                   <div class="text-center ">
                     <button type="submit" class=" btn btn-block send-button tx-tfm">Continuar</button>
                     <h6><strong>SNU</strong></h6>
                   </div>
                 </form>
               </div>
             </div>
           </div>
         </div>
       </body>
     <?php endif; ?>

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
     function saveSignatureToServer(data, type) {
       var contrato_id = "<?= $_REQUEST['id'] ?>";
       var cliente = "<?= $_REQUEST['cliente'] ?>";
       fetch('?c=contratacion&a=guardarfirma&cliente=' + cliente, {
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
             text: 'El contrato fue firmado con éxito',
             timer: 1500,
             showConfirmButton: false,
           }, )
           setTimeout(function() {
            window.location.href = 'https://calidadsnu.com/';
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