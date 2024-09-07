<?php
//require_once("funciones.php");
if (isset($_GET['msmError'])) {
   mostrarMensaje("div","usuario y/o password invalido.","mensajeError"); 
}
class login {
    // Inicia sesion
    public function inicia($tiempo=3600, $usuario=NULL, $clave=NULL) {	
	   if ($usuario==NULL && $clave==NULL) {
		  // Verifica sesion
		  if (isset($_SESSION['idusuario'])) {
		     //echo "Estas logeado";
		  } else {
			   // Verifica cookie
			   if (isset($_COOKIE['idusuario'])) {
				   // Restaura sesion
				   $_SESSION['idusuario']=$_COOKIE['idusuario'];
				   $_SESSION['nombreusuario']=$_COOKIE['nombreusuario'];
				   $_SESSION['codigousuario']=$_COOKIE['codigousuario'];
				   $_SESSION['cargousuario']=$_COOKIE['cargousuario'];
			   } else {
				  // Si no hay sesion regresa al login
				  //header( "Location: index.php" );
				  echo 'error';
				  header( "Location: login.php" );
			   }
		    }
	     } else {
		   $this->verifica_usuario($tiempo, $usuario, $clave);
	     }
    }
// Cierra sesion
public function cierra(){
		$_SESSION = array(); 
        session_destroy(); // destruyo la sesión 
		setcookie("idusuario","",0); 
		setcookie("nombreusuario","",0);
		setcookie("codigousuario","",0);
		setcookie("cargousuario","",0);
		header("Location: login.php");
}

private function verifica_usuario($tiempo, $usuario, $clave) {
	require_once('conexion.class.php');
	$base = new ConexionBD();//creamos un objeto con la clase
	$base->conectar();
	$clave_convert=md5($clave);
	$result = $base->consulta("SELECT 
    v001.codi, 
    v001.logn, 
    v001.psw1, 
    v001.pate, 
    v001.mate, 
    v001.nomb 
    FROM 
    public.v001
    WHERE 
    V001.logn='$usuario' AND V001.psw1='$clave_convert' AND 
    V001.situ=TRUE");
	$base->desconectar();
	$row = pg_fetch_row($result);
	if ($usuario==$row[1] && $clave_convert==$row[2]) {
		// Si la clave es correcta
		$idusuario=$this->codificar_usuario($usuario);
		$nombreusuario=$row[3]." ".$row[4]." ".$row[5];
		$codigousuario=$row[0];
		$cargousuario=$row['6'];
		setcookie("idusuario", $idusuario, time()+$tiempo);
		$_SESSION['idusuario']=$idusuario;
		setcookie("codigousuario", $codigousuario, time()+$tiempo);
		$_SESSION['codigousuario']=$codigousuario;
		setcookie("nombreusuario", $nombreusuario, time()+$tiempo);
		$_SESSION['nombreusuario']=$nombreusuario;
		setcookie("cargousuario", $cargousuario, time()+$tiempo);
		$_SESSION['cargousuario']=$cargousuario;
		header( "Location: controladores/asistencia_covid.php" );
		
	} else {
		$true = 'Error';
        $arr[]=$true;
        echo '{"data":'.json_encode($arr).'}';
		// Si la clave es incorrecta
		//header( "Location: login.php?error=1" );
		//header( "Location: asistencia_covid_error.php" );
	}
}
// Codifica idusuario 
private function codificar_usuario($usuario) {
	return md5($usuario);
}
}
?>
