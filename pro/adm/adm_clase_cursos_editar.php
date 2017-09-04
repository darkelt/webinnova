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
 
 if ($stmt = $mysqli->prepare("
			SELECT 	`clase_cursos`.`nom_clase_cursos`,
					`clase_cursos`.`nom_corto_clase_cursos`,
					`clase_cursos`.`des_clase_cursos`,
					`clase_cursos`.`img_clase_cursos`
			FROM `u292000437_bdi`.`clase_cursos`
			WHERE `id_clase_cursos` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($e_nom , $e_nomcort,$e_des, $e_img);
            $stmt->fetch();    
			$stmt->close();
		}
		$mysqli->close();




?>
				  <h2>Editar Clase de Curso</h2>
				  
				  <form name="formulario" method="post" action="adm_clase_cursos_grabar.php">
				  	<input type="hidden" name="tipo" value="UPDATE">
					<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
				  <div class="row">
				    <div class="col-md-6">
					    <div class="form-group">
					    	<label for="name">Nombre de la Clase</label>
							<input  class="form-control" type="text" name="xnom" value="<?php echo $e_nom; ?>" required/>
					    </div>
					</div>
					<div class="col-md-6">
					    <div class="form-group">
					    	<label for="name">Codigo Corto de la Clase</label>
							<input  class="form-control" type="text" name="xnomcor" value="<?php echo $e_nomcort; ?>"  required/>
					    </div>
				    </div>
				    <div class="col-md-6">
					    <div class="form-group">
					    	<label for="name">Nombre de la imagen</label>
							<input   class="form-control" type="text" name="xnomimg" value="<?php echo $e_img; ?>" required/>
					    </div>
				    </div>
				    <div class="col-md-12">
					    <div class="form-group">
					    	<label for="demo-message">Descripción de la Clase</label>
							<textarea class="form-control" name="xdescrip" id="demo-message" rows="6" required><?php echo $e_des; ?></textarea>
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
 
 
 