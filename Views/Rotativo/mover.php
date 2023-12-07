<?// print_r($kardex);

//echo $cantidad = $totalEntrada - $totalSalida;?>

<form name="formtraslado" id="formtraslado">
    <label>Nueva Ubicación</label>
    <select name="ubicacion_id" id="ubicacion_id" class="form-control">
        <option value="">Seleccionar</option>
        <? foreach ($ubicaciones as $value) : ?>
            <? if ($value->id != $kardex->ubicacion_id) : ?>
                <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
            <? endif; ?>
        <? endforeach; ?>
    </select>
    <label>Cantidad a Mover</label>
    <input type="number" name="cantidad" id="cantidad" class="form-control"  min="0" max="<?=$_REQUEST['cantidad']?>"  value="">
    <span id="cantidad-error"></span>
    <input type="hidden" name="cantidad_act" id="cantidad_act" class="form-control" value="<?= $kardex->cantidad ?>">
    <input type="hidden" name="k_id" id="k_id" class="form-control" value="<?= $_REQUEST['id'] ?>">
    <input type="hidden" name="tipo" id="tipo" class="form-control" value="entrada">
    <input type="hidden" name="old_ubicacion_id" id="k_id" class="form-control" value="<?= $kardex->ubicacion_id ?>">
</form>
<script>
//    function validarCantidad() {
//     var cantidadInput = document.getElementById("cantidad");
//     var cantidadMin = cantidadInput.getAttribute("min");
//     var cantidadMax = cantidadInput.getAttribute("max");

//     if (cantidadInput.value < cantidadMin) {
//         cantidadInput.value = cantidadMin;
//         Swal.fire({
//             icon: 'info',
//             title: 'La cantidad ingresada es menor al permitido.',
//             timer: 1500,
//             showConfirmButton: false,
//         });
//     } else if (cantidadInput.value > cantidadMax) {
//         cantidadInput.value = cantidadMax;
//         Swal.fire({
//             icon: 'info',
//             title: 'La cantidad ingresada es mayor al máximo permitido.',
//             timer: 1500,
//             showConfirmButton: false,
//         });
//     }
// }

const cantidadInput = document.getElementById('cantidad');
const cantidadError = document.getElementById('cantidad-error');

cantidadInput.addEventListener('input', () => {
  const cantidad = parseInt(cantidadInput.value);
  const min = parseInt(cantidadInput.min);
  const max = parseInt(cantidadInput.max);
  const miBoton = document.getElementById('guardar');
  
  if (cantidad <= min || cantidad > max) {
      cantidadError.textContent = 'La cantidad ingresada está fuera del rango permitido.'+ min +' a '+ max;
      miBoton.disabled = true;
    } else {
    cantidadError.textContent = '';
    miBoton.disabled = false;
  }
});

</script>