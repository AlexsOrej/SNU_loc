<?php
require_once 'model/Contrato.php';
class ContratacionController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Contrato();
    }

    public function GenerarContrato()
    {
        $cliente= $this->model->Cliente($_REQUEST['cliente']);
        $datos =  $this->model->GenerarContrato($_REQUEST['id']);        
        require_once 'Views/Contratos/generar_contrato2.php';
    }

    public function Aleatorio()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud = 10; // La longitud deseada de la cadena aleatoria
        $cadenaAleatoria = '';

        for ($i = 0; $i < $longitud; $i++) {
            $indice = rand(0, strlen($caracteres) - 1);
            $cadenaAleatoria .= $caracteres[$indice];
        }

        echo $cadenaAleatoria;
    }


    public function Guardarfirma()
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        $signatureData = $data['signatureData'];
        $type = $data['type'];
        $contrato_id = $data['contrato_id'];

        $base64Image = explode(',', $signatureData)[1];
        $image = base64_decode($base64Image);
        $filename =  uniqid() . '.png'; // Nombre del archivo
        $path = '../Assets/firmas/'  . $filename; // Ruta donde guardar las firmas

        if (file_put_contents($path, $image)) {

            http_response_code(200);
        } else {
            http_response_code(500);
        }

        $imgfirma = $filename;
        $fecha = date('Y-m-d, H:i:s');
        echo   $this->model->Firmar($contrato_id, $imgfirma, $fecha, $type);

        return;
    }
}
