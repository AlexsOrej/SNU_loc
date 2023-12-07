<?php
require_once '../model/Evento.php';

class EventoController
{

    private $model;
    public function __CONSTRUCT()
    {
        $this->model = new Evento();
    }

    public function Index()
    {

        //require_once '../vista/header.php';
        require_once '../vista/cliente/index.php';
        //require_once '../vista/footer.php';

    }

    public function fin()
    {
        //require_once '../vista/header.php';
        require_once '../vista/cliente/index1.php';
        // require_once '../vista/footer.php';

    }
    public function Crud()
    {
        $alm = new Cliente();
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
            require_once '../vista/header.php';
        } else {
            require_once '../vista/vista_pqrs.php';
        }

        require_once '../vista/pqrs/pqrs-editar.php';
        require_once '../vista/footer.php';
    }

    public function Add()
    {
        $alm = new Cliente();
        $alm->empresa_id = $_REQUEST['empresa_id'];
        $alm->respuesta_id = $_REQUEST['respuesta_id'];
        $alm->estado_cliente = $_REQUEST['estado_cliente'];
        $alm->sugerencia = $_REQUEST['sugerencia'];
        $alm->created = date('Y-m-d');
        $alm->modified = date('Y-m-d');
        $this->model->Registrar($alm);
        $emp = $alm->empresa_id;
        header("Location: https://calidadsnu.com/snu/Contacto/cliente/index?exit=" . $emp . "");
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}
