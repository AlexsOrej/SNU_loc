<div class="col-md-4">
    <div class="row">
        <div class="card">
            <div class="header">
                <h4>Permisos</h4>
                <small>Registra los permisos del colaborador:
                    <strong><?php
                    // print_r($usuario_per); 
                   echo $usuario_per->nombres . ' ' . $usuario_per->apellidos ?>
                    </strong>
                </small>                
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Universos</label>
                        <select name="modulo" id="modulo" class="form-control">
                            <option value="">Seleccionar</option>
                            <? foreach ($modulos as $value) : ?>
                                <option value="<?= $value->id ?>"><?= $value->oferta ?></option>
                            <? endforeach; ?>
                        </select>
                        <div id="validar"></div>
                    </div>
                </div>
                <input type="hidden" id="usuario_id" name="usuario_id" value="<?= $_REQUEST['id'] ?>">
                <div class="text-center">
                    <input type="button" id="buscar" class="btn bg-green" value="Buscar">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <h4>Permisos Autorizados</h4>
                <small>Elimina los permisos del colaborador:
                    <strong><?= $usuario_per->nombres . ' ' . $usuario_per->apellidos ?></strong>
                </small>
            </div>
            <div class="body">
                <table class="table table-bordered" id='resultado1'>
                    <tr>
                        <th>Módulo</th>
                        <th>Acción</th>
                        <th style="text-align:center">Quitar</th>
                    </tr>
                    <? foreach ($datos as $value) : ?>
                        <tr>                            
                            <td><?= ucwords($value->controller) ?></td>
                            <td><?= ucwords($value->nombre) ?></td>
                            <td style="text-align:center">
                                <a type="" onclick="Quitar('<?= $value->auid ?>')" name="quitar" class="" value=""><i class="glyphicon glyphicon-trash col-red"></i></a>
                            </td>
                        </tr>
                    <? endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-8" id="resultado"></div>
<script>
    function Quitar(accion_id) {
        Swal.fire({
            title: 'Esta seguro?',
            text: "Recuerda que puedes activar el permiso de nuevo si es necesario!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Eliminalo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '?c=permisos&a=Accionquitar',
                    data: {
                        id: accion_id,
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Eliminado!',
                            text: 'El permiso fue eliminado.',
                            icon: 'success'
                        }).then(() => {
                            // Aquí puedes agregar cualquier lógica adicional que necesites después de la eliminación exitosa
                            // Por ejemplo, actualizar una tabla o lista de permisos                          
                            $('#resultado1').load(window.location.href + ' #resultado1');
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Se produjo un error al intentar eliminar el permiso.',
                            icon: 'error'
                        });
                    }
                });
            } else {
                // Si el usuario hace clic en "Cancelar", no se hace nada
                return;
            }
        });
    }

    $(document).on('click', '#buscar', function(e) {
        var modulos = document.getElementById('modulo').value;
        var usuario_id = document.getElementById('usuario_id').value;
        if (modulos === '') {
            $('#validar').html('<label class="font-bold col-red">Seleciona un universo</label>');
            setTimeout(function() {
                $('#validar').html('<label class="font-bold col-red">Seleciona un universo</label>').fadeOut();
            }, 1000)
        } else {
            $.ajax({
                type: "POST",
                url: '?c=permisos&a=controllers',
                data: {
                    modulo: modulos,
                    usuario_id: usuario_id,
                },
                beforeSend: function() {
                    $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(resp) {
                    $('#resultado').html(resp);
                }
            });
        }
    });
</script>