<?php
// Incluir la clase BD
include_once 'cBaseDatos.php';

// Clase recordatorio
class cRecordatorio{
    // Atributos de la clase
    private $id;
    private $mensaje;
    private $leido;
    private $fecha_hora;
    private $id_usuario;

    // Constructor por defecto
    function __construct(){
        $this->id = 0;
        $this->mensaje = "";
        $this->leido = "";
        $this->id_usuario = "";
        $this->fecha_hora = "";
    }

    // Getters and setters de la clase

    function setId($id) {
        $this->id = $id;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setLeido($leido) {
        $this->leido = $leido;
    }

    function setFecha_hora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function getId() {
        return $this->id;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getLeido() {
        return $this->leido;
    }

    function getFecha_hora() {
        return $this->fecha_hora;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function registrarRecordatorio() {
        // Establecer la zona horaria de Cancún
        date_default_timezone_set('America/Cancun');
        $baseDatos = new cBaseDatos();
        $fechaCreacion = date('Y-m-d H:i:s');
        
        // Obtener todos los usuarios
        $usuarios = $baseDatos->consultaRegistros("SELECT id FROM usuarios");
    
        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                $idUsuario = $usuario['id'];
                $sentenciaSQL = "INSERT INTO recordatorios (mensaje, leido, fecha_hora, id_usuario) VALUES ('{$this->mensaje}', {$this->leido}, '$fechaCreacion', '{$idUsuario}')";
                $baseDatos->insertarRegistro($sentenciaSQL);
            }
        }
        
        return true;
    }    
    

    // Método para obtener todos los recordatorios que tiene el usuario
    function obtenerRecordatorios() {

        session_start();

        $usuario_id = $_SESSION['id'];
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL = "SELECT id, mensaje, leido, fecha_hora FROM recordatorios WHERE id_usuario = '$usuario_id' AND leido = 0 ORDER BY fecha_hora ASC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $result[] = $row;
            }
        } else {
            $result["error"] = 1;
            $result["message"] = "Sin recordatorios no leídos para el usuario.";
        }

        return $result;
    }

    function marcarLeido($id) {
        $baseDatos = new cBaseDatos();
        $sentenciaSQL = "UPDATE recordatorios SET leido = 1 WHERE id = '$id'";
        $result = $baseDatos->modificarRegistro($sentenciaSQL);
        $response = array();
    
        if ($result > 0) {
            $response["success"] = 1;
            $response["message"] = "Recordatorio marcado como leído.";
        } else {
            $response["success"] = 0;
            $response["message"] = "¡Ocurrió un error!";
        }
    
        return $response;
    }    
    
	//Método marcarTodosLeidos, usado para marcar como leído todos los recordatorios que tenga un usuario en la BD
    function marcarTodosLeidos(){
        
        session_start();

        $usuario_id = $_SESSION['id'];

	    $baseDatos = new cBaseDatos();

	    $sentenciaSQL="UPDATE recordatorios SET leido = 1 WHERE id_usuario = '$usuario_id'"; 

		$result = $baseDatos->modificarRegistro($sentenciaSQL);

		$response = array();

		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Recordatorios marcados como leído correctamente.";
	    } else {
       
    	    $response["success"] = 0;
        	$response["message"] = "¡Ocurrió un error!";
       
    	}

		return $response;
		 
    }//Fin método marcarTodosLeidos
}

?>