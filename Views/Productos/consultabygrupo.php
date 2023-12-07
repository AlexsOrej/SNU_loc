<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Item Registrados</h3>
        </div>
        <div class="panel-body">
            <table id="tblConByGrupo" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Caracteristicas</th>
                        <th>Categoria</th>
                        <th>Ubicación</th>
                        <th>Fabricante</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($result  as $result0):?>
                    <tr>
                        <td><?=$result0->id?></td>
                        <td><?=$result0->nombre?></td>
                        <td><?=$result0->carateristicas?></td>
                        <td><?=$result0->categoria?></td>
                        <td><?=$result0->ubicacion.'-'.$result0->sede?></td>
                        <td><?=$result0->fabricantes?></td>
                        <td><?=$result0->estado?></td>                       
                    </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>