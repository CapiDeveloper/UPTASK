<?php
namespace Model;
class Proyecto extends ActiveRecord{
    protected static $tabla = 'proyecto';
    protected static $columnasDB = ['id','nombre','descripcion','fecha','cotizacion','url','propietarioId'];
    public $id;
    public $nombre;
    public $descripcion;
    public $fecha;
    public $url;
    public $propietarioId;
    public $cotizacion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->propietarioId = $args['propietarioId'] ?? '';
        $this->cotizacion = $args['cotizacion'] ?? '';
        
    }
    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['error'][]='El nombre es obligatorio';
        }
        if (!$this->descripcion) {
            self::$alertas['error'][]='La descripcion es obligatoria';
        }
        if (!$this->cotizacion) {
            self::$alertas['error'][]='La cotizacion es obligatoria';
        }
        return self::$alertas;
    }
}