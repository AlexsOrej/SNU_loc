<?php  //print_r($dato);
?>
<!-- Input -->
<!--   <div class="row clearfix">-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2> REGISTRAR DATO DEL INDICADOR </h2>
        </div>
        <div class="body">
            <form action="" name="f" id="f" method="post">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Nombre</label>
                                <?php $fecha = date('Y-m-d'); ?>
                                <input type="text" name="" class='form-control' value="<?php echo strtoupper($indicadors->nombre) ?>">
                                <input type="hidden" name="indicador_id" class='form-control' value="<?php echo $_REQUEST['id'] ?>">
                                <input type="hidden" name="dato_id" class='form-control' value="<?php echo $_REQUEST['dato_id'] ?>">
                            </div>
                        </div>
                    </div>
                    <label>Formula Seleccionada: <?php echo $indicadors->formula ?></label> <br>
                    <?php switch ($indicadors->formula_id) {
                        case 1:

                            echo '<div class="col-md-6">
                                                        <div class="form-line">
                                                           <label>A</label>
                                                           <input class="form-control"  type="number" id="dividendo" name="expr1"  oninput ="f1();" value="" required >
                                                        </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                        <div class="form-line">
                                                           <label>B</label>
                                                           <input class="form-control"  type="number" id="divisor" name="expr2"  oninput ="f1();" value="" required >
                                                        </div>
                                                      </div>
                                                    ';
                            break;
                        case 2:
                            echo '
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo" name="expr1"  oninput ="f2();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control" type="number"  id="divisor"  name="expr2" oninput ="f2();" value=""required  >
                                                </div>
                                               </div>';
                            break;
                        case 3:

                            echo '
                                                <div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo" name="expr1"  oninput ="f3();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr2"  oninput ="f3();" value="" required >
                                                  </div>
                                               </div>';
                            break;
                        case 4:
                            echo '<div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo" name="expr1"  oninput ="f4();" value=""required  >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr2"  oninput ="f4();" value="" required >
                                                  </div>
                                               </div>';

                            break;

                        case 5:
                            echo '<div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo" name="expr1"  oninput ="f5();" value=""required  >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr2"  oninput ="f5();" value=""required  >
                                                  </div>
                                               </div>';

                            break;
                        case 6:

                            echo '<div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo"  name="expr1" oninput ="f6();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr2"  oninput ="f6();" value="" required >
                                                  </div>
                                               </div>
                                                        
                                                     ';

                            break;
                        case 7:

                            echo '<div class="col-md-4">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="v1" name="expr1"  oninput ="f7();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-line">
                                                        <label>B</label>
                                                        <input class="col-md-3 form-control"  type="number" id="v2" name="expr2"  oninput ="f7();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-line">
                                                       <label>C</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr3"  oninput ="f7();" value="" required >
                                                  </div>
                                               </div>';

                            break;
                        case 8:

                            echo '<div class="col-md-4">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="v1" name="expr1"  oninput ="f8();" value="" required >
                                                    </div>
                                               </div>
                                               ';

                            break;

                        case 10:
                            echo '<div class="col-md-4">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="v1" name="expr1"  oninput ="f10();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-line">
                                                        <label>B</label>
                                                        <input class="col-md-3 form-control"  type="number" id="v2" name="expr2"  oninput ="f10();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-4">
                                                    <div class="form-line">
                                                       <label>C</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr3"  oninput ="f10();" value="" required >
                                                  </div>
                                               </div>';


                            break;
                        case 11:
                            echo '<div class="col-md-6">
                                                    <div class="form-line">
                                                        <label>A</label>
                                                        <input class="col-md-3 form-control"  type="number" id="dividendo"  name="expr1" oninput ="f11();" value="" required >
                                                    </div>
                                               </div>
                                               <div class="col-md-6">
                                                    <div class="form-line">
                                                       <label>B</label>
                                                       <input class="col-md-3 form-control"  type="number" id="divisor" name="expr2"  oninput ="f11();" value="" required >
                                                  </div>
                                               </div>
                                                        
                                                     ';


                            break;
                    } ?>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Resultado</label>
                                <input class="form-control" id="resultado" name="resultado" type="text" value="<?= $dato->resultado ?>" />

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fecha Aplicación</label>
                                <input class="form-control" name="fecha_aplicacion" id="fecha_aplicacion" type="date" value="<?= $dato->fecha_aplicacion ?>" required>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Fuente</label>
                                <textarea class="form-control" name="" readonly><?php echo $indicadors->definicion ?></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Interpretación</label>
                                <textarea class="form-control" name="" value="<?php echo $indicadors->interpretacion ?>" value="" readonly><?php echo $indicadors->interpretacion ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Periodicidad</label>
                                <input class="form-control" name="periodicidad" type="text" value="<?php echo  ucwords($indicadors->periodicidad)  ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Meta</label>
                                <select name="meta_id" id="meta_id" class='form-control'>
                                    <?php foreach ($metas as $meta) : ?>
                                        <option value="<?php echo $meta->id ?>" select><?php echo $meta->comparativo . '' . $meta->valor ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="id" type="hidden" value="<?php //echo $indicadors->id  
                                                        ?>">
                <input type="button" id="guardar" class="btn btn-default btn-block" value="Registrar">
            </form>
        </div>
    </div>
</div>
<!-- #END# Input -->
<script>
    $(document).on('click', '#guardar', function(e) {
        e.preventDefault();
        var data = $("#f").serialize();
        if (($('#fecha_aplicacion').val() != "") && ($('#Resultado').val() != "")) {
            $.ajax({
                data: data,
                type: "post",
                url: "?c=indicadors&a=AddDatos",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'El dato fue registrado con éxito',
                        text: 'Ahora registra el plan de acción',
                        timer: 1500
                    }, )
                    setTimeout(function() {
                        window.location = '?c=acciones&a=add&id=' + response.trim() + '&ind_id=<?= $_REQUEST["id"] ?>';
                    }, 1501)
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Debe diligenciar la fecha y el resultado',
                timer: 1500
            }, )
        }
    });


    function f1() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 / m2) * 100;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        // document.getElementById('resultado').innerHTML = resultado;
        document.f.resultado.value = resultado
    }

    function f2() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 - m2) * 100;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        // document.getElementById('resultado').innerHTML = resultado;
        document.f.resultado.value = resultado
    }

    function f3() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 / m2);
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        // document.getElementById('resultado').innerHTML = resultado;
        document.f.resultado.value = resultado
    }

    function f4() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 - m2);
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f5() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 * m2) / 100;
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f6() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 * m2) + 100;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f7() {
        m1 = document.getElementById("v1").value;
        m2 = document.getElementById("v2").value;
        m3 = document.getElementById("divisor").value;
        resultado = (m1 + m2) / m3 * 100000;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f8() {
        m1 = document.getElementById("v1").value;
        resultado = (m1);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f10() {
        m1 = document.getElementById("v1").value;
        m2 = document.getElementById("v2").value;
        m3 = document.getElementById("divisor").value;
        resultado = (m1 + m2 / m3) * 100;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }

    function f11() {
        m1 = document.getElementById("dividendo").value;
        m2 = document.getElementById("divisor").value;
        resultado = (m1 / m2) * 100000;
        resultado = resultado.toFixed(2);
        // Colocar el resultado de la suma en el control "span".
        document.f.resultado.value = resultado
    }
</script>