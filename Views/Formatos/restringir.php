<div class="row">
    <form name="formdata" id="formdata">
        <div class="col">
            <label for="usuario_id">Colaborador Autorizado</label>
            <select name="usuario_id" id="usuario_id" class="form-control">
                <?php foreach ($usuarios as $usuario) : ?>
                    <option value="<?= $usuario->id ?>"><?= $usuario->nombres . ' ' . $usuario->apellidos ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $_REQUEST['doc_id'] ?>">
        </div>
        <div class="col text-center">
            <br>
            <button id="botonenviar" class="btn  bg-green">Autorizar</button>
        </div>
    </form>
    <div class="col text-center">
        <h3>Autorizados</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autorizados  as $value) : ?>
                    <tr>
                        <td><?= $value->restricion_id ?></td>
                        <td><?= $value->fullNombre ?></td>
                        <td style="vertical-align: middle;text-align: center;"><button type="button" class="" style="background:none; border:none" onclick="Quitar('<?php echo $value->restricion_id ?>')"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></button></td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>
<script>
  function enviarDatos() {
        var data = $("#formdata").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=usuarios&a=autorizar_colaborador",
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'El registro se realizó con éxito',
                    timer: 1500,
                    showConfirmButton: false
                });
                setTimeout(function() {
                    window.location.href = '?c=formatos&a=index';
                }, 1500);
            }
        });
    }

    // Desenlazar eventos anteriores y enlazar el evento click al botón #botonenviar
    $(document).off('click', '#botonenviar').on('click', '#botonenviar', function(e) {
        e.preventDefault();
        enviarDatos();
    });

    function Quitar(id) {
        // Muestra un cuadro de diálogo de confirmación
        if (confirm('¿Estás seguro de que deseas remover el acceso?')) {
            // El usuario confirmó, realiza la eliminación          
            $.ajax({
                data: {
                    id: id
                },
                type: "post",
                url: "?c=usuarios&a=QuitarAutorizado",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Removio con éxito',
                        text: response,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location.href = '?c=formatos&a=index';
                    }, 1500);
                }
            });
        } else {
            //  El usuario canceló la eliminación
            // Puedes realizar cualquier otra acción que desees o simplemente ignorarla
        }
    }
</script>