<?php
if (!isset($_GET['file'])) {
    die('No se especificó ningún archivo.');
}

$file = $_GET['file'];
$file_path = 'C:/wamp/www/proyectoWeb/archivosPDF/' . $file; // Cambia esto a la ruta correcta en tu servidor

if (!file_exists($file_path)) {
    die('El archivo no existe.');
}

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($file_path);
?>
