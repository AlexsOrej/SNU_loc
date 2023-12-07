<div class="row">
    <div class="col-sm-12">
        <div class='form-group'>
            <div class='form-line'>
                <label>Modo Elaboración</label>
                <select name='modos' id='modos' class='form-control'>
                    <option value=''>Seleccionar</option>
                    <option value='subir'>Subir Documento</option>
                    <option value='online'>En linea</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class='form-group' id="tipo" style="display: none;">
            <div class='form-line'>
                <label>Tipo Documento</label>
                <select name='modostipo' id='modostipo' class='form-control'>
                    <option value=''>Seleccionar</option>
                    <option value='procedimiento'>Procedimiento</option>
                    <option value='caracterizacion'>Caracterización</option>
                    <option value='mapa'>Mapa</option>
                </select>
            </div>
        </div>
        <div class="form-group" id="filename_div" style="display: none;" data-toggle="tooltip" data-placement="bottom" title="Words o excel de un peso maximo de 2MB">
            <div class="form-line">
                <label>Adjuntar Archivo</label>
                <input type="file" name="filename" class='form-control' value="">
                <input type="hidden" name="dir" class='form-control' value="">
                <input type="hidden" name="Aprobado" id="Aprobado" class='form-control' value="">
            </div>
        </div>
    </div>
</div>
<script>
    $('#modos').on('change', function() {
        var modos = document.getElementById('modos').value
        var filename_div = document.getElementById('#filename_div');
        console.log(modos.length);
        if (modos.length != 0) {
            if (modos != 'subir') {
                $("#filename_div").hide();
                $("#tipo").show();
            } else {
                $("#filename_div").show();
                $("#tipo").hide();
            }
        }else{
            $("#filename_div").hide();
            $("#tipo").hide();
        }
    });
</script>