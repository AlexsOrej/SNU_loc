<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Cartelera</div>
    <div class="panel-body">
        <p>
            <a id="btn-registro" class="neu pull-right" data-toggle="modal" href='#modal-id' onclick="Registro()">Registrar</a>
        </p>
    </div>

    <!-- Table -->
    <table id="exercise" class="table table-bordered">
        <thead>
            <tr>
                <th>Titulos</th>
                <th>Asunto</th>
                <th>Vigencia</th>
                <th>Usuario</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cartelera as $value): ?>
            <tr>
                <td><?= $value->titulo?> </td>
                <td><?= $value->contenido?> </td>
                <td><?= $value->vigencia?> </td>
                <td><?= $value->usuario_id ?> </td>
                <td>
                    <button type="button" class="" onclick="ver(<?=$value->id;?>)">
                    <i class="glyphicon glyphicon-eye-open"></i></button>
                    <button type="button" data-toggle="modal" href='#modal-id' class="" onclick="Editar(<?=$value->id;?>)">
                    <i class="glyphicon glyphicon-edit"></i></button>
                    <button type="button" class="" onclick="Eliminar(<?=$value->id;?>)">
                    <i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cartelera</h4>
            </div>
            <div class="modal-body" id='cartel'>
                
            </div>
            
        </div>
    </div>
</div>


<script>
     function Registro(){
        
        $.ajax({            
            type: "post",
            url: "?c=cartelera&a=crud",
            success: function(response) {
                $('#cartel').html(response)
            }
        });
    }
     function Editar(id){
        var data= id;
        $.ajax({
            data: {id:id},
            type: "post",
            url: "?c=cartelera&a=crud",
            success: function(response) {
                $('#cartel').html(response)
            }
        });
    }


    function Eliminar(val) {
        Swal.fire({
                title: "¿Estás seguro de eliminar el mensaje?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "POST",
                        url: '?c=cartelera&a=eliminar',
                        data: 'id=' + val,
                        success: function(datos) {
                            Swal.fire({
                                icon: "success",
                                title: "Bien Hecho!",
                                text: datos,
                                timer: 2000
                            }, )
                            setTimeout(function() {                                
                              window.location.reload();
                            }, 2000)
                        }
                    });
                }
            });
    }
</script>