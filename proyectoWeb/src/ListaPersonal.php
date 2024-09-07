<?php
session_start();
//require_once("class/login.class.php");
require_once("class/conexion.class.php");
//
//require_once("funciones.php");
//$login=new login();
//$login->inicia();
$base = new ConexionBD();
$base->conectar();
$result = $base->consulta("
SELECT
	libro.libro_id,
	libro.libro_nombre,
	libro.libro_autor,
	libro.libro_editorial,
	libro.libro_fecha,
	carrera.carrera_nombre,
	semestre.semestre_periodo,
	curso.curso_nombre
FROM
	biblioteca.libro,
	biblioteca.carrera,
	biblioteca.semestre,
	biblioteca.curso
WHERE
	libro.carrera_id = carrera.carrera_id AND
	libro.semestre_id = semestre.semestre_id AND
	libro.curso_id = curso.curso_id
ORDER BY
	libro.libro_nombre;");
$nrorow = pg_numrows($result);
//echo $nrorow; 
if (!$result) {
	echo "A ocurrido un error.\n";
	exit;
}
$arr = Array();
$msg = $result ? 'Registro agregado ' : 'Felicidades....';
if ($nrorow > 0){
while ($obj = pg_fetch_object($result)) {
    $arr[] = $obj;
}
($obj = pg_fetch_object($result));
echo '{"data":'.json_encode($arr).'}';
}else {
	  $false = 'hola';
	  $arr[]=$false;
      echo '{"data":'.json_encode($arr).'}';
}
$base->desconectar();
?>
