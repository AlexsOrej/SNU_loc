<?php
// importar los modelos necesarios
require_once 'Models/database.php';
require_once 'Models/Usuario.php';
require_once 'correos/index.php';

//nombre la clase
class RecuperacionController
{
    // public function __CONSTRUCT()
    // {
    //     $this->model = new Grupofamiliar();
    // }
    /*crear los metodos necesarios*/
    public function info()
    {
       require_once 'Views/Recuperacion/info.php';
        
    }

    public  function Envio()
    {
        
    }



    public function Confirmar()
    {
        $confirm=new Usuario();
        $confirm->identificacion=$_REQUEST['cedula'];
        $confirm->email=$_REQUEST['correo'];
        $recuperar= $confirm->Validar($confirm);

        if(!empty($recuperar)){           
           $recuperar->nombres;
           $recuperar->apellidos;
           $recuperar->identificacion;
           $recuperar->username;
           $recuperar->email;           
           $rand= rand(3, $recuperar->identificacion);
           $pass=$rand;          
           $clave=md5($pass);
           $mensaje = 'Buen dia '.$recuperar->nombres.' '.$recuperar->apellidos.' la contraseña de acceso al software SNU es:'.$pass  ;
           $to = $recuperar->email;
           $subject='Recuperación de Clave';
           $confirm->id=$recuperar->id;
           $confirm->username = $recuperar->username;
           $confirm->password = $clave;           

         if(mail($to,$subject,$mensaje)){
                   $confirm->ClaveUpdate($confirm);
           }

        }else{         
            return 'Los datos no fueron encontrados,verifica la informacion y trata de nuevo';
        }    

      
        
    }
    public function Edit()
    {        
        require_once 'Views/Layout/default.php';
        require_once 'Views/Cliente/index.php';
        require_once 'Views/Layout/foot.php';
    }

}