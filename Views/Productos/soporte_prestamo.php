<div class="soporte2">
    <button onclick="javascript:imprim1(imp1);" class="btn btn-default"> <i class="glyphicon glyphicon-print"></i></button>
</div>
<div class="soporte" id="imp1">
    <style>
        .soporte {
            padding: 20px 1% 30px;
        }

        .soporte2 {
            padding: 10px 1% 10px;
        }

        .responsive {
            margin-left: auto;
            margin-right: auto;
        }

        .top {
            margin-top: 70px;
        }
    </style>
    <div class="row">
        <div class=" col-md-12">
            <table class="table table-bordered" border="1" width='100%'>
                <tr class="active">
                    <th width="20%">
                        <img src="Assets/img/uploads/colegio/<?php echo $_SESSION['datos_cliente']->filename ?>" width="50" height="50" alt="User" />
                    </th>
                    <th width="80%">Comprobante de Prestamo N° <?= $prestamos->num_prestamo ?></th>
                </tr>
            </table>
            <div class="responsive">
                <br> <br>
                <table class="table table-bordered" border="1">
                    <tr>
                        <th colspan="7" class="active">Datos del Beneficiario</th>
                    </tr>
                    <tr>
                        <th>Fecha del Prestamo</th>
                        <th>Beneficiario</th>
                        <th>Identificación</th>
                        <th>Relación con la institución</th>
                        <th>Número de Contacto</th>
                        <th>Datos de ubicación</th>
                    </tr>
                    <tr>
                        <td><?= $prestamos->fecha_entrega ?></td>
                        <td><?= ucwords($prestamos->nombre_bene . ' ' . $prestamos->apellido_bene) ?></td>
                        <td><?= $prestamos->identificacion_bene ?></td>
                        <td><?= ucwords($prestamos->tipo_bene) ?></td>
                        <td><?= $prestamos->num_contacto ?></td>
                        <td><?= $prestamos->ubicacion_bene . ' ' . $prestamos->barrio . ' ' . $prestamos->correo ?></td>
                    </tr>
                </table>
                <br> <br>
                <table class="table table-bordered" border="1">
                    <tr>
                        <th class="active" colspan="7">Datos del Articulo</th>
                    </tr>
                    <tr>
                        <th>Nombre del Articulo</th>
                        <th>Caracteriscas</th>
                        <th>Serial</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                        <td width="20%"><?= $prestamos->nombre ?></td>
                        <td width="40%"><?= $prestamos->carateristicas ?></td>
                        <td width="10%"><?= $prestamos->serie ?></td>
                        <td width="10%"><?= $prestamos->estado ?></td>
                    </tr>
                </table>
            </div>
            <br> <br>
        </div>
        <div class="col-md-12">
            <br>
            <div class="panel panel-default">
                <div class="panel-default">
                    <h3 class="panel-title"><label>Observaciones</label></h3>
                </div>
                <div class="panel-body">
                    <label><?= $prestamos->observaciones ?></label>
                </div>
            </div>
        </div>
        <? if ($prestamos->dellate_entrada != 'null') : ?>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-default">
                            <h3 class="panel-title"><label>Fecha Entrada</label></h3>
                        </div>
                        <div class="panel-body">
                            <label><?= $prestamos->fecha_entrada ?></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-default">
                            <h3 class="panel-title"><label>Dellate Entrada</label></h3>
                        </div>
                        <div class="panel-body">
                            <label><?= $prestamos->dellate_entrada ?></label>
                        </div>
                    </div>
                </div>
            </div>
        <? endif; ?>
        <div class="col-md-12 col-md-offset-1">
            <table class="top">
                <tr>
                    <th>
                        <strong>______________________</strong>
                    </th>
                    <th width="40%"></th>
                    <th>
                        <strong>______________________</strong>
                    </th>
                </tr>
                <tr>
                    <td>Responsable entrega<br><span><?= ucwords($prestamos->funcionario) ?></span></td>
                    <td></td>
                    <td>Beneficiario<br><span><?= ucwords($prestamos->nombre_bene . ' ' . $prestamos->apellido_bene) ?></span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    function imprim1(imp1) {
        var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        w.print();
        w.close();
        return true;
    }
</script>