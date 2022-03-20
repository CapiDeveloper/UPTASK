<?php 
namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController{
    public static function index(){
        session_start();
        $proyectoId = s($_GET['id']);
        if (!$proyectoId) header('location: /dashbord');
        $proyecto =  Proyecto::where('url',$proyectoId);
        if (!$proyecto || $_SESSION['id'] !== $proyecto->propietarioId) {
            header('location: /404');
        }
        $tareas = Tarea::belongsTo('proyectoId',$proyecto->id);
        echo json_encode(['tareas' => $tareas]);
    }
    public static function crear(){
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            session_start();
            //Encontrando si existe el proyecto, gracias al id de la url que extraimos con js
            $proyecto = Proyecto::where('url',$_POST['proyectoId']);

            if (!$proyecto || $_SESSION['id'] !== $proyecto->propietarioId ) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al agregar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }
                //Todo bien
                $tarea = new Tarea($_POST);
                $tarea->proyectoId = $proyecto->id;
                $resultado = $tarea->guardar();
                $respuesta = [
                    'tipo' => 'exito',
                    'mensaje' => 'Tarea creada correctamente',
                    'id' => $resultado['id'],
                    'proyectoId' =>$proyecto->id
                ];
                echo json_encode($respuesta);
            }
    }
    public static function actualizar(){
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            session_start();
            //Validar que el proyecto exista
            $proyecto = Proyecto::where('url',$_POST['proyectoId']);
            if (!$proyecto || $_SESSION['id'] !== $proyecto->propietarioId ){
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            };
            $tarea = new Tarea($_POST);
            $tarea->proyectoId = $proyecto->id;
            $resultado = $tarea->guardar();
            if ($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $tarea->id,
                    'mensaje' => 'Actualizado correctamente',
                    'proyectoId' =>$proyecto->id
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }
    public static function eliminar(){
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            session_start();
            //Validar que el proyecto exista
            $proyecto = Proyecto::where('url',$_POST['proyectoId']);
            if (!$proyecto || $_SESSION['id'] !== $proyecto->propietarioId ){
                $respuesta = [
                    'resultado' => false,
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al eliminar la tarea'
                ];
                echo json_encode($respuesta);
                return;
            }
            $tarea = Tarea::where('id',$_POST['id']);
            $resultado = $tarea->eliminar();
            $resultado = [
                'resultado' => $resultado,
                'tipo' => 'success',
                'mensaje' => 'Eliminado Correctamente'
            ];
            echo json_encode($resultado);
        }
    }
}