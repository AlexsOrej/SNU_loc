<?
//print_r($_SESSION);
//exit();
if (!isset($_SESSION['squema']) or !isset($_SESSION['user'])) {
    session_destroy();
    echo "<script>
        window.addEventListener('load', init, false);
        function init() {
            Swal.fire({
                icon: 'error',
                title: 'Sesion Terminada',
                text: 'La sesion expiro, por inactividad',
                showConfirmButton: true,
                showCloseButton: true,
                timer: 2500
            }, )
            setTimeout(function() {
             window.location = 'https://calidadsnu.com/';
                }, 2000)           
        }
    </script>";
}
