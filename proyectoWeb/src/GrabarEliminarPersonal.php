<?php
session_start();
//require_once("class/login.class.php");
require_once("class/conexion.class.php");
//require_once("json_service/json.php");

//require_once("funciones.php");
//$login=new login();
//$login->inicia();
$base = new ConexionBD();
$base->conectar();

$users = $_GET['datos'];
$arrUsuario = json_decode($users);
//$beneficiados_fecha = date('Y-m-d');
foreach($arrUsuario as $usuario){
    $datos=$usuario->libro_id;
}
$users1=$_GET['datos'];
$arrUsuario1=json_decode($users1);
foreach($arrUsuario1 as $usuario1){
    $libro_id=$usuario1->libro_id;
}

$result=$base->consulta("DELETE FROM biblioteca.libro WHERE libro_id='$libro_id'"); 
	if(!$result){
      echo "A ocurrido un error .\n";
      exit;
    }else{
		$false='elim';
		$arr[]=$false;
		echo '{"data":'.json_encode($arr).'}';
	}
$base->desconectar();
?>
