<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
    </div>
    <div class="panel-body">
        <table id="tbl_completo" class="table table-bordered">
            <thead>
                <tr>
                    <th>numeroSticker</th>
                    <th>nombre</th>
                    <th>carateristicas </th>
                    <th>serie</th>
                    <th>precio</th>
                    <th>categoria</th>
                    <th>fabricante</th>
                    <th>ubicacion</th>
                    <th>sede</th>
                    <th>estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($infoByCompleto as $value) : ?>
                    <tr>
                        <th><?= $value->numeroSticker ?></th>
                        <th><?= $value->nombre ?></th>
                        <th><?= $value->carateristicas ?></th>
                        <th><?= $value->serie ?></th>
                        <th><?= $value->preciocosto ?></th>
                        <th><?= $value->categoria ?></th>
                        <th><?= $value->fabricante ?></th>
                        <th><?= $value->ubicacion ?></th>
                        <th><?= $value->sede ?></th>
                        <th><?= $value->estado ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>