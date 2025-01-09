<?php
	include '../clases/cUsuario.php';
	
	$usuario = new cUsuario();
	
	$result = "";	

	//Opción 1 registrar un usuario
	if($_GET['opcion']==1){
		$usuario->setNombre($_POST['txtNombre']);
		$usuario->setApellido_pat($_POST['txtApellido_pat']);
		$usuario->setApellido_mat($_POST['txtApellido_mat']);
		$usuario->setCorreo($_POST['txtCorreo']);
		$usuario->setContrasena($_POST['txtContrasena']);
		$usuario->setImagen('../dist/img/user.jpg');
		$usuario->setRol($_POST['selRol']);   
		$result = $usuario->registraUsuario();    
	}

	//Opción 2 eliminar un usuario
	if($_GET['opcion']==2){
		$usuario->setId($_GET['id']);	
		$result = $usuario->eliminaUsuario();      
	}

	//Opción 3 editar un usuario
	if($_GET['opcion']==3){
		$usuario->setId($_GET['id']);
		$usuario->setNombre($_POST['txtNombreE']);
		$usuario->setApellido_pat($_POST['txtApellido_patE']);
		$usuario->setApellido_mat($_POST['txtApellido_matE']);
		$usuario->setCorreo($_POST['txtCorreoE']);
		$usuario->setContrasena($_POST['txtContrasenaE']);
		$usuario->setImagen('../dist/img/user.jpg');
		$usuario->setRol($_POST['selRolE']);  
		$result = $usuario->actualizaDatosUsuario();      
	}

	//Opción 4 consultar un usuario
	if($_GET['opcion']==4){
		$usuario->setId($_POST['id']);
		$result = $usuario->consultaUsuario();  
	}

	//Opción 5 consultar usuarios
	if($_GET['opcion']==5){
		$result = $usuario->consultaUsuarios();  
    
	}

	echo json_encode($result);	

?>