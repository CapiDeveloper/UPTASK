<?php

    namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

    class LoginController{
        public static function login(Router $router){
            $alertas = [];
            $usuario = new Usuario;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarLogin();
                if(empty($alertas)){
                    $existeUsuario = Usuario::where('email',$_POST['email']);
                    if(!$existeUsuario || $existeUsuario->confirmado === '0' ){
                        Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                    }else{
                        //Existe usuario
                        if (!password_verify($_POST['password'],$existeUsuario->password)) {
                            //No coincide password
                            Usuario::setAlerta('error','Password incorrecto');
                        }else{
                            session_start();
                            $_SESSION['id'] = $existeUsuario->id;
                            $_SESSION['nombre'] = $existeUsuario->nombre;
                            $_SESSION['email'] = $existeUsuario->email;
                            $_SESSION['login'] = true;
                            header('location: /dashbord');
                        }
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/login',[
                'titulo' => 'Iniciar Seccion',
                'usuario' => $usuario,
                'alertas' => $alertas
            ]);
        }
        public static function logout(){
            session_start();
            $_SESSION =[];
            header('location: /');
        }
        public static function crear(Router $router){
            $alertas = [];
            $usuario = new Usuario;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validar();
                
                if (empty($alertas)) {
                    $existeUsuario =  Usuario::where('email',$usuario->email);
                    
                    if($existeUsuario){
                        Usuario::setAlerta('error','El usuario ya existe');
                        $alertas = Usuario::getAlertas();
                    }else{
                        //Hashear password
                        $usuario->hashearPassword();
                        //Eliminamos password2 del objeto en memoria
                        unset($usuario->password2);
                        //Generamos token
                        $usuario->crearToken();
                        //Guardar usuario
                        $resultado = $usuario->guardar();
                        //Enviar Email
                        $email = new Email($usuario->nombre,$usuario->email,$usuario->token);
                        $email->enviarConfirmacion();
                        if ($resultado) {
                            header('location: /mensaje');
                        }
                    }
                }
            }
            $router->render('auth/crear',[
                'titulo' => 'Crear',
                'usuario' =>$usuario,
                'alertas' =>$alertas
            ]);
        }
        public static function olvide(Router $router){
            $alertas = [];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $usuario = new Usuario($_POST);
                $alertas = $usuario->validaValidarEmail();
                if (empty($alertas)) {
                    $auth = Usuario::where('email',$_POST['email']);
                    if ($auth && ($auth->confirmado === '1') ) {
                        //Generar un token
                        $auth->crearToken();
                        //Actualizar usuario
                        unset($auth->password2);
                        $auth->guardar();
                        //Enviar email
                        $email = new Email($auth->nombre,$auth->email,$auth->token);
                        $email->enviarInstrucciones();

                        //Alerta exito
                        Usuario::setAlerta('exito','Hemos enviado las instrucciones a tu email');
                        
                    }else{
                        Usuario::setAlerta('error','Usuario no existe o no esta confirmado');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/olvide',[
                'titulo' => 'Olvide',
                'alertas' => $alertas
            ]);
        }
        public static function reestablecer(Router $router){
            $alertas = [];
            $mostrar = true;
            $token = s($_GET['token']);
            if(!$token) header('location: /');
                $usuario = Usuario::where('token',$token);
                if(empty($usuario)){
                    Usuario::setAlerta('error','Token no valido');
                    $mostrar = false;
                }   
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $usuario->sincronizar($_POST);
                    $alertas = $usuario->validarPassword();
                    if (empty($alertas)) {
                        //Hashear password
                        $usuario->hashearPassword();
                        //Eliminar el token, es decir dejarlo en null
                        $usuario->token = NULL;
                        //Eliminar elemento de objeto que no es necesario
                        unset($usuario->password2);
                        //Guardar 
                        $resultado = $usuario->guardar();
                        //Condicional si se guardo perfectamente retonar a /
                        if($resultado){
                            header('location: /');
                        }
                    }
            }
            $alertas = Usuario::getAlertas();
            $router->render('auth/reestablecer',[
                'titulo' => 'Reestablecer Password',
                'alertas' => $alertas,
                'mostrar' => $mostrar
            ]);
        }
        public static function mensaje(Router $router){
            
            $router->render('auth/mensaje');
        }
        public static function confirmar(Router $router){
            $token = s($_GET['token']);
            if (!$token) {
                header('location: /');
            }
            //Encontrar al usuario con este token
            $usuario = Usuario::where('token',$token);
            if (empty($usuario)) {
                //No se encontro un usuario con ese token
                Usuario::setAlerta('error','Token no valido');
            }else{
                //Confirmar la cuenta
                
                $usuario->confirmado = 1;
                unset($usuario->password2);
                $usuario->token=null;

                //Guardar en la BD
                $usuario->guardar();
                Usuario::setAlerta('exito','Cuenta comprobada correctamente');
            }
            $alertas = Usuario::getAlertas();
            // $usuario->token='';
            $router->render('auth/confirmar',[
                'alertas' =>$alertas
            ]);
        }
    }