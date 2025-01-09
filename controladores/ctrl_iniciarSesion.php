<?php

	include '../clases/cUsuario.php';

    $usuario = new cUsuario();
	
	$resultado = array();
	
	if(isset($_GET['inicia_sesion'])){

        $usuario->setCorreo($_POST['correo']);
        $usuario->setContrasena($_POST['contrasena']);
        
        // Iniciar sesión
        $resultado = $usuario->iniciarSesion();
    }
    
    ob_clean();
	echo json_encode($resultado);	


?>