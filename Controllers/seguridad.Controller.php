<?php
require_once 'Models/Seguridad.php';
class SeguridadController
{    
     
    public $model;

    public function __CONSTRUCT()
    {
        $this->model = new Seguridad();
    }
    public function Logon()    
    {
        $userAuth  =  $this->model->Login($_REQUEST['usuario'], md5($_REQUEST['clave']));
        if ($userAuth) {
            if (isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])) {
                $user =  $this->model->Identificar($_REQUEST['usuario'], md5($_REQUEST['clave']));
                if ($user) { //print_r($user);
                    @session_start();
                    $_SESSION['last_activity'] = time();
                    $_SESSION['start'] = 'TRUE';
                    $_SESSION['log'] = 'true';
                    $_SESSION['user'] = $user;
                    $_SESSION['squema'] = $user->squema;
                    $_SESSION['rol'] = $user->rol;
                    $_SESSION['rol_id'] = $user->rol_id;
                    $_SESSION['cliente_id'] = $user->cliente_id;
                    /*se determina  que tipo de rol tiene para la redireccion rol->root,admin podran administrar toda el app
                  si por el contrario  no es ni root, admin sera dirigido al dashboard segun el squema registrado*/
                    switch ($user->rol) {
                        case 'root':
                            $_SESSION['squema'] = 'normalizacion_snu';
                            header('location:?c=clientes&a=index');
                            break;
                        case 'administrador':
                            header('location:?c=clientes&a=verificar');
                            break;
                        case 'funcionario':
                            header('location:?c=clientes&a=verificar');
                            break;
                        case 'proveedor':
                            header('location:?c=clientes&a=verificarP');
                            break;
                        case 'gestor':
                            header('location:?c=clientes&a=verificar');
                            break;
                    }
                } else {
                  //  header('location:?c=seguridad&a=logout&error=true');
                    // Obtener la cadena antes del signo de interrogación
                    $parsed_url = parse_url($_SERVER['REQUEST_URI']);                   
                   $url_before_question_mark = $parsed_url['path'];
                    // Redirigir al usuario a la página de inicio de sesión con un mensaje de error, si se especifica
                   header('location:' . $url_before_question_mark . '?error=true');
                }
            } else {
            }
        } else {
            $parsed_url = parse_url($_SERVER['REQUEST_URI']);
            $url_before_question_mark = $parsed_url['path'];
            // Redirigir al usuario a la página de inicio de sesión con un mensaje de error, si se especifica
            header('location:' . $url_before_question_mark . '?error=true');
        }
    }
    public function Index()
    {
        require_once 'Views/Seguridad/login.php';
    }
    public function Logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        // Obtener la cadena antes del signo de interrogación
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);
        print_r($parsed_url);
        $url_before_question_mark = $parsed_url['path'];
        // Redirigir al usuario a la página de inicio de sesión con un mensaje de error, si se especifica
        if (isset($_REQUEST['error'])) {
            header('location: /' . $url_before_question_mark . '?error=true');
        } else {
            header('location: ' . $url_before_question_mark);
        }
    }
    public function adquirir()
    {
        require_once 'Views/Layout/default.php';
        require_once 'Views/Layout/adquirir.php';
        require_once 'Views/Layout/foot.php';
    }
    public function Error()
    {
        require_once 'Views/Layout/error.php';
        require_once 'Views/Seguridad/error.php';
        require_once 'Views/Layout/ferror.php';
    }
}

