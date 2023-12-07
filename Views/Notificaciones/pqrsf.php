 <?php 
//  print_r($notifs)?>
 
 <div class="col-md-12">
     <div class="card">
         <div class="header">
             <h3 class="panel-title">Notificaciónes</h3>
             <a href='?c=notificaciones&a=notificar_pqrsf' class="btn btn-default">Registrar</a>
         </div>
         <div class="body">
             <table class="table table-bordered" id="result">
                 <tr>                    
                     <th>Usuario</th>
                     <th>Correo</th>
                     <th>Notificar</th>
                     <th>Menu</th>
                 </tr>
                 <? foreach ($notifs as $value) : ?>
                     <tr>
                         
                         <td><?= $value->usuario_id ?></td>
                         <td><?= $value->email ?></td>
                         <td><?php
                                $accion = json_decode($value->accion, true);
                                foreach ($accion as $value0) {
                                    echo ucwords($value0).' ';
                                };
                                ?></td>
                         <td>                             
                             <a onclick="Borrar('<?= $value->id ?>')" type="button" title="Borrar datos ">
                                 <i class="material-icons">delete</i>
                             </a>
                         </td>
                     </tr>
                 <? endforeach; ?>
             </table>
         </div>
     </div>
 </div>
 <script>
     function Borrar(id) {
         confirmar = confirm("¿Deseas eliminar este registro?");
         if (confirmar)
             $.ajax({
                 type: "POST",
                 url: '?c=notificaciones&a=borrar',
                 data: {
                     id: id
                 },
                 success: function(resp) {
                     $('#result').load(window.location.href + ' #result');
                 }
             });
     }
 </script>