<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Usuario.php';
require_once 'Models/Cargo.php';
require_once 'Models/Pqrsf.php';
require_once 'Models/Procesos.php';
require_once 'Models/Accion.php';
require_once 'Models/Solicitudes.php';
require_once 'Models/Eventos.php';


class AccionesController
{
    private $usuario;
    private $cargo;
    private $proceso;
    private $accion;
    private $solicitudes;
    private $eventos;
    private $pqrs;
    
    public function __CONSTRUCT()
    {
        $this->usuario = new Usuario();
        $this->cargo = new Cargo();
        $this->proceso = new Proceso();
        $this->accion = new Accion();
        $this->solicitudes = new Solicitud();
        $this->eventos = new Evento();
        $this->pqrs = new Pqrs();
    }


    function PerfilUsuario(): mixed
    {
        require_once 'Views/Layout/estadistico.php';
        require_once 'Views/Acciones/add.php';
        require_once 'Views/Layout/foot.php';
    }
}
