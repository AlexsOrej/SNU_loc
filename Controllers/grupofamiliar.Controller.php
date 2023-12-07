<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Grupofamiliar.php';
class GrupofamiliarController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Grupofamiliar();
    }

    public function Index()
    {
        $grupof = $this->model->Obtener($_REQUEST['id']);
        require_once 'Views/grupofamiliar/grupo.php';
    }

    public function Crud()
    {
        $alm = new Grupofamiliar();
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener1($_REQUEST['id']);
        }
        require_once 'Views/grupofamiliar/grupo-editar.php';
    }
    public function Crud1()
    {
        $alm = new Grupofamiliar();
        /* echo $_REQUEST['id'];*/
        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        //require_once '../vista/header1.php';
        require_once '../vista/grupofamiliar/grupo-editar2.php';
        require_once '../vista/foot.php';
    }
    public function Index2()
    {

        require_once '../vista/header.php';
        require_once '../vista/grupofamiliar/grupo1.php';
        require_once '../vista/foot.php';
    }
    public function Guardar()
    {
        $alm = new Grupofamiliar();

        $alm->id = $_REQUEST['id'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellidos = $_REQUEST['apellidos'];
        $alm->parentesco = $_REQUEST['parentesco'];
        $alm->contacto = $_REQUEST['contacto'];
        $alm->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
        $alm->usuario_id = $_REQUEST['usuario_id'];

        $alm->id > 0
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
    }

    public function Guardar2()
    {
        $alm = new Grupofamiliar();

        $alm->id = $_REQUEST['id'];
        $alm->nombre = $_REQUEST['nombre'];
        $alm->apellidos = $_REQUEST['apellidos'];
        $alm->parentesco = $_REQUEST['parentesco'];
        $alm->contacto = $_REQUEST['contacto'];
        $alm->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
        $alm->usuario_id = $_REQUEST['usuario_id'];
        $id = $_REQUEST['usuario_id'];

        $alm->id > 0
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        echo "<script>
		          alert('El registro de la información se realizo correctamente');
		                window.location = 'https://sgvalle.com/usuarios/index.php?c=Usuario&a=Complementarios&id=$id';
		        </script>";
    }

    public function Eliminar()
    {
        $id = $_REQUEST['id'];
        $this->model->Eliminar($_REQUEST['idf']);
        // echo "<script>
		//       alert('El se elimino la información correctamente');
        //       //window.history.back();
		//       </script>";
    }
}
