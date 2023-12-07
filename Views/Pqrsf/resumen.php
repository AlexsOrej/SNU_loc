<?php   header('Content-Type: text/html; charset=UTF-8'); ?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <div class="card">
            <div class="header bg-teal">
                <h2>
                    SOLICITUD <small>Radicado # <?php echo $Pqr->radicado; ?></small>
                </h2>
            </div>
            <div class="body">
                <p>
                <div class="responsive">
                    <table class="table table-responsive">
                        <tr>
                            <th>Petición</th>
                            <th>Enviado por</th>
                            <th>Identificación</th>
                            <th>Correo</th>
                            <th>Contacto</th>
                            <th>Registro</th>
                            <th>Estado</th>
                        </tr>
                        <tr>
                            <td><?php echo ucfirst($Pqr->tipo_peticion); ?></td>
                            <td><?php echo $Pqr->nombres . ' ' . $Pqr->apellidos; ?></td>
                            <td><?php echo $Pqr->identificacion; ?></td>
                            <td><?php echo $Pqr->email; ?></td>
                            <td><?php echo $Pqr->n_contacto; ?></td>
                            <td><?php echo $Pqr->fecha_registro; ?></td>
                            <td><?php echo ucfirst($Pqr->estado); ?></td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center"> Descripcion de la solicitud </th>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-justify"><?php echo $Pqr->descripcion; ?></td>

                        </tr>
                        <tr>
                            <td colspan="8" class="text-justify">Asigando A: <?php echo $Pqr->responsable; ?> <br> Fecha de Asiganción: <?php echo $Pqr->f_asignacion; ?></td>
                            <td colspan="8" class="text-justify"></td>
                        </tr>
                    </table>
                </div>
                </p>
            </div>
        </div>
    </div>
    <?

    if (!empty($respuesta)) :
    ?>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>
                        RESPUESTA <small>reporte de la gestión prestada</small>
                    </h2>
                </div>
                <div class="body">
                    <p>
                    <table class="table table-responsive">
                        <tr>
                            <th>Proceso</th>
                            <th>Segmento</th>
                            <th>Clasificación</th>
                            <th>estado</th>
                        </tr>
                        <tr>
                            <td><?php echo $respuesta->proceso_id; ?></td>
                            <td><?php echo ucwords($respuesta->segmento); ?></td>
                            <td><?php echo ucwords($respuesta->clasificacion_id); ?></td>
                            <td><?php echo ucwords($respuesta->estado); ?></td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center"> Descripcion de la Respuesta </th>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-justify">Fecha Registro:<br><?php echo $respuesta->fecha; ?></td>
                            <td colspan="4" class="text-justify">Registrado por:<br><?php
                            $encodingOriginal = "ISO-8859-1"; // Por ejemplo, ISO-8859-1 (Latin-1)
                            $encodingObjetivo = "UTF-8"; // Por ejemplo, UTF-8
                            $nuevaCadena = UConverter::transcode($respuesta->usuario, $encodingOriginal,  $encodingObjetivo);
                            echo  $nuevaCadena1 = iconv("ISO-8859-1", "UTF-8", $respuesta->usuario);
                          //echo ucwords($respuesta->usuario);
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-justify">
                                <p><?php echo $respuesta->respuesta; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">
                                <?php if (!empty($respuesta->soporte)) : ?>
                                    <a href="<?php //echo APP_WWW.'img/'. $datos['Colegio']['nombre'].'/'. h(@$Pqr['Respuesta'][0]['soporte']);
                                                ?>" target="_blank">Soporte</a>
                                <?php else : ?>
                                    <span>Sin Soporte</span>
                                <?php endif; ?>
                            </th>
                        </tr>
                    </table>
                    </p>
                </div>
            </div>
        </div>
    <? endif;

    if (!empty($satisfacion)) : ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header bg-teal">
                    <h2>
                        VERIFICACIÓN <small>detalla el grado de satisfación del cliente</small>
                    </h2>
                </div>
                <div class="body">
                    <p>
                    <dl>
                        <dt>Grado de satisfación</dt>
                        <dd>
                            <?php echo $satisfacion->gradoSat;
                            switch ($satisfacion->gradoSat) {
                                case 'Muy Satisfecho':
                                    echo '<br><span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    break;
                                case 'Satisfecho':
                                    echo '<br><span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">stars</span>';
                                    break;
                                case 'Poco Satisfecho':
                                    echo '<br><span class="material-icons">stars</span>';
                                    echo '<span class="material-icons">sentiment_dissatisfied</span>';

                                    break;
                                case 'Nada Satisfecho':
                                    echo '<br><span class="material-icons">sentiment_very_dissatisfied</span>';
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            ?>
                        </dd>
                        <dt>Sugerencia y/o Comentario</dt>
                        <dd class="tex-justify"><?php echo $satisfacion->sugerencia; ?></dd>
                        <dt>Fecha Registro</dt>
                        <dd><?php echo @$satisfacion->created; ?></dd>
                    </dl>
                    </p>
                </div>
            </div>
        </div>
    <? endif; ?>
</div>