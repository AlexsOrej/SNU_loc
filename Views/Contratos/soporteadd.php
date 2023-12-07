<form id="sop_contrato" name="sop_contrato" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <input type="file" name="file_contrato" id="file_contrato" class="form-control">
            <input type="hidden" name="colaborador_cc" id="colaborador_cc" value="<?php echo $_REQUEST['colaborador_cc'] ?>">
            <input type="hidden" name="contrato_id" id="contrato_id" value="<?php echo $_REQUEST['contrato_id'] ?>">
        </div>
        <div class="col-md-12">
            <button style="border:none; margin-top:20px;" type="button" class="btn-guardar btn-box" id="enviar_soporte" name="enviar_soporte">
                <i class="material-icons" style="font-size: 14px;">upload</i>
                Subir
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#enviar_soporte").click(function() {
            var formData = new FormData($("#sop_contrato")[0]); // Obtener todos los datos del formulario
            $.ajax({
                url: "?c=contratacion&a=SubirSoporte", // Cambia esto a la ruta correcta
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        title: 'El registro se realizo con éxito',
                        text: response,
                        timer: 1500,
                        showConfirmButton: false,
                    }, )
                    setTimeout(function() {
                         window.location.reload();                        
                    }, 1500)

                },
                error: function(xhr, status, error) {
                    // Maneja los errores de la solicitud AJAX
                    console.error(error);
                }
            });
        });
    });
</script>