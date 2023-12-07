<style>
.table-bordered tbody tr td, .table-bordered tbody tr th {
    padding: 4px;
    border: 1px solid #eee;
    text-align: justify; 
    border-radius: 10px;
}
</style>
<?php print_r($productos);?>
<form action="?c=traslados&a=masivo" method="POST" name="" id="">
<div class="row">    
 <div class="col-md-12">
    <label for="">ELIGIR LA UBICACIÓN PARA TRASLADAR:</label>
    <select name="ubicacion" id="ubicacion" class="form-control" >
        <?php  foreach($ubicaciones as $value):?>
        <option value="<?=$value->sede_id."/". $value->ubicacion_id?>"><?=$value->nomSede." ".$value->nomUbicacion ?> </option>
        <?php endforeach;?>
    </select>
  </div>
  <div class="col-md-12"> 
      <label for="">NOVEDAD</label>
      <textarea  name="novedad" id="novedad" class="form-control" required ></textarea>    
      <input type="hidden" name="user_id" value="<?=$_SESSION['user']->user_id?>">
  </div>
</div>
<br>
<table id="#tbl_traslado" class="table table-bordered">
    <thead>
        <tr>
            <th>Número</th>
            <th>Nombre</th>
            <th>Caracteriscas</th>
            <th>Marcar</th>
        </tr>
    </thead> 
    <tbody>
        <?php  foreach ($productos as $key => $value) : ?>
            <tr>
                <td width="5%"><?= $value->id ?></td>
                <td width="5%"><?= $value->nombre ?></td>
                <td width="85%" ><?= utf8_encode($value->carateristicas) ?></td>
                <td width="5%" style=" text-align:center ">                
                <input name="productos[<?php echo $key; ?>]->id" type="checkbox" class="Filled In" id="<?php echo $value->id; ?>" value="<?php echo $value->id; ?>"/>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button type="submit" class="btn btn-primary btn-block">Registrar</button>
</form>
<!-- DataTables  & Plugins -->
<script src="Assests/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="Assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="Assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Assests/plugins/jszip/jszip.min.js"></script>
<script src="Assests/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Assests/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Assests/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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

</script>
<script>
    $(function() {
        $("#example1").DataTable({

            language: {
                search: "Buscar:",
                paginate: {
            previous: '‹',
            next:     '›'
        },
        aria: {
            paginate: {
                previous: 'Anterior',
                next:     'Siguiente'
            }
        }
            },
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>