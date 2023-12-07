<div class="col-md-12">
      <div class="row">
            <div class="col-md-4">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                              <h3 class="panel-title">Registrar</h3>
                        </div>
                        <div class="panel-body" id="index">
                              <form id="form_tipo" class="form_tipo" method="POST">
                                    <div class="form-group">
                                          <div class="form-line">
                                                <label for="">Novedad</label>
                                                <input name="id" id="id" value="" type="hidden" class="form-control" placeholder="" />
                                                <input name="evento" id="evento" value="" type="text" class="form-control" placeholder="" />
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <div class="form-line">
                                                <label for="">Tipo</label>
                                                <select name="tipo" id="tipo" value="" class="form-control">
                                                      <option value="" >Seleccionar</option>
                                                      <option value="1" >Novedad</option>
                                                      <option value="2" >Ausentismo</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="col-md-12">
                                          <button id="botonenviar" type="button" class="btn btn-primary btn-block">Guardar</button>
                                    </div>
                              </form>
                              <div></div>
                        </div>
                  </div>
            </div>
            <div class="col-md-8">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                              <h3 class="panel-title">Tipos de novedad</h3>
                        </div>
                        <div class="panel-body">
                              <table id="tbl_requicision" class="table table-bordered">
                                    <thead>
                                          <tr>
                                                <th>Novedad</th>
                                                <th>Tipo</th>
                                                <th>Editar</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <? foreach ($tipoNovedades as $value) : ?>
                                                <tr>
                                                      <td><?= $value->evento ?></td>
                                                      <td><?
                                                     if($value->tipo==1){echo 'Novedad';}
                                                     if($value->tipo==2){echo 'Ausentismo';}                                                    
                                                      ?></td>
                                                      <td>
                                                            <a onclick="Editar('<?= $value->id ?>')"><i class="glyphicon glyphicon-edit"></i></a>
                                                      </td>
                                                </tr>
                                          <? endforeach; ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>

<script>
      $(document).ready(function() {
            $('#botonenviar').click(function() {
                  if (($('#evento').val() != "")) {
                        var datos = $('#form_tipo').serialize();
                        $.ajax({
                              type: "POST",
                              url: "?c=tiponovedades&a=crud",
                              data: datos,
                              success: function(r) {
                                    if (r == 1) {
                                          alert("Fallo al agregar");
                                    } else {
                                          Swal.fire({
                                                icon: 'success',
                                                title: 'BIEN HECHO!!',
                                                timer: 1500
                                          }, )
                                          setTimeout(function() {
                                              window.location.reload();
                                          }, 2000)
                                    }
                              }
                        });
                  } else {
                        Swal.fire({
                              icon: 'error',
                              title: 'El campo evento es obligatorio',
                              timer: 1500
                        }, )
                  }
                  return false;
            });
      });

      function Editar(val) {
            $.ajax({
                  type: "POST",
                  url: '?c=tiponovedades&a=editar',
                  data: 'id=' + val,
                  success: function(resp) {
                        $('#index').html(resp);
                        $('#respuesta').html("");
                  }
            });
      }
</script>