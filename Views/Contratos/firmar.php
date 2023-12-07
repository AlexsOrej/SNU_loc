<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Signature Pad demo</title>
  <meta name="description" content="Signature Pad - HTML5 canvas based smooth signature drawing using variable width spline interpolation.">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link href="Assets/css/signature_pad.css" rel="stylesheet" />
  <script src="Assets/js/signature_pad.js"></script>
</head>
<body>
  <!-- Contenedor y Elemento Canvas -->
  <div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas id="canvas"></canvas>
    </div>
    <div class="signature-pad--footer">
      <div class="description">Firmar  Arriba</div>
      <div class="signature-pad--actions">
        <!-- <div>
          <button type="button" class="button clear" data-action="clear">Clear</button>
          <button type="button" class="button" data-action="change-color">Change color</button>
          <button type="button" class="button" data-action="undo">Undo</button>
        </div> -->
        <div>
          <form id="form" action="?c=contratacion&a=getfirma" method="post">
            <input type="hidden" name="base64" value="" id="base64">
            <input type="hidden" name="contrato" value="<?=$_REQUEST['id']?>" >
            <button type="button" class="button clear" data-action="clear">Limpiar</button>
            <button id="saveandfinish" class="btn btn-success">Guardar y Finalizar</button>
            <!-- <button type="button" class="button save" data-action="save-png">Save as PNG</button>
            <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
            <button type="button" class="button save" data-action="save-svg">Save as SVG</button> -->
        </div>
      </div>
    </div>
  </div>
  </form>
  <script src="Assets/js/signature_pad.umd.js"></script>
  <script src="Assets/js/app.js"></script>
  <!-- Formulario que recoge los datos y los enviara al servidor -->
  <script type="text/javascript">
    var wrapper = document.getElementById("signature-pad");
    var canvas = wrapper.querySelector("canvas");
    var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(255, 255, 255)'
    });
    function resizeCanvas() {
      var ratio = Math.max(window.devicePixelRatio || 1, 1);
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
      signaturePad.clear();
    }
    window.onresize = resizeCanvas;
    resizeCanvas();
  </script>
  <script>
    document.getElementById('form').addEventListener("submit", function(e) {
      var ctx = document.getElementById("canvas");
      var image = ctx.toDataURL(); // data:image/png....
      document.getElementById('base64').value = image;
    }, false);
  </script>

  <?php
  echo '</body>
</html>';
