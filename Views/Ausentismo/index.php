
    <section>
     <div class="row">  
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                            <h2 class="h1">Ausentismo</h2>
                            </div>
                            <div  class="col-sm-6">
                            <!-- <button class="neu" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-plus"> </i> Registrar</button> -->

                            </div>


                        </div>
                       
                    </div>
                </div>
               
            </div>
            <div class="row clearfix">
                <div   class="col-sm-5">
                                    <!-- <div class="input-group">   -->
                                    <div style="padding:3%;" class="card" >
                                    <div class="">
                                        <h4>BUSCAR USUARIO</h4>
                                    </div>
                                    <p style="font-size: 1.2rem" class="text-muted">Ingresa el nombre, apellido o identificacion del usuario</p>
                                    <hr>
                                    <input type="text" name="dato" id="dato" minlength="1" maxlength="20" class="form-control" placeholder="">
                                        <span  class="input-group-btn text-center mt-5">
                                        <a style="margin-top:10px;" type="submit" id="buscar" class="btn bg-green"> <i style="font-size:13px" class="glyphicon glyphicon-search"></i> Buscar</a>
                                        </span>
                                        <div id="val"></div>
                                    </div>
                                        
                                    <!-- </div> -->
                </div>
                    <div  class="col-sm-7 ">
                        
                        <div style="padding:3%; height:195px; display:none" class="card" id="datos">
                        </div> 
                    </div>
                 </div>
            </div>
        </div>
        <div style="padding:0px;" class="container-fluid p-0">
            <div class="">
                             <div style="display:none; padding:3%;" class="card"  id="resultado">
                                <!-- <h3 class="text-muted">Registros</h3> -->
                            </div>
            </div>

        </div>
       
    </section>

    <script>
        $('#buscar').on('click', function() {
            var data = document.getElementById("dato").value
            if (data === "") {
                $('#val').html("<label class='col-red'>El campo de buscar esta vacio</label>");
                setTimeout(function() {
                    $('#val').fadeOut(1500);
                }, 3000);
            } else {
                $.ajax({
                    type: "POST",
                    url: '?c=ausentismos&a=buscar',
                    data: {
                        data: data
                    },
                    beforeSend: function() {
                        $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                    },
                    success: function(response) {
                        $('#resultado').css("display","block");
                        $('#resultado').html(response);
                        $('#datos').css("display","block");

                        datos();


                    }
                });
            }
        });

        function datos(){
            var data = document.getElementById("dato").value

            $.ajax({
                    type: "POST",
                    url: '?c=ausentismos&a=DatosUsuario',
                    data: {
                        dato: data
                    },
                    success: function(response) {
                        
                        $('#datos').html(response);
                    }
                });
        }

    </script>