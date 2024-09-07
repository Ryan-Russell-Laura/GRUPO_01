<?php
/*UP_LOAD_FILE_', 'SubirArchivo.php');*/
	class UpLoadFile{
		var $directorio;
		public $archivo;    
		var $nuevo_archivo;
		var $is_upload;
		var $mensaje;
	    var $archivosPDF;
		function SubirArchivo($directorio){ 
			$this->directorio = $directorio; 
		}
	    function RenombrarArchivo($nuevo_archivo){ 
	        $this->nuevo_archivo = $nuevo_archivo; 
	    }
		function Subir($files){ 
			if(!file_exists($this->directorio)){
				die('<script>parent.resultado_subir(4);</script>');
			}else{
				$this->archivo = ($this->nuevo_archivo) ? $this->nuevo_archivo : $files['name'];
				if(trim($files['name']) == ''){//elimina los espacios en blanco
					die('<script>parent.resultado_subir(5);</script>');
				}
				if(is_uploaded_file($files['tmp_name'])){
					move_uploaded_file($files['tmp_name'],$this->directorio.'/'.$this->archivo) or die(' Directorio sin permisos...! '); 
				}else{
					die('<script>parent.resultado_subir(3);</script>');
				}
			}
		}				
	public function UpLoadPDF($file, $path){
		if($this->archivo == NULL) $this->archivo = $_FILES[$file]['name'];
		//if($this->tamano_real == NULL) $this->tamano_real = $_FILES[$file]['size'];
		$file = $this->archivo;
		$this->mensaje = '';
		$extension = strtolower(substr(strrchr($this->archivo, '.'), 1));
		$tamano_real = $_FILES['FileInput']['size'];
		$tamno_fijo = 80971520;	
		if($extension == 'pdf')  {
				if ($_FILES['FileInput']['error'] > 0){
				    //echo $tamno_fijo = 80971520;
					return 0;
					$this->mensaje = 'Error inesperado.';
					$this->is_upload = false;
				} else {
					if($tamano_real < $tamno_fijo){
					    //echo $tamno_fijo = 80971520;
						if (file_exists($path . $this->archivo)){
							//return -1;
							$this->mensaje = 'El archivo ya existe.';
							$this->is_upload = false;
						}else {
							if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $path . $this->archivo)){	
								//return true;
								//$this->mensaje = 'archivo subido con exito';
								$this->is_upload = true;
								//echo "archivo subido con exito";
							}else{
								$this->mensaje = 'Error al subir el archivo';
								$this->is_upload = false;
								//echo "error al copiar el archivo";
							}
						}
						
					}else{
						$this->mensaje = 'Este archivo supera el m\xe1ximo tama\xf1o permitido de '.$tamfijo_msg.'. Ud. Intent\xf3 subir un archivo de '.$tamreal_msg;
						$this->is_upload = false;
						//echo "el archivo supera los 60kb";		
					}
					
				}
		 } else {
			//return -2;
			$this->mensaje = 'El formato de archivo no es v\xe1lido, solo *.pdf';
			$this->is_upload = false;
			echo "el formato de archivo no es valido, solo $extension";
		}			
		}		
		public function UpLoad($file, $path){
			if($this->archivo == NULL)
				$this->archivo = $_FILES[$file]['name'];
				if ($_FILES[$file]['error'] > 0){
					return 0;
				} else {
					if (file_exists($path . $this->archivo)) {
					  return -1;
					} else {
					  	move_uploaded_file($_FILES[$file]['tmp_name'], $path . $this->archivo);
						
						return true;
					}
				}
			}
	
		function BorrarArchivo(){
			unlink($this->directorio . '/' . $this->archivo);
		}	
	}
?>