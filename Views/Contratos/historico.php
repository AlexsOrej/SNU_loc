<div class="col-lg-12 col-md-12 col-sm-12 8col-xs12 ">
    <div class="card">
        <div class="header">
            <h2>
                Historico <small>Consulta los datos de contratos elaborados a:<br><?php echo $contratado->nombre . ' ' . $contratado->apellidos . '<br>Identificación: ' . $contratado->cedula ?> </small>
            </h2>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>CARGO</th>
                            <th>TIPO DE CONTRATO</th>
                            <th>FECHA DE INICIO</th>
                            <th>DURACIÓN</th>
                            <th>ELABORADO POR:</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>CARGO</th>
                            <th>TIPO DE CONTRATO</th>
                            <th>FECHA DE INICIO</th>
                            <th>DURACIÓN</th>
                            <th>ELABORADO POR:</th>
                            <th>OPCIONES</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($historial as $historia) : ?>
                            <tr>
                                <td>
                                    <?php
                                    $disabled="";
                                    $targetDir = "Assets/soportes_contratos/" . $_SESSION['datos_cliente']->nombre . "/" . $contratado->cedula . '-' . $historia->id.".pdf";
                                    if (file_exists($targetDir)) {
                                        $disabled="true";
                                        ?>                                        
                                        <a href="<?php echo $targetDir ?>" target="_blank">
                                            <?php echo $historia->cargo ?>                                            
                                        </a>
                                    <?php } else {; ?>
                                        <a href="?c=contratacion&a=generarContrato&id=<?php echo $historia->id ?>">
                                            <?php echo $historia->cargo ?>
                                        </a>
                                    <?php } ?>
                                </td>
                                <td><?php echo $historia->contrato ?></td>
                                <td><?php echo $historia->inicio_contrato ?></td>
                                <td width="5px"><?php echo $historia->duracion ?></td>
                                <td><?php echo $historia->usuario ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <?if(!$disabled):?>
                                    <a class='' onClick="Soporte('<?php echo $historia->id ?>','<?= $contratado->cedula ?>')" data-toggle="modal" href='#sop-modal' title="Botón para subir soporte del contrato firmado" >
                                        <i class="	glyphicon glyphicon-cloud-upload" style="font-size: 14px;"></i>
                                    </a>
                                    <a href="#" class='' onClick="editar('<?php echo $historia->id ?>')" title="Botón para actualizar datos del contrato">
                                        <i class="glyphicon glyphicon-edit" style="font-size: 14px;"></i>
                                    </a>
                                    <a href="#" class='' onClick="InformarFirma('<?php echo $historia->id ?>')" title="Botón para notificar a los interesados que el contrato esta listo para firmar">
                                        <i class="material-icons" style="font-size: 14px;">contact_mail</i>
                                    </a>
                                    <?endif;?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function Cargar(val) {
        $('#obras').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            type: "POST",
            url: '../turnos/consultaContrato.php',
            data: 'solicitante=' + val,
            success: function(resp) {
                $('#obras').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function editar(modal) {
        var options = {
            modal: true,
            height: 800,
            width: 600
        };
        // Realiza la consulta al fichero php para obtener información de la BD.
        $('#conte-modal').load('?c=contratacion&a=contratar&contrato_id=' + modal, function() {
            $('#bootstrap-modal').modal({
                show: true
            });
        });
    }

    function Soporte(contrato, cc) {

        $.ajax({
            data: {
                contrato_id: contrato,
                colaborador_cc: cc,
            },
            type: "post",
            url: "?c=contratacion&a=soporte",
            success: function(data) {
                $('#soporte_id').html(data);
            }
        });
    }

    function InformarFirma(id_contrato) {
        var options = {
            modal: true,
            height: 800,
            width: 600
        };
        // Realiza la consulta al fichero php para obtener información de la BD.
        $('#notificar').load('?c=contratacion&a=informar&contrato_id=' + id_contrato, function() {
            $('#notificar-modal').modal({
                show: true
            });
        });
    }

    function ver(modal) {
        var options = {
            modal: true,
            height: 800,
            width: 600
        };
        // Realiza la consulta al fichero php para obtener información de la BD.
        $('#conte-modal01').load('?c=Contrato&a=novedades&id=' + modal, function() {
            $('#bootstrap-modal1').modal({
                show: true
            });
        });
    }
</script>
<!-- // Novedades -->
<div class="modal fade" id="sop-modal" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Soporte del Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body" id="soporte_id">

            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
                <a href="javascript:location.reload()" class="bg-orange btn">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bootstrap-modal1" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novedad del Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div id="conte-modal01"></div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
                <a href="javascript:location.reload()" class="bg-orange btn">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="notificar-modal" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div id="notificar"></div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
                <a href="javascript:location.reload()" class="bg-orange btn">Cerrar</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // Modal -->
<div class="modal fade" id="bootstrap-modal" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Datos del Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
                <div id="conte-modal"></div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
                <a href="javascript:location.reload()" class="bg-orange btn">Cerrar</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // Modal -->
<div id="deleteProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="delete_product" id="delete_product">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Contrato# <?php echo $historia->id ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que quieres eliminar este registro?</p>
                    <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
                    <input type="hidden" name="delete_id" id="delete_id" value="<?php echo $historia->id ?>">
                </div>
                <div class="resultados" id="resultados"></div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input href="javascript:location.reload()" type="submit" class="btn btn-danger" onclick="Cargar0()" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {});
    $('#editProductModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var code = button.data('code')
        $('#edit_code').val(code)
        var name = button.data('name')
        $('#edit_name').val(name)
        var category = button.data('category')
        $('#edit_category').val(category)
        var stock = button.data('stock')
        $('#edit_stock').val(stock)
        var price = button.data('price')
        $('#edit_price').val(price)
        var id = button.data('id')
        $('#edit_id').val(id)
    })

    $('#deleteProductModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        $('#delete_id').val(id)
    })

    $("#delete_product").submit(function(event) {
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "?c=Contrato&a=eliminar",
            data: parametros,
            beforeSend: function(objeto) {
                $("#resultados").html("<div class='alert alert-success' role='alert'>Eliminado...</div> ");
            },
            success: function(datos) {
                $('#deleteProductModal').modal('hide');
                //	location.reload();
                $("#resultado").html("<div class='alert alert-success' role='alert'>Eliminado.</div> ");
            }
        });
        event.preventDefault();
    });
</script>