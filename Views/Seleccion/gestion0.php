<div class="panel panel-default">
    <div class="panel-heading text-center">
        Información General  
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <button class="neu" id="editar">Editar</button>
        </div>
        <div class="col-md-12 image-area" id="contenido">
            <div class="col-md-12 card profile-card">
                <div class="content-area">
                    <p>
                    <table class="table">
                        <tr>
                            <th colspan="6">
                                <div class="col-md-2">
                                    <img src="Assets/img/<?= $_SESSION['datos_cliente']->nombre ?>/Fotos/<?= $persona->cedula ?>.jpeg" class="card-img-top img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" width="120" height="auto" alt="FOTO DEL EMPLEADO">
                                </div>
                                <div class="col-md-10">
                                    <h3><?= ucwords($persona->nombre . ' ' . $persona->apellidos) ?></h3>

                                    <form method="post" action="#" name="formCrud" id="formCrud" enctype="multipart/form-data">
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <label>Subir Foto</label>
                                                <!-- <input type="file" class="form-control-file" name="image" id="image">                                                   -->
                                                <input type="file" class="form-control" name="image" id="image">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="hidden" name="foto_nom" id="foto_nom" value="<?= $persona->cedula ?>">
                                            <input type="hidden" name="personal_id" id="personal_id" value="<?= $_REQUEST['id'] ?>">
                                            <input type="button" name="registro" class="btn btn-primary upload neu" value="Subir" />
                                        </div>
                                    </form>
                                </div>
                            </th>
                        </tr>
                        <tr class='active'>
                            <th>Identificación</th>
                            <th>Fecha Expedición</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Ciudad residencia</th>
                            <th>Dirección</th>
                        </tr>
                        <tr>
                            <td><?= $persona->cedula ?></td>
                            <td><?= $persona->expedicion ?></td>
                            <td><?= $persona->correo ?></td>
                            <td><?php
                                if ($persona->rol_id == '1') {
                                    echo '<span class="label label-info">Aspirante</span>';
                                }
                                if ($persona->rol_id == '2') {
                                    echo '<span class="label label-info">Seleccionado</span>';
                                }
                                if ($persona->rol_id == '3') {
                                    echo '<span class="label label-info">Contratado</span>';
                                }
                                if ($persona->rol_id == '4') {
                                    echo '<span class="label label-info">Rechazado</span>';
                                }
                                ?></td>
                            <td><?= $persona->ciudad_recidencia ?></td>
                            <td><?= $persona->direccion ?></td>
                        </tr>

                        <tr class="active">
                            <th>Barrio</th>
                            <th>Expedición</th>
                            <th>RH</th>
                            <th>Lugar Nacimiento</th>
                            <th>Fecha Nacimiento</th>
                            <th>Sexo</th>
                        </tr>
                        <tr>
                            <td><?= ucfirst(strtolower($persona->Barrio)) ?></td>
                            <td><?= $persona->expedicion ?></td>
                            <td><?= $persona->rh ?></td>
                            <td><?= $persona->LugarNacimiento ?></td>
                            <td><?= $persona->FechaNacimiento ?></td>
                            <td><?= $persona->Sexo == 1 ? 'Masculino' : 'Femenino' ?></td>
                        </tr>
                        <tr class="active">
                            <th>Telefono fijo</th>
                            <th>Celular</th>
                            <th>Fecha Registro</th>
                        </tr>
                        <tr>
                            <td><?= $persona->telefono_fijo ?></td>
                            <td><?= $persona->celular ?></td>
                            <td><?= $persona->FechaRegistro ?></td>
                        </tr>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $(".upload").on('click', function() {
                            // var formData = new FormData();
                            var formData = new FormData($("#formCrud")[0]);
                            var files = $('#image')[0].files[0];
                            console.log(files);
                            if (typeof files === 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Debe Seleccionar la imagen',
                                    timer: 1500
                                }, )
                            } else {
                                formData.append('file', files);
                                $.ajax({
                                    url: '?c=subirs&a=UploadFoto',
                                    type: 'post',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response != 0) {
                                            $(".card-img-top").attr("src", response);
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'BIEN HECHO!!',
                                                timer: 1500
                                            }, )
                                            setTimeout(function() {
                                              window.location.reload();
                                            }, 1500)
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'El formato de la imagen es incorrecto, usa jpg o jpeg',
                                                timer: 1500
                                            }, )
                                        }
                                    }
                                });
                            }
                            return false;
                        });
                        $("#editar").on('click', function() {
                            const personal_id = $('#personal_id').val();
                            $.ajax({
                                url: '?c=personas&a=crud',
                                type: 'post',
                                data: {
                                    personal_id: personal_id,
                                },
                                success: function(resp) {
                                    $('#contenido').html(resp);
                                }
                            })
                        });
                        

                    });
                </script>
