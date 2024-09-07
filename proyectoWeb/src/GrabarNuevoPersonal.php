<?php
session_start();
require_once("class/conexion.class.php");

$base = new ConexionBD();
$base->conectar();

$libro_nombre     = json_decode($_POST['libro_nombre']);
$libro_autor = json_decode($_POST['libro_autor']);
$libro_editorial = json_decode($_POST['libro_editorial']);
$libro_fecha  = json_decode($_POST['libro_fecha']);
$carrera_id  = json_decode($_POST['carrera_id']);
$semestre_id  = json_decode($_POST['semestre_id']);
$curso_id  = json_decode($_POST['curso_id']);
//$perso_area_id = json_decode($_POST['perso_area_id']);

if($libro_nombre == '' or $libro_autor == '' or $libro_editorial =='' or $libro_fecha=='' or $carrera_id=='' or $semestre_id=='' or $curso_id==''){
    $false = 'vacio';
    $arr[] = $false;
    echo '{"data":'.json_encode($arr).'}';
    return;
}

    $resulttl = $base->consulta("INSERT INTO biblioteca.libro (libro_nombre,libro_autor,libro_editorial,libro_fecha,carrera_id,semestre_id,curso_id) VALUES ('$libro_nombre', '$libro_autor', '$libro_editorial', '$libro_fecha', '$carrera_id', '$semestre_id', '$curso_id')");
    if ($resulttl == TRUE){
        $false = 'nuevo';
        $arr[] = $false;
        echo '{"data":'.json_encode($arr).'}';
    } else {
        $false = 'error';
        $arr[] = $false;
        echo '{"data":'.json_encode($arr).'}';
    }
//}
?>

 


