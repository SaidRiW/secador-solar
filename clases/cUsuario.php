<?php
// Incluir la clase BD
include_once 'cBaseDatos.php';

// Clase usuario
class cUsuario{
    // Atributos de la clase
    private $id;
    private $nombre;
    private $apellido_pat;
    private $apellido_mat;
    private $correo;
    private $contrasena;
    private $imagen;
    private $rol;

    // Constructor por defecto
    function __construct(){
        $this->id = 0;
        $this->nombre = "";
        $this->apellido_pat = "";
        $this->apellido_mat = "";
        $this->correo = "";
        $this->contrasena = "";
        $this->imagen = "";
        $this->rol = "";
    }

    // Getters and setters de la clase

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido_pat($apellido_pat) {
        $this->apellido_pat = $apellido_pat;
    }

    function setApellido_mat($apellido_mat) {
        $this->apellido_mat = $apellido_mat;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setContrasena($contrasena) {
        $this->contrasena = MD5($contrasena); // Aplica un cifrado hash por seguridad
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    function setRol($rol) {
        $this->rol = $rol;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido_pat() {
        return $this->apellido_pat;
    }

    function getApellido_mat() {
        return $this->apellido_mat;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getImagen() {
        return $this->imagen;
    }
    
    function getRol() {
        return $this->rol;
    }

	//Método registraUsuario, usado para registrar un Usuario en la BD
    function registraUsuario(){     

	    $baseDatos = new cBaseDatos();

    	$sentenciaSQL="INSERT INTO usuarios (nombre, apellido_pat, apellido_mat, correo, contrasena, imagen, id_rol) VALUES ('$this->nombre', '$this->apellido_pat', '$this->apellido_mat', '$this->correo', '$this->contrasena', '$this->imagen', '$this->rol')"; 
        
		$result = $baseDatos->insertarRegistro($sentenciaSQL);

		$response = array();

	    if ($result) {
       
    		$response["success"] = 1;
        	$response["message"] = "Usuario registrado correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "¡Ocurrió un error!";
       
    	}
 		
		return $response;
		 
    }//Fin método registraUsuario

	//Método actualizaDatosUsuario, usado para actualizar un usuario en la BD
    function actualizaDatosUsuario(){     

	    $baseDatos = new cBaseDatos();

	    $sentenciaSQL="UPDATE usuarios SET nombre='$this->nombre', apellido_pat='$this->apellido_pat', apellido_mat='$this->apellido_mat', correo='$this->correo', contrasena='$this->contrasena', id_rol='$this->rol' WHERE id='$this->id'"; 

		$result = $baseDatos->modificarRegistro($sentenciaSQL);

		$response = array();

		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Usuario modificado correctamente.";
	    } else {
       
    	    $response["success"] = 0;
        	$response["message"] = "¡Ocurrió un error!";
       
    	}

		return $response;
		 
    }//Fin método actualizaUsuario

	//Método eliminaUsuario, usado para eliminar una Usuario en la BD
    function eliminaUsuario(){     

	    $baseDatos = new cBaseDatos();

	    $sentenciaSQL="DELETE FROM usuarios WHERE id='$this->id'";

		$result = $baseDatos->eliminarRegistro($sentenciaSQL);
	
    	if ($result) {
        
        	$response["success"] = 1;
        	$response["message"] = "Usuario eliminado correctamente.";
    	} else {
       
        	$response["success"] = 0;
        	$response["message"] = "¡Ocurrió un error!";      
    	}

		return $response;
		 
    }//Fin método eliminaUsuario


    //Método consultaUsuario, usado para consultar registros de todos los usuarios en la BD
    function consultaUsuario(){     
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT DISTINCT id, nombre, apellido_pat, apellido_mat, correo, id_rol FROM usuarios WHERE id=". $this->id;

		$rs = $baseDatos->consultaRegistros($sentenciaSQL);

		$result = array();

		if ($rs->num_rows > 0){
	    	while($row = $rs->fetch_assoc()){
                $result[]=  $row;
            }
		}
		else{
        
        	$result["error"] = 1;
        	$result["message"] = "El usuario no existe en la BD.";
		
		}

		return $result;
         
    }//Fin método consultaUsuarios

    //Método consultaUsuarios, usado para consultar registros de todos los usuarios en la BD
    function consultaUsuarios(){  

        session_start();
        
        $baseDatos = new cBaseDatos();
        
        $sentenciaSQL="SELECT DISTINCT u.id, CONCAT(u.nombre, ' ', u.apellido_pat, ' ', u.apellido_mat) AS nombre_completo, u.correo, r.nombre AS rol FROM usuarios u JOIN roles r ON u.id_rol = r.id WHERE u.id != " . $_SESSION['id'];

        $rs = $baseDatos->consultaRegistros($sentenciaSQL);

        $result = array('data' => array());

        if ($rs->num_rows > 0){           
           while($row = $rs->fetch_assoc()){
                $result['data'][] = $row; 
            }
        
        }
        
        return $result;
         
    }//Fin método consultaUsuarios

    // Función para iniciar sesión
    function iniciarSesion() {

        $bd = new cBaseDatos();

        // Validar el inicio de sesión
        $comandoSQL = "SELECT * FROM usuarios WHERE correo = '$this->correo' AND contrasena = '$this->contrasena'";

        // Si el usuario existe en la base de datos
        $resultado = $bd->consultaRegistros($comandoSQL);

        // Si encontró el registro del usuario
        if ($resultado->num_rows > 0) {
            // Inicia la sesión y crea variables de sesión
            session_start();
            $_SESSION['autenticado'] = true;
            // Aquí se asignan las variables de sesión con los datos del usuario
            $fila = $resultado->fetch_row();
            $_SESSION['id'] = $fila[0];
            $_SESSION['nombre'] = $fila[1];
            $_SESSION['apellido_pat'] = $fila[2];
            $_SESSION['apellido_mat'] = $fila[3];
            $_SESSION['correo'] = $this->correo;
            $_SESSION['imagen'] = $fila[6];
            $_SESSION['rol'] = $fila[7];

            // Retorna un valor de 1 para indicar que se inició la sesión correctamente
            return 1;
        }
        // En caso de que no se encontró al usuario, retorna 0
        else {
            return 0;
        }
    }

	//Método actualizaFotoPerfil, usado para actualizar la foto de un Usuario en la BD
    function actualizaFotoPerfil(){     

	    $baseDatos = new cBaseDatos();

    	$sentenciaSQL="UPDATE usuarios set imagen='$this->imagen' WHERE Matricula='$this->Matricula'"; 
		
        $result = $baseDatos->modificarRegistro($sentenciaSQL);
        
		$response = array();


		if ($result>0) {       
        	$response["success"] = 1;
        	$response["message"] = "Foto modificada correctamente.";
	    } else {
       
    	    $response["success"] = 0;
        	$response["message"] = "Oops! Ocurrió un error!!";
       
    	}

		return $response;
		 
    }//Fin método actualizaFotoPerfil   

}

?>