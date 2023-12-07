<html>
    <header>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </header>
    <?php
      $usuario= $this->model->Buscar($_SESSION['cc']);
      //print_r($usuario);
    ?>
    
<br><br><br><br>    
<body onload="window.print()">    
<div class="container">
  <div class="row">
      <br><br>
 <div class="col-md-12 text-center">   
  <h4>OTRO SI</h4>
 </div>
<div class="col-md-12">
   <h4 class="text-center">AL CONTRATO DE TRABAJO</h4>   
</div><br><br><br><br><br>
<div class="col-md-12">
    <ul>
    <ol>NOMBRE DEL EMPLEADOR:		SERVICIOS GENERALES DEL VALLE DEL CAUCA</ol>
    <ol>DIRECCIÓN DEL EMPLEADOR:	CRA 10 A No 56-25</ol>
    <ol>NOMBRE DEL TRABAJADOR: <?php echo strtoupper($usuario[0]->Nombre.' '.$usuario[0]->Apellido)  ?></ol>
    <ol>IDENTIFICACIÓN: <?php echo $usuario[0]->cedula ?></ol>
    <ol>DIRECION DEL TRABAJADOR: <?php echo strtoupper($usuario[0]->direccion.' '.$usuario[0]->Barrio .' '.$usuario[0]->ciudad_res) ?></ol>
   </ul>

 <br>
</div>      
      
<div class="col-md-12">
<p class='text-justify'>
<?php echo $_SESSION['print'];?>


<br><br><br><br><br>
<img src="https://sgvalle.com/vista/usuario/tiposContrato/firmas/cosas/firmaSGV.png" style="padding:1px 1px 1px 1px;" width="250" height="150" alt="firma del empleador"><br>
______________________________________________
<p>SERVICIOS GENERALES DEL VALLE DEL CAUCA S.A.<br>
NIT: 900.572.793-0<br>
EL EMPLEADOR
<br><br>
<img src="https://sgvalle.com/vista/firmas/img/<?php echo $usuario[0]->cedula.$_SESSION['id_novedad'] ?>.png" style="padding:1px 1px 1px 1px;" width="250" height="95" alt="firma del empleador"><br>
_____________________________________________<br>
<p><?php echo $usuario[0]->Nombre.' '.$usuario[0]->Apellido?><br>
C.C. <?php echo $usuario[0]->cedula ?><br>
TRABAJADOR 
</p>
</p>
</div>
</div>
</div>
</body>
</html>
