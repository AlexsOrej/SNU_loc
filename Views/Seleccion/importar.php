<? //print_r($usuarios);?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Importar Usuarios</h3>
    </div>
    <div class="panel-body">
        <table  id="tbl_aspirante" class="table table-bordered">
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Cedula</th>
                <th>Marcar</th>
            </tr>
            <? foreach ($usuarios as $key => $value) : ?>
                <tr>
                    <td><?= $value->nombres ?></td>
                    <td><?= $value->apellidos ?></td>
                    <td><?= $value->identificacion ?></td>
                    <td><input type="checkbox" name="" id=""></td>
                </tr>
            <? endforeach; ?>
        </table>
    </div>
</div>