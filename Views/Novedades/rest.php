     <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Registro de Novedades
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
    <div class="body">
                          
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
            
                                        <tr>
                                            
            <th>Fecha</th>
            <th>Cedula</th>
            <th>Descripción</th>
            <th>Otro Si</th>
            
            
        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
            <th>Fecha</th>
            <th>Apellido</th>
            <th>Descripcion</th>
            <th>Otro Si</th>
        </tr>
            </tfoot>
            <tbody>
                <?php foreach( $this->model->rest($_REQUEST['id']) as $r): ?>
        <tr>
            
            <td><?php echo $r->fecha_novedad; ?></td>
            <td><?php echo $r->cedula; ?></td>
            <td><?php echo $r->descripcion; ?></td>
            <td><?php echo $r->otro_si; ?></td>
            
           
            
            
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
            
            

