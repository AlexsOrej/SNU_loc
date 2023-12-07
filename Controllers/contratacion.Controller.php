<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Model.php';
require_once 'Models/Contrato.php';
require_once 'Models/Persona.php';
require_once 'Models/Cargo.php';
require_once 'Models/Usuario.php';
require_once 'Models/Postulacion.php';
require_once 'Controllers/notificaciones.Controller.php';

class ContratacionController
{

    private $model;
    private $usuario;
    public function __CONSTRUCT()
    {
        $this->model = new Contrato();
        $this->usuario = new Usuario();
        $personal = new Model();
        $personal->Tblstado('stados');
        $personal->Tblpersonacontratos('persona_contratos');
    }

    public function Index()
    {

        $result = $this->model->ByEst(2);
        require_once 'Views/Layout/talento.php';
        // require_once 'Views/Contratos/Index.php';
        // require_once 'Views/Layout/foot.php';
        require_once 'Views/Contratos/buscar.php';
        require_once 'Views/Layout/footer.php';
        require_once 'Views/Layout/filtro.php';
    }
    public function Cargos()
    {
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Cargos/index.php';
        require_once 'Views/Layout/foot.php';
    }
    public function PlantaPersonal()
    {
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $planta = $this->model->PlantaPersonal();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Contratos/plantapersonal.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
    }


    public function Buscar()
    {
        is_numeric($_REQUEST['data']) ? $result = $this->model->ByCc($_REQUEST['data']) : $result = $this->model->ByNa($_REQUEST['data']);
        require_once 'Views/Contratos/buscar.php';
    }

    public function BuscarEst()
    {
        is_numeric($_REQUEST['data']) ? $result = $this->model->ByEst($_REQUEST['data']) : $result = $this->model->ByNa($_REQUEST['data']);
        require_once 'Views/Contratos/buscar.php';
        require_once 'Views/Layout/filtro.php';
    }

    public function Procesar()
    {
        $alm = new Persona();
        $alm = $alm->GetPersona($_REQUEST['id']);
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $postulacion = new Postulacion();
        $post = $postulacion->Getpostulacion($alm->cedula);
        require_once 'Views/Contratos/procesar.php';
    }

    public function Novedad()
    {
        require_once 'Views/Contratos/novedad.php';
    }
    //cambio de estado del aspirante
    public function EstadoAsp()
    {
        $aspirante = new Persona();
        $aspirante->id = $_REQUEST['id'];
        $aspirante->rol_id = $_REQUEST['estado'];
        $aspirante->cedula = $_REQUEST['cedula'];
        $aspirante->expedicion = $_REQUEST['expedicion'];
        $aspirante->Nombre = $_REQUEST['Nombre'];
        $aspirante->Apellido = $_REQUEST['Apellido'];
        $aspirante->FechaNacimiento = $_REQUEST['FechaNacimiento'];
        $aspirante->direccion = $_REQUEST['direccion'];
        $aspirante->Barrio = $_REQUEST['Barrio'];
        $aspirante->celular = $_REQUEST['celular'];
        $aspirante->Correo = $_REQUEST['Correo'];
        $aspirante->telefono_fijo = $_REQUEST['telefono_fijo'];


        $this->model->EstadoAsp($aspirante);
    }
    public function Contratar()
    {
        $contrato = new Contrato();
        $aspirante = new Persona();

        $seleccionado = $aspirante->GetPersona($_REQUEST['id']);
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $tipos = $this->model->TipoContrato();
        $usuarios = $this->usuario->getFuncionario();
        require_once 'Views/Contratos/datosContrato.php';
    }

    public function Guardar()
    {
        $contrato = new Contrato();
        $contrato->id = $_REQUEST['id'];
        $contrato->usuario = $_REQUEST['usuario_id'];
        $contrato->tipo_contrato = $_REQUEST['tipoContrato'];
        $contrato->cargo_id = $_REQUEST['cargo_id'];
        $contrato->valor = $_REQUEST['valor'];
        $contrato->aux_trans = $_REQUEST['aux_trans'];
        $contrato->inicio_contrato = $_REQUEST['inicio_contrato'];
        $contrato->usuario_id = $_REQUEST['usuario'];
        $contrato->duracion = $_REQUEST['duracion'];
        $contrato->lugar = $_REQUEST['lugar'];
        $contrato->manual = $_REQUEST['manual'];
        $contrato->contrato = $_REQUEST['contrato'];
        $contrato->registro = date('Y-m-d');
        $contrato->encargadofirma = $_REQUEST['encargadofirma'];
        $contrato->id > 0 ? $this->model->Actualizar($contrato) : $this->model->Registrar($contrato);
    }

