<?php
$cliente = $_SESSION['datos_cliente']->nombre;
//print_r($_SESSION['datos_cliente']);
$email = new NotificacionesController();
$fecha_actual = $datos->inicio_contrato;
$datos->duracion;
$tiempo = explode(" ", $datos->duracion);
$correo = explode("~", $_SESSION['datos_cliente']->correos);
$targetDir = "Assets/img/" . $_SESSION['datos_cliente']->nombre . "/contratos/" . $datos->nombre . '_' . $datos->apellidos . '_' . $datos->cedula . '_' . $_REQUEST['id'] . ".pdf";
//sumo 1 mes
$terminacion = date("Y-m-d", strtotime($fecha_actual . "+" . "$tiempo[0]" . "month"));
$disable = '0';
$imagenBase2 = '';
$firmaButton = '';
$id = $_REQUEST['id'];
/*logo*/
$logo = "Assets/img/uploads/colegio/" . $_SESSION['datos_cliente']->filename;
$imagenlogo = "data:image/png;base64," . base64_encode(file_get_contents($logo));
/*logo*/
$firma1 = "Assets/firmas/firmaEmpresa.png";
$imagenBase1 = "data:image/png;base64," . base64_encode(file_get_contents($firma1));

$firma2 = "Assets/firmas/" . @$firma->imgfirma;
@$imagenBase2 = "data:image/png;base64," . base64_encode(file_get_contents($firma2));
file_exists($firma2) and is_file($firma2) ? $disable = "disabled" : $disable = "";

if (file_exists($firma2) and is_file($firma2)) {
  if ($datos->manual == "SI") {
    $manual = '<a href="https://calidadsnu.com/snu/Assets/Perfiles/CALIDAD SNU (PRUEBAS)/' . $datos->cargo . '" style="text-decoration:none;">Clic para ver el manual de funciones</a>';
  } else {
    $manual = '';
  }
  if ($datos->notiContrato == "SI") {
    $contrato = '<a href="https://calidadsnu.com/snu/' . $targetDir . '" style="text-decoration:none;">Clic para ver Contrato</a></p>
    ';
  } else {
    $contrato = '';
  }
  if ($datos->manual == "SI" or $datos->notiContrato == "SI") {
    $asunto = "BIENVENIDO A " . $_SESSION['datos_cliente']->nombre;
    $cuerpo = '<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="x-apple-disable-message-reformatting">
      <title></title>
      <!--[if mso]>
      <style>
        table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
        div, td {padding:0;}
        div {margin:0 !important;}
      </style>
      <noscript>
        <xml>
          <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
      </noscript>
      <![endif]-->
      <style>
        table, td, div, h1, p {
          font-family: Arial, sans-serif;
        }
        @media screen and (max-width: 530px) {
          .unsub {
            display: block;
            padding: 8px;
            margin-top: 14px;
            border-radius: 6px;
            background-color: #555555;
            text-decoration: none !important;
            font-weight: bold;
          }
          .col-lge {
            max-width: 100% !important;
          }
        }
        @media screen and (min-width: 531px) {
          .col-sml {
            max-width: 27% !important;
          }
          .col-lge {
            max-width: 73% !important;
          }
        }
      </style>
    </head>
    <body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
      <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#939297;">
        <table role="presentation" style="width:100%;border:none;border-spacing:0;">
          <tr>
            <td align="center" style="padding:0;">
              <!--[if mso]>
              <table role="presentation" align="center" style="width:600px;">
              <tr>
              <td>
              <![endif]-->
              <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                <tr>
                  <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                    <a href="http://www.example.com/" style="text-decoration:none;"><img src="https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $_SESSION["datos_cliente"]->filename . '" width="165" alt="Logo" style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                  </td>
                </tr>
                <tr>
                  <td style="padding:30px;background-color:#ffffff;">
                    <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">BIENVENID@ A  '  .  $_SESSION['datos_cliente']->nombre . ' </h1>
                    <p style="margin:0;">¡Felicitaciones por tu incorporación a la empresa!<br> Estamos muy emocionados porque formes parte de nuestro equipo y colabores con nuestro crecimiento.<br>
                    ' . $manual . '</p>
                    ' . $contrato . '
             
                    </td>
                </tr>                              
                <tr>
                  <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                  <p style="margin:0;font-size:14px;line-height:20px;">&reg; snu, 2022<br></p>
                  </td>
                </tr>
              </table>
              <!--[if mso]>
              </td>
              </tr>
              </table>
              <![endif]-->
            </td>
          </tr>
        </table>
      </div>
    </body>
    </html>';
    try {
      if ($email->Notificar($asunto, $cuerpo, $datos->correo)) {
        echo 'Mensaje fue enviado con la info del manual';
      }
    } catch (Exception $e) {
      "Message could not be sent. Mailer Error: {}";
    }
  }
} else {

  $firmaButton = '<a href="?c=contratacion&a=firmar&id=' . $id . '" class="neu">Firmar</a>';
}
?>
<div class="col-md-12">
  <br>
  <?= $firmaButton ?>
  <a href="?c=contratacion&a=exportar&id=<?= $_REQUEST['id'] ?>" class="neu" <?= $disable ?>>Exportar</a>
</div>
<div style="background-color:white">
  <?php
