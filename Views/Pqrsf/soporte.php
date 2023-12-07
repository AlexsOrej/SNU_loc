<div class="col-md-12">
    <div class="card">
        <div class="body">
            <div class="col">
                <h1><?= $pqr->nombres ?></h1>
                <p>
                    Descripción: <?= $pqr->descripcion ?>
                    <br>
                    Asignado A: <?= $pqr->responsable ?>
                </p>
            </div>

            <form method="POST" role="form" name="uploadForm" enctype="multipart/form-data">
                <legend>Soporte <?= ucwords($pqr->tipo_peticion) ?> </legend>
                <div class="form-group">
                    <div class="form-line">
                        <label>Nombre Soporte</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" class="form-control" id="soporte" name="soporte" placeholder="Input field" required>
                        <input type="hidden" class="form-control" id="id_pqrsf" name="id_pqrsf" value="<?php echo $_REQUEST['id'] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Adjuntar
                </button>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                Soporte
            </div>
            <div class="body">
                <?php
                $directorio = "Assets/SoportesPqrs/" . $_REQUEST['id'] . "/"; // Reemplaza 'ruta_de_la_carpeta' con la ruta de la carpeta que quieres inspeccionar

                // Obtén una lista de archivos y directorios dentro de la carpeta
                if (is_dir($directorio)) {
                    $archivos = scandir($directorio);
                    // Imprime los nombres de los archivos con enlaces
                    foreach ($archivos as $archivo) {
                        if ($archivo != '.' && $archivo != '..') {
                            echo '<a href="' . $directorio .  $archivo . '" target="_blank">' . $archivo . '</a>';
                            echo ' | <a onclick="eliminarArchivo(\'' . $directorio . $archivo . '\')"><i class="glyphicon glyphicon-trash"></i></a><br>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.uploadForm.addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        fetch("?c=pqrsf&a=GuardarSoporte", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: '¡BIEN HECHO!',
                    text: data,
                    // timer: 1500
                });
            })
            .catch(error => {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: '¡ERROR!',
                    text: 'Se produjo un error al enviar el formulario.',
                    // timer: 1500
                });
            });
    });

    function eliminarArchivo(archivo) {
        if (confirm("¿Estás seguro de que quieres eliminar este archivo?")) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    // location.reload(); // Recarga la página después de eliminar el archivo
                }
            };
            xhttp.open("POST", "?c=pqrsf&a=QuitarDocumento&archivo=" + archivo, true);
            xhttp.send();
        }
    }
</script>