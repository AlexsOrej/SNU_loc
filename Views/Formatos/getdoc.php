<?php print_r($documentos)?>
<div class="card">
    <div class="header">
        <h2>
            Documento         
        </h2>
    </div>
    <div class="body">
        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th>Codigo</th>                        
                    
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Version</th>
                    <th>Recuperación</th>
                    <th>Emision</th>
                    <th>Actualización</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
            <td><?php echo $documentos->CodDocumento?></td>
            <td><?php echo $documentos->NomDocumento?></td>
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
            success: function(resp) {
                $('#resultado').html(resp);
                //$('#resultado').html("<div class='alert alert-success'></div>");
            }
        });
   }
</script>
