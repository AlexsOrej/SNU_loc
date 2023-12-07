<?php //print_r($_REQUEST['data']) ?>


<div class="row" >
    <div class="col-sm-6">
        <h4>Ausentismos</h4>
    </div>
    <div class="col-sm-6">
        <!-- <div style="padding-right:10px; padding-top:10px" class=" pull-right"> -->
        <button onclick="limpiar()" class="neu pull-right " data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-plus"> </i> Registrar</button> 
        <!-- </div> -->
    </div>


</div>


<div>
    <?php if ($ausentimos) : ?>
        <div id="tabla">
            <table id="" class="table table-bordered">
                <tr>
                    <th>Tipo</th>
                    <th>Diagnostico</th>
                    <th>Observaciones</th>
                    <th>Fecha Inicio</th>
                    <th>Dias Calendario</th>
                    <th>Horas de ausencia</th>
                    <th>Menu</th>
                </tr>
                <? foreach ($ausentimos as $value) : ?>
                    <tr>
                        <td><?= $value->evento ?> </td>
                        <td><?= $value->diagnostico ?></td>
                        <td><?= $value->observaciones ?></td>
                        <td><?= $value->f_inicio ?></td>
                        <td><?= $value->dias_calendario_ausente ?></td>
                        <td><?= $value->horas_ausente_real ?></td>
                        <td style="vertical-align: middle;text-align: center;">
                            <a type="button" onclick="Editar('<?= $value->id ?>')" class="" data-toggle="modal" data-target="#modelId" href="#"><i class="glyphicon glyphicon-edit"></i></a>
                            <a type="button" onclick="Borrar('<?= $value->id ?>')" class="" href="#"><i  style="color:#EB2A2A" class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                <? endforeach; ?>
            </table>
        </div>
        
    <?php else : ?>
        <h2>No Hay registros</h2>
    <?php endif; ?>
</div>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php //print_r($alm) ?>
                <div class="row">
                    <form action="" name="formAusentismo" id="formAusentismo" method="post">
                        <input name="id" id="id" value="<?= $alm->id; ?>" type="hidden" />
                        <input name="personal_id" id="personal_id" value="<?= $ausentimos[0]->personaid; ?>" type="hidden" />
                        <!-- <input type="hidden" id="diagnostico_mod" name="diagnostico_mod" value="na">
                        <input type="hidden" id="organo_mod" name="organo_mod" value="na"> -->

                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Tipo ausencia</label>
                                    <select name="tipo_ausencia_id" id="tipo_ausencia_id" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <? foreach ($tnoveda as $tnov) : ?>
                                            <option value="<?= $tnov->id ?>" <?= $alm->tipo_ausencia_id == $tnov->id ? 'selected' : ''; ?>><?= $tnov->evento ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>cie10</label>
                                    <input name="cie10" id="cie10" value="<?php echo $alm->cie10; ?>" type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div id="resulcie10">
                        <div class="col-sm-4">
                    <div class="form-group">
                            <div class="form-line">
                                <label>Diagnostico</label>
                                <input name="diagnostico" id="diagnostico" value="<?= $alm->diagnostico ?>" type="text" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <label>Organo/Sistema</label>
                                <input name="organo_sistema" id="organo_sistema" value="<?= $alm->organo_sistema ?>" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                        </div>             

                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Dias Calendario Ausente</label>
                                    <input name="dias_calendario_ausente" id="dias_calendario_ausente" value="<?php echo $alm->dias_calendario_ausente; ?>" type="number" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Horas Ausente Real</label>
                                    <input name="horas_ausente_real" id="horas_ausente_real" value="<?php echo $alm->horas_ausente_real; ?>" type="number" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Incapacidad Genarada Por</label>
                                    <select name="incap_genarada_por" id="incap_genarada_por" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <option value="4" <?= $alm->incap_genarada_por == 4 ? 'selected' : '' ?>>NO APLICA</option>
                                        <option value="1" <?= $alm->incap_genarada_por == 1 ? 'selected' : '' ?>>EPS</option>
                                        <option value="2" <?= $alm->incap_genarada_por == 2 ? 'selected' : '' ?>>PREPAGADA</option>
                                        <option value="3" <?= $alm->incap_genarada_por == 3 ? 'selected' : '' ?>>PARTICULAR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombre IPS</label>
                                    <input name="nom_ips" id="nom_ips" value="<?php echo $alm->nom_ips; ?>" type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Nombre del Profesional</label>
                                    <input name="nom_profesional" id="nom_profesional" value="<?php echo $alm->nom_profesional; ?>" type="text" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Inicio</label>
                                    <input name="f_inicio" id="f_inicio" value="<?php echo $alm->f_inicio; ?>" type="date" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Fecha Fin</label>
                                    <input name="f_fin" id="f_fin" value="<?php echo $alm->f_fin; ?>" type="date" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Soporte Original</label>
                                    <select name="soporte_original" id="soporte_original" class="form-control">
                                        <option value="">Seleccionar</option>
                                        <option value="1" <?= $alm->soporte_original == 1 ? 'selected' : '' ?>>SI</option>
                                        <option value="2" <?= $alm->soporte_original == 2 ? 'selected' : '' ?>>NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Observaciones generales y seguimiento</label>
                                    <textarea name="observaciones" id="observaciones" value="<?php echo $alm->observaciones; ?>" type="text" class="form-control" placeholder=""><?php echo $alm->observaciones; ?></textarea>
                                </div>
                            </div>
                            <input type="hidden" id="cargar" onload="cie10()">
                        </div>
                </div>
               

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-orange" id="cerrar" data-dismiss="modal">Cerrar</button>
                <button  type="button" id="guardar" onclick="guardar()" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="dato" value="<?= $_REQUEST['data'] ?>">

