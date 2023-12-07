<style>
    .break {
        width: 600px;
        height: auto;
        text-align: justify;
        word-break: break-word;
    }

    .nobreak {
        width: auto;
        height: auto;
        text-align: justify;
        word-break: break-word;
    }
</style>
<div class="container-fluid max-width p-0">
    <div style="padding:2%;" class="card">
                <h4>Novedades Registradas</h4>
    </div>
    <!-- Basic Card -->
    <!-- #END# Basic Card -->
    <div class="col-md-12">
        <div class="">
            <!-- <div style="padding:5px;" class="">
                <h3>Novedades Registradas</h3>
            </div> -->
            <div class="body">
                <div class="row clearfix">
                    <div style="padding:0px" class="col-md-4 p-0">
                        <div style="height:430px;" class="card">
                            <div class="header">
                                <h2>
                                    BUSCAR USUARIO <small>Ingresa el <b>número de identificación,nombre o apellido </b> del usuario requerido para la consulta y/o registro de la novedad</small>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="col-md-12 text-center">
                                            <!-- <label for="">Buscar por nombre</label>
                                            <input name="nombre" id="doc" type="text" class="form-control">
                                            <label for="">Buscar por apellido</label>
                                            <input name="apellido" id="doc" type="text" class="form-control">
                                            -->
                                            
                                            <label for="">Buscar usuario</label> 
                                            <input name="doc" id="doc" type="text" class="form-control">
                                            <div class="" id="val"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button title="Botón para buscar usuario" id="guardar" name="guardar" class="btn bg-green"> <i style="font: size 12px;" class="glyphicon glyphicon-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                        
                            <div id="cargar" ></div>
                      
                    </div>
                </div>
                <div class="row" >
                <div class="container-fluid">

                 
                <div class="col-md-12 card p-3" class="responsive" id="resultado">
                            <div class="">
                                <div class="header"></div>
                                <div class="body">

                                    <table id="tbl_novedad" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Novedad</th>
                                                <th>Fecha</th>
                                                <th>Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <? foreach ($novedades as $value) : ?>
                                                <tr>
                                                    <td><?= $value->fullNombre ?><br>
                                                        <span class="label label-info badge">C.C: <?= $value->cedula ?></span><br>
                                                    </td>
                                                    <td class="break">
                                                         <?= $value->descripcion ?><br>
                                                        <span class="label label-warning badge"><?= $value->evento ?></span>                                                   
                                                    </td>
                                                    <td><?= $value->fecha_novedad ?></td>
                                                    <td><?= $value->fecha_registro ?></td>
                                                </tr>
                                            <? endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                 </div>
                </div>   
            </div>
        </div>
        <br>
        <script>
            $('#guardar').on('click', function() {
                //alert("este boton se dispara");
                // var nombre = document.getElementById("nombre").value             
                // var apellido = document.getElementById("apellido").value             
                var doc = document.getElementById("doc").value   


                 if (doc !="" ) {
                    $.ajax({
                        type: "POST",
                        url: '?c=novedades&a=resultado',
                        data: {
                            dato: doc
                        },
                        beforeSend: function() {
                            $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                        },
                        success: function(resp) {
                            $('#resultado').html(resp);
                           // $('#cargar').html("<div class=card id=main style=width: 100%;height:400px;>cargó</div>");
                            ficha();
                        }
                    });
                }else{
                    $('#val').html("<span class='label label-warning'>no hay datos para buscar</span>");
                
                }
            });

            function ficha(){
                var doc = document.getElementById("doc").value   
                if (doc !="" ) {
                    $.ajax({
                        type: "POST",
                        url: '?c=novedades&a=resultadoFicha',
                        data: {
                            dato: doc
                        },
                        beforeSend: function() {
                            //$('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                        },
                        success: function(resp) {
                           // $('#resultado').html(resp);
                            $('#cargar').html(resp);

                        }
                    });
                }else{
                    $('#val').html("<span class='label label-warning'>no hay datos para buscar</span>");
                
                }
            }


            // $('#guardar').on('click', function() {
            //     var nombre = document.getElementById("nombre").value             
            //     var apellido = document.getElementById("apellido").value             
            //     var doc = document.getElementById("doc").value             

            //      if (doc !="" ) {
            //         $.ajax({
            //             type: "POST",
            //             url: '?c=novedades&a=resultado',
            //             data: {
            //                 dato: dato
            //             },
            //             beforeSend: function() {
            //                 $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            //             },
            //             success: function(resp) {
            //                 $('#resultado').html(resp);
            //             }
            //         });
            //     }else{
            //         $('#val').html("<span class='label label-warning'>no hay datos para buscar</span>");
                
            //     }
            // });
        </script>





























        <?php if (isset($_POST['doc']) or isset($_REQUEST['doc'])) :
            $cc = $_REQUEST['doc'];
            $_SESSION['cc'] = $cc;
            $rol = $datos[0]['rol_id'];
            $id = $datos[0]['id'];
            if (empty($listar = $this->model->Buscar($cc))) {

                echo "<div class='col-lg-8 col-md-8 col-sm-8 col-xs-8 col-md-offset-2 alert alert-warning text-center' role='alert' '>
                                  El número identificación consultado no se encuentra registrado
                         </div> ";
            } else {

        ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Registro histórico del trabajador</h2>
                            <ul class="header">

                                <?php
                                /*           echo '<pre>';
             print_r($_SESSION['menu']);
              echo '</pre>';*/
                                foreach ($_SESSION['menu'] as $menu) {


                                    if ($menu->modulo == 'Novedades' && $menu->escritura == 'si') { ?>

                                        <ul class="header-dropdown m-r--5">
                                            <a href="?c=Novedades&a=Registro&id=<?php echo $_POST['doc'] ?>" class="btn btn-success">Registrar Novedad</a>
                                        </ul>
                                <?php
                                    }
                                }
                                ?>



                        </div>
                        <div class="body">
                            <p id="demo"></p>

                            <table class="table table-bordered text-center">
                                <th><?php
                                    foreach ($listar as $r) :
                                        $nombre_fichero = '../usuarios/archivos/' . $r->cedula . '/foto.jpg';
                                        $nombre_fichero2 = '../usuarios/archivos/' . $r->cedula . 'foto.jpg';
                                        $nombre_fichero3 = '../usuarios/archivos/' . $r->cedula . '/foto.jpg.jpg';

                                        if (file_exists($nombre_fichero3)) {
                                            echo "<img src='$nombre_fichero3' width='50' height='60' class='text-center'>";
                                        } else {

                                            if (file_exists($nombre_fichero2)) {
                                                echo "<img src='$nombre_fichero2' width='50' height='60' class='text-center'>";
                                            } else {
                                                echo "<img src='$nombre_fichero' width='50' height='60' class='text-center'>";
                                            }
                                        } ?>
                                    <?php endforeach; ?> </th>
                                <th><?php echo $r->Nombre . ' ' . $r->Apellido; ?>
                                <td><?php echo $r->cedula; ?></td>
                                </th>
                                <th><?php echo $r->Correo; ?></th>
                                <th><?php echo $r->celular; ?></th>
                            </table>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Novedad</th>
                                            <th>Descripción</th>
                                            <th>Otro_si</th>
                                            <th>Fecha del Contrato</th>
                                            <th>Fecha Novedad</th>
                                            <!--<th>Obra</th>-->
                                            <th>Servicio</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th>Novedad</th>
                                        <th>Descripción</th>
                                        <th>Otro_si</th>
                                        <th>Fecha del Contrato</th>
                                        <th>Fecha Novedad</th>
                                        <!--<th>Obra</th>-->
                                        <th>Servicio</th>
                                        <th>Opción</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        /* echo '<pre>';
                print_r($this->model->novedad($cc));  
                echo '<pre>';*/
                                        $listar = $this->model->novedad($cc);

                                        foreach ($listar as $r) :
                                            $contrato = $this->model->Listacontrato01($r->usuariocargo_id);
                                            /* echo '<pre>';
                print_r($contrato);  
                echo '<pre>';*/


                                            foreach ($contrato as $c) {
                                            }
                                        ?>
                                            <tr>
                                                <td><a onClick="loadDynamicContentModal('<?php echo $r->id ?>')"><?php echo $r->novedad; ?></a></td>
                                                <td><?php echo substr($r->descripcion, 0, 50) . '...'; ?></td>
                                                <td><?php echo substr($r->otro_si, 0, 50) . '...'; ?></td>
                                                <td><?php

                                                    if ($r->usuariocargo_id == @$c->id) {
                                                        echo @$c->inicio_contrato;
                                                    } else {
                                                        echo $r->fecha_novedad;
                                                    }

                                                    ?>
                                                </td>
                                                <td><?php echo $r->fecha_novedad; ?></td>
                                                <!--<td><?php echo $r->obra; ?></td>-->
                                                <td><?php echo $r->nombre; ?></td>
                                                <td>
                                                    <?php if ($r->novedad == "Otro Si") : $_SESSION['id_datos'] = $r->id  ?>
                                                        <a href="https://sgvalle.com/vista/firmas" title="firma del empleado"><i class="glyphicon glyphicon-pencil"></i></a>

                                                    <?php endif;   ?>

                                                    <a onClick="upDate('<?php echo $r->id ?>')"><i class="glyphicon glyphicon-edit"></i></a>
                                                    <a onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=Novedades&a=Delete&id=<?php echo $r->id; ?>" title="Eliminar" data-toggle="popover" data-trigger="hover" data-content="Elimina los datos de la novedad "><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                        <?php };
                endif; ?>


                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <!-- #END# Exportable Table -->

    <!--OTRO SI-->
    <div class="modal fade" id="bootstrap-modal" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal contenido-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles Novedad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    <p id="demo"></p>
                </div>
                <div class="modal-body">
                    <div id="conte-modal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--ACTUALIZAR-->
<div class="modal fade" id="bootstrap-modal1" role="dialog">
    <div class="modal-dialog" role="document">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualización de Novedad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div id="update-modal"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--ELIMINAR-->
</script>
<div id="deleteProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="delete_product" id="delete_product">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Novedad# <?php echo $id ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div id="delete-modal">
                        <p>¿Seguro que quieres eliminar este registro?</p>
                        <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
                        <input type="hidden" name="delete_id" id="delete_id" value="<?php echo $id ?>">
                    </div>
                </div>
                <div class="resultados" id="resultados"></div>

                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input class="btn btn-danger" onclick=" myFunction()" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>