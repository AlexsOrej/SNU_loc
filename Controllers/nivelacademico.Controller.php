<?php
require_once 'Models/Sessioncheck.php';
require_once 'Models/Nivelacademico.php';

class NivelacademicoController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Nivelacademico();
    }

    public function Index()
    {
        $formacion = $this->model->Listar($_REQUEST['id']);
        require_once 'Views/Nivelacademico/nivelacademico1.php';
    }

    public function Index2()
    {

        require_once '../vista/nivelacademico/nivelacademico.php';
    }

    public function Crud()
    {
        $alm = new Nivelacademico();
        if (isset($_REQUEST['formacion_id'])) {
            $alm = $this->model->Obtener($_REQUEST['formacion_id']);
        }
        require_once 'Views/Nivelacademico/nivelacademico-editar.php';
    }


    public function Crud1()
    {
        $alm = new Nivelacademico();

        if (isset($_REQUEST['id'])) {
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        require_once '../vista/header1.php';
        require_once '../vista/nivelacademico/nivelacademico-editar1.php';
        require_once '../vista/footer.php';
    }

    public function Guardar()
    {
        $alm = new Nivelacademico();

        $alm->id = $_REQUEST['id'];
        $alm->nivel = $_REQUEST['nivel'];
        $alm->estudio = $_REQUEST['estudio'];
        $alm->curso_vigilancia = $_REQUEST['curso_vigilancia'];
        $alm->lugar = $_REQUEST['lugar'];
        $alm->fecha = $_REQUEST['fecha'];
        $alm->usuario_id = $_REQUEST['usuario_id'];
        $id = $_REQUEST['usuario_id'];

        $alm->id > 0
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        echo "<script>
		       alert('El registro de la información se realizo correctamente');
		                  window.location = '?c=Nivelacademico&a=Index&id=" . $id . "';
		     </script>";
    }


    public function Guardar1()
    {
        $alm = new Nivelacademico();
        $alm->id = $_REQUEST['id'];
        $alm->nivel = $_REQUEST['nivel'];
        $alm->estudio = $_REQUEST['estudio'];
        $alm->curso_vigilancia = $_REQUEST['curso_vigilancia'];
        $alm->lugar = $_REQUEST['lugar'];
        $alm->fecha = $_REQUEST['fecha'];
        $alm->usuario_id = $_REQUEST['usuario_id'];
        $id = $_REQUEST['usuario_id'];
        $alm->id > 0
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);


        echo "<script>
		      alert('El registro de la información se realizo correctamente');
		                  window.location = '?c=Usuario&a=complementarios&id=$id';
		     </script>";
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        echo "<script>
		       alert('El registro de la información se realizo correctamente');
               window.location.reload(1);       
		     </script>";
    }
}
