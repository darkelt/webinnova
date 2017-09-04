<?php

								$fileName = $_FILES["file1"]["name"]; // The file name
								$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
								$fileType = $_FILES["file1"]["type"]; // The type of file it is
								$fileSize = $_FILES["file1"]["size"]; // File size in bytes
								$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
								if (!$fileTmpLoc) { // if file not chosen
								    echo "ERROR: Debe de bucar un archivo antes de hacer click en el botón de subida.";
								    exit();
								}
								$buscar = 'pack';
								$pos  = strripos($fileName, $buscar);

								if($pos === false){
									$url= '../../images/curso';

								}else{
									$url= '../../images/pack';

								}
								if(move_uploaded_file($fileTmpLoc, "$url/$fileName")){
									echo "<br><p class='text-success'>El archivo ". $fileName. " ha sido subido con EXITO</p> <br>";
	
								   
								} else {
								    echo "<br><p class='bg-danger'>Ha ocurrido un error, trate de nuevo!</p> <br>";

echo "<a href='tarea.php'  class='btn btn-default'>Volver a Intentarlo </a>";
								}
								?>

			   