<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../css/style.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php $imagen = $this->model->Imagen($_REQUEST["url"]);

$ruta = 'https://documental.calidadsg.com/documental/img/uploads/colegio/filename/' . $imagen->filename;
?>


<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <!-- <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>PQRSF</h3>
                        <p> Herramienta que nos permite conocer las inquietudes y manifestaciones 
                        que tienes, para que tengamos la oportunidad de fortalecer
                        nuestro servicio.</p> -->
            <div class="contenedor-texto">
                <img class="logo2" src="<?php echo $ruta ?>" alt="" />


                <h3>PQRSF</h3>
                <p> Esta herramienta nos permite conocer las inquietudes y manifestaciones
                    que tienes, para que tengamos la oportunidad de fortalecer
                    nuestro servicio. ;)</p>

            </div>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <img class="logo" src="..\img\qa.png" alt="">
                    <h3 class="register-heading">Diligencia el Formulario </h3>
                    <form action="?c=pqrs&a=add" method="POST">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="urlp" class="form-control" placeholder="" value="<?php echo $_REQUEST['url'] ?>" />
                                    <input type="text" name="nombres" class="form-control" placeholder="Nombres *" value=""  required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos *" value=""  required/>
                                </div>
                                <div class="form-group">
                                    <select name="tipo_peticion" class="form-control" required>
                                        <option class="hidden" selected disabled>Tipo Solicitud</option>
                                        <option value="felicitacion">Felicitación</option>
                                        <option value="sugerencia">Sugerencia</option>
                                        <option value="reclamo">Reclamo</option>
                                        <option value="queja">Queja</option>
                                        <option value="peticion">Petición</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" name="correo" class="form-control" placeholder="Tu Correo *" value="" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="n_contacto" minlength="12" maxlength="15" class="form-control" placeholder="Número de Contacto *" value="" required />
                                </div>

                                <div class="form-group">
                                    <textarea type="text" name="descripcion" class="form-control" placeholder="Describe tu solicitud *" value="" required/></textarea>
                                </div>
                                <input type="submit" class="btnRegister" value="Enviar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
//session_start();
if (isset($_REQUEST['rad'])) : $rad = $_REQUEST['rad'];
    $rad =  base64_decode($rad);
?>

    <script type="text/javascript">
        swal({
            title: "Confirmamos su Radicado",
            text: "Gracias por usar nuestro sistema de PQRSF;  su solicitud fue radicada con el N° <?php echo $rad; ?>. Sus aportes son muy importantes para nosotros en el mejoramiento continuo de la empresa y la satisfacción de nuestros clientes.",
            html: true,
            type: "info",
            confirmButtonText: "Aceptar"
        });
    </script>

<?php endif; ?>