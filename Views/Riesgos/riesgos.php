
<div class="container-fluid">
<div style="padding:1.5%">
    <div style="padding:1%; margin-bottom:10px;" class="row card">
        <div style="margin-bottom: 0px; padding:2%; vertical-align: middle;" class="col-sm-4">
            <a class="btn bg-orange" href="?c=riesgos&a=index">volver</a>
        </div> 
        <div style="margin-bottom: 0px;" class="col-sm-8 ">
            <h2 style="margin:0px; padding:2%;" class="m-0 p-0">Tratamiento del riesgo</h2>
            <?php //print_r($riesgo) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div style="padding:3%; height:350px"  class="card">
            <h3><?php echo $riesgo->riesgo ?></h3>
            
            <p>Descripcion:<?php echo $riesgo->descripcion ?> </p>
            <div style="border-radius:5px; background-color: #0d6efd; color:white; padding:2%" class="">
                <p><b>Probabilidad:</b><?php echo $riesgo->valorProbabilidad ?></p>
                <p><b>Impacto:</b><?php echo $riesgo->valorImpacto ?></p>
                <?php $resultado = $riesgo->valorProbabilidad*$riesgo->valorImpacto ?>
                <p><b>Resultado del riesgo:</b><?php echo $resultado?></p>
            </div>
           
        </div>
    </div>
    <div class="col-md-6">
        <div style="padding:5%; height:350px; vertical-align: middle;text-align: center;"  class="card text-center">
            <h3>matriz de calor</h3>

            <?php //print_r($valoresI);
            // Inicializa una matriz vacía para almacenar los resultados
                $resultados = array();

                // Recorre los elementos de $valoresP
                for ($i = 0; $i < count($valoresP); $i++) {
                    // Inicializa la fila actual de resultados
                    $resultado_fila = array();

                    // Multiplica cada elemento de $valoresP por el correspondiente de $valoresI
                    for ($j = 0; $j < count($valoresI); $j++) {
                        // Calcula el resultado y agrega a la fila actual
                        $resultado_fila[] = $valoresP[$i] * $valoresI[$j];
                    }

                    // Agrega la fila actual a la matriz de resultados
                    $resultados[] = $resultado_fila;
                }
                // Muestra la matriz resultante en formato de tabla
                echo '<table class="mapa table table-borderless table-condensed table-responsive-sm" style="width:100%" border="1"><thead><tr><th></th>';

                // Imprimir encabezados con los valores de $valoresI
                

                foreach ($valoresI as $valorI) {
                    echo '<th style="vertical-align: middle;text-align: center;">' . $valorI . '</th>';
                }
                echo '</tr></thead><tbody>';

                // Imprimir valores de $valoresP y resultados de la multiplicación
                foreach ($resultados as $index => $fila) {
                    echo '<tr>';
                    echo "<td style='vertical-align: middle;text-align: center;'>" ,"<b>". $valoresP[$index] ."</b>". "</td>";

                    // foreach ($fila as $valor) {
                    //     //$background = 'white'; // Color predeterminado
                    //     foreach ($nivelRiesgo as $riesgo && $fila as $valor ) {
                    //         if ($riesgo->rango <= $valor) {
                    //             $background = $riesgo->color;
                    //             $nivel = $riesgo->nombre;
                    //         }
                    //     }
                    //     echo '<td style="padding:1%; background:' . $background . ';">' . $valor."<br>". "<small>".$nivel."</small>" . '</td>';

                    // }
                    foreach ($fila as $valor) {
                        $background = 'red'; // Color predeterminado
                        $nivel = ''; // Inicializar la variable nivel
                        

                    
                        foreach ($nivelRiesgo as $riesgos) {
                            if ($riesgos->rango >= $valor) {
                                if ($valor == $riesgo->nivel_riesgo){
                                    $background = "white";
                                   
                                }else{
                                    $background = $riesgos->color." ; color:#494949";
                                }
                                $nivel = $riesgos->nombre;
                                break;
                            }
                        }
                    
                        echo '<td style="vertical-align: middle;text-align: center; font-weight:bold; padding:1%; background:' . $background . ';">' . $valor . "<br>" . "<small>" . $nivel ."</small>" . '</td>';
                    }

                    echo '</tr>';
                }

                echo '</tbody></table>';

                ?>
            </div>
    </div>
    <div class="col-md-12">
        <div style="padding:2%; height:300px"  class="card">
            <div class="pull-right"><button class="neu">Asignar</button></div>
            <h3>Controles</h3>
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Calificación</th>
                        <th>Fecha</th>


                        
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </thead>
                <tbody>
                   
                    <?php foreach ($controles as $value) : ?>
                        <tr class="">
                            <td><?php echo  $value->nombre ?></td>
                            <td><?php echo  $value->descripcion ?></td>
                            <td><?php //echo  $value->descripcion ?></td>
                            <td><?php echo  $value->fecha ?></td>



                            <td style="vertical-align: middle;text-align: center;">
                                <a title="Evaluar control" href="?c=controles&a=evaluar&id=<?= $value->id ?>"> 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="orange" height="16" width="12" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 40c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm121.2 231.8l-143 141.8c-4.7 4.7-12.3 4.6-17-.1l-82.6-83.3c-4.7-4.7-4.6-12.3 .1-17L99.1 285c4.7-4.7 12.3-4.6 17 .1l46 46.4 106-105.2c4.7-4.7 12.3-4.6 17 .1l28.2 28.4c4.7 4.8 4.6 12.3-.1 17z"/></svg>
                                </a>
                                <a title="Botón para editar un proceso"  onclick="Editar('<?php echo $value->id ?>')" data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                                <!-- <a title="Botón para borrar un proceso" href="#" onclick="Borrar('<?php echo $value->id ?>')"><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a> -->
                            </td>
                        </tr>
                    <?php endforeach;
                   ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Calificacion</th>
                        <th>Fecha</th>
                        <th style="vertical-align: middle;text-align: center;">Menu</th>
                    </tr>
                </tfoot>
            </table>    
        </div>
    </div>
    <div class="col-md-6">
        <div style="padding:3%; height:300px"  class="card">
            <div class="pull-right"><button class="neu">Registrar</button></div>
            <h3>Causas / Consecuencias</h3>
            <table class="table table-bordered">
                <thead>
                    <th>nombre</th>
                    <th>Descripcion</th>
                    <th>Menu</th>

                </thead>
                <tbody>
                    <td>causa <br> tipo <br>categoria
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis nesciunt repudiandae cupiditate! Odio, culpa ducimus voluptatibus ipsa rem, distinctio cum debitis nobis sequi dicta ea quidem? Vel tempora est at.</td>
                    <td>  
                        <a title="Botón para editar un proceso"   data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                        <a title="Botón para borrar un proceso" href="#" ><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                    </td>

                </tbody>
               
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div style="padding:3%; height:300px"  class="card">
            <div class="pull-right"><button class="neu">Registrar</button></div>
            <h3>Acciones</h3>
            <table class="table table-bordered">
                <thead>
                    <th>nombre</th>
                    <th>Descripcion</th>
                    <th>Menu</th>

                </thead>
                <tbody>
                    <td>causa <br> tipo <br>categoria
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis nesciunt repudiandae cupiditate! Odio, culpa ducimus voluptatibus ipsa rem, distinctio cum debitis nobis sequi dicta ea quidem? Vel tempora est at.</td>
                    <td>  
                        <a title="Botón para editar un proceso"   data-toggle="modal" href='#modal-id'><i class="glyphicon glyphicon-edit"></i></a>
                        <a title="Botón para borrar un proceso" href="#" ><i style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                    </td>

                </tbody>
               
            </table>
        </div>
    </div>
</div>

</div>