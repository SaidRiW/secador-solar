<?php

	include '../clases/cRecordatorio.php';
	
    $recordatorio = new cRecordatorio();
	
	$result = "";	

    // Opción 1: obtener todas los recordatorios
    if ($_GET['opcion'] == 1) {
        $result = $recordatorio->obtenerRecordatorios();
    }

    // Opción 2: marcar como leído todos los recordatorios
    if ($_GET['opcion'] == 2) {
        $result = $recordatorio->marcarTodosLeidos();
    }

    // Opción 3: marcar como leído un recordatorio
    if ($_GET['opcion'] == 3) {
        $id = $_GET['id'];
        $result = $recordatorio->marcarLeido($id);
    }

	echo json_encode($result);	

?>