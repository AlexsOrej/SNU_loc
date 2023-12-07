<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Grupo Familiar</h2>
                <div style="margin-bottom:10px" class="header-dropdown m-r--1">
                    <button  title="Botón para registrar un familiar" type="" class="btn  bg-blue" id="user_id" value="<?= isset($_REQUEST['id']) ? $_REQUEST['id'] : $id ?>">
                        <i style="color:#FFF !important; font-size:13px" class="material-icons col-amber">contacts</i> Registrar</button>
                </div>
            </div>

            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Parentesco</th>
                                <th>Fecha Nacimiento</th>
                                <th>Número de Contacto</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Parentesco</th>
                                <th>Fecha Nacimiento</th>
                                <th>Número de Contacto</th>
                                <th>-</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($grupof as $r) : ?>
                                <tr>
                                    <td><?php echo $r->nombre; ?></td>
                                    <td><?php echo $r->apellidos; ?></td>
                                    <td><?php echo $r->parentesco; ?></td>
                                    <td><?php echo $r->fecha_nacimiento; ?></td>
                                    <td><?php echo $r->contacto; ?></td>
                                    <td style="vertical-align: middle;text-align: center;" >
                                       <!-- <button type="button" id="editar" onclick="Editar(<?= $r->id ?>)"  class=""><i class="glyphicon glyphicon-edit"></i></button> -->
                                       <a href="#" title="Botón para editar información del familiar" id="editar" onclick="Editar(<?= $r->id ?>)"  class=""><i class="glyphicon glyphicon-edit"></i></a>
                                       <a href="#" title="Botón para eliminar información de un familiar" onclick="Borrar(<?php echo $r->id; ?>)"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
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
<!-- #END# Exportable Table -->
<script>
    $('#user_id').on('click', function() {
        var id = document.getElementById("user_id").value

        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=crud',
            data: {
                user_id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);

            }
        });
    });

    function Editar(id) {

        $.ajax({
            type: "POST",
            url: '?c=grupofamiliar&a=crud',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#resultado').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#resultado').html(resp);
                // window.location.reload(1);

            }
        });
    }

    function Borrar(id) {
        confirmar = confirm("¿Deseas eliminar este registro?");
        if (confirmar)
            $.ajax({
                type: "POST",
                url: "?c=grupofamiliar&a=Eliminar",
                data: {
                    idf: id
                },
                success: function(resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro eliminado con éxito',
                        timer: 1000,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000)
                }
            });
    }
</script>