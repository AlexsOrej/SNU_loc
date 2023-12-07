<style>
    .container-img {
        margin: 10px auto;
        text-align: center;
        max-width: 100%;
    }

    .box {
        /* box-shadow: 5px 5px 15px black;**/
        box-shadow: 3px 3px 3px 1px rgba(0, 0, 0, 0.2);
    }

    .datos {
        border-radius: 10px;
        /* border-top-right-radius: 10px; */
        padding-top: 10px;
        padding-bottom: 10px;
        border-color: #FF9800;
        /* margin-top: 5px; */
    }
</style>
<!-- Basic Validation -->

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>FICHA TECNICA</h2>
                    <div class="col"> <label class="bg-orange badge float-right"><?php echo $producto->nombre ?></label></div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12  text-center datos">
                            <?php echo $producto->carateristicas ?>
                        </div>
                        <div class="col-sm-5"><!--left col-->
                            <div class="text-center">
                                <!--  -->




                                <?php

                                $filePath = 'Assets/productos/' . $_SESSION['datos_cliente']->nombre . '/' . $producto->filename;

                                if (file_exists($filePath)) {
                                    $dir = "Assets/productos/" . $_SESSION['datos_cliente']->nombre . '/' . $producto->filename;
                                } else {
                                    $dir = "https://ssl.gstatic.com/accounts/ui/avatar_2x.png";
                                }
                                ?>
                                <img src="<?= $dir ?>" class="avatar  img-thumbnail" alt="avatar">
                            </div>
                        </div><!--/col-3-->
                        <div class="col-md-6 bg-blue-grey datos">
                            <div class="col bg-blue badge float-right">Placa # <?php echo $producto->id; ?></div>
                            <div class="col">Factura #: <?php echo $producto->factura  ?></div>
                            <div class="col">Proveedor :<?php echo $producto->proveedor  ?></div>
                            <div class="col">Categoria :<?php echo $producto->categoria ?></div>
                            <div class="col">Fabricante :<?php echo $producto->fabricantes  ?></div>
                            <div class="col">Estado :<?php echo $producto->estado ?></div>
                            <div class="col">Serie :<?php echo $producto->serie ?></div>
                            <div class="col">Precio :<?php echo number_format($producto->preciocosto) ?></div>
                            <div class="col">Fecha Compra :<?php echo $producto->fechacompra ?></div>
                            <div class="col">Ubicación : <?php echo $producto->sede . ' - ' . $producto->ubicacion; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9 text-left">
                            <h2>ESPECIFICACIONES TECNICAS</h2>
                        </div>
                        <div class="col-md-3">
                            <?php
                            // print_r($especificaciones);
                            if ($especificaciones) : ?>
                                <button onclick="Etecnicaupdate('<?= $especificaciones->id ?>')" class="neu pull-right" data-toggle="modal" href='#modal-id'>Actualizar</button>
                            <?php else : ?>
                                <button onclick="Etecnica('<?= $_REQUEST['id'] ?>')" class="neu pull-right" data-toggle="modal" href='#modal-id'>Registrar</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <?php
                        // print_r($especificaciones);
                        if ($especificaciones) : ?>

                            <div class="col-md-6  datos">
                                <div class="col">Ubicación especifica: <?php echo $especificaciones->ubicacion_especifica ?></div>
                                <div class="col">Uso: <?php echo $especificaciones->uso ?></div>
                                <div class="col">Clasificación de riesgo : <?php echo $especificaciones->clasificacion_riesgo ?></div>
                                <div class="col">Marca: <?php echo $especificaciones->marca ?></div>
                                <div class="col">Modelo: <?php echo $especificaciones->modelo ?></div>
                            </div>
                            <div class="col-md-6  datos">
                                <div class="col">Material: <?php echo $especificaciones->material ?></div>
                                <div class="col">Color: <?php echo $especificaciones->color ?></div>
                                <div class="col">Lugar de Origen :<?php echo $especificaciones->lugar_origen ?></div>
                                <div class="col">Inicio Mantenimiento : <?php echo $especificaciones->inicio_mantenimiento ?></div>
                                <div class="col">Frecuencia Mantenimiento : <?php echo $especificaciones->frecu_mantenimiento ?></div>
                            </div>
                            <div class="col-md-6  datos">
                                <div class="col">Resolucion : <?php echo $especificaciones->resolucion ?></div>
                                <div class="col">Presicion :<?php echo $especificaciones->presicion ?></div>
                                <div class="col">Bateria : <?php echo $especificaciones->bateria ?></div>
                                <div class="col">Reg DIAN : <?php echo $especificaciones->reg_DIAN ?></div>
                                <div class="col">Documentación :
                                    <a href="<?php echo $especificaciones->link ?>" target="_blank">
                                        <label class="badge bg-orange">
                                            Consultar
                                        </label>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6  datos">
                                <div class="col">Rango ini calibracion : <?php echo $especificaciones->rango_ini_calibracion ?></div>
                                <div class="col">Rango fin calibracion : <?php echo $especificaciones->rango_fin_calibracion ?></div>
                                <div class="col">Rango ini medicion : <?php echo $especificaciones->rango_ini_medicion ?></div>
                                <div class="col">Rango fin medicion : <?php echo $especificaciones->rango_fin_medicion ?></div>
                                <div class="col">Tipo certificado : <?php echo $especificaciones->tipo_certificado ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>CONTROL DE MANTENIMIENTO</h2>
                </div>
                <div class="body">
                    <?php
                    // echo '<pre>';
                    // print_r($mantenimientos);
                    // echo '</pre>';
                    if (!empty($mantenimientos)) : ?>
                        <div class="responsive">
                            <table id="gestionmante" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Cód</th>
                                        <th>Fecha</th>
                                        <th>Responsable</th>
                                        <th>Descripcion</th>
                                        <th>Recomendación</th>
                                        <th>Detalle</th>
                                        <th>Verificación</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mantenimientos as $mantenimiento) :
                                        if ($mantenimiento->est_solicitud === 'planeacion' && $mantenimiento->est_ejecucion === 'ejecucion' && empty($mantenimiento->est_verificacion)) {
                                            $bg = "bg-red";
                                        }
                                    ?>
                                        <tr class="<?= $bg ?>">
                                            <td><?php echo $mantenimiento->codigo ?></td>
                                            <td><?php echo $mantenimiento->fecha  ?></td>
                                            <td><?php echo $mantenimiento->responsable  ?></td>
                                            <td><?php echo $mantenimiento->descripcion  ?></td>
                                            <td><?php echo $mantenimiento->recomendacion  ?></td>
                                            <td><?php echo $mantenimiento->detalles ?></td>
                                            <td><?php echo $mantenimiento->verificacion ?></td>
                                            <td>
                                                <a type="button" onclick="EditarMantenimiento('<?= $mantenimiento->id ?>')" class="" data-toggle="modal" href='#modal-id_mant'><i class="glyphicon glyphicon-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Formulario de Especificaciones</h4>
                    </div>
                    <div class="modal-body" id="esp"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-id_mant">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Mantenimiento</h4>
                    </div>
                    <div class="modal-body" id="mante"></div>
                </div>
            </div>
        </div>
        <script>
            function Etecnica(id) {
                $.ajax({
                    url: '?c=especificaciones&a=add',
                    data: {
                        producto_id: id
                    },
                    type: 'post',
                    success: function(data) {
                        $('#esp').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Manejo básico de errores para depuración
                    }
                });
            }

            function Etecnicaupdate(id) {
                $.ajax({
                    url: '?c=especificaciones&a=add',
                    data: {
                        especicacion_id: id
                    },
                    type: 'post',
                    success: function(data) {
                        $('#esp').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Manejo básico de errores para depuración
                    }
                });
            }

            function EditarMantenimiento(id) {
                $.ajax({
                    url: '?c=mantenimientos&a=editar',
                    data: {
                        mantenimiento_id: id
                    },
                    type: 'post',
                    success: function(data) {
                        $('#mante').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Manejo básico de errores para depuración
                    }
                });
            }
        </script>