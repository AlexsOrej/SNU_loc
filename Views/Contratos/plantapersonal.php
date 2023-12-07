<div class="card">
      <div class="header">
            <h2> PLANTA DE PERSONAL <small>Encuentra toda la información relacionada con la fuerza laboral de la organización</small>
            </h2>
            <ul class="header-dropdown m-r--6">
                  <li class="dropdown">
                        <a title="Botón para descargar datos del personal en excel" href="javascript:void(0);"  class="dropdown-toggle neu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i style="color:#fff; font-size: 13px" class="material-icons">cloud_download</i> Descargar
                        </a>
                        <ul class="dropdown-menu pull-right">
                              <li><a href="?c=sociodemografico&a=exportToExcelPlanta"><i class="material-icons">file_download</i>Planta de Personal</a></li>
                              <li><a href="?c=sociodemografico&a=exportToExcelSocio"><i class="material-icons">file_download</i>Perfil Sociodemografico</a></li>
                              <li><a href="?c=contratacion&a=PersonalSoporte"><i class="material-icons">file_download</i>Info Soportes</a></li>
                        </ul>
                  </li>
            </ul>
      </div>

      <div class="body">
            <table class="table table-bordered" id="tbl_aspirante">
                  <thead>
                        <tr class="active">
                              <th>Nombre Completo</th>
                              <th>Contacto</th>
                              <th>Contratación</th>
                              <th>Estado</th>
                        </tr>
                  </thead>
                  <tbody>
                        <? foreach ($planta as $value) : ?>
                              <tr>
                                    <td>
                                          <label class="font-bold col-teal"> <?= $value->nombre ?></label>
                                          <br>
                                          <label class="">Documento Identificación: </label> <?= $value->cedula ?>
                                          <br>
                                          <label>Genero: </label> <?= $value->sexo == 1 ? ' Masculino' : 'Femenino'; ?>
                                          <br>
                                          <div class="align-right"><a href="?c=sociodemografico&a=index&personal_id=<?= $value->id ?>" class=""><i class="glyphicon glyphicon-plus col-amber"></i> Información</a></div>
                                    </td>
                                    <td>
                                          <label class="glyphicon glyphicon-earphone col-teal"></label> <?= $value->contacto ?>
                                          <br>
                                          <label class="glyphicon glyphicon-envelope col-teal"></label> <?= $value->correo ?>
                                          <br>
                                          <label class="glyphicon glyphicon-home col-teal"></label> <?= $value->direccion ?>
                                    </td>
                                    <td>
                                          <label>Inicio:</label> <?= $value->inicio_contrato ?><br>
                                          <label>Duración:</label> <?= $value->duracion ?><br>
                                          <?
                                          $hoy = date('Y-m-d');
                                          if ($this->model->validarFechas(date('Y-m-d'), $value->duracion)) {
                                                $diferencia = $this->model->calcularDiferenciaFechas($hoy, $value->duracion);
                                                if ($hoy > $value->duracion) {
                                                      echo '<label class="label label-danger" >Termino hace:  </label>' .  $diferencia . ' días<br>';
                                                } else {

                                                      echo '<label>Termina en:  </label>' .  $diferencia . ' días<br>';
                                                }
                                          } else {
                                                echo 'Una o ambas fechas no son válidas.<br>';
                                          }
                                          ?>
                                          <label>Cargo:</label> <?= $value->cargo ?>
                                    </td>
                                    <td>

                                          <?php
                                          $labelstatus = "";
                                          if ($value->status == 'Contratado') :
                                                $labelstatus = "label-success";
                                          elseif ($value->status == 'Retirado') :
                                                $labelstatus = "label-warning";
                                          else :
                                                $labelstatus = "label-danger";
                                          endif
                                          ?>
                                          <span class="label <?= $labelstatus ?> "><?= $value->status ?></span>
                                    </td>
                              </tr>
                        <? endforeach; ?>
                  </tbody>
            </table>

      </div>
</div>