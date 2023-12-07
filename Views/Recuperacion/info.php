<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container forget-password">
    <div class="row">
        <div class="col-md-12 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <img src="https://usa.afsglobal.org/SSO/SelfPasswordRecovery/images/send_reset_password.svg?v=3" alt="car-key" border="0">
                        <h2 class="text-center">Olvido la Clave?</h2>
                        <p>Puedes Restaurar tu clave aqui</p>
                        <form id="register-form" name="register-form"  id="register-form" role="form" autocomplete="off" class="form" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="cedula" name="cedula"  placeholder="No Cédula" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <input id="correo" name="correo" placeholder="Correo" class="form-control" type="mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="btnForget" id="guardar" class="btn btn-lg btn-primary btn-block btnForget" value="Restaurar" type="button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
         $('#guardar').click(function(){
            if(($('#cedula').val() !="")  && ($('#correo').val() !="")){                   
               var datos=$('#register-form').serialize();
               $.ajax({
                  type:"POST",
                  url:"?c=recuperacion&a=confirmar",
                  data:datos,
                  success:function(r){
                     if(r==1){
                        alert("Fallo al agregar");
                     }else{
                        alert("Restaurado con éxito valida el correo");
                        //document.getElementById("frmajax").reset();
                         window.location = 'https://calidadsnu.com/'; 
                     }
                  }
               });
            } else {
               alert('Todos las casillas son obligatorias');
            }
            return false;
         });
      });
</script>    
<style>
    body {
        background: #f3c538;
    }

    .forget-pwd>a {
        color: #dc3545;
        font-weight: 500;
    }

    .forget-password .panel-default {
        padding: 31%;
        margin-top: -27%;
    }

    .forget-password .panel-body {
        padding: 15%;
        margin-bottom: -50%;
        background: #fff;
        border-radius: 5px;
        -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    img {
        width: 40%;
        margin-bottom: 10%;
    }

    .btnForget {
        background: #c0392b;
        border: none;
    }

    .forget-password .dropdown {
        width: 100%;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }

    .forget-password .dropdown button {
        width: 100%;
    }

    .forget-password .dropdown ul {
        width: 100%;
    }
</style>