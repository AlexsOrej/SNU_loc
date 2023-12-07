<?php
require_once '../Models/database.php';
$pdo = Database::StartUp();
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=INFORME COMPLETO.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT
        `productos`.`id` AS `numeroSticker`,
        `productos`.`nombre` AS `nombre`,
        `productos`.`carateristicas` AS `carateristicas`,
        `productos`.`adquisicion` AS `adquisicion`,
        `productos`.`proveedor` AS `proveedor`,
        `productos`.`factura` AS `factura`,
        `productos`.`serie` AS `serie`,
        `productos`.`preciocosto` AS `preciocosto`,
        `productos`.`fechacompra` AS `fechacompra`,
        `categorias`.`nombre` AS `categoria`,
        `fabricantes`.`nombres` AS `fabricante`,
        `ubicacions`.`nombre` AS `ubicacion`,
        `sedes`.`nombre` AS `sede`,
        `estados`.`nombre` AS `estado`
    FROM
        `productos`
    JOIN `categorias` JOIN `fabricantes` JOIN `ubicacions` JOIN `sedes` JOIN `estados` WHERE
        (
            (
                productos.`categoria_id` = categorias.`id`
            ) AND(
                productos.`fabricante_id` = fabricantes.`id`
            ) AND(
                productos.`ubicacion_id` = ubicacions.`id`
            ) AND(
                productos.`estado_id` = `estados`.`id`
            ) AND(
                productos.`sede_id` = sedes.`id`
            )
        )
    ORDER BY
        `productos`.`id`,
        `productos`.`sede_id` ASC,
        `productos`.`ubicacion_id`";
$stm = $pdo->prepare($sql);
$stm->execute();
$infoByCompleto = $stm->fetchAll(PDO::FETCH_OBJ);
// print_r($i);
?>



<table border="1px" >
    <thead>
        <tr>
            <th>NUMERO</th>
            <th>NOMBRE</th>
            <th>CARACTERISTICA </th>
            <th>SERIE</th>
            <th>PRECIO</th>
            <th>CATEGORIA</th>
            <th>FABRICANTE</th>
            <th>UBICACION</th>
            <th>SEDE</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($infoByCompleto as $value) : ?>
            <tr>
                <td><?= $value->numeroSticker ?></td>
                <td><?= utf8_encode($value->nombre) ?></td>
                <td><?= utf8_encode($value->carateristicas)  ?></td>
                <td><?= $value->serie ?></td>
                <td><?= $value->preciocosto ?></td>
                <td><?= utf8_encode($value->categoria) ?></td>
                <td><?= $value->fabricante ?></td>
                <td><?= utf8_encode($value->ubicacion) ?></td>
                <td><?= utf8_encode($value->sede) ?></td>
                <td><?= $value->estado ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>