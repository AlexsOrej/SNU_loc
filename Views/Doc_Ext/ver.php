<div class="card">
    <div class="header">
        <h2>
            Documentos Externos
            <!-- <small>de clic en el proceso para ver el listado de documentos</small> -->
        </h2>
    </div>
    <div class="body">        
    <table id="tbl_externos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Expedición</th>
                    <th>Descripción</th>                    
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documentos as $value) : ?>
                    <tr>
                        <td><?= $value->codigo?></td>                     
                        <td><a href="Assets/img/Externos/<?=$value->codigo?>.pdf" target="_blank" ><?= utf8_encode($value->nombre)  ?></a></td>
                        <td><?= $value->expedicion ?></td>  
                        <td><?= utf8_encode($value->descripcion)  ?></td>                       
                        <td>
                               
                            <!-- <a data-toggle="modal" href='#modal-id' type="button" onclick="Get('<?=$value->id ?>')" title="Ver datos del Documento">
                                <i class="material-icons">visibility</i>-->
                            </a>
                            <?php if ($_SESSION['user']->rol_id == 4 or $_SESSION['user']->rol_id == 1) : ?>
                                <a data-toggle="modal" href='#modal-id' type="button" onclick="Edit('<?=$value->id ?>')" type="button" title="Actualizar datos del Documento">
                                    <i class="material-icons">system_update</i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="resultado">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
   function Get(doc_id){
    var doc_id =  doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=documentos&a=Getdoc",            
            success: function(data) {
                $('#resultado').html(data);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
   }
   function Edit(doc_id){
    var doc_id =  doc_id
        $.ajax({
            data: {
                doc_id: doc_id
            },
            type: "post",
            url: "?c=documentos&a=Edit",            
            success: function(data) {
                $('#resultado').html(data);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
   }
</script>
