<div class="card">
    <div class="header">Ubicaciones</div>
    <div class="body">
        <table id="tbl_Ubicacion1" class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Ubicaciones</th>
                    <th>Elegir</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($ubicacions as $value) : ?>
                    <tr>
                        <td><?= $value->id ?></td>
                        <td><?= $value->nombre ?></td>
                        <td><input type="checkbox" <?php if (in_array($value->id, $ubicacionesignados)) echo 'checked="checked"'; ?>></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
        <script>
            $(document).on('change', '#tbl_Ubicacion1 input[type="checkbox"]', function() {
                // Obtener el valor del atributo 'id' del registro actual
                var idRegistro = $(this).closest('tr').find('td:first-child').text();
                // Obtener si el checkbox está marcado o no
                var isChecked = $(this).is(':checked');

                // Hacer algo con los valores obtenidos, por ejemplo, imprimirlos en la consola
                console.log('Registro ' + idRegistro + ' marcado: ' + isChecked);
                if (isChecked) {
                    var estado = 1
                } else {
                    var estado = 0
                }
                $.ajax({
                    type: "POST",
                    url: '?c=rotativos&a=asigna_ubicacion',
                    data: {
                        ubicacion_id: idRegistro,
                        estado: estado
                    },
                    beforeSend: function() {
                        $('#hecho').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Asignando</p> </div>");
                    },
                    success: function(resp) {
                        // $('#tbl_Ubicacion1').load(window.location.href + ' #tbl_Ubicacion1');
                        $('#hecho').html("");
                        // window.location.reload(1);
                    }
                });
            });
        </script>