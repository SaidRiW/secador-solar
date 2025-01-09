<?php

	include '../clases/cLectura.php';
	
    $lectura = new cLectura();
	
	$result = "";	

    // Opción 1: obtener todas las lecturas
    if ($_GET['opcion'] == 1) {
        $result = $lectura->obtenerLecturas();
    }

    // Opción 2: obtener las lecturas de un día
    if ($_GET['opcion'] == 2 && isset($_GET['fecha'])) {
        $fecha = $_GET['fecha'];
        $result = $lectura->obtenerLecturasPorFecha($fecha);
    }

	echo json_encode($result);	

?>