<?php
namespace Model;
class Usuario extends ActiveRecord{
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmado;
    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
    //Validar nuevo password desde perfil de dashbord
    public function nuevo_password(){
        $this->password;
        if (!$this->password_actual) {
            self::$alertas['error'][]='El password actual el obligatorio';
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][]='El password nuevo el obligatorio';
        }
        if (strlen($this->password_nuevo) < 6 ) {
            self::$alertas['error'][]='El password nuevo debe contener almenos 6 caracteres';
        }
        return self::$alertas;
    }
    //Validar el login de usuarios
    public function validarLogin(){
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][]='Email no valido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        return self::$alertas;
    }
    public function validar(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Es boligatorio el nombre';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener mas de 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los password son diferentes';
        }
        
        return self::$alertas;
    }

    //Validar perfil
    public function validarPerfil(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Es boligatorio el nombre';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }
    //Hashea password
    public function hashearPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }
    //Crear Token
    public function crearToken(){
        $this->token = uniqid();
    }
    //Validar email
    public function validaValidarEmail(){
        if (!$this->email) {
            self::$alertas['error'][]='El email es obligatorio';
        }
        //Para validar un email, es decir que tenga un formato valido
        if (!filter_var($this->email,FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][]='Email no valido';
        }
        return self::$alertas;
    }
    //Valida el password
    public function validarPassword(){
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener mas de 6 caracteres';
        }
        return self::$alertas;
    }
}