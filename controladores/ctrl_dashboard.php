<?php
date_default_timezone_set('America/Cancun');

include '../clases/cLectura.php';
include '../clases/cRecordatorio.php';

$lectura = new cLectura();
$recordatorio = new cRecordatorio();

$result = "";

// Función para verificar si debe generarse un recordatorio
function debeGenerarRecordatorio($fecha_hora) {
    // Hora específica para generar el recordatorio (12 AM)
    $horaLimite = new DateTime(date('Y-m-d') . ' 00:00:00');
    $fechaHoraLectura = new DateTime($fecha_hora);
    
    return $fechaHoraLectura >= $horaLimite;
}

// Función para verificar si ya se generó un recordatorio hoy
function yaSeGeneroRecordatorioHoy() {
    $baseDatos = new cBaseDatos();
    $hoy = date('Y-m-d');
    $sentenciaSQL = "SELECT COUNT(*) as total FROM recordatorios WHERE DATE(fecha_hora) = '$hoy'";
    $resultado = $baseDatos->consultaRegistros($sentenciaSQL);
    $fila = $resultado->fetch_assoc();
    
    return $fila['total'] > 0;
}

// Opción 1: registrar una lectura
if ($_GET['opcion'] == 1) {
    $lectura->setId($_POST['id']);
    $lectura->setTemperatura($_POST['temperatura']);
    $lectura->setHumedad($_POST['humedad']);
    $lectura->setPeso($_POST['peso']);
    $lectura->setFecha_hora($_POST['fecha_hora']);
    
    $result = $lectura->registraLectura();    
    
    // Verificar si debe generarse un recordatorio
    if (debeGenerarRecordatorio($_POST['fecha_hora']) && !yaSeGeneroRecordatorioHoy()) {
        $mensaje = "Datos del día anterior listos";
        
        $recordatorio->setMensaje($mensaje);
        $recordatorio->setLeido(0);
        $recordatorio->setFecha_hora(date('Y-m-d H:i:s'));
        $recordatorio->registrarRecordatorio();
    }
}

// Opción 2: consultar nuevas lecturas
if ($_GET['opcion'] == 2) {
    $ultimoFechaHora = isset($_GET['ultimoFechaHora']) ? $_GET['ultimoFechaHora'] : '';
    $start = time();
    $timeout = 20;
    while (true) {
        if (hayNuevosDatos($ultimoFechaHora)) {
            $lectura = new cLectura();
            $result = $lectura->consultaLectura();
            break;
        }
        if (time() - $start > $timeout) {
            break;
        }
        usleep(500000);
    }
}

// Opción 3: obtener todas las lecturas
if ($_GET['opcion'] == 3) {
    $result = $lectura->obtenerLecturas();
}

echo json_encode($result);
?>
