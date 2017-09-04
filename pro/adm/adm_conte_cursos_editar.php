<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?>  
<?php

 $xcod = leerParam("xcod","");
 
 if ($stmt = $mysqli->prepare("SELECT `contenido_cursos`.`id_contenido_cursos`,
										`contenido_cursos`.`primer_contenido_cursos`
							FROM `u292000437_bdi`.`contenido_cursos`
							WHERE `id_contenido_cursos` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($e_cod ,$e_des);
            $stmt->fetch();    
   }
?>
				
						<h2>Editar Tema</h2>
 						<form name="formulario" method="post" action="adm_conte_cursos_grabar.php" onsubmit="return revisar()">
						 	<input type="hidden" name="tipo" value="UPDATE">
							<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">ID</label>
									<input class="form-control" type="text" name="xnom" value="<?php echo $e_cod; ?>" readonly="yes">
							    </div>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Tema del curso</label>
									<input class="form-control" type="text" name="xdeta" value="<?php echo $e_des; ?>"  required/>
							    </div>
						    </div>
						    <div class="col-md-12">
							    <button type="submit" class="btn btn-default">Grabar</button>
						    </div>
						  </div>
						 </form>
							
	</div>
</div>			
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 