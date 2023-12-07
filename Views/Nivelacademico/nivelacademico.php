<div class="well well-sm text-right">
    <a title="Botón para registrar información academica" class="btn btn-success" href="?c=Nivelacademico&a=Crud&usuario_id=<?php echo $_GET['id'] ?>">Registrar Formación academica</a>
    <a title="Botón para registrar información academica " class="btn btn-primary" href="?c=Grupofamiliar&a=Crud&usuario_id=<?php echo $_GET['id'] ?>">Registrar Información Pariente</a>
</div>
<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2> Nivel Academico </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Estudio</th>
                                <th>Curso Vigilancia</th>
                                <th>Academia</th>
                                <th>Fecha realización</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nivel</th>
                                <th>Estudio</th>
                                <th>Curso Vigilancia</th>
                                <th>Academia</th>
                                <th>Fecha realización</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($this->model->Listar() as $r) :
                                if ($r->usuario_id == $_GET['id']) :
                            ?>
                                    <tr>
                                        <td><?php echo $r->nivel; ?></td>
                                        <td><?php echo $r->estudio; ?></td>
                                        <td><?php echo $r->curso_vigilancia; ?></td>
                                        <td><?php echo $r->lugar; ?></td>
                                        <td><?php echo $r->fecha; ?></td>
                                        <td>
                                            <a href="?c=Nivelacademico&a=Crud&id=<?php echo $r->id; ?>">Editar</a>
                                            <a onclick="javascript:return confirm('Seguro de eliminar este registro?');" href="?c=Nivelacademico&a=Eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                                        </td>
                                    </tr>
                            <?php endif;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->