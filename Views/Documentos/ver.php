<div class="card" style="width: fit-content;">
    <div class="header">
        <h2>
            <a href="">
                <span class="material-icons">
                    help_center
                </span></a></i>Documentos
        </h2>
    </div>
        <div class="body">
        <div class="table-responsive" style="max-width: 100%" ;>
            <table id="tableDoc" class="table table-bordered font-13">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Protección</th>
                        <th>Versión</th>
                        <th>Preservación</th>
                        <th>Emisión</th>
                        <th>Actualización</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($documentos as $value) : ?>
                        <tr>
                            <td><?= $value->CodDocumento ?></td>
                            <td class="font-11">
                                <? $doc_online = $online->Documentos($value->CodDocumento); ?>
                                <? if (empty($doc_online->doc_online_id)) :
                                    $dir = "Assets/img/" . $_SESSION['datos_cliente']->nombre . '/' . $value->CodDocumento . ".pdf";
                                ?>
                                    <? if (!file_exists($dir) || !filesize($dir)) :  ?>
                                        <a onclick="VisorNo('<?= $dir ?>')" data-toggle="modal" href='#modal-id'>   <?= $value->NomDocumento ?> <i style="color: #ff4500;" class="glyphicon glyphicon-warning-sign"></i>                                           
                                                                                    
                                        </a>
                                    <? else :
                                        $dir = "Assets/img/" . $_SESSION['datos_cliente']->nombre . '/' . $value->CodDocumento . ".pdf#toolbar=0";
                                    ?>
                                        <a onclick="Visor('<?= $dir ?>')" data-toggle="modal" href='#modal-idv'><?= $value->NomDocumento ?></a>
                                    <? endif; ?>
                                <? else : ?>
                                    <a onclick="Online('<?= $doc_online->doc_online_id ?>')" data-toggle="modal" href='#modal-id'><?= $value->NomDocumento ?></a>&nbsp;
                                <? endif; ?>
                            </td>
                            <td><?= $value->proteccion ?></td>
                            <td class="align-center"><?= $value->Version ?></td>
                            <td><?= $value->preservacion ?></td>
                            <td><?= $value->Emision ?></td>
                            <td><?= $value->Actualizacion ?></td>
                            <td style="vertical-align: middle;text-align: center;">
                                <?php if ($_SESSION['user']->rol_id == 2 or $_SESSION['user']->rol_id == 1) : ?>
                                    <a title="Botón para editar los datos asociados al documento" data-toggle="modal" href='#modal-id' type="button" onclick="Edit('<?php echo $value->id ?>')" type="button" title="Actualizar datos del Documento">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        /* Estilo base del botón */
        .close-button {
            border: none;
            background-color: transparent;
            color: #fff;
            font-size: 1.5rem;
            padding: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            background-color: #ff4500;
            border: 2px solid #ff4500;
        }

        /* Estilo cuando se pasa el ratón por encima */
        .close-button:hover {
            color: #ff4500;
            background-color: #fff;
        }

        /* Estilo cuando se hace clic */
        .close-button:active {
            color: #fff;
            background-color: #ff4500;
        }
    </style>
<style>
  .modal-full {
    width: 80%;
    height: 100%;
    padding: 0;
  }

  .modal-full .modal-dialog {
    width: 80%; /* Ajusta el tamaño del modal como desees */
    max-width: 100%;
    margin: auto;
    height: 90vh; /* Ajusta el alto del modal como desees */
  }
</style>

    <div class="modal fade" id="modal-id">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times; Cerrar</button>
                </div>
                <div class="modal-body" id="resultado"></div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-orange" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-idv">
        <div class="modal-header">
            <button type="button" class="close-button" data-dismiss="modal" aria-hidden="true">&times; Cerrar</button>
        </div>
        <div class="modal-body" id="resultadov" style="width:100%; height:100%;">
        </div>
    </div>
</div>
<script>
    function Online(id) {
        $.ajax({
            type: "POST",
            url: '?c=onlines&a=index',
            data: 'id=' + id,
            success: function(resp) {
                $('#resultado').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Visor(id) {
        $.ajax({
            type: "POST",
            url: '?c=onlines&a=visor',
            data: 'id=' + id,
            success: function(resp) {
                $('#resultadov').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function VisorNo() {
        $('#resultado').html("El Documento No fue encontrado");
    }


    function Get(doc_id) {
        var doc_id = doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=documentos&a=Getdoc",
            success: function(data) {
                $('#resultado').html(data);
                //$('#resultado').html("<div class='alert alert-success'></div>");
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
            url: "?c=documentos&a=Edit",
            success: function(data) {
                $('#resultado').html(data);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
    }
</script>