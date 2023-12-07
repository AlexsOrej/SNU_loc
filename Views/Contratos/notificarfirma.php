<div class="card">
    <div class="header">
        <h5 class="modal-title">Notificación del Contratos
            <small>Valida los datos del contrato, luego envia correo electronico a los involucrado para que firmen</small>
        </h5>
    </div>
    <div class="body">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?php
                    echo "El funcionario $contrato->usuario<br>
                                Preparo el $contrato->contrato<br>
                                Para $contrato->Colaborador<br>
                                Para cargo de $contrato->cargo<br>
                                Este contrato debe ser firmado por $contrato->firmante<br>
                                El valor del contrato es de: $" . number_format($contrato->valor) . "<br>
                                La fecha de inicio del contrato es: $contrato->inicio_contrato<br>
                                La fecha de terminación del contrato es: $contrato->duracion<br>
                                El correos de notificación del contratante: $contrato->correofirmante<br>
                                El correos de notificación del colaborador: $contrato->correocolaborador<br>
                                <strong>Si la información es correcta por favor notificar a los firmantes</strong>                              
                                ";

                    $mensaje = "<strong>{$_SESSION['datos_cliente']->nombre}</strong><br>
                                El funcionario: $contrato->usuario<br>
                                Preparo el: $contrato->contrato<br>
                                Para: $contrato->Colaborador<br>
                                Para cargo de: $contrato->cargo<br>
                                Este contrato debe ser firmado por: $contrato->firmante<br>
                                El valor del contrato es: $" . number_format($contrato->valor) . "<br>
                                La fecha de inicio del contrato es: $contrato->inicio_contrato<br>
                                La fecha de terminación del contrato es: $contrato->duracion<br>                                                              
                                <a href='https://calidadsnu.com/snu/Eventos/?c=contratacion&a=generarContrato&id={$contrato->id}&cliente={$_SESSION['datos_cliente']->id}'>IR A FIRMAR</a>";
                    ?>
                </p>
            </div>
            <div class="col-md-6">
                <button class="btn bg-green" onclick="Notificar(<?= $contrato->id ?>)"> <i></i> Notificar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function Notificar(id_contrato) {
        var mensaje = `<?php echo addslashes($mensaje); ?>`;
        var colaborador = `<?php echo addslashes($contrato->correocolaborador); ?>`;
        var contratante = `<?php echo addslashes($contrato->correofirmante); ?>`;

        const requestData = {
            idContrato: id_contrato,
            colaborador: colaborador,
            contratante: contratante,
            mensaje: mensaje
        };

        fetch("?c=notificaciones&a=notificarcontrato", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(requestData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                // Si la notificación es exitosa, muestra un mensaje utilizando SweetAlert
                if (data.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Notificación exitosa',
                        text: 'La notificación se ha enviado con éxito.',                        
                    });
                    setTimeout(function() {
                          window.location.reload();                        
                    }, 1500)

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al enviar la notificación.',
                    });
                }
            })
            .catch(error => {
                console.error("Hubo un problema con la operación fetch:", error);
            });
    }
</script>