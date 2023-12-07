<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">Registrar</div>
            <div class="body">
                <form name="formdata" id="formdata" method="POST" role="form">
                    <div class="form-group">
                        <label for="">Segmento</label>
                        <input type="text" class="form-control" id="segmento" name="segmento" placeholder="Digita el Nombre" value="<?= $versegmento->nombre ?>">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $versegmento->id ?>">
                    </div>
                    <button title="Botón para registrar segmentos" type="botton" id="guardar" class="btn btn-guardar">Registrar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">Consultar</div>
            <div class="body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Segmento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($segmento as $value) : ?>
                            <tr>
                                <td><?= $value->id ?></td>
                                <td><?= ucfirst($value->nombre) ?></td>
                                <td style="vertical-align: middle;text-align: center;">
                                    <a title="Botón para editar nombre segmento" href="?c=pqrsf&a=segmento&id=<?= $value->id ?>" type="button" class="">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <button title="Botón para eliminar nombre segmento " type="button" style="border:none; background:#fff;" class="" onclick="Quitar(<?= $value->id ?>)">
                                        <i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#guardar', function(e) {
            e.preventDefault();
            var data = $("#formdata").serialize();
            $.ajax({
                data: data,
                type: "post",
                url: "?c=pqrsf&a=RegistrarSegmento",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'El registro se realizo con éxito',
                        text: response,
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                        window.location.href = '?c=pqrsf&a=segmento';
                    }, 1500)

                }
            });
        });
    });

    function Quitar(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el elemento.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    data: {
                        id: id
                    },
                    type: "post",
                    url: "?c=pqrsf&a=QuitarSegmento",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'El segmento se elimino con éxito',
                            text: response,
                            // timer: 1500,
                            showConfirmButton: false,
                        }, )
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 1500)

                    }
                });

            }
        });
    }
</script>