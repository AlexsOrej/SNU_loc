<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h2 class="title">Requisito</h2>
                            <h4 class="mute"><?=$requisitos->numero.'. '.$requisitos->descripcion ?></h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button class="neu" id="registrarseccion">Registrar Debe</button>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <p class="text">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Descripción</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($debe as $debes) : ?>
                                <tr>
                                    <td><?= $debes->numero ?></td>
                                    <td><?= ucwords($debes->descripcion) ?></td>
                                    <td>
                                        <a onclick="Editar('<?= $debes->id ?>')" title="Edita los datos de la norma" data-valor="<?= $debes->id ?>"> <span class="glyphicon glyphicon-edit"></span></a>
                                        <a onclick="Quitar('<?= $debes->id ?>')" title="Elimina la norma">
                                            <span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="?c=debes&a=index&requisito=<?= $debes->id ?>" title="Gestionar la secciones de la norma"> <span class="glyphicon glyphicon-list"></span></a></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="resultado"></div>
    </div>
</div>
<script>
    $(document).on('click', '#registrarseccion', function(e) {
        $.ajax({
            type: "post",
            url: "?c=debes&a=crud",
            data: {
                requisito_id: <?= $_REQUEST['requisito'] ?>
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(response) {
                $('#resultado').html(response);
            }
        });
    })

    function Editar(valor) {
        $.ajax({
            data: {
                norma_id: valor
            },
            type: "post",
            url: "?c=debes&a=crud",
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(response) {
                $('#resultado').html(response);
            }
        });
    }

    function Quitar(valor) {
        // Mostrar el cuadro de confirmación con SweetAlert
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará la norma. ¿Deseas continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirmó, realizar la eliminación
                $.ajax({
                    data: {
                        norma_id: valor
                    },
                    type: 'post',
                    url: '?c=debes&a=Eliminar',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500)

                    }
                });
            }
        });
    }
</script>