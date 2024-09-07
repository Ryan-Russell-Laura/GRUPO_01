<?php
session_start();
//require_once("class/login.class.php");
require_once("class/conexion.class.php");
//$login = new login();
//$login ->incia();
$libro_id = json_decode($_POST['libro_id']); 
$libro_nombre = json_decode($_POST['libro_nombre']);
$libro_autor = json_decode($_POST['libro_autor']);
$libro_editorial = json_decode($_POST['libro_editorial']);
$libro_fecha  = json_decode($_POST['libro_fecha']);
$carrera_id  = json_decode($_POST['carrera_id']);
$semestre_id  = json_decode($_POST['semestre_id']);
$curso_id  = json_decode($_POST['curso_id']);

if($libro_nombre == '' or $libro_autor == '' or $libro_editorial =='' or $libro_fecha=='' or $carrera_id=='' or $semestre_id=='' or $curso_id==''){
    $false = 'vacio';
    $arr[] = $false;
    echo '{"data":'.json_encode($arr).'}';
}else{

    $base = new ConexionBD();
    $base->conectar();

    $result = $base->consulta("
        UPDATE biblioteca.libro 
        SET 
            libro_nombre = '$libro_nombre',
            libro_autor  = '$libro_autor',
            libro_editorial = '$libro_editorial',
            libro_fecha = '$libro_fecha',
            carrera_id = '$carrera_id',  
            semestre_id = '$semestre_id',
            curso_id = '$curso_id'
        WHERE
            libro_id = '$libro_id'
    ");
    if($result == TRUE)
    {
        $false = 'actua';
        $arr[] = $false;
        echo '{"data":'.json_encode($arr).'}';
    }
    $base->desconectar ();

}
?>