echo $parte0 = "    
<style>
.page-break{
    page-break-after:always;
}
table, th, td, tr {    
    text-align:center;
   
  }
  .border{
    border: 1px solid black;
    border-collapse: collapse;
  }
  .noborder{
    border: 0px solid black;
    border-collapse: collapse;
  }
  div{
    align:justify
  }  
  .parrafo {
    padding-top: 10px;
    padding-right: 25px;
    border-left-width: 15px;
    padding-left: 20px;
    text-align:justify
}
// .pagenum:before {
//     content: counter(page);
// }
</style>
<body>
<br><br><br>
<table class='border' align='center'>
<tr>
    <th colspan='' class='border text-center'>
        <div class='row'>
              <div class='col-md-2'>
                  <p>
                    <img src='" . $imagenlogo . "' width='80%' height='auto' alt='User' />
                  </p>
              </div>
    </th>
    <th colspan='' class='border'>
              <div class='col-md-10 > 
              <p class='text-center'>" . strtoupper($datos->contrato) . "</p>          
              </div>         
    </th>
</tr> 
    <tr>   
   <td colspan='2' align='center'><br><strong>DATOS DEL CONTRATANTE:<strong></td>
    </tr> 
    <tr class='border'>
        <td class='border'>
       <strong> NOMBRE DEL EMPLEADOR: <br></strong>" . $_SESSION['datos_cliente']->nombre . "
        </td>
        <td class='border'><strong>NIT:<br></strong> " . $_SESSION['datos_cliente']->telefono . "
        </td>
    </tr>    
    <tr class='border'>
        <td class='border'>
        <strong>CORREO:</strong> <br>" . $correo[0] . "
        </td>
        <td class='border'><strong>DOMICILIO:<br> </strong>" . $_SESSION['datos_cliente']->direccion . "
        </td>
    </tr>    
    <tr class='border'>
        <td class='border'>
        <strong> NOMBRE DEL AUTORIZADO:<br> </strong>
             " . $_SESSION['datos_cliente']->rector . "
        </td>
        <td class='border'><strong>CARGO DEL AUTORIZADO :<br></strong>           
        </td>
    </tr>  
    <tr>
    <td colspan='2' align='center'><br><strong>DATOS DEL CONTRATADO:<strong></td>
    </tr>  
    <tr class='border'>
        <td class='border'><strong>NOMBRES y APELLIDOS:<br> </strong>" . utf8_encode($datos->nombre . ' ' . $datos->apellidos) . " </td>
        <td class='border'><strong>DOMICILIO:</strong> <br>" . utf8_encode($datos->direccion) . "</td>
    </tr>   
    <tr class='border'>
        <td class='border'><strong>TELÉFONO FIJO – CELULAR : </strong><br>" . utf8_encode($datos->celular) . " </td>
        <td class='border'><strong>CORREO </strong><br>" . utf8_encode($datos->correo) . "</td>
    </tr>
    <tr class='border'>
        <td class='border'><strong>DOCUMENTO IDENTIDAD: </strong><br>" . utf8_encode($datos->cedula) . "</td>
        <td class='border'><strong>LUGAR Y FECHA DE NACIMIENTO: </strong><br>" . utf8_encode($datos->LugarNacimiento . ' ' . $datos->FechaNacimiento) . "</td>
    </tr>
    <tr>
    <td colspan='2' align='center'><br><strong>DATOS DEL CONTRATADO:</strong></td>
    </tr>
    <tr class='border' >
        <td class='border' ><strong>TIPO DE CONTRATO:</strong> <br>" . $datos->contrato  . "</td>
        <td class='border' ><strong>CARGO A DESARROLLAR</strong>: <br>" . $datos->cargo . "</td>
    </tr>
    <tr class='border' >       
        <td class='border'><strong>FECHA DE INICIO:</strong><br>" . $datos->inicio_contrato  . "</td>
        <td class='border'><strong>FECHA TERMINACIÓN:</strong><br>" . $terminacion . "</td>
    </tr>
    <tr class='border' >
        <td class='border'><strong>LUGAR DE LAS ACTIVIDADES:</strong><br>" . $datos->lugar  . "</td>       
        <td class='border'><strong>DURACIÓN DEL CONTRATO:<br></strong>" . $datos->duracion  . "</td>
    </tr>
    <tr class='border' >
        <td class='border'><strong>SALARIO MENSUAL:<br></strong>" . $datos->valor  . "</td>       
        <td class='border'></td>       
    </tr>
</table>
<br>
<div class='page-break'></div>
<div class='parrafo'>
    <p>" . ucfirst(strtolower($datos->contenido)) . "
<br><br>
<table class='noborder'>
            <tr>
                <th><img src='" . $imagenBase1 . "' width='160px' height='90px'></th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                    <img src='" . $imagenBase2 . "' width='160px' height='90px' id='firma'>
                </th>
            </tr>
            <tr>
                <td>" . $cliente . " <br> NIT: " . $_SESSION['datos_cliente']->telefono . "</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>" . utf8_encode($datos->nombre . ' ' . $datos->apellidos) . "<br>CC:" . utf8_encode($datos->cedula) . "</td>
            </tr>
        </table>
    </p>
    <span class='pagenum'></span>
</div>
</body>
"; ?>
  <?php
  $_SESSION['content'] = $parte0;
  $_SESSION['contratado']  = $datos->nombre . '_' . $datos->apellidos . '_' . $datos->cedula . '_' . $_REQUEST['id'];
  ?>

<a class="btn btn-primary" data-toggle="modal" href='#modal-id' onclick="Firmar()">Firmar</a>

<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body" id="firma">
         Aquí se mostrará el contenido del recurso solicitado 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> 
<?php ?>
<script>
  function Firmar() {
    var contrato_id = "<?php echo $_REQUEST['id']; ?>"; // Ajusta esto si estás utilizando PHP
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById("firma").innerHTML = xhr.responseText;
          document.getElementById("modal-id").style.display = "block";
        } else {
          console.error("Error fetching data:", xhr.status, xhr.statusText);
        }
      }
    };
    
    xhr.open("POST", "https://calidadsnu.com/snu/?c=contratacion&a=firmar&id=56", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("id=" + encodeURIComponent(contrato_id));
  }
</script>
