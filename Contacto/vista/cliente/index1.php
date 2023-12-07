<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../css/style.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container register">
    <?php if (isset($_REQUEST['pqrs'])) {
        $pqrs =  $this->model->Obtener($_REQUEST['pqrs']);
    } ?>
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
            <h3>PQRSF</h3>
            <p class="text-justify"> Herramienta que nos permite conocer las inquietudes y manifestaciones
                que tienes, para que tengamos la oportunidad de fortalecer
                nuestro servicio.</p>
        </div>
        <div class="col-md-9 register-right">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading alert alert-default">Diligencia el Formulario end </h3><br><br>
                    <div class="col-md-12 register-heading">
                        <h6>
                            <spam>para dar cierre al tramite</spam>
                        </h6>
                    </div>
                    <form action="?c=cliente&a=add" method="POST">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="hidden" name="empresa_id" class="form-control" placeholder="" value="<?php echo $pqrs->url ?>" />
                                    <input type="hidden" name="respuesta_id" class="form-control" placeholder="" value="<?php echo $_REQUEST['resp'] ?>" />
                                </div>
                                <div class="form-group">
                                    <select name="estado_cliente" class="form-control">
                                        <option class="hidden" selected disabled>Grado de satisfaci贸n</option>
                                        <option value="Muy Satisfecho">Muy Satisfecho</option>
                                        <option value="Satisfecho">Satisfecho</option>
                                        <option value="Poco Satisfecho">Poco Satisfecho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea type="text" name="sugerencia" class="form-control" placeholder="Escribe tu Sugerencia *" value="" /></textarea>
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
if (isset($_REQUEST['exit'])) :
    $url =  $this->model->Listar($_REQUEST['exit']);
?>
    <script type="text/javascript">
        swal({
            title: '¡GRACIAS!',
            text: 'Sus aportes son muy importantes para nosotros en el mejoramiento continuo de la empresa y la satisfacci贸n de nuestros clientes.',
            type: 'success'
        }).then(function() {
            window.location.href = "<?php echo $url->url ?>";
        })
    </script>

<?php endif; ?>