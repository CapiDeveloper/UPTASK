<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashbordController;
use Controllers\TareaController;

$router = new Router();

//  ** Login - logout - Autenticacion - otros **

// Iniciar Seccion y Cerra Session
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

// Crear Cuenta
$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);

// Recuperar Cuenta
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);

//Colocar el nuevo password
$router->get('/reestablecer',[LoginController::class,'reestablecer']);
$router->post('/reestablecer',[LoginController::class,'reestablecer']);

//Confirmcion de cuenta
$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);

//  ** Rutas protegidas **
$router->get('/dashbord',[DashbordController::class,'index']);
$router->get('/crear-proyecto',[DashbordController::class,'crear_proyecto']);
$router->post('/crear-proyecto',[DashbordController::class,'crear_proyecto']);
$router->get('/proyecto',[DashbordController::class,'proyecto']);
$router->get('/perfil',[DashbordController::class,'perfil']);
$router->post('/perfil',[DashbordController::class,'perfil']);
$router->get('/cambiar-password',[DashbordController::class,'cambiar_password']);
$router->post('/cambiar-password',[DashbordController::class,'cambiar_password']);



// API para las tareas - CRUD
$router->get('/api/tareas',[TareaController::class,'index']); // Para mostrar tareas
$router->post('/api/tarea',[TareaController::class,'crear']); //Para crear una tarea
$router->post('/api/tarea/actualizar',[TareaController::class,'actualizar']); //Para crear una tarea
$router->post('/api/tarea/eliminar',[TareaController::class,'eliminar']); //Para crear una tarea


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();