    public function Historial()
    {
        $aspirante = new Persona();
        $contratado = $aspirante->GetPersona($_REQUEST['id']);
        $historial = $this->model->Historial($_REQUEST['id']);
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Contratos/historico.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Historial1()
    {
        $aspirante = new Persona();
        $contratado = $aspirante->GetPersona($_REQUEST['id']);
        $historial = $this->model->Historial($_REQUEST['id']);
        require_once 'Views/Contratos/historico.php';
        require_once 'Views/Layout/foot.php';
    }

    public function GenerarContrato()
    {
        $datos =  $this->model->GenerarContrato($_REQUEST['id']);
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Contratos/generar_contrato2.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Exportar()
    {
        $datos =  $this->model->GenerarContrato($_REQUEST['id']);
        // $firma =  $this->model->FirmaContrato($_REQUEST['id']);
        require_once 'Assets/dompdf/autoload.inc.php';
        require_once 'Views/Contratos/exportar.php';
    }

    public function Firmar()
    {
        require_once 'Views/Contratos/firmar.php';
    }
    public function Getfirma()
    {
        $img = $_POST['base64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = uniqid() . '.png';
        file_put_contents($fileName, $fileData);
        $origen =  $fileName;
        $destino = "Assets/firmas/" . $fileName; #Copiar pero cambiar nombre        
        $resultado = copy($origen, $destino);
        $this->model->Firmar($_REQUEST['contrato'], $fileName, date('Y-m-d'));
        $id = $_REQUEST['contrato'];
        echo "<script>
        window.close() 
        window.open('?c=contratacion&a=generarContrato&id=" . $id . "')
         </script>
         ";
    }

    public function Informar()
    {

        $contrato = $this->model->GetContratoNotificacion($_REQUEST['contrato_id']);
        require_once 'Views/Contratos/notificarfirma.php';
    }


    public function PersonalSoporte()
    {
        $cargo = new Cargo();
        $cargos = $cargo->CargoIndex();
        $planta = $this->model->PlantaPersonal();
        require_once 'Views/Layout/talento.php';
        require_once 'Views/Contratos/plantapersonalsoporte.php';
        require_once 'Views/Layout/foot.php';
        require_once 'Views/Layout/filtro.php';
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
        $path = 'Assets/firmas/'  . $filename; // Ruta donde guardar las firmas


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

    function Soporte()
    {
        require_once 'Views/Contratos/soporteadd.php';
    }

    public function SubirSoporte()
    {
        $contrato_id = $_REQUEST['contrato_id'];
        $colaborador_cc = $_REQUEST['colaborador_cc'];
        $file_contrato=$_FILES['file_contrato'];
        $targetDir = "Assets/soportes_contratos/".$_SESSION['datos_cliente']->nombre."/"; // Cambia esto a la carpeta de destino deseada
        $maxFileSize = 2 * 1024 * 1024; // 2 MB en bytes
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Crea la carpeta si no existe
        }

        $archivoNombre = $file_contrato["name"];
        $archivoTamano = $file_contrato["size"];
        $archivoTipo = $file_contrato["type"];
        $archivoTmp = $file_contrato["tmp_name"];
        $archivoError = $file_contrato["error"];

        $archivoExtension = strtolower(pathinfo($archivoNombre, PATHINFO_EXTENSION));

        // Validar que el archivo sea un PDF
        if ($archivoExtension !== "pdf") {
            echo "El archivo debe ser un PDF.";
            exit();
        }

        // Validar el tamaño del archivo
        if ($archivoTamano > $maxFileSize) {
            echo "El archivo es demasiado grande. El tamaño máximo permitido es 2 MB.";
            exit();
        }

        // Mover el archivo a la carpeta de destino
        $archivoDestino = $targetDir . $colaborador_cc.'-'.$contrato_id . '.' . $archivoExtension;
        if (move_uploaded_file($archivoTmp, $archivoDestino)) {
            echo "Archivo subido correctamente.";
            exit();
        } else {
            echo "Error al subir el archivo.";
            exit();
        }
    }
}
