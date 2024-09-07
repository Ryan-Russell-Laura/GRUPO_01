<?php
class ConexionBD 
{
	private $con;//Variable que almacena la cadena de conexion
	private $des;
	public function conectar() 
	{
		//$base = new PDO("pgsql:host=localhost password=olvido user=postgres dbname=asistencia")
		$this->con = pg_connect("host=localhost password=123456789 user=postgres dbname=bibliotecaWeb")//abro la conexion
		or die("Error al conectarse con la base de datos");//mensaje a mostrar en caso de error
		//$this -> $base;
		return $this->con;
	}
	public function desconectar()
	{
		$this->des=pg_close();
		return $this->des;	
	}
	public function consulta($sentenciaSql) {
		$query = pg_query($this->conectar(), $sentenciaSql);//ejecuto la consulta
		return $query;
	}
}
?>
