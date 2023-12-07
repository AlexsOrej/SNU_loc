<?
if (!isset($_SESSION['squema'])) {
    echo'<script>
    alert("LA SESION EXPIRO, POR FALTA DE ACTIVIDAD");
    window.location.href = "?c=seguridad&a=Logout";
    </script>';
     die();
    exit();
}
