<?php
require_once("src/class/conexion.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $libro_nombre = $_GET['libro_nombre'];

    $sql = "SELECT * FROM biblioteca.libro WHERE libro_nombre LIKE '$libro_nombre'";
    $result = $conexion->query($sql);

    $libros = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $libros[] = $row;
        }
    }

    echo json_encode($libros);
    $conexion->close();
}
?>
