<div class="panel panel-default">
    <div class="panel-body text-justify">
        <table class="table table-bordered">
            <tr>
                <td rowspan="2" width="10%">
                    <p><img src="Assets/img/uploads/colegio/<?= $_SESSION['datos_cliente']->filename ?>" width="100%" height="auto" alt="User" />
                    </p>
                </td>
                <th colspan="2">
                    <p>Nombre Documento</p>
                </th>
                <th>
                    <p>Código:Automatico</p>
                </th>
            </tr>
            <tr>
                <td>
                    <p>Fecha Vigencia</p>
                </td>
                <td>
                    <p>0000-00-00</p>
                </td>
                <td>
                    <p>Version:0</p>
                </td>
            </tr>
            <tr>
        </table>
        <br>
        <div class="cuerpo">
            <?php
            echo $_REQUEST['ckeditor'];
            $_REQUEST['ids'];
            $_REQUEST['modo']; ?>
            <a href="?c=solicitudes&a=index" class="btn btn-success">Terminar</a>
        </div>
    </div>
</div>
<style>
    .panel-body {
        margin-left: 40px;
        margin-right: 60px;
        margin-top: 25px;
        margin-bottom: 50px;
    }
</style>
<script>
    window.addEventListener('load', init, false);
    function init() {
        Swal.fire({
            icon: 'success',
            title: 'Bien Hecho!!',
            text: 'Esta es la versión preliminar del documento solicitado, esta versión sera revisada y el resultado informado al gestionar la solicitud',
            showConfirmButton: true,
            showCloseButton: true
            // timer: 1500
        }, )
    }
</script>
