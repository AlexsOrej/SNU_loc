<table id="tbl_val_mant" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Item</th>
            <th>carateristicas</th>
            <th>Quitar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mantenimientos as $value) : ?>
            <tr>
                <td><?= $value->produId ?></td>
                <td><?= $value->produNombre ?></td>
                <td class="text-justify"><?= utf8_encode($value->carateristicas) ?></td>

                <td style="vertical-align: middle;text-align: center;" class="text-justify">
              <?  if($_SESSION['rol']!='proveedor'):  ?> 
                <a title="Botón para eliminar elemento" class="" onclick="Quitar('<?= $value->id ?>')" data-toggle="modal" href='#modal-id'><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a></td>
              <? endif;?>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    function Quitar(val) {
        var id = val
        $.ajax({
            data: {
                productoId: id
            },
            type: "post",
            url: "?c=mantenimientos&a=quitar",

            success: function(resp) {
                Swal.fire({
                        title: "Estas seguro?",
                        text: "Esta acción no puede ser desecha",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "SI",
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                        //  timer: 1500
                    },

                    function(isConfirm) {
                        if (isConfirm) {
                            form.submit();
                            setTimeout(function() {
                                //window.location = '?c=indicadors&a=index';
                                window.location.reload(1);
                            }, 2000) // submitting the form when user press yes
                        } else {
                            swal.fire("Cancelado", ";)");
                        }
                    });


                setTimeout(function() {
                    //window.location = '?c=indicadors&a=index';
                   // window.location.reload(1);
                }, 2000)

            }
        });
    }
</script>