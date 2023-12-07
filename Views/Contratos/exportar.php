
<?php
ini_set("memory_limit", "128M");
$html = $_SESSION['content'];
use Dompdf\Dompdf;
use Dompdf\Options;
// instantiate and use the dompdf class
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();
$pdf = $dompdf->output();
// Output the generated PDF to Browser
$dompdf->stream( $_SESSION['contratado'], array("Attachment" => true));
//file_put_contents("Assets/contrato/prueba.pdf", $pdf);
$targetDir = "Assets/img/" . $_SESSION['datos_cliente']->nombre . "/contratos/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}
file_put_contents($targetDir.$_SESSION['contratado'].".pdf", $pdf);
?>

