<h3>Asignar Funcionario</h3>
<form action="" name="form_asignar" id="form_asignar" method="">
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-line">
                    <label>Proceso</label>
                    <select name="proceso" id="proceso" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php foreach ($procesos as $value): ?>
                            <option value="<?= $value->id?>"><?= $value->Iniciales.' '.$value->NombreProceso?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-12" id="responsable">          
        </div>
        <input type="hidden" id="id" name="id" value="<?=$_REQUEST['id']?>" class="btn btn-success btn-guardar">       
        <div class="text-center">
            <input type="button" id="guardar" value="Guardar" class="btn bg-green ">       
        </div>
    </div>
</form>
<script>
    $('#proceso').on('change', function() {
        var proceso = document.getElementById("proceso").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=Asignar_responsable',
            data: {
                proceso: proceso
            },
            beforeSend: function() {
                $('#responsable').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#responsable').html(resp);
            }
        });
    });
    $(document).on('click', '#guardar', function(e) {
            var data = $('#form_asignar').serialize();
           $.ajax({
                type: "POST",
                url: "?c=pqrsf&a=addAsignar",
                data: data,
                success: function(data) {
                    if (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BIEN HECHO!!',
                            timer: 1500
                        }, )
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'HUBO UN ERROR TRATA DE NUEVO',
                            timer: 1500
                        }, )
                        setTimeout(function() {
                          window.location.reload();
                        }, 1500)
                    }
                }
            });
        });  
</script>
