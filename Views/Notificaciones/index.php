 <div class="col-md-12">
     <div class="card">
         <div class="header">

            <div class="row">
                <div class="col-md-9 text-center">
                    <h3 class="panel-title">Notificaciónes</h3>
                </div>
                <div class="col-md-3">
                     <a  title="Botón para registrar notificaciones" href='?c=notificaciones&a=crud' class="neu pull-right text-decoration-none btn-notificar"><i class="glyphicon glyphicon-plus"></i> Registrar notificación</a>
                </div>
            </div>


            
             <div class="container-fluid">
                <!-- <a title="Botón para registrar notificaciones" href='?c=notificaciones&a=crud' class="neu pull-right text-decoration-none"><i class="glyphicon glyphicon-plus"></i> Registrar</a> -->
             </div>
         </div>
         <div class="body">
             <table class="table table-bordered" id="result">
                 <tr>
                     <th>Módulo</th>
                     <th>Usuario</th>
                     <th>Correo</th>
                     <th>Notificación de</th>
                     <th>Menu</th>
                 </tr>
                 <? foreach ($notifs as $value) : ?>
                     <tr>
                         <td><?= $value->oferta ?></td>
                         <td><?= $value->usuario_id ?></td>
                         <td><?= $value->email ?></td>
                         <td><?php
                                $accion = json_decode($value->accion, true);
                                foreach ($accion as $value0) {
                                    echo ucwords($value0).' ';
                                };
                                ?></td>
                         <td style="vertical-align: middle;text-align: center;">
                             <a href="?c=notificaciones&a=crud&id=<?php echo $value->id ?>" type="button" title="Botón para editar notificaciones">
                                 <i class="glyphicon glyphicon-edit"></i>
                             </a>
                             <a onclick="Borrar('<?= $value->id ?>')"  href="" type="button" title="Botón para eliminar notificaciones ">
                                 <i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i>
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