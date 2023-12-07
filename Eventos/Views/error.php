<?php
http_response_code(404); // Establece el código de respuesta HTTP para indicar el error (en este caso, 404 para página no encontrada)

// HTML de la página de error
echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error 404 - Página no encontrada</title>
</head>
<body>
    <h1>Error 404 - Página no encontrada</h1>
    <p>Lo sentimos, la página que estás buscando no se pudo encontrar.</p>
</body>
</html>
HTML;
?>
