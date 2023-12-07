<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SNU-PQRSF</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../css/nuev0.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<?php $imagen = $this->model->Imagen($_REQUEST["url"]);
$tyc = $this->model->Tyc($_REQUEST["url"]);
$terminos = $tyc->matriz;
$ruta = 'https://calidadsnu.com/snu/Assets/img/uploads/colegio/' . $imagen->filename;
?>
<div class="container register">
    <div class="row">
        <div class="col-md-6 col-sm-12 register-left">
            <div class="contenedor-texto">
                <img class="logo2" src="<?php echo $ruta ?>" alt="" />
                <h3>PQRSF</h3>
                <p> Esta herramienta nos permite conocer las inquietudes y manifestaciones
                    que tienes, para que tengamos la oportunidad de fortalecer
                    nuestro servicio. ::|;)</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <img class="logo" src="..\img\qa.png" alt="">
                    <h3 class="register-heading">::Diligencia el Formulario:: </h3>
                    <form action="?c=pqrs&a=add" method="POST" id="form_pqrs" name="form_pqrs" >
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="urlp" class="form-control" placeholder="" value="<?php echo $_REQUEST['url'] ?>" required />
                                    <input type="text" name="nombres" class="form-control" placeholder="Nombres *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="empresa" class="form-control" placeholder="Empresa *" value="" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="correo" class="form-control" placeholder="Tu Correo *" value="" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="n_contacto" minlength="10" maxlength="15" name="txtEmpPhone" class="form-control" placeholder="Número de Contacto *" value="" required />
                                </div>
                                <div class="form-group">
                                    <select name="tipo_peticion" class="form-control" required>
                                        <option value="" class="hidden" selected disabled>Tipo Solicitud</option>
                                        <option value="informacion">Información</option>
                                        <option value="soporte">Soporte</option>
                                        <option value="felicitacion">Felicitación</option>
                                        <option value="sugerencia">Sugerencia</option>
                                        <option value="reclamo">Reclamo</option>
                                        <option value="queja">Queja</option>
                                        <option value="peticion">Petición</option>
                                    </select>
                                </div>

                                <!-- <input type="submit" class="btnRegister" value="Enviar" /> -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?
                                    $descricion = '';
                                    $cols = '';
                                    $rows = '';
                                    if ($_REQUEST['url'] == 67) :
                                        $cols = 0;
                                        $rows = 4;
                                        $descricion = '
                                        Digite los siguientes datos que describen su solicitud:
                                        NIT EMPRESA
                                        NOMBRE PRODUCTO
                                        MARCA
                                        NOMBRE DE LA EMPRESA
                                        N° FACTURA                                        
                                        MUESTRA FÍSICA (SI, NO)
                                        NUMERO DE CANTIDADES CON NOVEDAD
                                        CANTIDADES TOTAL DEL PEDIDO CON PROBLEMA
                                        DESCRIPCIÓN GENERAL DE LA SITUACIÓN';
                                    ?>
                                    <? endif; ?>
                                    <label for="">Descripción <i class="col-red">*</i> </label>
                                    <textarea  cols="<?= $cols ?>" rows="<?= $rows ?>" name="descripcion" id="descripcion" class="form-control" data-toggle="popover" title="<?= $descricion ?>" data-content="<?= $descricion ?>" data-placement="top" title="<?= $descricion ?>" placeholder="Describe tu solicitud *" value="" required ></textarea>
                                    <div class="form-group">
                                        <label for="terminos-condiciones">
                                            <input type="checkbox" id="terminos-condiciones" required>
                                            Acepto los <a href="<?php echo $terminos ?>" target="_blank">términos y condiciones</a>
                                        </label>
                                    </div>
                                </div>
                                <input type="submit" id="myButton" class="btnRegister" value="Enviar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_REQUEST['rad'])) : $rad = $_REQUEST['rad'];
    $rad =  base64_decode($rad); ?>
    <script type="text/javascript">
        var checkbox = document.getElementById("terminos-condiciones");
        var submitButton = document.querySelector("input[type='submit']");
        checkbox.addEventListener("change", function() {
            submitButton.disabled = !checkbox.checked;
        });

        // function disableButton() {
        //     var button = document.getElementById("myButton");
        //     button.disabled = true;
        //     setTimeout(function() {
        //         button.disabled = false;
        //     }, 1500)
        // }
        swal({
            title: "Confirmamos su Radicado",
            text: "Gracias por usar nuestro sistema de PQRSF;  su solicitud fue radicada con el N° <?php echo $rad; ?>. Sus aportes son muy importantes para nosotros en el mejoramiento continuo de la empresa y la satisfacción de nuestros clientes.",
            html: true,
            type: "info",
            confirmButtonText: "Aceptar"
        });
        setTimeout(function() {
            window.location.href = "https://calidadsnu.com/snu/Contacto/start/index.php?url=<?php echo $_REQUEST['url'] ?>";
        }, 3000)
    </script>
<?php endif; ?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Agrega un evento de clic al botón de envío del formulario
    document.getElementById('form_pqrs').addEventListener('submit', function (event) {
        // Deshabilita el botón después de enviar el formulario
        document.getElementById('myButton').disabled = true;
    });
});
</script>