<?php
// Incluir la clase BD
include_once 'cBaseDatos.php';

// Clase lectura
class cLectura{
    // Atributos de la clase
    private $id;
    private $temperatura;
    private $humedad;
    private $peso;
    private $fecha_hora;

    // Constructor por defecto
    function __construct(){
        $this->id = 0;
        $this->temperatura = "";
        $this->humedad = "";
        $this->peso = "";
        $this->fecha_hora = "";
    }

    // Getters and setters de la clase

    function setId($id) {
        $this->id = $id;
    }

    function setTemperatura($temperatura) {
        $this->temperatura = $temperatura;
    }

    function setHumedad($humedad) {
        $this->humedad = $humedad;
    }

    function setPeso($peso) {
        $this->peso = $peso;
    }

    function setFecha_hora($fecha_hora) {
        $this->fecha_hora = $fecha_hora;
    }

    function getId() {
        return $this->id;
    }

    function getTemperatura() {
        return $this->temperatura;
    }

    function getHumedad() {
        return $this->humedad;
    }

    function getPeso() {
        return $this->peso;
    }

    function getFecha_hora() {
        return $this->fecha_hora;
    }

	//Método registraLectura, usado para registrar una Lectura en la BD
    function registraLectura(){     

	    $baseDatos = new cBaseDatos();

    	$sentenciaSQL="INSERT INTO lecturas(temperatura, humedad, peso, fecha_hora, id_sensor) VALUES ('$this->temperatura', '$this->humedad', '$this->peso', '$this->fecha_hora', '$this->id')"; 
        
		$result = $baseDatos->insertarRegistro($sentenciaSQL);

		$response = array();

	    if ($result) {
            echo "Lectura registrada correctamente";
    		$response["success"] = 1;
    	} else {
            echo "Error al registrar la lectura";
        	$response["success"] = 0;
    	}
 		
		return $response;
		 
    }//Fin método registraLectura

    //Funcion para obtener la última lectura almacenada en la base de datos
    function consultaLectura(){     
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT temperatura, humedad, peso, fecha_hora FROM lecturas ORDER BY fecha_hora DESC LIMIT 1";

		$rs = $baseDatos->consultaRegistros($sentenciaSQL);

		$result = array();

		if ($rs->num_rows > 0){
	    	while($row = $rs->fetch_assoc()){
                $result[]=  $row;
            }
		}
		else{
        
        	$result["error"] = 1;
        	$result["message"] = "No hay lecturas registradas.";
		
		}

		return $result;
         
    }//Fin método consultalectura

    // Método para obtener todas las lecturas de temperatura, humedad y peso
    function obtenerLecturas() {
        // Establecer la zona horaria de Cancún
        date_default_timezone_set('America/Cancun');
        
        // Calcular la fecha de hoy en la zona horaria de Cancún
        $fechaActual = date('Y-m-d');
        
        // Conectar a la base de datos
        $baseDatos = new cBaseDatos();
        
        // Usar la fecha calculada en la consulta SQL
        $sentenciaSQL = "SELECT temperatura, humedad, peso, fecha_hora FROM lecturas WHERE DATE(fecha_hora) = '$fechaActual' ORDER BY fecha_hora ASC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();

        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $result[] = $row;
            }
        } else {
            $result["error"] = 1;
            $result["message"] = "No hay lecturas de hoy";
        }

        return $result;
    }


    function obtenerLecturasPorFecha($fecha) {
        $baseDatos = new cBaseDatos();
        $sentenciaSQL = "SELECT temperatura, humedad, peso, fecha_hora FROM lecturas WHERE DATE(fecha_hora) = '$fecha' ORDER BY fecha_hora ASC";
        $rs = $baseDatos->consultaRegistros($sentenciaSQL);
        $result = array();
    
        if ($rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                $result[] = $row;
            }
        } else {
            $result["error"] = 1;
            $result["message"] = "No hay lecturas de este día";
        }
    
        return $result;
    }
    
}

// Función para comprobar si hay nuevos datos
function hayNuevosDatos($ultimoFechaHora) {
    $lectura = new cLectura();
    $ultimaLectura = $lectura->consultaLectura();
    
    if (isset($ultimaLectura[0]['fecha_hora']) && $ultimaLectura[0]['fecha_hora'] != $ultimoFechaHora) {
        return true;
    }
    return false;
}

?>