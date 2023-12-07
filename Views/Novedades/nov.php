     <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                NOVEDADES EN TURNO
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                           <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                            
                                        <tr>
                                           
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Cedula</th>
                                            <th>Novedad</th>
                                            <th>Descripción</th>
                                            <th>Fecha Novedad</th>
                                            <th>Fecha Registro</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Cedula</th>
                                            <th>Novedad</th>
                                            <th>Descripción</th>
                                            <th>Fecha Novedad</th>
                                            <th>Fecha Registro</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                <?php
                /*echo '<pre>';
                print_r($this->model->User_novturno());  
                echo '<pre>';*/
                 $listar=   $this->model->User_novturno();
               foreach( $listar as $r): 
              ?>
        <tr>
            
            
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $r->Apellido; ?></td>
            <td><?php echo $r->cedula; ?></td>
            <td><?php echo $r->novedad; ?></td>
            <td><?php echo $r->descripcion; ?></td>
            <td><?php echo $r->fecha_novedad; ?></td>
            <td><?php echo $r->fecha_registro; ?></td>
            
        </tr>
    <?php endforeach; ?>
                                       
                                    </tbody>
                                </table>
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
