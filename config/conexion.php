<?php

    session_start();//PARA LOGIN - iniciamos el sesion

    /*private $servidor = "localhost";
        private $nombre = "bdarchivo";
        private $puerto = 3306;
        private $usuario = "root";
        private $contrasena = "";*/
    //creamos la clase conectar
    class Conectar {
        
        protected $dbh; //Atributo para la base de datos privada
        
        protected function conexion()
        { 
        try {//verifica la conexion

            $conectar = $this -> dbh = new PDO("mysql:local=localhost;port=3306;dbname=bdarchivo2","root","");
            return $conectar; //devolvemos la conexion para usarla en otras clases o para la conexion con las tablas
            
        } catch (Exception $e) {
            //imprime un mensaje de error
            print "¡Error al conectar!". $e->getMessage()."<br/>";
            die();        
        }
        
    }//Cierre de conectar
    public function set_names(){
        return $this -> dbh -> query("set_names 'utf8'");//Funcion para los caracteres    
    }
    public function ruta(){//Funcion para la ruta de nuestro sistema - nos ayudara para redireccionar 
        return "http://localhost/prueba/";
    }

/*
    public function get_servidor():string
    {
        return $this->servidor;
    }

    public function get_name():string
    {
        return $this->db;
    }

    public function get_puerto():string
    {
        return $this->port;
    }

    public function get_usuario():string
    {
        return $this->usuario;
    }

    public function get_contrasena():string
    {
        return $this->contrasena;
    }
    */
}//Cierra Conectar
?>