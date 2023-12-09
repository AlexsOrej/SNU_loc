<div id="datosgrales"></div>
<div id="usabilidadPorModUso"></div>
<div id="datosPorUsuario"></div>
<div id="usoPorRol"></div>
<?php
// Verificar si los parámetros necesarios están presentes
if (isset($_REQUEST['clientes'], $_REQUEST['startDate'], $_REQUEST['endDate'])) {
    $cliente = $_REQUEST['clientes'];
    $inicio = $_REQUEST['startDate'];
    $fin = $_REQUEST['endDate'];

    // Realizar la solicitud AJAX solo si los parámetros están presentes
    ?>
    <script>
        $(document).ready(function() {
            var cliente = <?php echo $cliente ?>;
            var inicio = "<?php echo $inicio; ?>";
            var fin = "<?php echo $fin; ?>";
            $.ajax({
                type: "POST",
                url: "?c=clientes&a=DatosGrales",
                data: { cliente: cliente, inicio: inicio, fin: fin },
                success: function(response) {                    
                    if (response) {                        
                        $("#datosgrales").html(response);
                         UsabilidadModUsu(cliente,  inicio, fin)
                    } else {
                        $("#datosgrales").html("<div class='alert alert-danger'>Error en el registro</div>");
                         setTimeout(function() {
                            $("#datosgrales").empty(); // Eliminar el contenido del elemento con el ID "datosgrales"
                        }, 5000); // 5000 milisegundos = 5 segundos
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores si la solicitud AJAX falla
                    $("#datosgrales").html("<div class='alert alert-danger'>Error en la solicitud: " + status + "</div>");
                }
            });
        });

        function UsabilidadModUsu(cliente,  inicio, fin){
            $.ajax({
                type: "POST",
                url: "?c=clientes&a=usabilidadModUsu",
                data: { cliente: cliente, inicio: inicio, fin: fin },
                success: function(response) {                    
                    if (response) {                        
                        $("#usabilidadPorModUso").html(response);
                           datosPorUsuario(cliente,  inicio, fin)
                    } else {
                        $("#usabilidadPorModUso").html("<div class='alert alert-danger'>Error en el registro</div>");
                         setTimeout(function() {
                            $("#usabilidadPorModUso").empty(); // Eliminar el contenido del elemento con el ID "datosgrales"
                        }, 5000); // 5000 milisegundos = 5 segundos
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores si la solicitud AJAX falla
                    $("#usabilidadPorModUso").html("<div class='alert alert-danger'>Error en la solicitud: " + status + "</div>");
                }
            });
        }

        function datosPorUsuario(cliente,  inicio, fin){
            $.ajax({
                type: "POST",
                url: "?c=clientes&a=datosPorUsuario",
                data: { cliente: cliente, inicio: inicio, fin: fin },
                success: function(response) {                    
                    if (response) {                        
                        $("#datosPorUsuario").html(response);
                        usoPorRol(cliente,  inicio, fin)
                    } else {
                        $("#datosPorUsuario").html("<div class='alert alert-danger'>Error en el registro</div>");
                         setTimeout(function() {
                            $("#datosPorUsuario").empty(); // Eliminar el contenido del elemento con el ID "datosgrales"
                        }, 5000); // 5000 milisegundos = 5 segundos
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores si la solicitud AJAX falla
                    $("#datosPorUsuario").html("<div class='alert alert-danger'>Error en la solicitud: " + status + "</div>");
                }
            });
        }
        function usoPorRol(cliente,  inicio, fin){
            $.ajax({
                type: "POST",
                url: "?c=clientes&a=UsoByRol",
                data: { cliente: cliente, inicio: inicio, fin: fin },
                success: function(response) {                    
                    if (response) {                        
                        $("#usoPorRol").html(response);

                    } else {
                        $("#usoPorRol").html("<div class='alert alert-danger'>Error en la consulta</div>");
                         setTimeout(function() {
                            $("#usoPorRol").empty(); // Eliminar el contenido del elemento con el ID "datosgrales"
                        }, 5000); // 5000 milisegundos = 5 segundos
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores si la solicitud AJAX falla
                    $("#usoPorRol").html("<div class='alert alert-danger'>Error en la solicitud: " + status + "</div>");
                }
            });
        }
    </script>
    <?php
} else {
    // Manejar la ausencia de parámetros de manera apropiada
    echo "<div class='alert alert-danger'>Faltan parámetros necesarios para la solicitud.</div>";
}
?>
