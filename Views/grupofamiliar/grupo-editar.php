<div class="card">
    <div class="header">
        <h2>Registrar Integrante</h2>
    </div>
    <div class="body">
        <form id="frm_pariente" name="frm_pariente" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
                <input name="usuario_id" value="<?php echo $_REQUEST['user_id']; ?>" type="hidden" />
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nombre</label>
                            <input name="nombre" value="<?php echo $alm->nombre; ?>" type="text" class="form-control" placeholder="" required />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Apellidos</label>
                            <input name="apellidos" value="<?php echo $alm->apellidos; ?>" type="text" class="form-control" placeholder="" required />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Parentesco</label>
                            <select name="parentesco" class="form-control" required>
                                <option value="">Seleccionar</option>
                                <option <?php echo $alm->parentesco == 'Madre' ? 'selected' : ''; ?> value="Madre">Madre
                                </option>
                                <option <?php echo $alm->parentesco == 'Padre' ? 'selected' : ''; ?> value="Padre">Padre
                                </option>
                                <option <?php echo $alm->parentesco == 'Hermano(a)' ? 'selected' : ''; ?> value="Hermano(a)">
                                    Hermano(a)</option>
                                <option <?php echo $alm->parentesco == 'Hijo(a)' ? 'selected' : ''; ?> value="Hijo(a)">Hijo(a)
                                </option>
                                <option <?php echo $alm->parentesco == 'Conyuge' ? 'selected' : ''; ?> value="Conyuge">Conyuge
                                </option>
                                <option <?php echo $alm->parentesco == 'Padrastro' ? 'selected' : ''; ?> value="Padrastro">
                                    Padrastro</option>
                                <option <?php echo $alm->parentesco == 'Hijastro(a)' ? 'selected' : ''; ?> value="Hijastro(a)">Hijastro(a)</option>
                                <option <?php echo $alm->parentesco == 'Madrastra' ? 'selected' : ''; ?> value="Madrastra">
                                    Madrastra</option>
                                <option <?php echo $alm->parentesco == 'Tia(o)' ? 'selected' : ''; ?> value="Tia(o)">Tia(o)
                                </option>
                                <option <?php echo $alm->parentesco == 'Abuelo(a)' ? 'selected' : ''; ?> value="Abuelo(a)">
                                    Abuelo(a)</option>
                                <option <?php echo $alm->parentesco == 'Prima(o)' ? 'selected' : ''; ?> value="Prima(o)">
                                    Prima(o)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Fecha nacimiento</label>
                            <input name="fecha_nacimiento" value="<?php echo $alm->fecha_nacimiento; ?>" type="date" class="form-control" placeholder="" required />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Contacto</label>
                            <input name="contacto" value="<?php echo $alm->contacto; ?>" type="text" class="form-control" placeholder="" required />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <input type="button" id="botonenviar" value="Guardar" class="btn btn-guardar">
                </div>
            </div>
        </form>
    </div>
