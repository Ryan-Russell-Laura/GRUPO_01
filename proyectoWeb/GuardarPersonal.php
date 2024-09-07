<?php 
	session_start();
	//require_once("class/login.class.php");
	require_once("src/class/conexion.class.php");
	//require_once("funciones.php");
	date_default_timezone_set('America/Lima');
	require_once("UploadFile.php");
	$base = new ConexionBD();
	$base->conectar();

    $path = "archivosPDF";
	
	$libro_nombre = $_POST['libro_nombre'];
	$libro_autor = $_POST['libro_autor'];
	$libro_editorial = $_POST['libro_editorial'];
	$libro_fecha  = $_POST['libro_fecha'];
	$carrera_id  = $_POST['carrera_id'];
	$semestre_id  = $_POST['semestre_id'];
	$curso_id  = $_POST['curso_id'];
	$filename = $_FILES["FileInput"]["name"];
	$file = $_FILES["FileInput"]["name"];
	$tamano = $_FILES["FileInput"]["size"];
	if($filename != ''){
	   $type = explode('.',$filename);
	   $random_pass = substr(md5(rand()),0,4);
	   $filename = "pdf-".$random_pass.'.'.$type[1];
     } else{
	    $filename = "";
	    $false = 'vacio';
	    $arr[]=$false;
        echo '{"data":'.json_encode($arr).'}';
	    return;
    }
 
	if($libro_nombre == '' or $libro_autor == '' or $libro_editorial =='' or $libro_fecha=='' or $carrera_id=='' or $semestre_id=='' or $curso_id==''){
		$false = 'vacio';
		$arr[] = $false;
		echo '{"data":'.json_encode($arr).'}';
		return;
	}
	if($file != ""){
	    $ext = strtolower(substr(strrchr($file, '.'), 1));
       if($ext == 'pdf')  {
            $base = new ConexionBD();
	        $base->conectar(); 
			           	 
			  $result = $base->consulta("INSERT INTO biblioteca.libro (libro_nombre,libro_autor,libro_editorial,libro_fecha,carrera_id,semestre_id,curso_id,archivospdf) VALUES ('$libro_nombre', '$libro_autor', '$libro_editorial', '$libro_fecha', '$carrera_id', '$semestre_id', '$curso_id', '$filename')");

 	        if (!$result){
        	  	$false = 'false';
        	    $arr[]=$false;
                echo '{"failure":'.json_encode($arr).'}';
	         }else{
	              $bo = new UploadFile();
        		  $bo->archivo = $filename;
        		  $bo->UpLoadPDF($filename,"archivosPDF/");	
        	      $true = 'success';
        	      $arr[]=$true;
                  echo '{"success":'.json_encode($arr).'}';
             }
	   }
	}
	$base->desconectar();
?>