<div class="card">
    <div class="header">
        <h2>
            <a href="https://scribehow.com/shared/Como_subir_las_evidencias_de_los_formatos__mrb9G9UjRgS3xqHEaNmrLA" target="_blank">
                <span class="material-icons">
                    help_center
                </span></a></i>Formatos
            <small>De clic en el proceso para ver el listado de Formatos</small>
        </h2>
    </div>
    <div class="table-responsive" style="max-width: 100%">
        <div class="body">
            <table id="tableDoc" class="table table-bordered table-striped font-13">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <!-- <th>Versión</th> -->
                        <th>F.Revisión</th>
                        <th>Almacenamiento</th>
                        <th>Protección</th>
                        <th>Tiempo</th>
                        <th>Disposición</th>
                        <th></th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php foreach ($documentos as $value) : ?>
                        <tr>
                            <td class="font-11"><?= $value->CodFormato ?></td>
                            <td class="font-11"><a href="<?= $value->RutaFormato ?>" target="_blank"><?= $value->NomFormato ?></a>
                            <br><p style="width:60px; margin-top:5px; padding-left: 8px; padding-right: 4%;border-radius:5px; font-size:10px" class="bg-light-blue pull-right"> Versión:<?= $value->Version ?> </p> 
                            </td>
                            <!-- <td></td> -->
                            <td><?= $value->Actualizacion == '0000-00-00' ? $value->Emision : $value->Actualizacion ?></td>
                            <td>
                                <?php
                                $doc_auth = $this->usuario->FormatoRestringido($value->id);
                                // print_r($doc_auth);
                                if ($doc_auth == 'privado') {
                                    $auth=$this->usuario->ColaboradorAutorizado($_SESSION['user']->user_id, $value->id);
                                    if ($auth) {
                                        echo'<a href="'.$value->Recuperacion.'"  target="_blank">'.$value->Almacenamiento.'</a>';
                                    }else{
                                        echo'<a onclick="AlertRestringir()">'.$value->Almacenamiento.'</a>';
                                    }
                                } else {
                                    echo'<a href="'.$value->Recuperacion.'"  target="_blank">'.$value->Almacenamiento.'</a>';                            
                                }                                
                                ?>

                            </td>
                            <td><?= $value->Proteccion ?></td>
                            <td width=2%><?= $value->TiempoRetencion ?></td>
                            <td><?= $value->DispFinal ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <?php if ($_SESSION['user']->rol_id == 2 or $_SESSION['user']->rol_id == 1) : ?>
                                    <a data-toggle="modal" href='#modal-id' type="button" onclick="Edit('<?= $value->id ?>')" type="button" title="Botón para actualizar datos asociados al formato">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a data-toggle="modal" href='#modal-id' type="button" onclick="Restringir('<?= $value->id ?>')" type="button" title="Botón para restringir el acceso al formato">
                                        <i style="color:#FF9800" class="glyphicon glyphicon-comment"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body p-5" id="resultado">
            </div>
            <div class="modal-footer">
                <button title="Botón para cerrar este cuadro" type="button" class="btn bg-orange"  data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>





    function Get(doc_id) {
        var doc_id = doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=formatos&a=Getdoc",
            success: function(data) {
                $('#resultado').html(data);

            }
        });
    }

    function Edit(doc_id) {
        var doc_id = doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=formatos&a=Edit",
            success: function(data) {
                $('#resultado').html(data);
            }
        });
    }

    function Restringir(doc_id) {
        var doc_id = doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=formatos&a=restringir",
            success: function(data) {
                $('#resultado').html(data);
            }
        });
    }

    function AlertRestringir() {
        Swal.fire({
        icon: 'info',
        title: 'Restringido',
        text: 'Las evidencias/recuperaciones están restringidas',
        showConfirmButton: true,
    });
    }
</script>