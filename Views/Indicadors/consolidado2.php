<div class="panel panel-default">    
    <div class="panel-body" id="result">
        <table class="table table-bordered table-condensed">
            <tr class="active text-center">
                <th colspan="">INDICADORES</th>
                <th colspan="">RESULTADOS</th>
                <th colspan="">METAS</th>
            </tr>
            <? foreach ($indicadornombre as  $value) : ?>
                <tr>
                    <th class="info" colspan="3">
                        <a href="?c=indicadors&a=verdatos&indicador_id=<?= $value->id ?>"><?= $value->nombre ?></a>
                        <span class="label label-info"><?= ucwords($value->periodicidad) ?></span>
                    </th>
                </tr>
                <?php 
                
                foreach ($indicadordato as $value0) :
                    $fecha = explode("-", $value0->fecha_aplicacion);
                    $dia = $fecha[2];
                    $mes = $fecha[1];
                    $año = $fecha[0];
                ?>
                    <?php if ($value0->indicador_id == $value->id) : ?>
                        <tr>
                            <th>
                                <? switch ($mes) {
                                    case '1':
                                        echo $dia . ' Enero ' . $año;
                                        break;
                                    case '2':
                                        # code...
                                        echo $dia . ' Febrero ' . $año;
                                        break;
                                    case '3':
                                        # code...
                                        echo $dia . ' Marzo ' . $año;
                                        break;
                                    case '4':
                                        # code...
                                        echo $dia . ' Abril ' . $año;
                                        break;
                                    case '5':
                                        # code...
                                        echo $dia . ' Mayo ' . $año;
                                        break;
                                    case '6':
                                        # code...
                                        echo $dia . ' Junio ' . $año;
                                        break;
                                    case '7':
                                        # code...
                                        echo $dia . ' Julio ' . $año;
                                        break;
                                    case '8':
                                        # code...
                                        echo $dia . ' Agosto ' . $año;
                                        break;
                                    case '9':
                                        # code...
                                        echo $dia . ' Septiembre ' . $año;
                                        break;
                                    case '10':
                                        # code...
                                        echo $dia . ' Octubre ' . $año;
                                        break;
                                    case '11':
                                        # code...
                                        echo $dia . ' Noviembre ' . $año;
                                        break;
                                    case '12':
                                        # code...
                                        echo $dia . ' Diciembre ' . $año;
                                        break;
                                    default:
                                        # code...
                                        break;
                                } ?>
                            </th>
                            <td><?= number_format($value0->resultado, 2) . '%' ?></td>
                            <td class="
                        <?php switch ($value0->comparativo) {
                            case '<=':
                            case '<':
                             echo   $value0->resultado <= $value0->metaV ? 'alert alert-success' : 'alert alert-danger';
                                break;
                            case '>=':
                            case '>':
                              echo  $value0->resultado >= $value0->metaV ? 'alert alert-success' : 'alert alert-danger';
                                break;
                            case '=':
                              echo  $value0->resultado == $value0->metaV ? 'alert alert-info' : 'alert alert-danger';
                                break;
                        } ?>">
                                <?= $value0->meta ?>
                            </td>
                        </tr>
                    <?php else : ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tr>
            <? endforeach; ?>
        </table>
    </div>
</div>