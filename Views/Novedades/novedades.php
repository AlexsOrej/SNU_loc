<?php //print_r($novedades[0]->descripcion); ?>


<? $cliente = $_SESSION['datos_cliente']->nombre; ?>
<div class="">
    <!-- <input type="hidden" onload="loadChart()">  -->
    <div style="display:none" id="main" style="width: 100%;height:400px;"></div>
    
    
        
   
       
    

    <div class="body">
        <div style=" padding-right: 20px;padding-top: 10px;height:60px;" class="row">
            <div class="col-sm-6 text-start"> 
                <h3>Novedades</h3>
            </div>
            <div class="col-sm-6 text-end">
                <button title="Botón para registrar una novedad" data-toggle="modal" data-target="#modelId" onclick="Add(<?= $novedades[0]->persona_id ?>)" class="neu  float-right"> <i class="glyphicon glyphicon-plus"></i> Registrar novedad</button><br>
            </div>
            <input type="hidden" name="" id="dato" value="<?= $dato ?>">
        </div>
        <!-- <table class="table table-bordered text-center"> -->
           
        <div class="">
            <table id="tbl_novedad" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Novedad</th>
                        <th>Descripción</th>
                        <th>Fecha del Evento</th>
                        <th>Fecha del Registro</th>
                        <th>Soporte</th>
                        <th>Opción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    $dataset = array();
                    $labels = array();
                                  
                    $num = 0;
                    if ($novedades[0]->descripcion == ""){

                    }else{

                    foreach ($novedades as $r) : 
                        if ($r->evento != null)
                        $labels[] = $r->evento;
                        // $num++;
                        // $dataset[] = $num;
                    ?>
                        <tr>
                            <td><a onClick="loadDynamicContentModal('<?php echo $r->id ?>')"><?php echo $r->evento; ?></a></td>
                            <td><?php echo substr($r->descripcion, 0, 50) . '...'; ?></td>
                            <td><?php echo $r->fecha_novedad; ?></td>
                            <td><?php echo $r->fecha_registro; ?></td>
                            <td>
                                <?
                                //echo $r->soporte;
                                if (empty($r->soporte)) {
                                    echo 'Sin Soporte';
                                } else {
                                    $uploadFileDir = 'Assets/img/' . $cliente . '/Personal/Novedades/' . $r->cedula . '/'  . $r->soporte;
                                    
                                    if (!file_exists($uploadFileDir) || !filesize($uploadFileDir)) {
                                        echo 'Sin Soporte';
                                       // echo $uploadFileDir;
                                    } else {
                                       // echo $uploadFileDir;
                                        echo '<a href="' . $uploadFileDir . '" target="_blank">Ver soporte</a>';
                                    }
                                }
                                ?>
                            </td>
                            <td style="vertical-align: middle;text-align: center;" >
                                <a title="Botón para una editar novedad" onClick="upDate('<?php echo $r->id ?>')" data-toggle="modal" data-target="#modelId" href="#"><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Botón para una borrar novedad" onclick="Borrar(<?php echo $r->id; ?>)" href="#" title="Botón para eliminar novedad" ><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                            
                            <?php endforeach; 
                             }    
                            // print_r($labels);
                            $array = array_count_values($labels);

                            $names = array();
                            $numbers = array();

                            foreach ($array as $name => $number) {
                                $names[] = $name;
                                $numbers[] = $number;
                            }

                            $label = json_encode($names);
                            $data = json_encode($numbers);
                    
                        
                        ?>
                        </tbody>
                <tfoot>
                    <th>Novedad</th>
                    <th>Descripción</th>
                    <th>Fecha del Evento</th>
                    <th>Fecha del Registro</th>
                    <th>Soporte</th>
                    <th>Opción</th>
                    </tr>
                </tfoot>
               
            </table>
        </div>
    <!-- </div> -->
   
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-header">
                
            </div>
            <div class="modal-body" id="registro"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
    

   


    <script>
        function Add(val) {

            var dato = document.getElementById('dato').value;
            var args = {
                idp: val,
                dato: dato,
                accion: "registrar"
            };
            var jsonArgs = JSON.stringify(args);

            $.ajax({
                type: "POST",
                url: '?c=novedades&a=Registro',
                data: jsonArgs,
                beforeSend: function() {
                    $('#registro').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                },
                success: function(data) {
                    $('#registro').html(data);
                }
            });
            $('.modal-open').css('overflow','hidden');

        }

        function upDate(val) {
            var dato = document.getElementById('dato').value;
            var args = {
                idp: val,
                dato: dato,
                accion: "modificar"
            };
            var jsonArgs = JSON.stringify(args);

            $.ajax({
                type: "POST",
                url: '?c=novedades&a=Registro',
                data: jsonArgs,
                // beforeSend: function() {
                //     $('#registro').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                // },
                success: function(data) {
                    $('#registro').html(data);
                }
            });
        }

        function Borrar(id) {   
        var dato = document.getElementById('dato').value;

        Swal.fire({
                title: "¿Estás seguro de eliminar esta novedad?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "GET",
                        url: '?c=Novedades&a=Delete',
                        data:  'id=' + id,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: "Registro eliminado",
                                timer: 1000
                            }, ).then((result) => {
                        setTimeout(function() {
                        //esto es el fading del modal que no me deja ver los resultados
                        $('.modal-backdrop').remove();
                        $('.modal-open').css('overflow','visible');

                        cargar(dato);
                    }, 1000);
                });
                           
                        }
                    });
                }
            });

    }
    function cargar(dato){
        $.ajax({
                        type: "POST",
                        url: '?c=novedades&a=resultado',
                        data: {
                            dato: dato
                        },
                        beforeSend: function() {
                            $('#resultado').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                        },
                        success: function(resp) {
                            $('#resultado').html(resp);
                        }
        });
    }

    
</script>


<script>
       
        // function loadChart() {
        //     var myChart = echarts.init(document.getElementById('main'));
        //     option = {
        //         title: {
        //             text: 'Novedades'
        //         },
        //         tooltip: {
        //             trigger: 'axis',
        //             axisPointer: {
        //                 type: 'shadow'
        //             }
        //         },
        //         xAxis: {
        //             data: <?php echo $label; ?>
        //         },
        //         yAxis: {
        //             name: 'Cantidad',
        //         },
        //         legend: {
        //          data: ['Cantidad'],
        //         },
        //         series: [{
        //             type: 'bar',
        //             data: <?php echo $data; ?>,
        //             barMaxWidth: 50,
        //             barMinHeight: 2
        //         }]
        //     };

        //     option && myChart.setOption(option);
        // }

        // $(document).ready(function() {
        //    // alert("ahi si cargas no?");
        //    loadChart();
        //   //$("#main").css("display","none");
        // });

        // // document.addEventListener("DOMContentLoaded", function() {
        // // // Tu código aquí se ejecutará después de que todo el código se haya ejecutado
        // // loadChart();
        // // });
        
        </script>