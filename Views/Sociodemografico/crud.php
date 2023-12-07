<div class="card">
    <div class="header">
        <h2>
            Perfil Sociodemográfico
            <!-- <small>List group items may be buttons instead of list items (that also means a parent <code>&lt;div&gt;</code> instead of an <code>&lt;ul&gt;</code>). No need for individual parents around each element. Don't use the standard <code>.btn</code> classes here.</small> -->
        </h2>
    </div>
    <div class="body">
        <div class="row clearfix">
            <form id="formdata" name="formdata">
                <div class="col-md-12">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label># Personas dependientes?</label>
                                <input type="hidden" name="persona_id" id="persona_id"
                                    value="<?= $_REQUEST['personal_id'] ?>">
                                <input type="hidden" name="id" id="id" value="<?= $sd->id ?>">
                                <input type="text" name="dependientes" id="dependientes"
                                    value="<?= $sd->dependientes ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>#personas convives(incluyete)?</label>
                                <input type="text" name="num_dependientes" id="num_dependientes"
                                    value="<?= $sd->cuantas_personas_vive ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Tiene Alergias?</label>
                                <select name="alergia" id="alergia" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="si" <?= $sd->alergias == 'si' ? 'selected' : '' ?>>Si</option>
                                    <option value="no" <?= $sd->alergias == 'no' ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Cuales?</label>
                                <input type="text" name="cual_alergia" id="cual_alergia"
                                    value="<?= $sd->cual_alergia ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Transporte al trabajo</label>
                                <select name="transporte" id="transporte" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="A Pie" <?= $sd->medio_transporte == 'A Pie' ? 'selected' : '' ?>>A Pie
                                    </option>
                                    <option value="Servicio Publico" <?= $sd->medio_transporte == 'Servicio Publico' ? 'selected' : '' ?>>Servicio Publico</option>
                                    <option value="Bicicleta" <?= $sd->medio_transporte == 'Bicicleta' ? 'selected' : '' ?>>
                                        Bicicleta</option>
                                    <option value="Moto" <?= $sd->medio_transporte == 'Moto' ? 'selected' : '' ?>>Moto</option>
                                    <option value="Carro" <?= $sd->medio_transporte == 'Carro' ? 'selected' : '' ?>>Carro
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Tiempo de desplazamiento(min)</label>
                                <input type="number" name="tiempo_trans" id="tiempo_trans"
                                    value="<?= $sd->tiempo_desplazamiento ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Uso Tiempo libre</label>
                                <input type="text" name="tiempo_libre" id="tiempo_libre"
                                    value="<?= $sd->uso_tiempo_libre ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Tiene otros trabajos?</label>
                                <select name="otro_trabajo" id="otro_trabajo" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="si" <?= $sd->otros_trabajos == 'si' ? 'selected' : '' ?>>Si</option>
                                    <option value="no" <?= $sd->otros_trabajos == 'no' ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                        </div>
                    </div>                      
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Consume Cigarillo?</label>
                                <select name="cigarrillo" id="cigarrillo" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="Nunca" <?= $sd->fuma == 'Nunca' ? 'selected' : '' ?>>Nunca</option>
                                    <option value="Ocasionalmente" <?= $sd->fuma == 'Ocasionalmente' ? 'selected' : '' ?>>
                                        Ocasionalmente</option>
                                    <option value="1 a 5" <?= $sd->fuma == '1 a 5' ? 'selected' : '' ?>>1 a 5 cigarrillos
                                        diarios</option>
                                    <option value="5 a 10" <?= $sd->fuma == '5 a 10' ? 'selected' : '' ?>>5 a 10 cigarrillos
                                        diarios</option>
                                    <option value="10 a 15" <?= $sd->fuma == '10 a 15' ? 'selected' : '' ?>>10 a 15 cigarrillos
                                        diarios</option>
                                    <option value="15 a 20" <?= $sd->fuma == '15 a 20' ? 'selected' : '' ?>>15 a 20 cigarrillos
                                        diarios</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Consume Licor?</label>
                                <select name="licor" id="licor" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="Nunca" <?= $sd->licor == 'Nunca' ? 'selected' : '' ?>>Nunca</option>
                                    <option value="Ocasionalmente" <?= $sd->licor == 'Ocasionalmente' ? 'selected' : '' ?>>
                                        Ocasionalmente</option>
                                    <option value="Diario" <?= $sd->licor == 'Diario' ? 'selected' : '' ?>>Diario</option>
                                    <option value="Semanal" <?= $sd->licor == 'Semanal' ? 'selected' : '' ?>>Semanal</option>
                                    <option value="Quincenal" <?= $sd->licor == 'Quincenal' ? 'selected' : '' ?>>Quincenal
                                    </option>
                                    <option value="Mensual" <?= $sd->licor == 'Mensual' ? 'selected' : '' ?>>Mensual</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Realiza ejercicio/deporte?</label>
                                <select name="ejercicio" id="ejercicio" class="form-control" required="required">
                                    <option value="">Seleccionar</option>
                                    <option value="Nunca" <?= $sd->realiza_ejercicio == 'Nunca' ? 'selected' : '' ?>>Nunca
                                    </option>
                                    <option value="Ocasionalmente"
                                        <?= $sd->realiza_ejercicio == 'Ocasionalmente' ? 'selected' : '' ?>>Ocasionalmente
                                    </option>
                                    <option value="-3 veces por semana" <?= $sd->realiza_ejercicio == '-3 veces por semana' ? 'selected' : '' ?>>-3 veces por semana</option>
                                    <option value="+3 veces por semana" <?= $sd->realiza_ejercicio == '+3 veces por semana' ? 'selected' : '' ?>>+3 veces por semana</option>
                                    <option value="1 vez x semana" <?= $sd->realiza_ejercicio == '1 vez x semana' ? 'selected' : '' ?>>1 vez x semana</option>
                                    <option value="1 vez x mes" <?= $sd->realiza_ejercicio == '1 vez x mes' ? 'selected' : '' ?>>1 vez x mes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button title="Botón para guardar datos" type="button" style="border:none" class="btn-guardar btn-block" id="botonenviar">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#botonenviar').click(function () {
            if (($('#cliente_id').val() != "") && ($('#servicio_id').val() != "") && ($('#f_inicio').val() != "")) {
                var datos = $('#formdata').serialize();
                $.ajax({
                    type: "POST",
                    url: "?c=sociodemografico&a=crud",
                    data: datos,
                    success: function (r) {
                        if (r == 1) {
                            alert("Fallo al agregar");
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'BIEN HECHO',
                                timer: 1500
                            },)
                            setTimeout(function () {
                                // window.location = '?c=solicitudes&a=index';
                               window.location.reload(1);
                            }, 2000)
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'CAMPOS SI LLENAR',
                    timer: 1500
                },)
            }
            return false;
        });

        $(function () {
            $("#alergia").change(function () {
                if ($(this).val() === "si") {
                    $("#cual_alergia").prop("disabled", false);
                } else {
                    $("#cual_alergia").prop("disabled", true);
                }
            });
        });

    });
</script>