<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Explorador de imágenes</title>
    <style>
        section>div {
            clear: both;
        }

        .group {
            overflow: hidden;
            padding: 2px;
        }

        section .group:nth-child(odd) {
            background: #e5e5e5;
        }

        .directory {
            font-weight: bold;
        }

        .name {
            float: left;
            width: 250px;
            overflow: hidden;
        }

        .mime {
            float: left;
            margin-left: 10px;
        }

        .size {
            float: right;
        }

        .thumbnail {
            max-width: 50px;
            max-height: 50px;
            margin-right: 10px;
        }

        .bold {
            font-weight: bold;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #808080;
        }
    </style>
</head>

<body>
    <?php
    function sanitizePath($path)
    {
        return htmlspecialchars($path, ENT_QUOTES, 'UTF-8');
    }

    if (isset($_GET["path"])) {
        $path = sanitizePath($_GET["path"]);
        $back = implode("/", explode("/", $path, -2));
        if ($back) {
            $back .= "/*";
        } else {
            $back = "*";
        }
    } else {
        $path = "*";
    }

    $nombreCliente = str_replace(' ', '', strtolower($_SESSION['datos_cliente']->nombre));
    $ruta = "Assets/images/{$nombreCliente}/";

    // Verificar y crear la carpeta si no existe
    if (!file_exists($ruta)) {
        if (mkdir($ruta, 0777, true)) {
            echo "Carpeta creada con éxito.";
        } else {
            echo "Error al crear la carpeta.";
        }
    }
    ?>
    <header>
        <h1>Explorador de imágenes</h1>

    </header>
    <nav>
        <h2><?php echo $path ?></h2>
    </nav>

    <section>
        <div>
            <input type="file" id="archivoInput">
            <button onclick="subirArchivo()">Subir Archivo</button>
        </div>
        <div id="index">
            <?php
            if ($path != "*") {
                echo "<div class='bold group'><a href='?path=" . $back . "'>...</a></div>";
            }
            $imageExtensions = array("jpg", "jpeg", "png", "gif");
            $fileCount = 0;

            foreach (glob($ruta . "*") as $filename) {
                $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $imageExtensions) && is_file($filename)) {
                    $fileCount++;

                    $pathParts = explode("/", $filename);
                    $basename = end($pathParts);
                    $rutaImg = $ruta . $basename;
                    echo "<div class='group'>
                    <img src='$rutaImg' alt='miniatura' class='thumbnail'>
                    <div class='name'>$basename</div>
                    <button onclick=\"returnFileUrl('$rutaImg')\">Insertar</button>
                </div>";
                }
            }
            ?>
            <footer>
                <?php echo $fileCount ?> archivo/s de imagen
            </footer>
        </div>
    </section>
    <script>
        // Helper function to get parameters from the query string.
        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\\?&]|&)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);

            return (match && match.length > 1) ? match[1] : null;
        }
        // Pass the selected image URL to CKEditor.
        function returnFileUrl(fileUrl) {
            var funcNum = getUrlParam('CKEditorFuncNum');
            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
            window.close();
        }

        function subirArchivo() {
            const archivoInput = document.getElementById('archivoInput');
            const archivo = archivoInput.files[0];
            if (archivo) {
                const formData = new FormData();
                formData.append('archivo', archivo);

                fetch('?c=explorador&a=cargar', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(result => {
                        window.location.reload();
                       // console.log(result); // Aquí puedes manejar la respuesta del servidor
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }
    </script>
</body>

</html>