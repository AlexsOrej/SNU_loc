<section>
    
    <div class="panel">
        <div class="panel-heading text-right">
            <button title="Botón para registrar universos" onclick="Ver1()" data-toggle="modal" href='#modal-id' class="neu  text-center bg-light-blue"><i class="glyphicon glyphicon-plus"></i> Registrar modulo</button>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="row">
                    <div class="responsive">
                        <table id="tbl_servicios" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Universo</th>
                                    <th>Fecha</th>
                                    <th>Dias Restantes</th>
                                    <th>Estado</th>
                                    <th style="vertical-align: middle;text-align: center;">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($servicios as $value) : ?>
                                    <tr>
                                        <td><?php echo  strtoupper($value->cliente)  ?></td>
                                        <td><?php echo $value->oferta ?></td>
                                        <td><?php echo $value->f_inicio ?></td>
                                        <td><?= $resultado = $this->model->calcularDiasPasadosOVigentes($value->f_inicio); ?></td>
                                        <td><?php echo $value->estado == 1 ? '<span style="color:#4CAF50" class=""><i class="fas fa-circle"></i> Activo</span>' : '<span style="color:#EB2A2A" class=""><i class="fas fa-circle"></i> Inactivo</span>' ?></td>
                                        <td style="vertical-align: middle;text-align: center;">
                                            <a title="Botón para editar un modulo" onclick="Ver('<?= $value->servicios_id ?>')" data-toggle="modal" href='#modal-id' class=""><i class="glyphicon glyphicon-edit"></i></a>
                                            <a title="Botón para eliminar un modulo" onclick="Borrar('<?= $value->servicios_id ?>')" class="" href="#"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
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
</section>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Agregar Servicio</h4>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>

<script>
    function Ver(id) {
        var val = id;
        $.ajax({
            type: "POST",
            url: '?c=servicios&a=crud',
            data: 'id=' + val,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Ver1() {
        $.ajax({
            type: "POST",
            url: '?c=servicios&a=crud',
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Borrar(val) {
        Swal.fire({
                title: "¿Estás seguro de eliminar este Servicio?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "POST",
                        url: '?c=servicios&a=delete',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: 'success',
                                title: 'BIEN HECHO!!',
                                timer: 2000
                            }, )
                            setTimeout(function() {
                                //  window.location = '?c=solicitudes&a=index';
                                window.location.reload();
                            }, 2000)
                        }
                    });
                }
            });
    }
</script>