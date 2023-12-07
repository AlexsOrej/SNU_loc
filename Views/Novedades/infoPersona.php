<div style="padding-left:3%;">
    <div id="carta" class="card" >
        <div class="row" style="padding:3%;">
                <div  class="col-sm-6">
                    <h4> <?php echo $novedades[0]->fullNombre; ?></h4><br>
                   
          
   
                        <b>Celdula: </b><?php $_SESSION['persona'] = $novedades[0]->cedula;
                           echo $novedades[0]->cedula; ?><br>
                        <br>
                        <b>Correo: </b><?php echo $novedades[0]->Correo; ?><br>
                        <br>
                        <b>Celular: </b><?php echo $novedades[0]->celular; ?><br>

                    <!-- <div style="margin-top:50px;" class="text-center">
                        <button title="Botón para registrar una novedad" data-toggle="modal" data-target="#modelId" onclick="Add(<?= $novedades[0]->persona_id ?>)" class="neu"> <i class="glyphicon glyphicon-plus"></i> Registrar novedad</button><br>
                    </div> -->
                   
                    
                

                </div>
                <div class="col-sm-6">
                    <div class="text-center">
                        <h4>Novedades</h4>
                    </div>
                    <div  id="main" style="width: 100%;height:350px;"></div>
                </div>
            
        </div>
    </div>
</div>

<?php   
                    $dataset = array();
                    $labels = array();
                                  
                    $num = 0;
                    foreach ($novedades as $r) : 
                        if ($r->evento != null)
                        $labels[] = $r->evento;
                        // $num++;
                        // $dataset[] = $num;
                    endforeach   
                    ?>
                    <?php
                    // print_r($labels);
                    $array = array_count_values($labels);

                    $names = array();
                    $numbers = array();

                    foreach ($array as $name => $number) {
                        $names[] = $name;
                        $numbers[] = $number;
                    }

                    // $label = json_encode($names);
                    // $data = json_encode($numbers);
                    // print_r($label);

                    $data_objects = array();
                    for ($i = 0; $i < count($names); $i++) {
                        $data_objects[] = (object) array('value' => $numbers[$i], 'name' => $names[$i]);
                    }
                    
                    $data = json_encode($data_objects);
                    //print_r($data);
                    
                    ?>

<script src="https://cdn.bootcdn.net/ajax/libs/echarts/5.1.2/echarts.min.js"></script>

<script>
       
        function loadChart() {
            var myChart = echarts.init(document.getElementById('main'));
            option = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    left: 'center',
                    bottom: 0.1

                },
                series: [
                    {
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: true,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                        show: true,
                        fontSize: 40,
                        fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: <?php echo $data;?>
                    // data: [
                    //     { value: 1048, name: 'Search Engine' },
                    //     { value: 735, name: 'Direct' },
                    //     { value: 580, name: 'Email' },
                    //     { value: 484, name: 'Union Ads' },
                    //     { value: 300, name: 'Video Ads' }
                    // ]
                    }
                ]
                };
            // option = {
            //     title: {
            //         text: 'Novedades'
            //     },
            //     tooltip: {
            //         trigger: 'axis',
            //         axisPointer: {
            //             type: 'shadow'
            //         }
            //     },
            //     xAxis: {
            //         data: <?php //echo $label; ?>
            //     },
            //     yAxis: {
            //         name: 'Cantidad',
            //     },
            //     legend: {
            //      data: ['Cantidad'],
            //     },
            //     series: [{
            //         type: 'bar',
            //         data: <?php //echo $data; ?>,
            //         barMaxWidth: 50,
            //         barMinHeight: 2
            //     }]
            // };

            option && myChart.setOption(option);
        }

        $(document).ready(function() {
           // alert("ahi si cargas no?");
           loadChart();
          //$("#main").css("display","none");
        });

        // document.addEventListener("DOMContentLoaded", function() {
        // // Tu código aquí se ejecutará después de que todo el código se haya ejecutado
        // loadChart();
        // });
        
        </script>