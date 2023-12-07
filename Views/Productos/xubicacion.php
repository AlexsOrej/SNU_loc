<style>
.table-bordered tbody tr td, .table-bordered tbody tr th {
  text-align: justify; 
}
.modal-lg {
    /* width: 1020px;    */
    padding:  10px,10px; 
}
</style>
<? $referer = $_SERVER['HTTP_REFERER'];?>
<table id="table" class="table table-bordered">
    <thead>
        <tr>
            <th>Número</th>
            <th>Nombre</th>
            <th>Caracteriscas</th>
            <th>Estado</th>
            <th>Menu</th>
        </tr>
    </thead> <img src="" width="" alt="">
    <tbody>
        <?php foreach ($productos as $value) : ?>
            <tr>
                <td width="5%"><?= $value->id ?></td>
                <td width="15%"><?= $value->nombre ?></td>
                <td width="40%" ><?= utf8_encode($value->carateristicas)?></td>
                <td width="20%" ><?= $value->estado?></td>
                <td style="vertical-align: middle;text-align: center;" width="20%">
                    <!-- <a  href="#" title="Botón para ver la ficha del producto" data-toggle="modal" data-target="#modelId"  onclick="Ficha('<?=$value->id ?>')"><i class="glyphicon glyphicon-wrench"></i></a> -->
                   <?php if($referer!="https://calidadsnu.com/snu/?c=productos&a=prestamos"):?>
                    <a href="#"  title="Botón para editar datos del producto" data-toggle="modal" data-target="#modelId"  onclick="Editar('<?=$value->id ?>')" ><i class="glyphicon glyphicon-edit"></i></a>
                    <a  href="#" title="Botón para cambiar estado del producto" data-toggle="modal" data-target="#modelId"  onclick="Estado('<?=$value->id ?>')" ><i class="glyphicon glyphicon-retweet"></i></a>
                    <?php endif; ?>
                    <a href="#" title="Botón para hacer prestamo del producto"  data-toggle="modal" data-target="#modelId"  onclick="Prestamo('<?=$value->id ?>')" ><i class="glyphicon glyphicon-share-alt"></i></a>
               
                  
                    <!-- <a title="" ><i class="glyphicon glyphicon-trash"></i></a> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="resultados"></div>
         </div>
    </div>
</div>
<script>    
        function Ficha(val) {
                var id = val;
                $.ajax({
                    type: "POST",
                    url: "?c=productos&a=ver",
                    data: {id:id},
                    success: function(resp) {
                        $('#resultados').html(resp);
                        
                    }
                })
            }
            function Editar(val) {
                var idproducto = val;
                $.ajax({
                    type: "POST",
                    url: "?c=productos&a=crud",
                    data: {idproducto:idproducto},
                    success: function(resp) {
                        $('#resultados').html(resp);
                       
                    }
                })
            }
            function Estado(val) {
                var id = val;
                $.ajax({
                    type: "POST",
                    url: "?c=productos&a=estado",
                    data: {id:id},
                    success: function(resp) {
                        $('#resultados').html(resp);
                        
                    }
                })
            }
            function Prestamo(val) {
                var id = val;
                $.ajax({
                    type: "POST",
                    url: "?c=productos&a=Prestar",
                    data: {id:id},
                    success: function(resp) {
                        $('#resultados').html(resp);
                        
                    }
                })
            }
</script>
