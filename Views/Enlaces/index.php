<!DOCTYPE html>
<html>

<head>
    <title>Copy Code Function</title>
    <style>
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            font-family: 'Courier New', Courier, monospace;
        }

        .copy-btn,
        .copy-btn01 {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
    <script>
        function copyCode() {
            /* Seleccionar el código dentro del elemento <pre> */
            var codeElement = document.getElementById("code");
            var code = codeElement.textContent;

            /* Crear un elemento de texto temporal y asignar el código */
            var tempElement = document.createElement("textarea");
            tempElement.value = code;

            /* Añadir el elemento temporal al documento */
            document.body.appendChild(tempElement);

            /* Seleccionar y copiar el texto del elemento temporal */
            tempElement.select();
            document.execCommand("copy");

            /* Eliminar el elemento temporal */
            document.body.removeChild(tempElement);

            /* Mostrar un mensaje de éxito */
            alert("El enlace a Eventos ha sido copiado al portapapeles.");
        }

        function copyCode01() {
            /* Seleccionar el código dentro del elemento <pre> */
            var codeElement = document.getElementById("code01");
            var code = codeElement.textContent;

            /* Crear un elemento de texto temporal y asignar el código */
            var tempElement = document.createElement("textarea");
            tempElement.value = code;

            /* Añadir el elemento temporal al documento */
            document.body.appendChild(tempElement);

            /* Seleccionar y copiar el texto del elemento temporal */
            tempElement.select();
            document.execCommand("copy");

            /* Eliminar el elemento temporal */
            document.body.removeChild(tempElement);

            /* Mostrar un mensaje de éxito */
            alert("El enlace a PQRSF ha sido copiado al portapapeles.");
        }

        function copyCode02() {
            /* Seleccionar el código dentro del elemento <pre> */
            var codeElement = document.getElementById("code02");
            var code = codeElement.textContent;

            /* Crear un elemento de texto temporal y asignar el código */
            var tempElement = document.createElement("textarea");
            tempElement.value = code;

            /* Añadir el elemento temporal al documento */
            document.body.appendChild(tempElement);

            /* Seleccionar y copiar el texto del elemento temporal */
            tempElement.select();
            document.execCommand("copy");

            /* Eliminar el elemento temporal */
            document.body.removeChild(tempElement);

            /* Mostrar un mensaje de éxito */
            alert("El enlace a Postulados ha sido copiado al portapapeles.");
        }
    </script>
</head>

<body>
    <!-- Ejemplo de código -->
    <div class="col-md-6">
        <pre id="code">
   https://calidadsnu.com/snu/Eventos/?cliente=<?= $_SESSION['datos_cliente']->id ?>    
  </pre>
        <!-- Botón para copiar el código -->
        <button class="copy-btn" onclick="copyCode()">Copiar Eventos</button>
    </div>



    <div class="col-md-6">
        <!-- Ejemplo de código -->
        <pre id="code01" >
   https://calidadsnu.com/snu/Contacto/start/index.php?url=<?= $_SESSION['datos_cliente']->id ?>
 
   </pre>
        <!-- Botón para copiar el código -->
        <button class="copy-btn01" onclick="copyCode01()">Copiar Pqrs</button>
    </div>

    <div style="margin-top: 20px" class="col-md-6 mt-4">
        <!-- Ejemplo de código -->
        <pre id="code02" >
        https://calidadsnu.com/snu/Seleccion/?cliente=<?= $_SESSION['datos_cliente']->id ?>
 
   </pre>
        <!-- Botón para copiar el código -->
        <button class="copy-btn01" onclick="copyCode02()">Copiar postulados</button>
    </div>

</body>

</html>