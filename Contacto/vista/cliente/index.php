<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../css/nuevo01.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<div class="container register">
    <?php if (isset($_REQUEST['pqrs'])) {
        $pqrs =  $this->model->Obtener($_REQUEST['pqrs']);
    } ?>
    <div class="row">
        <div class="col-md-6 col-sm-12 register-left-cli">
            <div class="contenedor-texto">
                <img class="logo" src="..\img\qa.png" alt="">
                <h3>PQRSF</h3>
                <p> Herramienta que nos permite conocer las inquietudes y manifestaciones
                    que tienes, para que tengamos la oportunidad de fortalecer
                    nuestro servicio.</p>
            </div>

        </div>
        <div class="col-md-6 col-sm-12 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?php if (!isset($_REQUEST['exit'])) : ?>
                        <h3 class="register-heading alert alert-default">Diligencia el Formulario </h3><br><br>
                        <div class="col-md-12 register-heading">
                            <h6>
                                <spam>para dar cierre al tramite</spam>
                            </h6>
                        </div>

                        <form action="?c=cliente&a=add" method="POST">
                            <div class="row register-form">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <input type="hidden" name="empresa_id" class="form-control" placeholder="" value="<?php echo $pqrs->url ?>" />
                                        <input type="hidden" name="respuesta_id" class="form-control" placeholder="" value="<?php echo $_REQUEST['resp'] ?>" />
                                    </div>
                                    <div class="form-group">
                                        <select name="estado_cliente" class="form-control">
                                            <option class="hidden" selected disabled>Grado de satisfación</option>
                                            <option value="Muy Satisfecho">Muy Satisfecho</option>
                                            <option value="Satisfecho">Satisfecho</option>
                                            <option value="Poco Satisfecho">Poco Satisfecho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea type="text" name="sugerencia" class="form-control" placeholder="Escribe tu Sugerencia *" value="" /></textarea>
                                    </div>
                                    <input type="submit" class="btnRegister" value="Enviar" />

                                </div>

                            </div>
                        </form>
                    <?php else : ?>

                        <h3 class="register-heading alert alert-default">Tu respuesta fue enviada con éxito</h3><br><br>
                        <div class="col-md-12 register-heading">
                            <h6>
                                <spam>Gracias por ayudarnos a mejorar</spam>
                            </h6>
                        </div>
                        <br><br><br><br><br>
                        <div class="col-md-12 text-center">
                            <img src="https://documental.calidadsg.com/pqrs/img/ok.jpg" width="50%">
                            <button onclick="window.close();" class="btnRegister">Cerrar esta ventana</button>
                        </div>
                        </body>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- <footer class="bg-light text-center text-lg-start footer">

            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2020 Copyright:
                <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>

        </footer> -->
    </div>
</div>


<?php
//session_start();
if (isset($_REQUEST['exit'])) :
    $url =  $this->model->Listar($_REQUEST['exit']);
?>

    <script type="text/javascript">
        swal({
            title: '¡GRACIAS!',
            text: 'Sus aportes son muy importantes para nosotros en el mejoramiento continuo de la empresa y la satisfacción de nuestros clientes.',
            type: 'success'
        }).then(function() {
            window.location.href = "<?php echo $url->url ?>";
        })
    </script>

<?php endif; ?>