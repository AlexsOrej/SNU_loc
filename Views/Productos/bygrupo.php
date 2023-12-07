<!-- Basic Validation -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>AGREGAR PRODUCTOS</h2>
            </div>
            <div class="body">
                <div class="row">
                    <form name="formProducto" id="formProducto" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?= $producto->id ?>">
                        <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $producto->usuario_id ?>">

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Cantidad de Elementos</label>
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control" name="filename" id="filename" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Número de Factura</label>
                                    <input type="text" class="form-control" name="factura" id="factura" value="<?= $producto->factura ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">proveedor</label>
                                    <input type="text" class="form-control" name="proveedor" id="proveedor" value="<?= $producto->proveedor ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Categoria</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($categorias as $value) : ?>
                                            <option value="<?= $value->id ?>" <?php echo $value->id == $producto->categoria_id ? 'selected' : '' ?>><?= utf8_encode($value->nombre) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Fabricante</label>
                                    <select name="fabricante_id" id="fabricante_id" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($fabricantes as $value) : ?>
                                            <option value="<?= $value->id ?>" <?php echo $value->id == $producto->fabricante_id ? 'selected' : '' ?>><?= $value->nombres ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $producto->nombre ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Carateristicas</label>
                                    <input type="text" class="form-control" name="carateristicas" id="carateristicas" value="<?= $producto->carateristicas ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Número Serie</label>
                                    <input type="text" class="form-control" name="serie" id="serie" value="<?= $producto->serie ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Estado</label>
                                    <select name="estado_id" id="estado_id" class="form-control" required="true">
                                        <option value="">Seleccione...</option>
                                        <option value="1" <?php echo $producto->estado_id == '1' ? 'selected' : '' ?>>Excelente</option>
                                        <option value="2" <?php echo $producto->estado_id == '2' ? 'selected' : '' ?>>Bueno</option>
                                        <option value="3" <?php echo $producto->estado_id == '3' ? 'selected' : '' ?>>Regular</option>
                                        <option value="4" <?php echo $producto->estado_id == '4' ? 'selected' : '' ?>>Malo</option>
                                        <option value="5" <?php echo $producto->estado_id == '5' ? 'selected' : '' ?>>Baja</option>
                                        <option value="6" <?php echo $producto->estado_id == '6' ? 'selected' : '' ?>>Propiedad de Terceros</option>
                                        <option value="7" <?php echo $producto->estado_id == '7' ? 'selected' : '' ?>>Obsoleto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Forma de Adquisición</label>
                                    <select name="adquisicion" class="form-control" required="true">
                                        <option value="">Seleccione...</option>
                                        <option value="compra" <?php echo $producto->adquisicion == 'compra' ? 'selected' : '' ?>>Compra</option>
                                        <option value="donacion" <?php echo $producto->adquisicion == 'donacion' ? 'selected' : '' ?>>Donación</option>
                                        <option value="terceros" <?php echo $producto->adquisicion == 'terceros' ? 'selected' : '' ?>>Propiedad de Terceros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="">Precio/Costo</label>
                                    <input type="text" class="form-control" name="preciocosto" id="preciocosto" value="<?= $producto->preciocosto ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Fecha Compra</label>
                                    <input name="fechacompra" id="fechacompra" type="date" class="form-control" value="<?php echo $producto->fechacompra ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Sede</label>
                                    <select name="sede_id" id="sede_id" class="form-control" required="required">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($sedes as $value) : ?>
                                            <option value="<?= $value->id ?>" <?php echo $value->id == $producto->sede_id ? 'selected' : '' ?>><?= $value->nombre ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label>Ubicación</label>
                                    <div id="div_subcategorias_wrapper"></div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="guardar" class="btn btn-guardar btn-block" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Validation -->
<script>
    $(document).ready(function() {
        $("#formProducto").submit(function(e) {
            e.preventDefault();
            var formData = $(this);
            var isValid = true;
            var cantidad = document.getElementById("cantidad").value
            formData.find('input.required, select.required').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    return false; // Romper el bucle si se encuentra un campo vacío
                }
            });

            // Si algún campo está vacío, muestra un mensaje de error
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Por favor, completa todos los campos del formulario.',
                });
            } else {
                var formData = new FormData($("#formProducto")[0]);
                $.ajax({
                    url: "?c=productos&a=RegistrarByGrupo",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BIEN HECHO!!',
                            text:response,
                            timer: 1500
                        }, )
                        setTimeout(function() {
                             window.location = '?c=productos&a=ConsultaByGrupo&can='+ response;
                        }, 2000)
                    }
                });
            }
        });
    });
  $('#sede_id').on('change', function() {
        var sede_id = document.getElementById("sede_id").value
        $.ajax({
            type: "POST",
            url: '?c=productos&a=descripcion',
            data: {
                sede_id: sede_id
            },
            beforeSend: function() {
                $('#div_subcategorias_wrapper').html("<h5 class='text-center'>Cargando Información</h5>");
            },
            success: function(resp) {
                $('#div_subcategorias_wrapper').html(resp);
                $('#respuesta').html("");
            }
        });
    });
</script>