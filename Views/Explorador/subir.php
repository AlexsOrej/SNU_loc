
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Subir archivos al servidor</title>
</head>
<body>
    <input type="file" id="archivoInput">
    <button onclick="subirArchivo()">Subir Archivo</button>

    <script>
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
                    console.log(result); // Aquí puedes manejar la respuesta del servidor
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
