<div class="row clearfix text-center">
    <form id="formCrud" name="formCrud">
        <div class="col-md-3">
            <div class=" ">
                <label for="">Nombre:</label>
                <input type="text" id="nombre" name="nombres" value="<?php echo $usuario->nombres ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $usuario->apellidos ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Correo:</label>
                <input type="email" id="email" name="email" placeholder="example@gmail.com" value="<?php echo $usuario->email ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Telefono:</label>
                <input type="telefono" id="telefono" name="telefono" placeholder="" value="<?php echo $usuario->telefono ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Identificación</label>
                <input type="number" id="identificacion" name="identificacion" value="<?php echo $usuario->identificacion ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Rol</label>
                <select name="rol_id" id="rol_id" class="form-control">
                    <option value="">Seleccionar</option>
                    <?php foreach ($roles as $value) : ?>
                        <option value="<?php echo $value->id ?>" <?php echo $value->id == $usuario->rol_id ? 'selected' : '' ?>> <?php echo ucwords($value->rol) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <?php if (isset($_SESSION['datos_cliente'])) : ?>
            <div class="col-md-3">
                <div class=" ">
                    <label for="">Cargo</label>
                    <select name="cargo_id" id="cargo_id" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php foreach ($cargos as $value01) : ?>
                            <option value="<?php echo $value01->id ?>" <?php echo $value01->id == $usuario->cargo_id ? 'selected' : '' ?>> <?php echo ucwords($value01->cargo) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <?php else : ?>
            <input type="hidden" id="cargo_id" name="cargo_id" value="1" class="form-control">
        <?php endif; ?>
        <div class="col-md-3">
            <div class=" ">
                <label for="">Estado</label>
                <select id="estado" name="estado" class="form-control">
                    <option value="">Seleccionar</option>
                    <option value="1" <?php echo '1' == $usuario->estado ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?php echo '0' == $usuario->estado ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class=" ">
                <?php
                if ($_SESSION['rol'] != "root") : ?>
                    <input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo $_SESSION['datos_cliente']->id ?>" class="form-control">
                <?php else : ?>
                    <label for="">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php foreach ($clientes as $value0) : ?>
                            <option value="<?php echo $value0->id ?>" <?= $value0->id == $usuario->cliente_id ? 'selected' : '' ?>> <?php echo  $value0->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-12" id="result" style="color:red">

        </div>
        <div class="col-md-12">
            <br>
            <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'] ?>" class="form-control">
            <input  title="Botón para guardar un nuevo usuario" type="button" id="guardar" name="guardar" value="guardar" class="btn-guardar">
        </div>
    </form>
</div>
<script>
    function validarForm() {
        const nombre = document.getElementById('nombre').value.trim();
        const apellidos = document.getElementById('apellidos').value.trim();
        const email = document.getElementById('email').value.trim();
        const telefono = document.getElementById('telefono').value.trim();
        const identificacion = document.getElementById('identificacion').value.trim();
        const rol_id = document.getElementById('rol_id').value.trim();
        const cargo_id = document.getElementById('cargo_id').value.trim();
        const estado = document.getElementById('estado').value.trim();
        const cliente_id = document.getElementById('cliente_id').value.trim();

        let valido = true;
        let msn = '';

        if (nombre === '') {
            // document.getElementById('nombre').textContent = 'El nombre debe ser diligenciado';
            let msn = 'El nombre debe ser diligenciado'
            valido = false;
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (apellidos === '') {
            // document.getElementById('apellidos').textContent = 'El apellidos debe ser diligenciado';
            let msn = 'El apellidos debe ser diligenciado'
            valido = false;
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (email === '') {
            // document.getElementById('email').textContent = 'El email debe ser diligenciado';
            let msn = 'El email debe ser diligenciado'
            valido = false;
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (telefono === '') {
            // document.getElementById('telefono').textContent = 'El telefono debe ser diligenciado';
            let msn = 'El telefono debe ser diligenciado'
            valido = false;
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (identificacion === '') {
            document.getElementById('identificacion').textContent = 'El identificacion debe ser diligenciado';
            valido = false;
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (rol_id === '') {
            // document.getElementById('rol_id').textContent = 'El rol debe ser diligenciado';
            valido = false;
            let msn = 'El rol debe ser diligenciado';
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);

        }

        if (cargo_id === '') {
            // document.getElementById('cargo_id').textContent = 'El cargo debe ser diligenciado';
            valido = false;
            let msn = 'El cargo debe ser diligenciado';
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (estado === '') {
            //document.getElementById('estado').textContent = 'El estado debe ser diligenciado';
            valido = false;
            let msn = 'El estado debe ser diligenciado';
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }

        if (cliente_id === '') {
            // document.getElementById('cliente_id').textContent = 'El cliente debe ser diligenciado';
            valido = false;
            let msn = 'El cliente debe ser diligenciado';
            $('#result').html(msn);
            setTimeout(function() {
                $('#result').fadeOut();
            }, 3000);
        }



        return valido;
    }

    // Si todos los campos son válidos, continuar con el envío del formulario
    $('#guardar').click(function(e) {
        e.preventDefault(); // Prevenir el envío del formulario predeterminado
        if (!validarForm()) {
            return false;
        }
        var formData = new FormData($("#formCrud")[0]);
        $.ajax({
            data: formData,
            type: "post",
            url: "?c=usuarios&a=Crud",
            processData: false,
            contentType: false,
            success: function(r) {
                Swal.fire({
                    icon: 'success',
                    title: 'El usuario se registró con éxito',
                    timer: 1500,
                    showConfirmButton: false,
                })
                setTimeout(function() {
                    window.location.reload();
                }, 1500)
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al guardar los datos',
                })
                console.log(xhr.responseText);
            }
        });
    });
</script>