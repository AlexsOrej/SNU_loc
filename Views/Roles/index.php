<div class="panel">
<div class="panel-heading">
            <h3 class="panel-title"></h3>
            <!-- <a href="?c=roles&a=addedit" type="botton"  class="neu text-center pull-right">Registrar</a> -->
      </div>
        <div class="panel-body">
            <br>
            <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombres</th>
                                <th>Creación</th>
                                <th style="vertical-align: middle;text-align: center;">Editar</th>
                            </tr>
                        <tbody>
                            </thead>
                            <?php
                            $i = 1;
                            foreach ($roles as $rol) :
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?>&nbsp;</td>
                                    <td><?php echo ucwords($rol->rol) ?></td>
                                    <td><?php echo $rol->created; ?>&nbsp;</td>
                                    <td style="vertical-align: middle;text-align: center;" class="actions">
                                        <a href="?c=roles&a=addedit&id=<?= $rol->id ?>" type="button" class="glyphicon glyphicon-edit" title="Editar Rol">
                                            
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>            
    </div>
<!--#END# CPU Usage-->
<?php
if (isset($_REQUEST['success'])) {
    echo "    
        <script>
        Swal.fire({    
            icon: 'success',
            title: 'BIEN HECHO!!',
            timer: 1500
        },)</script>";
}
?>
