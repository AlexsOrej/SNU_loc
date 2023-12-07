<label for='articulo' class='col-sm-2'>Articulos</label>
<select name='articulo' id='articulo' class='form-control' required='required'>
    <option value=''>Seleccionar</option>";
    <? foreach ($byNombres as $value) : ?>
       <option value='<?=$value->producto ?>'> <?=$value->producto ?></option>
    <? endforeach; ?>
</select>