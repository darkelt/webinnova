<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php';

					$id = $_REQUEST['id'];

					$titulo = $_REQUEST['titulo'];
				    $descripcion = $_REQUEST['descripcion'];

					$sql = "UPDATE `promocion`
						SET
						`titulo` = '$titulo' ,
						`descripcion` = '$descripcion'";

					$documentoUrl = '';
					if($_FILES["DocumentoDigital"]["error"] == 4) {
				        //means there is no file uploaded
				    } else {
				        $path = $_FILES['DocumentoDigital']['name'];
				        $ext = pathinfo($path, PATHINFO_EXTENSION);
				        $documentPath = 'documentos/'.$_REQUEST['id'].'.'.$ext;
				        $documentoUrl = $documentPath;
				        $sql.=", premio = '$documentoUrl'";
				        if (!move_uploaded_file($_FILES['DocumentoDigital']['tmp_name'], '../../'.$documentPath))
						{
							die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
						}
				    }

				    $imageUrl = '';

				    if($_FILES["Foto"]["error"] == 4) {
				        //means there is no file uploaded
				    }
				    else{
				        $path = $_FILES['Foto']['name'];
				        $ext = pathinfo($path, PATHINFO_EXTENSION);
				        $imagePath = 'images/promocion_'.$_REQUEST['id'].'.'.$ext;
				        $imageUrl = $imagePath;
				        $sql.=", portada = '$imageUrl'";
				        if (!move_uploaded_file($_FILES['Foto']['tmp_name'], '../../'.$imagePath))
						{
							die("Error al subir la imagen al servidor, puede que no tenga permisos para escribir en el directorio.");
						}
				    }
				    
				    $sql.=" WHERE id = $id";
								
					$stmt = $mysqli->prepare($sql);

					// execute the query
					$stmt->execute();

					echo " Registro Actualizado correctamente...
			  
							<div>
									<!--<a style='width: 200px;' href='adm_cursos.php' class='btn btn-default'>Terminar</a>-->
								
							</div>";
							
							 
				    $stmt->close();
					bitacora($mysqli, $sql);
					$mysqli->close();
				
				?>	

	</div>
</div>			
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