</div>
<!-- #END# Textarea -->
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#botonenviar').click(function(e) {
    //         e.preventDefault();
    //         var nombre = document.getElementsByName('nombre')[0].value;
    //         var apellidos = document.getElementsByName('apellidos')[0].value;
    //         var parentesco = document.getElementsByName('parentesco')[0].value;
    //         var fecha_nacimiento = document.getElementsByName('fecha_nacimiento')[0].value;
    //         var contacto = document.getElementsByName('contacto')[0].value;

    //         var msn = '';
    //         var estatus = '';

    //         if (nombre === '') {
    //             var msn = 'El nombre es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )

    //         }
    //         if (apellidos === '') {
    //             var msn = 'El apellidos es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )
    //         }
    //         if (parentesco === '') {
    //             var msn = 'El parentesco es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )
    //         }
    //         if (fecha_nacimiento === '') {
    //             var msn = 'El fecha_nacimiento es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )
    //         }
    //         if (fecha_nacimiento === '') {
    //             var msn = 'El fecha_nacimiento es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )
    //         }
    //         if (contacto === '') {
    //             var msn = 'El contacto es obligatorio';
    //             var estatus = false;
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             }, )
    //         }

    //         if (estatus) {
    //             var datos = $('#frm_pariente').serialize();
    //             $.ajax({
    //                 type: "POST",
    //                 url: "?c=Grupofamiliar&a=Guardar",
    //                 data: datos,
    //                 success: function(r) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'REGISTRADO CON ÉXITO',
    //                         timer: 2000
    //                     }, )
    //                     setTimeout(function() {
    //                       //  window.location.reload();
    //                     }, 2000)
    //                 },

    //             });console.log(r)
    //         }
    //     });
    // });
    // $(document).ready(function() {
    //     $('#botonenviar').click(function(e) {
    //         e.preventDefault(); // se debe invocar a la función e.preventDefault() para prevenir el comportamiento por defecto del botón

    //         var nombre = $('#nombre').val(); // utilizar jQuery para obtener el valor de los campos de formulario
    //         var apellidos = $('#apellidos').val();
    //         var parentesco = $('#parentesco').val();
    //         var fecha_nacimiento = $('#fecha_nacimiento').val();
    //         var contacto = $('#contacto').val();

    //         var msn = '';
    //         var estatus = true; // establecer el valor predeterminado de 'estatus' en verdadero

    //         if (nombre === '') {
    //             msn = 'El nombre es obligatorio';
    //             estatus = false;
    //         } else if (apellidos === '') { // utilizar else if para evitar múltiples alertas de SweetAlert2
    //             msn = 'Los apellidos son obligatorios';
    //             estatus = false;
    //         } else if (parentesco === '') {
    //             msn = 'El parentesco es obligatorio';
    //             estatus = false;
    //         } else if (fecha_nacimiento === '') {
    //             msn = 'La fecha de nacimiento es obligatoria';
    //             estatus = false;
    //         } else if (contacto === '') {
    //             msn = 'El contacto es obligatorio';
    //             estatus = false;
    //         }

    //         if (estatus===false) { // utilizar !estatus en lugar de estatus === false para mejorar la legibilidad del código
    //             Swal.fire({
    //                 icon: 'info',
    //                 title: msn,
    //                 timer: 2000
    //             });
    //         } else {
    //             var datos = $('#frm_pariente').serialize();
    //             $.ajax({
    //                 type: "POST",
    //                 url: "?c=Grupofamiliar&a=Guardar",
    //                 data: datos,
    //                 success: function(r) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'REGISTRADO CON ÉXITO',
    //                         timer: 2000
    //                     }).then(function() {
    //                        // location.reload(); // utilizar el método then() de SweetAlert2 para recargar la página después de que se cierre el mensaje de éxito
    //                     });
    //                 },
    //                 error: function(xhr, status, error) {
    //                     console.log(xhr.responseText); // mostrar cualquier error en la consola del navegador
    //                 }
    //             });
    //         }
    //     });
    // });
    $(document).ready(function() {
    $('#botonenviar').click(function(e) {
        e.preventDefault();
        var formulario_valido = true;
        var nombre = document.getElementsByName('nombre')[0].value;
        var apellidos = document.getElementsByName('apellidos')[0].value;
        var parentesco = document.getElementsByName('parentesco')[0].value;
        var fecha_nacimiento = document.getElementsByName('fecha_nacimiento')[0].value;
        var contacto = document.getElementsByName('contacto')[0].value;

        if (nombre === '') {
            formulario_valido = false;
            Swal.fire({
                icon: 'info',
                title: 'El nombre es obligatorio',
                timer: 2000,
                showConfirmButton: false,
            }, );
        }
        if (apellidos === '') {
            formulario_valido = false;
            Swal.fire({
                icon: 'info',
                title: 'El apellido es obligatorio',
                timer: 2000,
                showConfirmButton: false,
            }, );
        }
        if (parentesco === '') {
            formulario_valido = false;
            Swal.fire({
                icon: 'info',
                title: 'El parentesco es obligatorio',
                timer: 2000,
                showConfirmButton: false,
            }, );
        }
        if (fecha_nacimiento === '') {
            formulario_valido = false;
            Swal.fire({
                icon: 'info',
                title: 'La fecha de nacimiento es obligatoria',
                timer: 2000,
                showConfirmButton: false,
            }, );
        }
        if (contacto === '') {
            formulario_valido = false;
            Swal.fire({
                icon: 'info',
                title: 'El contacto es obligatorio',
                timer: 2000,
                showConfirmButton: false,
            }, );
        }

        if (formulario_valido) {
            var datos = $('#frm_pariente').serialize();
            $.ajax({
                type: "POST",
                url: "?c=Grupofamiliar&a=Guardar",
                data: datos,
                success: function(response) {                   
                    Swal.fire({
                        icon: 'success',                        
                        title: response,
                        timer: 1500,
                        showConfirmButton: false,
                    }, );
                    setTimeout(function() {
                          window.location.reload();
                    }, 1500);
                },
            
            });
            
        }
    });
});

</script>