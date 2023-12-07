<div class="col-md-12">
    <div id="hecho"></div>
    <div class="row">
        <div class="col-md-6" style="align-items: center;">
            <div class="card">
                <div class="header">Elige tipo de insumo y ubicaciones</div>
                <div class="body">
                    <div class="row clearfix">
                        <?php
                        $tipoasignado = false;
                        $tipoasignado0 = false;
                        $tipoasignado1 = false;
                        foreach ($tipoinsumoasignados as $value) {
                            if ($value->tipo_insumo == 'clinicos') {
                                $tipoasignado = true;
                            }
                            if ($value->tipo_insumo == 'oficina') {
                                $tipoasignado0 = true;
                            }
                            if ($value->tipo_insumo == 'industria') {
                                $tipoasignado1 = true;
                            }
                        }
                        ?>
                        <div class="col-sm-3">
                            <div class="demo-switch-title">Clínicos</div>
                            <div class="switch">
                                <label>OFF<input type="checkbox" id="clinicos" <?php echo $tipoasignado ? 'checked' : '' ?>><span class="lever switch-col-red"></span>ON</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="demo-switch-title">Oficina</div>
                            <div class="switch">
                                <label>OFF<input type="checkbox" id="oficina" <?php echo $tipoasignado0 ? 'checked' : '' ?>><span class="lever switch-col-pink"></span>ON</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="demo-switch-title">Industria</div>
                            <div class="switch">
                                <label>OFF<input type="checkbox" id="industria" <?php echo $tipoasignado1 ? 'checked' : '' ?>><span class="lever switch-col-purple"></span>ON</label>
                            </div>
                        </div>
                    </div>
                    <label for="">Sedes</label>
                    <select name="sede_id" id="sede_id" class="form-control">
                        <option value="">Seleccionar</option>
                        <? foreach ($sede as $value) : ?>
                            <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="ubicaciones"></div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">Elige los usuarios
                </div>
                <div class="body">
                    <? // print_r($usuarios) 
                    ?>
                    <table id="tbl_RotUser" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Usuario</th>
                                <th>Elegir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $uvalue) : ?>
                                <?php
                                $asignado = false;
                                foreach ($asignados as $avalue) {
                                    if ($avalue->usuario_id == $uvalue->id) {
                                        $asignado = true;
                                        break;
                                    }
                                }
                                ?>
                                <tr>
                                    <td><?php echo $uvalue->id ?></td>
                                    <td><?php echo $uvalue->nombres . ' ' . $uvalue->apellidos ?></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <input type="checkbox" <?php echo $asignado ? 'checked' : '' ?>>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '#sede_id', function(e) {
        const sede_id = $('#sede_id').val()
        $.ajax({
            type: "POST",
            url: '?c=ubicaciones&a=descripcion01',
            data: 'sede_id=' + sede_id,
            success: function(resp) {
                $('#ubicaciones').html(resp);
            }
        });
    })

    $(document).ready(function() {
        // Evento para cuando se cambie el estado del checkbox
        $("#clinicos").change(function() {
            var id = $(this).attr("id");
            var valor = $(this).prop("checked");
            if (valor === true) {
                var estado = 1
            } else {
                var estado = 0
            }
            $.ajax({
                type: "POST",
                url: '?c=rotativos&a=asigna_tipoinsumo',
                data: {
                    tipo: id,
                    estado: estado
                },
                beforeSend: function() {},
                success: function(resp) {                  

                    $('#hecho').html("<div class='alert bg-teal alert-dismissible' role='alert'>Asignado con Exito</div>");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1000)

                }
            });
        });
        $("#oficina").change(function() {
            var id = $(this).attr("id");
            var valor = $(this).prop("checked");
            if (valor === true) {
                var estado = 1
            } else {
                var estado = 0
            }
            $.ajax({
                type: "POST",
                url: '?c=rotativos&a=asigna_tipoinsumo',
                data: {
                    tipo: id,
                    estado: estado
                },
                beforeSend: function() {},
                success: function(resp) {
                    $('#hecho').html("<div class='alert bg-teal alert-dismissible' role='alert'>Asignado con Exito</div>");
                    setTimeout(function() {
                      window.location.reload(1);
                    }, 1000)
                }
            });
        });
        $("#industria").change(function() {
            var id = $(this).attr("id");
            var valor = $(this).prop("checked");
            if (valor === true) {
                var estado = 1
            } else {
                var estado = 0
            }
            $.ajax({
                type: "POST",
                url: '?c=rotativos&a=asigna_tipoinsumo',
                data: {
                    tipo: id,
                    estado: estado
                },
                beforeSend: function() {},
                success: function(resp) {
                    $('#hecho').html("<div class='alert bg-teal alert-dismissible' role='alert'>Asignado con Exito</div>");
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1000)
                }
            });
        });
    });
    // Obtener todos los elementos input de tipo checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    // Agregar controlador de eventos a cada checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Checkbox seleccionado
                var usuario = this.closest('tr').children[0].textContent
                $.ajax({
                    type: "POST",
                    url: '?c=rotativos&a=asigna_usuario',
                    data: {
                        usuario: usuario,
                        estado: 1
                    },
                    beforeSend: function() {},
                    success: function(resp) {
                        $('#hecho').html("<div class='alert bg-teal alert-dismissible' role='alert'>Asignado con Exito</div>");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 1000)

                    }
                });
            } else {
                // Checkbox no seleccionado
                var usuario = this.closest('tr').children[0].textContent
                $.ajax({
                    type: "POST",
                    url: '?c=rotativos&a=asigna_usuario',
                    data: {
                        usuario: usuario,
                        estado: 0
                    },
                    beforeSend: function() {},
                    success: function(resp) {

                        $('#hecho').html("<div class='alert bg-orange alert-dismissible' role='alert'>Asignación retirada con Exito</div>");
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 1000)

                    }
                });
            }
        });
    });
</script>