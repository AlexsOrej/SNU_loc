<div class="panel panel-default">
    <div class="panel-body">
        <form action="" method="post" id="formNoti" name="formNoti">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Modulo</label>
                        <select name="modulo_id" id="modulo_id" class="form-control">
                            <option>Selecionar</option>
                            <? foreach ($modulos as $value) : ?>
                                <option value="<?= $value->id ?>" <?= $notif->modulo_id == $value->id ? 'selected' : '' ?>><?= $value->oferta ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-line">
                        <label>Proceso</label>
                        <select name="proceso_id" id="proceso_id" class="form-control">
                            <option>Selecionar</option>
                            <? foreach ($procesos as $value) : ?>
                                <option value="<?= $value->id ?>" <?= $notif->proceso_id == $value->id ? 'selected' : '' ?>><?= $value->NombreProceso ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <input name="responsable" id="responsable" type="hidden" value="<?= $notif->usuario_id ?>">
            <div class="col-sm-4" id="responsable_"></div>
            <div class="col-sm-12">
                <div class="form-group">
                    
                        <div class="col-md-4"><label for="registro">Registro</label>
                            <input type="checkbox" name="registro" id="registro" value="registro" <?php echo @in_array("registro", json_decode($notif->accion, true))?'checked':'';?>>
                        </div>
                        <div class="col-md-4"><label for="revision">Revision</label>
                            <input type="checkbox" name="revision" id="revision" value="revision"  <?php echo @in_array("revision", json_decode($notif->accion, true))?'checked':'';?>>
                        </div>
                        <div class="col-md-4"><label for="respuesta">Respuesta</label>
                            <input type="checkbox" name="respuesta" id="respuesta" value="respuesta" <?php echo @in_array("respuesta", json_decode($notif->accion, true))?'checked':'';?> ></div>
                    
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <input name="id" id="id" type="hidden" value="<?= $notif->id ?>">
                
                <input name="email_" id="email_" type="hidden" value="<?= $notif->email ?>">
                <input type="button" id="guardar" class="btn bg-green mt-5" value="Registrar">
            </div>
        </form>
    </div>
</div>
<script>
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formNoti").serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=notificaciones&a=registrar",

            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'BIEN HECHO!!',
                    text: response,
                 timer: 1500
                }, )
                setTimeout(function() {
             window.location = '?c=notificaciones&a=index_notificaciones';
                }, 1501)
            }
        })
    });


    $('#proceso_id').on('change', function() {
        var proceso = document.getElementById("proceso_id").value
        $.ajax({
            type: "POST",
            url: '?c=autoreportes&a=Asignar_responsable',
            data: {
                proceso: proceso
            },
            beforeSend: function() {
                $('#responsable_').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#responsable_').html(resp);
            }
        });
    });
</script>