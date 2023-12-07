<?php //print_r($colaborador) 
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Soportes</h3>
    </div>
    <div class="panel-body" id>
        <form id="form_soporte" name="form-soporte" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">

                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th>Soporte</th>
                                <th style="vertical-align: middle;text-align: center;"> 
                                    <a title="Botón para subir nuevo soporte del empleado" class="btn btn-primary" data-toggle="modal" href='#modal-id'> <i style="font-size:13px" class="glyphicon glyphicon-upload"></i> Subir Nuevo</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($soportes as $value) : ?>
                                <tr>
                                    <td >
                                        <? $ruta = 'Assets/soportes/' . $colaborador->cedula . '/' . $value; ?>
                                        <a href="<?= $ruta ?>" target="_blank"><?= ucwords($value) ?></a>
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <a onclick="Quitar('<?php echo $ruta; ?>')" class="">
                                            <i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Soporte</h4>
            </div>
            <div class="modal-body">
                <form id="miFormulario" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombre_archivo">Nombre del Soporte</label>
                            <input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo" placeholder="Nombre del archivo">
                        </div>
                        <div class="col-md-6">
                            <label for="archivo">Seleccionar el soporte</label>
                            <input type="file" accept=".pdf" name="archivo" id="archivo" class="form-control" required>
                            <input type="hidden" value="<?= $colaborador->cedula ?>" name="colaborador" id="colaborador">
                        </div>
                        <div class="col-md-12">
                            <br>
                            <input type="button" value="Subir" id="enviarFormulario" class="btn btn-guardar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="cerrar" class="btn bg-orange" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<script>
    $(document).ready(function() {
        $("#enviarFormulario").on("click", function() {
            // Obtén los valores de los campos
            var nombreArchivo = $("#nombre_archivo").val();
            var archivoInput = $("#archivo");

            // Verifica que el campo "nombreArchivo" no esté vacío
            if (nombreArchivo.trim() === "") {
                // Muestra un mensaje de error o realiza una acción adecuada
                alert("Por favor, ingresa un nombre de archivo.");
                return;
            }

            // Verifica que se haya seleccionado un archivo
            if (archivoInput.get(0).files.length === 0) {
                // Muestra un mensaje de error o realiza una acción adecuada
                alert("Por favor, selecciona un archivo.");
                return;
            }

            // Si ambos campos tienen valores, procede con la solicitud AJAX
            var formData = new FormData($("#miFormulario")[0]);
            $.ajax({
                url: "?c=soportes&a=SubirSoporte",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Maneja la respuesta del controlador aquí
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'El archivo ' + response + ' subió con éxito',
                        // timer: 1500,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Cierra el modal
                            setTimeout(function() {
                                $("#cerrar").click();
                            }, 500)
                            // Simula un clic en el botón con id "docs"
                            setTimeout(function() {
                                $("#docs").click();
                            }, 1500)

                        }
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Maneja los errores de la solicitud aquí
                    console.error(errorThrown);
                }
            });
        });
    });

    function Quitar(ruta) {
        Swal.fire({
            title: '¿Estás seguro de que deseas eliminar este soporte?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación
                $.ajax({
                    data: {
                        ruta: ruta
                    },
                    type: "post",
                    url: "?c=soportes&a=Eliminar",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'El soporte se eliminó con éxito',
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        setTimeout(function() {
                            $("#docs").click();
                        }, 1500)
                    }
                });
            }
        });
    }
</script>