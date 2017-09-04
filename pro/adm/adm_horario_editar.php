<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!-------------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

<?php
 $xcod = leerParam("xcod","");
 
 if ($stmt = $mysqli->prepare("SELECT  `horario`.`nom_horario`, `horario`.`desscripcion`
								FROM `u292000437_bdi`.`horario`
							WHERE `horario`.`id_horario` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($e_nom,$e_des);
            $stmt->fetch();    
			$stmt->close();
		}
		$mysqli->close();




?>


										<h3>Editar Horario</h3>
										<form name="formulario" method="post" action="adm_horario_grabar.php">
											<input type="hidden" name="tipo" value="UPDATE">
											<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
											<div class="row">
											    <div class="col-md-6">
												    <div class="form-group">
												    	<label for="name">Nombre del horario</label>
														<input class="form-control" type="text" name="xnom" value="<?php echo $e_nom; ?>" required/>
												    </div>
												</div>
												<div class="col-md-12">
												    <div class="form-group">
												    	<label for="demo-message">Descripción de la Clase</label>
														<textarea class="form-control" name="xdescrip" id="demo-message" rows="6" required><?php echo $e_des; ?></textarea>
												    </div>
											    </div>
											    <div class="col-md-6">
												    <div class="form-group">
												    	<label class="radio-inline" for="demo-priority-low">
												    	<input type="radio" id="demo-priority-low" name="xestado" value="A" checked >Activo</label>
														<label class="radio-inline" for="demo-priority-normal" >
														<input type="radio" id="demo-priority-normal" name="xestado" value="X" >Inactivo</label>
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
 
 
 