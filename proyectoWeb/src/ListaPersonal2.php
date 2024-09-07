<?php
session_start();
require_once("class/conexion.class.php");

$base = new ConexionBD();
$base->conectar();
$result = $base->consulta("
SELECT
	libro.libro_id,
	libro.libro_nombre,
	libro.libro_autor,	
	libro.archivospdf
FROM
	biblioteca.libro
ORDER BY
	libro.libro_nombre;");
$nrorow = pg_numrows($result);

if (!$result) {
	echo "Ha ocurrido un error.\n";
	exit;
}

$arr = Array();
if ($nrorow > 0){
    while ($obj = pg_fetch_object($result)) {
        // Proporciona la URL del script PHP que sirve los archivos PDF
        if ($obj->archivospdf) {
            $obj->archivospdf = 'serve_pdf.php?file=' . urlencode($obj->archivospdf);
        }
        $arr[] = $obj;
    }
    echo '{"data":'.json_encode($arr).'}';
} else {
    echo '{"data":[]}';
}
$base->desconectar();
?>
