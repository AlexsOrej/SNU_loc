<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Postulados</h3>
        <div class="btn-toolbar" role="toolbar" aria-label="">
            <div class="btn-group" role="group" aria-label="">
                <a title="Botón para registrar un nuevo aspirante " href="?c=seleccion&a=FormAspirante" class="btn btn-primary" type="button">
                    <i class="material-icons">add_reaction</i>
                    Registrar
                </a>
                <button title="Botón para importar datos de los aspirantes" type="button" class="btn btn-primary" id="importar">
                    <i class="material-icons">cloud_upload</i>
                    Importar
                </button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table id="tbl_aspirante" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombres Apellidos</th>
                    <th>Cedula</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>CV</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postulados as $value) : ?>
                    <tr>
                        <td><?= ucwords($value->nombre) ?>
                            <?= ucwords($value->apellidos) ?></td>
                        <td><?= $value->cedula ?></td>
                        <td><?= $value->correo ?></td>
                        <td><?= $value->celular ?></td>
                        <td style="width: fit-content;">
                            <?php
                            $nombre_fichero = 'Assets/hojasVida/' . $value->cedula . '/' . $value->cedula . '.pdf';
                            if (file_exists($nombre_fichero)) { ?>
                                <a href="Assets/hojasVida/<?= $value->cedula ?>/<?= $value->cedula ?>.pdf" target="_blank"><span class="label label-success">Abrir</span></a>
                            <?php
                            } else { ?>
                                <span class="label label-warning">N/A</span>
                            <?php  } ?>
                        </td>
                        <td class="align-center" style="width: auto;vertical-align: middle;text-align: center;">
                            <!--ir al panel de gestion -->
                            <a href="?c=seleccion&a=gestion&id=<?= $value->id ?>" class="efecto"  title="Botón para gestionar la información">
                                <i style="font-size:18px" class="material-icons">manage_accounts</i></a>
                            <a href="#" type="button" id="procesar" title="Botón para procesar el aspirante" onclick="Procesar('<?= $value->id ?>')" data-toggle="modal" data-target="#modelId" class="efecto">
                                <i style="font-size:18px; color:#FF9800" class="material-icons">published_with_changes</i>
                            </a>
                            <a href="#" type="button" id="quitar" title="Botón para eliminar el aspirante" onclick="confirmarEliminar('<?= $value->id ?>')" class="efecto">
                                <i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="resultado">

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#importar').click(function() {
            $.ajax({
                type: "POST",
                url: '?c=seleccion&a=imporpersonal',
                success: function(resp) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Los datos de importaron con éxito',
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500)
                }
            });
        })
    });

    function Procesar(dato) {
        $.ajax({
            type: "POST",
            url: '?c=contratacion&a=procesar',
            data: {
                id: dato
            },
            success: function(resp) {
                $('#resultado').html(resp);
            }
        });
    }

    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Quitar(id);
            }
        });
    }

    function Quitar(id) {
        // Aquí iría la implementación de la función para eliminar el elemento
        // Puedes utilizar AJAX para enviar una solicitud al servidor u otro método apropiado
        console.log("Eliminar elemento con ID:", id);
        $.ajax({
            type: "POST",
            url: '?c=seleccion&a=quitar',
            data: {
                id: id,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: response,
                    timer: 1500
                }, )
                setTimeout(function() {
                    window.location.reload();
                }, 1500)
            }
        });
    }

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>