<div class="card">
    <div class="header">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-6">
                <h2 class="title">Seccion</h2>
            </div>
            <div class="col-xs-12 col-sm-6 align-right">

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
                    <th>Requisitos/Debes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($secciones as $seccion) : ?>
                    <tr>
                        <td><?= $seccion->numero ?></td>
                        <td><?= ucwords($seccion->titulo) ?></td>
                        <td>
                            <a data-toggle="modal" href='#my-modal' onclick="Requisitos('<?= $seccion->id ?>')" title="Edita los datos de la norma" data-valor="<?= $seccion->id ?>">
                                Ver Requisitos
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </p>
    </div>
</div>

<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-body" id="resultado">
                <p>Content</p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#registrarseccion', function(e) {
        $.ajax({
            type: "post",
            url: "?c=secciones&a=crud",
            data: {
                norma_id: <?= $_REQUEST['id'] ?>
            },
            beforeSend: function() {
                $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(response) {
                $('#resultado').html(response);
            }
        });
    })

    function Requisitos(valor) {
        $.ajax({
            data: {
                seccion: valor
            },
            type: "post",
            url: "?c=requisitos&a=obtener",
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
                    url: '?c=secciones&a=Eliminar',
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