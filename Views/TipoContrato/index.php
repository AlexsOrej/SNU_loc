            <div class="container-fluid">
                <div class="row">
                    <div class="pull-right">
                        <a name="registrar" id="registrar" data-toggle="modal" data-target="#modelId" type="button" class="neu">
                        Registrar</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tipo De Contratos</h3>
                </div>
                <div class="panel-body">
                    <table id="tbl_tipocontrato" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tipo De Contrato</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tipo as $value) : ?>
                                <tr>
                                    <td><?= $value->nombre ?></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <a style="cursor:pointer" onclick="Editar('<?= $value->id ?>')" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a style="cursor:pointer" onclick="Borrar('<?= $value->id ?>')"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row"> 
                                <!-- <div class="col-sm-6"><h4>Gestionar Contratos</h4></div>     -->
                                <div class="col-sm-12">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid" id="index"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-orange" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function Editar(id) {
                    $.ajax({
                        type: "POST",
                        url: "?c=tipocontratos&a=registrar",
                        data: {
                            id: id
                        },
                        success: function(resp) {
                            $('#index').html(resp);
                        }
                    });
                };

                function Borrar(val) {
                    Swal.fire({
                            title: "¿Estás seguro de eliminar este contrato?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }) 
                        .then((willDelete) => {
                            if (willDelete.value) {
                                $.ajax({
                                    type: "POST",
                                    url: '?c=tipocontratos&a=Delete',
                                    data: 'id=' + val,
                                    success: function(datos) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Bien Hecho!",
                                            text: datos,
                                            timer: 2000
                                        }, )
                                        setTimeout(function() {                                
                                            window.location.reload();
                                        }, 2000)
                                    }
                                });
                            }
                        });
                }

                // function Borrar(id) {
                //     confirmar = confirm("¿Deseas eliminar este registro?");
                //     if (confirmar)
                //         $.ajax({
                //             type: "POST",
                //             url: '?c=tipocontratos&a=Delete',
                //             data: {
                //                 id: id
                //             },
                //             success: function(resp) {
                //                // window.location.reload();
                //             }
                //         });
                // };

                $(document).ready(function() {
                    $('#registrar').click(function() {
                        $.ajax({
                            type: "POST",
                            url: "?c=tipocontratos&a=registrar",
                            success: function(resp) {
                                $('#index').html(resp);
                            }
                        });
                    });


                });
            </script>