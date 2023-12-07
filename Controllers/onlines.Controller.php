<?php
// importar los modelos necesarios
require_once 'Models/Model.php';
require_once 'Models/Sessioncheck.php';
require_once 'Models/database.php';
require_once 'Models/Onlinedoc.php';


//nombre la clase
class OnlinesController
{
    public function __CONSTRUCT()
    {
        $this->model = new Onlinedoc();
        $model= new Model();
        $model->ModelDocOnline('doc_online');        
    }
    /*crear los metodos necesarios*/
    public function Index()
    {
        $online = new Onlinedoc();
        $onlines = $online->GetOnlineDoc($_REQUEST['id']);       
        require_once 'Views/Onlines/index.php';
        
    }
    public function Visor()
    {
        $url = $_REQUEST['id'];
       if(!empty($url)){
           echo
         '<object data="'.$url.'" type="application/pdf"width="100%" height="100%">
                 <embed src="'.$url.'" type="application/pdf" />
          </object>';
        }else{
            echo '
            <div class="panel panel-primary">            
            <div class="panel-body">
            <h2 class="text-center">No se encontro el documento solicitado</h2>
            </div>
            </div>';
        }        
    }
    // public function Add()
    // {
    //     $fabricante = new Fabricante();
    //     if (isset($_REQUEST['id'])) {
    //         $fabricante = $fabricante->Fabricante($_REQUEST['id']);
    //     }
    //     require_once 'Views/Fabricantes/crud.php';
    // }

    // public function Crud()
    // {
    //     $fabricante = new Fabricante();
    //     $fabricante->id = $_REQUEST['id'];
    //     $fabricante->nombres = strtoupper($_REQUEST['nombres']);        
    //     $fabricante->created = $_REQUEST['created'];
    //     $fabricante->modified = $_REQUEST['created'];
    //     $fabricante->modified = date('Y-m-d');

    //     $fabricante->id > 0 ? $fabricante->Edit($fabricante) : $fabricante->Add($fabricante);
    // }



    // public function Delete()
    // {
    //     $this->model->Delete($_REQUEST['id']);
    // }
}