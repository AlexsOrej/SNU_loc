<div class="card">
    <div class="header"></div>
    <div class="body">
        <form id="form_asignargestion">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Proceso</label>
                                <select name="proceso" id="proceso" class="form-control select2" require>
                                    <option value="">Buscar</option>
                                    <? foreach ($proceso as $procesos) : ?>
                                        <option value="<?= $procesos->id ?>"> <?= $procesos->Iniciales . ' - ' . $procesos->NombreProceso ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Colaboradores</label>
                                <select name="usuarios" id="usuarios" class="form-control select2" require>
                                    <option value="">Buscar</option>
                                    <? foreach ($usuario as $usuarios) : ?>
                                        <option value="<?= $usuarios->id ?>"> <?= $usuarios->nombres . ' ' . $usuarios->apellidos ?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="">Actividad</label>
                                <select name="actividad" id="actividad" class="form-control select2" require>
                                    <option value="">Buscar</option>
                                    <option value="revisar">Revisar</option>
                                    <option value="aprobar">Aprobar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="neu">
                            <i class="glyphicon glyphicon-plus"></i>
                            Registrar
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <?php if ($asignados) { ?>
            <table id="asignados" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Proceso</th>
                        <th>Colaborador</th>
                        <th>Actividad</th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($asignados as $asignado) : ?>
                        <tr>
                            <td><?= $asignado->NombreProceso ?></td>
                            <td><?= $asignado->colaborador ?></td>
                            <td><?= ucfirst($asignado->actividad) . ' ' . 'Solicitudes' ?> </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <a onclick="Quitar('<?= $asignado->id ?>')" class="">
                                    <i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#form_asignargestion').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var isValid = true;

            // Verificar si hay campos vacíos
            form.find('select').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // Romper el bucle si se encuentra un campo vacío
                }
            });

            // Si algún campo está vacío, muestra un mensaje de error
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, completa todos los campos del formulario.',
                });
            } else {
                // Si no hay campos vacíos, enviar el formulario con AJAX
                $.ajax({
                    url: '?c=solicitudes&a=addAsignacion', // Cambia esto por la URL de tu controlador
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Maneja la respuesta aquí
                        Swal.fire({
                            icon: 'success',
                            title: 'El registro se realizó con éxito',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                         window.location.reload();
                        }, 1500);
                    }
                });
            }
        });
    });

    function Quitar(id) {
        // Muestra un cuadro de diálogo de confirmación al usuario
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            // Si el usuario confirma la eliminación, realiza la acción correspondiente
            if (result.isConfirmed) {
                $.ajax({
                    url: '?c=solicitudes&a=deleteAsignacion',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        // Maneja la respuesta aquí
                        Swal.fire({
                            icon: 'success',
                            title: 'El registro se eliminó con éxito',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                             window.location.reload();                            
                        }, 1500);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Maneja los errores de la petición AJAX aquí
                        console.error("Error:", textStatus, errorThrown);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error al eliminar el registro',
                            text: 'Por favor, intenta de nuevo más tarde',
                        });
                    }
                });
            }
        });
    }
</script>