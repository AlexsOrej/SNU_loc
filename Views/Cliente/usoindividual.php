<!-- <script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js"></script> -->
<?php
//print_r($_SESSION);
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="body">
                <form id="fservicios" name="fservicios">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="clientes">Clientes</label>
                                    <select name="clientes" id="clientes" class="form-control" required>
                                        <option value="">Buscar</option>
                                        <?php foreach ($clientes as $value) : ?>
                                            <option value="<?= $value->cliente_id ?>"><?= $value->nombre ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Desde</label>
                                    <input type="date" id="startDate" name="startDate" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Hasta</label>
                                    <input type="date" id="endDate" name="endDate" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12" id="resultado"></div>
</div>
<script>
    $(document).ready(function () {
        $('#fservicios').submit(function (e) {
            e.preventDefault(); // Evita que el formulario se envíe normalmente

            // Obtiene los datos del formulario
            var formData = $(this).serialize();

            // Envía los datos a través de AJAX
            $.ajax({
                type: 'POST',
                url: '?c=clientes&a=usoindividualresultado', // Reemplaza con la URL a la que deseas enviar los datos
                data: formData,
                beforeSend:function(){
                    $("#resultado").html('SNU ESTA CONSTRUYENDO EL INFORME');
                },
                success: function (response) {
                    // Maneja la respuesta del servidor
                    console.log(response);
                    $('#resultado').html(response);
                },
                error: function (error) {
                    // Maneja los errores si los hay
                    console.error(error);
                }
            });
        });
    });
</script>