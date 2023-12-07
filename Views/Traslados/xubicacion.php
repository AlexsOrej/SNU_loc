<style>
    .table-bordered tbody tr td,
    .table-bordered tbody tr th {
        padding: 4px;
        border: 1px solid #eee;
        text-align: justify;
        border-radius: 10px;
    }
</style>
<form action="?c=traslados&a=masivo" method="POST" name="formElement" id="formElement">
    <div class="row">
        <div class="col-md-12">
            <label for="">ELIGIR LA UBICACIÓN PARA TRASLADAR:</label>
            <select name="ubicacion" id="ubicacion" class="form-control">
                <?php foreach ($ubicaciones as $value) : ?>
                    <option value="<?= $value->sede_id . "/" . $value->ubicacion_id ?>"><?= $value->nomSede . " " . $value->nomUbicacion ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="">NOVEDAD</label>
            <textarea name="novedad" id="novedad" class="form-control" required></textarea>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user']->user_id ?>">
        </div>
    </div>
    <br>
    <table id="#tbl_traslado" class="table table-bordered">
        <thead>
            <tr>
                <th>Número</th>
                <th>Nombre</th>
                <th>Caracteriscas</th>
                <th>Marcar
                            <a href="javascript:seleccionar_todo()">Todos</a> | 
                            <a href="javascript:deseleccionar_todo()">Ninguno</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $key => $value) : ?>
                <tr>
                    <td width="5%"><?= $value->id ?></td>
                    <td width="5%"><?= $value->nombre ?>
                        <br><span class="label label-success"><?= $value->ubicacion . ' ' . $value->sede ?></span>
                        <br><span class="label label-info"><?= $value->estado ?></span>
                    </td>
                    <td width="85%"><?= utf8_encode($value->carateristicas) ?></td>
                    <td width="5%" style=" text-align:center ">
                        <input name="productos[<?php echo $key; ?>]->id" type="checkbox" class="Filled In" id="<?php echo $value->id; ?>" value="<?php echo $value->id; ?>" />
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-guardar btn-block">Registrar</button>
</form>
<script>
 function deseleccionar_todo() {
        for (i = 0; i < document.formElement.elements.length; i++)
            if (document.formElement.elements[i].type == "checkbox")
                document.formElement.elements[i].checked = 0
    }

    function seleccionar_todo() {
        for (i = 0; i < document.formElement.elements.length; i++)
            if (document.formElement.elements[i].type == "checkbox")
                document.formElement.elements[i].checked = 1
    }
</script>