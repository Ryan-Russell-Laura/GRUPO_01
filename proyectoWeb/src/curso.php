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

SELECT curso.curso_id , curso.curso_nombre
from biblioteca.curso 
ORDER BY 
curso.curso_id
");
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
	  $false = 'vacio';
	  $arr[]=$false;
      echo '{"data":'.json_encode($arr).'}';
}
$base->desconectar();
?>