<script>
function guardar(){
         // Acceder al campo personal_id
         var personal_id = document.getElementById("personal_id").value;

// Acceder al campo tipo_ausencia_id
var tipo_ausencia_id = document.getElementById("tipo_ausencia_id").value;

// Acceder al campo cie10
var cie10 = document.getElementById("cie10").value;

// Acceder al campo diagnostico
//var diagnostico = document.getElementById("diagnostico").value;

// Acceder al campo organo_sistema
//var organo_sistema = document.getElementById("organo_sistema").value;

// // Acceder al campo mes_evento
// var mes_evento = document.getElementById("mes_evento").value;

// // Acceder al campo dia_evento
// var dia_evento = document.getElementById("dia_evento").value;

// Acceder al campo dias_calendario_ausente
var dias_calendario_ausente = document.getElementById("dias_calendario_ausente").value;

// Acceder al campo horas_ausente_real
var horas_ausente_real = document.getElementById("horas_ausente_real").value;

// Acceder al campo incap_genarada_por
var incap_genarada_por = document.getElementById("incap_genarada_por").value;

// Acceder al campo nom_ips
var nom_ips = document.getElementById("nom_ips").value;

// Acceder al campo nom_profesional
var nom_profesional = document.getElementById("nom_profesional").value;

// Acceder al campo observaciones
var observaciones = document.getElementById("observaciones").value;

// Acceder al campo soporte_original
var soporte_original = document.getElementById("soporte_original").value;

// Acceder al campo f_inicio
var f_inicio = document.getElementById("f_inicio").value;

// Acceder al campo f_fin
var f_fin = document.getElementById("f_fin").value;


if (personal_id == "" || tipo_ausencia_id == "" || cie10 == "" || /*diagnostico == "" || organo_sistema == "" || */ dias_calendario_ausente == "" || horas_ausente_real == "" || incap_genarada_por == "" || nom_ips == "" || nom_profesional == "" || observaciones == "" || soporte_original == "" || f_inicio == "" || f_fin == "") {
    Swal.fire({
        icon: 'error',
        title: 'Todos los Campos son Obligatorios',
        //timer: 1500,
        showConfirmButton: false,
    }, )
} else {
    var datos = $('#formAusentismo').serialize();
    $.ajax({
        type: "POST",
        url: '?c=ausentismos&a=Crud',
        data: datos,
        success: function(resp) {
            Swal.fire({
                icon: 'success',
                title: 'BIEN HECHO!!',
                text: resp,
                timer: 1500,
                showConfirmButton: false,
            }, ).then((result) => {
                        CierraPopup();
                        setTimeout(function() {
                        cargar();
                    }, 1000);
                });
           
            // setTimeout(function() {
            //     $('#buscar').click();
            //     cargar();
            // }, 1500)
        }
    });

    function CierraPopup() {
        $('#cerrar').click(); //Esto simula un click sobre el botón close de la modal, por lo que no se debe preocupar por qué clases agregar o qué clases sacar.
        $('.modal-backdrop').remove(); //eliminamos el backdrop del modal
    }
}
    }

   

 


        $('#cie10').on('change', function() {
            var cie10 = document.getElementById("cie10").value
            if (cie10.length === 4) {
                $.ajax({
                    type: "POST",
                    url: '?c=ausentismos&a=cie10',
                    data: {
                        cie10: cie10,
                    },
                    beforeSend: function() {
                        $('#resulcie10').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
                    },
                    success: function(resp) {
                        $('#resulcie10').html(resp);
                    }
                });
            }
        });
    //});


    function Editar(ausentismo_id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "?c=ausentismos&a=editar",
            data: {
                ausentismo_id: ausentismo_id
            },
            success: function(response) {
                console.log(response['organo_sistema']);
                $("#dias_calendario_ausente").val(response['dias_calendario_ausente']);
                $("#horas_ausente_real").val(response['horas_ausente_real']);
                $("#diagnostico").val(response['diagnostico']);
                $("#observaciones").val(response['observaciones']);
                $("#f_inicio").val(response['f_inicio']);
                $("#f_fin").val(response['f_fin']);
                $("#tipo_ausencia_id").val(response['tipo_ausencia_id']).trigger('change');
                $("#incap_genarada_por").val(response['incap_genarada_por']).trigger('change');
                $("#full_name").val(response['full_name']);
                $("#id").val(response['id']);
                $("#organo_sistema").val(response['organo_sistema']);               
                $("#cie10").val(response['cie10']); 
                $("#diagnostico_mod").val(response['diagnostico']);
                $("#organo_mod").val(response['organo_sistema'])
                $("#nom_ips").val(response['nom_ips']);               
                $("#nom_profesional").val(response['nom_profesional']);               
                $("#soporte_original").val(response['soporte_original']);               
                $("#ausentismosid").val(response['ausentismosid']);               
            }
        });
    }

    function limpiar(){
                $("#dias_calendario_ausente").val("");
                $("#horas_ausente_real").val("");
                $("#diagnostico").val("");
                $("#observaciones").val("");
                $("#f_inicio").val("");
                $("#f_fin").val("");
                $("#tipo_ausencia_id").val("").trigger('change');
                $("#incap_genarada_por").val("").trigger('change');
                $("#full_name").val("");
                $("#id").val("");
                $("#organo_sistema").val("");               
                $("#cie10").val(""); 
                $("#diagnostico_mod").val("");
                $("#organo_mod").val("");
                $("#nom_ips").val("");               
                $("#nom_profesional").val("");               
                $("#soporte_original").val("");               
                $("#ausentismosid").val("");    
    }

    // function cie10(accion) {
    //      var cie10 = document.getElementById("cie10").value; // This is an example, you need to provide the cie10 code.
    //      //alert();
    //     // Wrap the AJAX call in a setTimeout to avoid blocking the call stack.
    //     if(accion == "mod"){
    //         setTimeout(function() {
    //         $.ajax({
    //         type: "POST",
    //         url: '?c=ausentismos&a=cie10',
    //         data: {
    //             cie10: cie10,
    //         },
    //         beforeSend: function() {
    //             $('#resulcie10').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
    //         },
    //         success: function(resp) {
    //             $('#resulcie10').html(resp);
    //         }
    //         });
    //     }, 0);
    //     }
    // }

    function Borrar(id) {      
        Swal.fire({
                title: "¿Estás seguro de eliminar este ausentismo?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "GET",
                        url: '?c=ausentismos&a=Borrar',
                        data:  'id-eliminar=' + id,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: response,
                                text: "Eliminacion correcta",
                                timer: 2000
                                }, )
                                    setTimeout(function() {
                                    cargar();
                                }, 1000); 
                        }
                    });
                }
            });
    }

   


    function cargar(){
            
            var data = document.getElementById("dato").value;
            //alert(data);
            $.ajax({
                    type: "POST",
                    url: '?c=ausentismos&a=buscar',
                    data: {
                        data: data
                    },
                    success: function(response) {
                        $('#resultado').html(response);

                    }
                });
        }

   
</script>

