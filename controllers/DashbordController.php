<?php 
namespace Controllers;
use Model\Proyecto;
use Model\Usuario;
use MVC\Router;

class DashbordController{
    public static function index(Router $router){
        session_start();
        isAuth();
        $proyectos = Proyecto::belongsTo('propietarioId',$_SESSION['id']);
        $router->render('dashbord/index',[
            'titulo' => 'Proyectos',
            'proyectos' => $proyectos
        ]);
    }
    public static function crear_proyecto(Router $router){
        session_start();
        isAuth();
        $alertas = [];
        $proyecto = new Proyecto;
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $proyecto->sincronizar($_POST);
            $alertas = $proyecto->validar();
            if (empty($alertas)) {
                //Generar una URL unica
                $proyecto->url = md5(uniqid());
                //Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];
                $proyecto->fecha = DATE('Y-m-d');
                $resultado = $proyecto->guardar();
                if ($resultado) {
                    header('location: /proyecto?id='.$proyecto->url);
                }
            }
        }
        $router->render('dashbord/crear-proyecto',[
            'titulo' => 'Crear Proyecto',
            'alertas' => $alertas,
            'proyecto' => $proyecto
        ]);
    }
    public static function proyecto(Router $router){
        session_start();
        isAuth();
        $token = s($_GET['id']);
        if (!$token) header('location: /dashbord');
        // Revisar que la persona que visita el proyecto es quien la creo
        $proyecto = Proyecto::where('url',$token);
        if($proyecto->propietarioId !== $_SESSION['id']){
            header('location: /dashbord');
        }
        $router->render('dashbord/proyecto',[
            'titulo' => $proyecto->nombre,
            'proyecto' => $proyecto
        ]);
    }
    public static function perfil(Router $router){
        session_start();
        $usuario = Usuario::find($_SESSION['id']);
        isAuth();
        $alertas = [];
        
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            
            $usuario->sincronizar($_POST);   
            $alertas = $usuario->validarPerfil();
            
            if(empty($alertas)){

                //Verificar si el correo ya existe
                $existeUsuario = Usuario::where('email',$usuario->email);
                //el ingresado existe    //El id ingresado es diferente de logueado id
                if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    //Existe usuario
                    Usuario::setAlerta('error','Email no valido, ya pertenece a otra cuenta');
                    $alertas = Usuario::getAlertas();
                }else{
                    //Guardar el usuario
                    $resultado = $usuario->guardar();
                    //Asignar nombre nuevo a la barra
                    $_SESSION['nombre'] = $usuario->nombre;
                
                    if ($resultado) {
                        Usuario::setAlerta('exito','Guardado correctamente');
                        $alertas = Usuario::getAlertas();
                        $_SESSION['nombre'] = $usuario->nombre;
                    }
                }
            }  
        }
        $router->render('dashbord/perfil',[
            'titulo' => 'Perfil',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }
    public static function cambiar_password(Router $router){
        session_start();
        isAuth();   
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->nuevo_password();
            if (empty($alertas)) {
                if (password_verify($usuario->password_actual,$usuario->password)) {
                    
                    $usuario->password = $usuario->password_nuevo;
                    
                    //Eliminar propiedades NO necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);
                    unset($usuario->password2);
                    //Hashear nuevo password
                    $usuario->hashearPassword();
                    
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        //Mensaje de exito en guardar password
                        Usuario::setAlerta('exito','Password cambiado correctamente'); 
                    }
                }else{
                    Usuario::setAlerta('error','El password con password actual son diferentes');
                    
                }
            }         
        }
        $alertas = Usuario::getAlertas();
        $router->render('/dashbord/cambiarPassword',[
            'titulo' => 'Cambiar Password',
            'alertas' => $alertas
        ]);
    }
}