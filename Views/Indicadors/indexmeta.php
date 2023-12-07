<?php //print_r($cargos)
?>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12">
                        <h2>LISTADO DE METAS</h2>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="sgcDocumentos index">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Meta</th>
                                    <th>Fecha</th>
                                    <th>Menu</th>
                                </tr>
                            <tbody>
                                </thead>
                                <?php
                                //debug($indicadors);

                                foreach ($metas as $value) : ?>
                                    <tr>
                                        <td><?php echo $value->comparativo ?></td>
                                        <td><?php echo $value->valor ?></td>
                                        <td><?php echo $value->fecha_uso ?>&nbsp;</td>

                                        <td class="actions">
                                            <a onclick="Editar('<?= $value->id ?>')" type="button" class="" title="Editar meta">
                                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                            </a>
                                            <a onclick="Quitar('<?= $value->id ?>')" type="button" class="" title="Quitar metas">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->
<div id="metas1"></div>

<script>
    function Editar(val) {
        var id = val
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=indicadors&a=meta",

            success: function(resp) {
                $('#metas1').html(resp);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
    }

    function Quitar(val) {
        var id = val
        $.ajax({
            data: {
                id: id
            },
            type: "post",
            url: "?c=indicadors&a=quitar",

            success: function(resp) {
                Swal.fire({
                        title: "Estas seguro?",
                        text: "Esta acción no puede ser desecha",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                        //  timer: 1500
                    },

                    function(isConfirm) {
                        if (isConfirm) {
                            form.submit();
                            setTimeout(function() {
                                window.location = '?c=indicadors&a=index';
                                // window.location.reload(1);
                            }, 2000) // submitting the form when user press yes
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });


                setTimeout(function() {
                    //window.location = '?c=indicadors&a=index';
                    // window.location.reload(1);
                }, 2000)

            }
        });
    }
</script>