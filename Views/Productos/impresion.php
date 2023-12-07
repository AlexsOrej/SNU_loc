   <body onload="window.print()">
         <div class="panel panel-default" id="section-to-print">
             <div class="panel-body">
                 <table class="table table-bordered">
                     <thead>
                        <tr>
                            <th colspan="2" style="text-align: center; vertical-align: middle;"><img src="Assets/img/uploads/colegio/<?php echo $_SESSION['datos_cliente']->filename ?>" width="90" height="90" alt="">
          </th>
                            <th colspan="2" style="text-align: center; vertical-align: middle;"><?= $reconteo[0]->ubicacion . '-' . $reconteo[0]->sede ?></th>
                        </tr>
                         <tr>
                             <th>Cantidad</th>
                             <th>Nombre</th>
                             <th>Caracteristicas</th>
                             <th>Observación</th>
                         </tr>
                     </thead>
                     <tbody style="width: fit-content;">
                         <? foreach ($reconteo  as $result0) : ?>
                             <tr >
                                 <td><?= $result0->cantidad ?></td>
                                 <td><?= utf8_encode($result0->nombre) ?></td>
                                 <td><?= utf8_encode($result0->carateristicas) ?></td>
                                 <td></td>
                             </tr>
                         <? endforeach; ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </body>