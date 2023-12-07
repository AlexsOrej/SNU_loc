  <div class="col-md-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-sm-9">
                      <h3 class="">
                          Listado de Proveedores
                      </h3>
                  </div>
                  <div class="col-sm-3">
                      <button title="Botón para registrar un proveedor" style="margin-top:15px" class="neu pull-right" id="registro" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-plus"></i> Registrar Proveedor</button>
                  </div>
              </div>
          </div>
          <div class="panel-body" id="resultado">
              <table id="tbl_servicios" class="table table-bordered">
                  <thead>
                      <tr>
                          <th>TIPO DE SERVICIO </th>
                          <th>NOMBRE</th>
                          <th>UBICACIÓN</th>
                          <th>CONTACTO</th>
                          <th style="align-items: center;">SOPORTES</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      <? foreach ($proveedor as $value) : ?>
                          <tr>
                              <td><?= ucwords($value->tipo_servicio) ?></td>
                              <td><?= ucwords($value->nombre) ?><br>
                                  <span class="label label-info">
                                      <?= ucwords($value->nit) ?>
                                  </span>
                              </td>
                              <td>
                                  <span class="label label-info"><?= $value->direccion ?></span>
                                  <span class="label label-info"><?= ucwords($value->ciudad) ?></span>
                                  <br>
                                  <span class="label label-info"><?= ucwords($value->estado) ?></span>
                                  <span class="label label-default"><?= ucwords($value->pais) ?></span>
                              </td>
                              <td>
                                  <span class="label label-warning"><?= ucwords($value->contacto) ?></span>
                                  <span class="label label-info"><?= ucwords($value->telefono) ?></span><br>
                                  <span class="label label-info"><?= ucwords($value->email) ?></span>
                              </td>
                              <td style="vertical-align: middle;text-align: center;">
                                  <span class="">
                                      <?
                                        $carpeta = $_SESSION['datos_cliente']->nombre;
                                        $proveedor_ = "proveedor_" . $value->id;
                                        $targetDir = "Assets/img/" . $carpeta . "/soportes/" . $proveedor_ . "/"; ?>
                                      <a href="<?= $targetDir ?>" onclick="VerSoporte('<?= $targetDir ?>')" data-toggle="modal" data-target="#soporte"><i class="glyphicon glyphicon-eye-open">

                                          </i> Documentos: <?=
                                                            is_dir($targetDir) ?
                                                                $this->model->countFilesInFolder($targetDir) : "0" ?>
                                      </a>
                                  </span>
                              </td>
                              <td style="vertical-align: middle;text-align: center;">
                                  <a title="Botón para editar datos del proveedor" class="" href="#" onclick="Editar('<?= $value->id ?>')" title="Editar los datos del proveerdor" data-toggle="modal" data-target="#modelId"><i class="glyphicon glyphicon-edit"></i></a>
                                  <a title="Botón para agregar soportes del proveedor" class="" href="#" onclick="Soporte('<?= $value->id ?>')" title="Subir el soporte del proveedor" data-toggle="modal" data-target="#modelId01"><i class="glyphicon  glyphicon-folder-open"></i></a>
                              </td>
                          </tr>
                      <? endforeach; ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="index"></div>
              <div class="modal-footer">
                  <button type="button" id="guardar" class="btn btn-guardar">Registrar</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="soporte" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="index02"></div>
              <div class="modal-footer">
                  <button type="button" id="guardar" class="btn btn-guardar">Registrar</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modelId01" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" id="index01"></div>
              <div class="modal-footer">
                  <button type="button" id="guardar01" class="btn btn-guardar">Registrar</button>
              </div>
          </div>
      </div>
  </div>

  <script>
      $(document).ready(function() {
          $('#registro').click(function() {
              $.ajax({
                  type: "POST",
                  url: "?c=proveedores&a=crud",
                  success: function(r) {
                      $('#index').html(r);
                  },
              });
          });
          $('#editar').click(function() {
              var id = $('#editar').value;
              console.log(id);
              $.ajax({
                  type: "POST",
                  url: "?c=proveedores&a=crud",
                  data: {
                      id: id
                  },
                  success: function(r) {
                      $('#index').html(r);
                  },
              });
          });
      })

      $(document).on('click', '#guardar', function(e) {

          var formulario = document.getElementById('form_proveedor');
          var campos = formulario.querySelectorAll('input, textarea'); // Obtener todos los campos de entrada y áreas de texto dentro del formulario.

          var errores = [];

          for (var i = 0; i < campos.length; i++) {
              var campo = campos[i];

              if (campo.hasAttribute('required') && campo.value.trim() === '') {
                  var label = formulario.querySelector('label[for="' + campo.id + '"]');
                  var mensaje = 'El campo ';
                  mensaje += label ? label.textContent : campo.id;
                  mensaje += ' es obligatorio.';
                  errores.push(mensaje);
              }
          }

          if (errores.length > 0) {
              var mensajeError = 'Por favor, corrige los siguientes errores:\n';
              for (var j = 0; j < errores.length; j++) {
                  mensajeError += '<br>- ' + errores[j] + '\n';
              }
              //   alert(mensajeError);
              Swal.fire({
                  icon: 'warning',
                  title: 'Faltan Campos Por llenar',
                  html: '<p><label class="col-orange"><br>' + mensajeError + '<label><br></p>',
                  //   timer: 1500,
                  showConfirmButton: false,
              }, )

              return false;
          }


          var formData = new FormData($("#form_proveedor")[0]);
          $.ajax({
              url: "?c=proveedores&a=guardar",
              type: "POST",
              data: formData,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  Swal.fire({
                      icon: 'success',
                      title: 'El proveedor se regitro con éxito',
                      timer: 1500,
                      showConfirmButton: false,
                  }, )
                  setTimeout(function() {
                      window.location.reload();
                  }, 1500)
              }
          });
          return false; // Evitamos que el formulario se envíe de forma predeterminada
      });

      $(document).on('click', '#guardar01', function(e) {
          var formData = new FormData($("#form_soporte")[0]);
          $.ajax({
              url: "?c=proveedores&a=subirSoporte",
              type: "POST",
              data: formData,
              contentType: false,
              cache: false,
              processData: false,
              success: function(data) {
                  Swal.fire({
                      icon: 'success',
                      title: 'El Soporte se regitro con éxito',
                      timer: 1500,
                      showConfirmButton: false,
                  }, )
                  setTimeout(function() {
                      window.location.reload();
                  }, 1500)

              }
          });
      });

      function Editar(id) {

          $.ajax({
              url: "?c=proveedores&a=crud",
              type: "POST",
              data: {
                  id: id
              },
              success: function(r) {
                  $('#index').html(r);
              },
          });
      }

      function Soporte(id) {
          $.ajax({
              url: "?c=proveedores&a=soporte",
              type: "POST",
              data: {
                  id: id
              },
              success: function(r) {
                  $('#index01').html(r);
              },
          });
      }

      function VerSoporte(id) {
          $.ajax({
              url: "?c=proveedores&a=versoporte",
              type: "POST",
              data: {
                  url: id
              },
              success: function(r) {
                  $('#index02').html(r);
              },
          });
      }
  </script>