<!-- <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Identificación</th>
            <th>Nombres y Apellidos</th>
            <th>Sexo</th>
            <th>Tipo Vivienda</th>
            <th>CUANTAS PERSONAS DEPENDE DEL TRABAJADOR?</th>
            <th>CUANTAS PERSONAS VIVE?</th>
            <th>USTED TIENE HIJOS MENORES DE 25 AÑOS?</th>
            <th>USTED TIENE HIJOS MENORES DE 25 AÑOS?</th>
            <th>ALERGIA</th>
            <th>NORMALMENTE CUAL ES SU MEDIO DE TRANSPORTE</th>
            <th>CUANTO TIEMPO TARDA EN DESPLAZARSE DE SU CASA AL INSTITUTO?</th>
            <th>EN QUE USAS EL TIEMPO LIBRE?</th>
            <th>TIENES OTRO TRABAJO O FORMA DE INGRESO ECONOMICO?</th>
            <th>CONSUME CIGARRILLO?</th>
            <th>CONSUME LICOR?</th>
            <th>REALIZA DEPORTE O EJERCICIO O ACTIVIDAD FISICA?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>        
    </tbody>
</table> -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Registro de Novedad</h3>
    </div>
    <div class="panel-body">
        <form id="formCrud" name="formCrud" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?=$nov->id?>" class="form-control">
        <input type="hidden" id="persona_id" name="persona_id" value="<?=$_REQUEST['idp']?>" class="form-control">
            <div class="col-md-6 text-center">             
                <label>Tipo de Novedad</label>
                <select id="tipo_id" name="tipo_id" class="form-control"  placeholder="" onChange="mostrar(this.value);">
                    <option value="" selected>Seleccion</option>
                    <?php foreach ($tiposnovedades as $t) : ?>
                        <option value="<?php echo $t->id ?>" <?= $t->id == $nov->tipo_id?'selected': ''?> ><?php echo $t->evento ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 text-center">
                <label for="">Fecha del Evento</label>
                <input name="fevento" id="fevento" type="date" class="form-control" value="<?=$nov->fecha_novedad?>">
            </div>
            <!-- <div class="col-md-3 text-center">
                <label for="">Fecha del Registro</label> -->
                <input name="fregistro" id="fregistro" type="hidden" class="form-control" value="<?=date('Y-m-d')?>">
            <!-- </div> -->
            <div class="col-md-12">
                <div class="form-line">
                    <label for="">Soporte</label>
                    <input type="file" id="file" name="file" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <label for="">Descripción</label>
                <textarea rows="3" cols="6" name="descripcion" id="descripcion" class="form-control" value=""><?=$nov->descripcion?></textarea>
            </div>
            <div class="col-md-12 text-center">
                <br>
            <input type="button" id="guardar" value="Guardar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<script>
      $(document).on('click', '#guardar', function(e) {        
        var formData = new FormData($("#formCrud")[0]);
        $.ajax({
            url: "?c=novedades&a=Crud",
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
                  window.location.reload();  
                //$("#registro").load(" #registro > *");               
                }, 2000)

            }
        });
    });
</script>