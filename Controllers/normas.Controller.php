<?php
require_once 'Models/Autoload.php';

class NormasController
{

    public $norma;
    public $planauditoria;
    public function __CONSTRUCT()
    {
        $this->norma = new Norma();
        $this->planauditoria = new Auditoria();
    }


    public function Index()
    {
        $normas = $this->norma->Index();
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Normas/index.php';
        require_once 'Views/Layout/foot.php';
    }

    public function Crud()
    {
        $normas = new Norma();
        if (isset($_REQUEST['norma_id'])) {
            $normas = $this->norma->Obtener($_REQUEST['norma_id']);
        }
        require_once 'Views/Normas/crud.php';
    }

    public function Registrar()
    {
        $normas = new Norma();
        $normas->id = $_REQUEST['id'];
        $normas->version = $_REQUEST['version'];
        $normas->descripcion = $_REQUEST['descripcion'];
        $normas->fecha_publicacion = $_REQUEST['publicacion'];
        $normas->ultima_actualizacion = $_REQUEST['actualizacion'];
        $normas->id > 0 ?
            $result =   $this->norma->Actualizar($normas) :
            $result =   $this->norma->Registrar($normas);
        echo $result;
    }

    public function Eliminar()
    {
        echo  $result =   $this->norma->Eliminar($_REQUEST['norma_id']);
    }

    ///ASIGNACION DE NORMAS PARA AUDITAR//

    public function Numerales()
    {
        //todo buscar el plan
       $planauditoria= $this->planauditoria->ObtenerPrograma($_REQUEST['pid']);
       $normas=$this->norma->Index();
       $_SESSION['pid']=$_REQUEST['pid'];
       $listaRequisitos=$this->planauditoria->ListaRequisitos($_REQUEST['pid']);
        require_once 'Views/Layout/auditorias.php';
        require_once 'Views/Auditorias/Planes/verplan.php';
        require_once 'Views/Layout/foot.php';
    }

    ///ASIGNACION DE NORMAS PARA AUDITAR//



}
