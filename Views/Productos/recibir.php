<!-- Basic Validation -->
<?php //print_r($prestamos) ?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>REGISTRO DE PRESTAMO</h2>                
            </div>
            <?php //debug($id); 
            ?>
            <div class="body">
                <form action="" id="formPrestamo01" name="formPrestamo01" method="POST" role="form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Consecutivo</label>
                                        <input type="text" class="form-control" id="cons" name="cons" placeholder="" Value='<?= $prestamos->num_prestamo ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Fecha Entrega</label>
                                        <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega" Value='<?= $prestamos->fecha_entrega ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" Value='<?= $prestamos->nombre_bene ?>'>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" Value='<?= $prestamos->apellido_bene ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Identificación</label>
                                        <input type="number" class="form-control" id="identificacion" name="identificacion" Value='<?= $prestamos->identificacion_bene ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Contacto</label>
                                        <input type="text" class="form-control" id="contacto" name="contacto" Value='<?= $prestamos->num_contacto ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Correo Electronico</label>
                                        <input type="text" class="form-control" id="correo" name="correo" Value='<?= $prestamos->correo ?>'>
                                    </div>
                                </div>
                            </div>                         
                            <div class="col-xs-4 col-sm-4 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Observaciones</label>
                                        <textarea type="text" class="form-control" id="observaciones" name="observaciones" Value=''><?= $prestamos->carateristicas ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Dellates de la Devolución</label>
                                        <textarea type="text" class="form-control" id="dellate_entrada" name="dellate_entrada" Value=''></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
                            <input type="hidden" class="form-control" id="fecha_entrada" name="fecha_entrada" Value='<?=date('Y-m-d')?>'> 
                            <input type="hidden" class="form-control" id="tipo" name="tipo" Value='entrega'>  
                            <input type="hidden" class="form-control" id="id" name="id" Value='<?= $prestamos->prestamoId ?>'>                               
                            <input type="button" id="guardar01" class="neu btn-block" value="Registrar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
    $(document).on('click', '#guardar01', function(e) {
        // var data = $("#formResponder").serialize();
        var formData = new FormData($("#formPrestamo01")[0]);
       // var idp= document.getElementById("id").value
        
        $.ajax({
            url: "?c=productos&a=AddRecibir",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    timer: 1500
                }, )
                setTimeout(function() {
                    // window.location = '?c=productos&a=Ver&id='+idp;
                     window.location.reload(1);
                }, 2000)

            }
        });
    });
</script>