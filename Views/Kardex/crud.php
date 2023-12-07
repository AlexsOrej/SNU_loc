<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<div class="row">
    <?
    //print_r($kardex->ubicacion_id);
    $cantidad = $totalEntrada - $totalSalida;
    ?>
    <div class="col-md-12">
        <h4 class="modal-title">Registrar <?= $_REQUEST['tipo'] ?></h4>
        <br>
    </div>
    <?php if ($_REQUEST['tipo'] == "entrada") : ?>
        <form action="" id="form_k" name="form_k">
            <div class="col-md-12">
                <input type="hidden" id="insumo_id" name="insumo_id" value="<?= $_REQUEST['id'] ?>">
                <input type="hidden" id="tipo" name="tipo" value="<?= $_REQUEST['tipo'] ?>">
                <div class="col-md-6">
                    <label for="">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control" max="">
                </div>
                <div class="col-md-6">
                    <label for="">Costo Unitario</label>
                    <input type="number" id="costo_unitario" name="costo_unitario" class="form-control" onchange="calcularTotal()">
                </div>
                <div class="col-md-6">
                    <label for="">Total</label>
                    <input type="text" id="total" name="total" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="ubicacion_id">Ubicación</label>
                    <select class="select2 form-control" name="ubicacion_id" id="ubicacion_id">
                        <option value="">Seleccionar</option>
                        <? foreach ($ubicaciones  as $ubicacion) : ?>
                            <option value="<?= $ubicacion->id ?>"><?= $ubicacion->nombre . '/' . $ubicacion->sede ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="display: <?= utf8_encode($insumo->tipo) != 'Farmacéutico' ? 'none' : '' ?>;">
                    <label for="">lote</label>
                    <input type="text" id="lote" name="lote" class="form-control">
                </div>
                <div class="col-md-6" style="display: <?= utf8_encode($insumo->tipo) != 'Farmacéutico' ? 'none' : '' ?>;">
                    <label for="">Caducidad</label>
                    <input type="date" id="caducidad" name="caducidad" class="form-control">
                </div>

            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="proveedor_id">Proveedor</label>
                    <select class="select2 form-control" name="proveedor_id" id="proveedor_id">
                        <option value="">Seleccionar</option>
                        <? foreach ($proveedores  as $proveedor) : ?>
                            <option value="<?= $proveedor->id ?>"><?= $proveedor->nombre ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Responsable</label>
                    <input type="text" id="responsable" name="responsable" class="form-control" required>
                </div>
            </div>
        </form>
    <?php endif; ?>
    <?php if ($_REQUEST['tipo'] == "salida") :
        //  print_r($kardex);
    ?>
        
        
        <form action="" id="form_k" name="form_k">
            <div class="col-md-12">
                <input type="hidden" id="insumo_id" name="insumo_id" value="<?= $_REQUEST['id'] ?>">
                <input type="hidden" id="tipo" name="tipo" value="<?= $_REQUEST['tipo'] ?>">
                <div class="col-md-6">
                    <label for="">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" max="<?= $cantidad ?>" oninput="validarCantidad()">
                </div>
                <div class="col-md-6" style="display: <?= utf8_encode($insumo->tipo) != 'Farmacéutico' ? 'none' : '' ?>;">
                    <label for="">lote</label>
                    <input type="text" id="lote" name="lote" class="form-control">
                </div>
                <input type="hidden" id="costo_unitario" name="costo_unitario" class="form-control" value="<?= $kardex->costo_unitario ?>">
                <input type="hidden" id="total" name="total" class="form-control" value="0">
            </div>
            <div class="col-md-12">
                <input type="hidden" id="caducidad" name="caducidad" class="form-control" value="0000-00-00">
                <input type="hidden" id="proveedor_id" name="proveedor_id" class="form-control" value="0">
                <div class="col-md-6" style="display: none;">
                    <label for="ubicacion_id">Ubicación</label>
                    <select class="select2 form-control" name="ubicacion_id" id="ubicacion_id">
                        <option value="">Seleccionar</option>
                        <? foreach ($ubicaciones  as $ubicacion) : ?>
                            <option value="<?= $ubicacion->id ?>" <?= $kardex->ubicacion_id == $ubicacion->id ? 'selected' : '' ?>> <?= $ubicacion->nombre . '/' . $ubicacion->sede ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Responsable</label>
                    <input type="text" id="responsable" name="responsable" class="form-control">
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
<script>    

        function validarCantidad() {
            var cantidadInput = document.getElementById("cantidad");
            var cantidadMin = Number(cantidadInput.getAttribute("min"));
            var cantidadMax = Number(cantidadInput.getAttribute("max"));
            var cantidadValue = Number(cantidadInput.value);

            if (cantidadValue < cantidadMin) {
                Swal.fire({
                    icon: 'info',
                    title: 'La cantidad ingresada es menor al permitido.',
                    timer: 1500,
                    showConfirmButton: false,
                });
                cantidadInput.value = cantidadMin;
                document.getElementById("k_guardar").disabled = true;
            }

            if (cantidadValue > cantidadMax) {
                Swal.fire({
                    icon: 'info',
                    title: 'La cantidad ingresada es mayor al permitido.',
                    timer: 1500,
                    showConfirmButton: false,
                });
                cantidadInput.value = cantidadMax;
                document.getElementById("k_guardar").disabled = true;
               
            }
        }


    function calcularTotal() {
        var cantidad = document.getElementById('cantidad').value;
        var costo = document.getElementById('costo_unitario').value;
        var total = cantidad * costo;
        document.getElementById('total').value = total.toFixed(2);
    }

    function validarFormulario() {
        var cantidadInput = document.getElementById("cantidad");
        var responsableInput = document.getElementById("responsable");
        var caducidadInput = document.getElementById("caducidad");
        var proveedorInput = document.getElementById("proveedor_id");
        var ubicacionInput = document.getElementById("ubicacion_id");
        var costoInput = document.getElementById('costo_unitario');

        if (cantidadInput.value == "") {
            Swal.fire({
                icon: 'info',
                title: 'El campo cantidad es obligatorio',
                timer: 1500,
                showConfirmButton: false,
            }, )
            return false;
        }
        if (costoInput.value == "") {
            Swal.fire({
                icon: 'info',
                title: 'El campo Costo es obligatorio',
                timer: 1500,
                showConfirmButton: false,
            }, )
            return false;
        }

        if (ubicacionInput.value == "") {

            Swal.fire({
                icon: 'info',
                title: 'El campo ubicacion es obligatorio',
                timer: 1500,
                showConfirmButton: false,
            }, )
            return false;
        }
        if (proveedorInput.value == "") {
            Swal.fire({
                icon: 'info',
                title: 'El campo proveedor es obligatorio',
                timer: 1500,
                showConfirmButton: false,
            }, )
            return false;
        }

        if (responsableInput.value == "") {
            Swal.fire({
                icon: 'info',
                title: 'El campo responsable es obligatorio',
                timer: 1500,
                showConfirmButton: false,
            }, )
            return false;
        }

        return true;
    }

    $('#k_guardar').click(function() {
        if (!validarFormulario()) {
            return false;
        }
        var formData = new FormData($("#form_k")[0]);
        $.ajax({
            url: "?c=rotativos&a=kguardar",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(r) {
                Swal.fire({
                    icon: 'success',
                    title: 'El insumo se actualizo con éxito',
                    timer: 1500,
                    showConfirmButton: false,
                }, )
                  window.location.reload();
            }
        });
    });
</script>