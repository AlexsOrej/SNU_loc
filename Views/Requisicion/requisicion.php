<div class="well well-sm text-right">
    <!--<a class="btn btn-primary" data-toggle="modal" href='#modal-id' onclick="Index()">NUEVA REQUISICION</a>-->
    <a href="?c=requisicion&a=Crud" class="btn btn-primary" data-toggle="modal" href='#modal-id'>NUEVA REQUISICION</a>
</div>
<?php $solicitante = $_SESSION['all'][0]['rol_id'];?>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    REQUISICION INTERNA DE PERSONAL
                </h2>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Num</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                                <th>Cargo</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Num</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                                <th>Cargo</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th> </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php

                        //print_r($this->model->Listar($id));
                        foreach ($this->model->Listar() as $r): 
                        if($r->estado == 'Contratado'):
                            $color= "success";
                            endif;
                        if($r->estado == 'Aceptado'):
                            $color= "warning";
                            endif;
                        if($r->estado == 'Solicitud'):
                            $color= "danger";
                            endif;
                        ?>
                            <tr >
                                <td class="<?php echo $color?>" ><?php echo $r->id; ?></td>
                                <td class="<?php echo $color?>" ><?php echo $r->cliente; ?></td>
                                <td class="<?php echo $color?>" ><?php echo $r->codigo_obra.' '. $r->obra; ?></td>
                                <td class="<?php echo $color?>" ><?php echo $r->cargo; ?></td>
                                <td class="<?php echo $color?>" ><?php echo $r->ciudad; ?></td>
                                <td class="<?php echo $color?>"><?php echo $r->estado; ?></td>
                                <td class="<?php echo $color?>">
                                    <?php   if($r->estado == 'Contratado'):?>
                                        <a onclick="Ver(<?php echo $r->id; ?>)" title="Ver" data-toggle="modal"
                                        href='#modal-id1'><i class="material-icons  md-18">preview</i></a>
                                            
                                    <?php else: ?>
                                    
                                    <a onclick="Edit(<?php echo $r->id; ?>)" title="Editar" data-toggle="modal"
                                        href='#modal-id'><i class="material-icons  md-18">edit</i></a>
                                        <?php
                                         $aut=array(3, 5);
                                         if(in_array($solicitante, $aut)):?>
                                    <a onclick="Autorizacion(<?php echo $r->id; ?>)" title="Autorizar"
                                        data-toggle="modal" href='#modal-id'><i
                                            class="material-icons  md-18">cloud_done</i></a>
                                    <?php endif; ?>
                                    
                                    <?php endif;?>        

                                </td>
                            </tr>
                            <?php endforeach;?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">REQUISICION INTERNA DE PERSONAL</h4>
            </div>
            <div class="modal-body index" id="index">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-id1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body index1" id="index1">

            </div>
        </div>
    </div>
</div>


<script>
function Index() {
    $('#index').html("<h5>Cargando Complementos</h5>");
    $.ajax({
        type: "POST",
        url: '?c=requisicion&a=Crud',
        success: function(resp) {
            $('#index').html(resp);
            $('#respuesta').html("");
        }
    });
}

function Edit(id) {
    $('#index').html("<h5>Cargando Complementos</h5>");
    $.ajax({
        type: "POST",
        url: '?c=requisicion&a=Crud',
        data: {
            id: id
        },
        success: function(resp) {
            $('#index').html(resp);
            $('#respuesta').html("");
        }
    });
}

function Autorizacion(id) {
    $('#index').html("<h5>Cargando Complementos</h5>");
    $.ajax({
        type: "POST",
        url: '?c=requisicion&a=Autorizacion',
        data: {
            id: id
        },
        success: function(resp) {
            $('#index').html(resp);
            $('#respuesta').html("");
        }
    });
}

function Ver(id) {
    $('#index1').html("<h5>Cargando Complementos</h5>");
    $.ajax({
        type: "POST",
        url: '?c=requisicion&a=Ver',
        data: {
            id: id
        },
        success: function(resp) {
            $('#index1').html(resp);
            $('#respuesta').html("");
        }
    });
}


</script>