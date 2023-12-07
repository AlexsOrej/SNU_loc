<div class="card">
      <div class="header">
            <h2> PLANTA DE PERSONAL <small>Encuentra toda la información de la documentación relacionada con la fuerza laboral de la organización</small>
            </h2>
            <ul class="header-dropdown m-r--6">
                  <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="material-icons">cloud_download</i> Descargar
                        </a>
                        <ul class="dropdown-menu pull-right">
                              <li><a href="?c=sociodemografico&a=exportToExcelPlanta"><i class="material-icons">file_download</i>Planta de Personal</a></li>
                              <li><a href="?c=sociodemografico&a=exportToExcelSocio"><i class="material-icons">file_download</i>Perfil Sociodemografico</a></li>
                        </ul>
                  </li>
            </ul>
      </div>
      <div class="body">
            <table class="table table-bordered" id="tbl_aspirante">
                  <thead>
                        <tr class="active">
                              <th>Nombre Completo</th>
                              <th>Soportes</th>

                        </tr>
                  </thead>
                  <tbody>
                        <? foreach ($planta as $value) : ?>
                              <tr>
                                    <td>
                                          <label class="font-bold col-teal"> <?= $value->nombre ?></label>
                                          <br>
                                          <label class="">Documento Identificación: </label> <?= $value->cedula ?>
                                          <span class="label label-success"><?= $value->status ?></span>

                                    </td>
                                    <td>
                                          <?php if (file_exists("Assets/soportes/" . $value->cedula . "/")) {
                                                $ruta = "Assets/soportes/" . $value->cedula . "/"; ?>
                                                <ul class="header-dropdown m-r--6">
                                                      <li class="dropdown">
                                                            <a href="javascript:void(0);" class="btn efecto dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                                  <span class="initials">
                                                                        <i class="material-icons" style="font-size: 14px; color:aliceblue">attach_file</i>
                                                                  </span><span class="list-text">SOPORTES</span>
                                                            </a>
                                                            <ul class="dropdown-menu pull-right">
                                                                  <?php $soportes = $this->model->obtener_estructura_directorios($ruta); ?>
                                                            </ul>
                                                      </li>
                                                </ul>
                                          <?php } else {
                                                echo "Los Soportes no existen";
                                          }
                                          ?>
                                    </td>
                                   
                              </tr>
                        <? endforeach; ?>
                  </tbody>
            </table>

      </div>
</div>