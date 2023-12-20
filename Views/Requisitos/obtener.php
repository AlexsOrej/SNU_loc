<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="header">
            </div>
            <div class="body">
                <p class="text" id="req_guardado"></p>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Descripción</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requisitos as $requisito) : ?>
                            <tr>
                                <td><?= $requisito->numero ?></td>
                                <td><?= ucwords($requisito->descripcion) ?></td>
                                <td id="resultado">
                                    <input type="checkbox" id="miCheckbox" onchange="Asociar('<?= $requisito->id ?>')" >
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    function Asociar(valor) {
        var valorNorma = valor;
        var isChecked = $('#miCheckbox').prop('checked');

        if (isChecked) {
            console.log('El checkbox ha sido marcado.');
        } else {
            console.log('El checkbox ha sido desmarcado.');
        }

        $.ajax({
            type: "post",
            url: "?c=requisitos&a=asociar",
            data: {
                requisito_id: valorNorma,
                isChecked: isChecked
            },
            beforeSend: function() {
                $('#req_guardado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(response) {
                $('#req_guardado').html(response);
            }
        });
    }
</script>