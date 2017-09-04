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
 
 if ($stmt = $mysqli->prepare("SELECT 
							`cursos`.`nom_cursos`,
							`cursos`.`nom_corto_cursos`,
							`cursos`.`des_cursos`,
							`cursos`.`img_cursos`,
							`cursos`.`id_clase_cursos`
							FROM `u292000437_bdi`.`cursos`
							WHERE `id_cursos` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($e_nom , $e_nomcort,$e_des, $e_img,$e_id_cla);
            $stmt->fetch();    
        }
?>
										<h2>Editar Curso</h2>
										<form name="formulario" method="post" action="adm_cursos_grabar.php" onsubmit="return revisar()">
											 	<input type="hidden" name="tipo" value="UPDATE">
												<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
											    <div class="col-md-6">
												    <div class="form-group">
												    	<label for="name">Nombre del Curso</label>
														<input class="form-control" type="text" name="xnom" value="<?php echo $e_nom; ?>" required/>
												    </div>
												</div>
												<div class="col-md-6">
												    <div class="form-group">
												    	<label for="name">Codigo Corto del Curso</label>
														<input class="form-control" type="text" name="xnomcor" value="<?php echo $e_nomcort; ?>"  required/>
												    </div>
											    </div>
											    <div class="col-md-6">
												    <div class="form-group">
												    	<label for="demo-category">Clase de curso</label>
														<select  class="form-control" name="xclascur" id="demo-category" required>
															
															<?php
																if ($stmt = $mysqli->prepare("
																		SELECT `clase_cursos`.`id_clase_cursos`,
																			`clase_cursos`.`nom_corto_clase_cursos`
																		FROM `u292000437_bdi`.`clase_cursos` ORDER BY `id_clase_cursos` = ? DESC")) {
																		$stmt->bind_param('i', $e_id_cla);	
																		$stmt->execute();
																		/* vincular variables a la sentencia preparada */
																		$stmt->bind_result($id,$nom);
																		/* obtener valores */
																	while ($stmt->fetch()) {
																		echo "<option value=$id>$nom</option>";
																	}

																	/* cerrar la sentencia */
																	$stmt->close();
																}
																$mysqli->close();
														  ?>
														</select>
												    </div>
											    </div>
											    <div class="col-md-6">
												    <div class="form-group">
												    	<label for="name">Nombre de la imagen</label>
														<input class="form-control" type="text" name="xnomimg" value="<?php echo $e_img; ?>" required/>
												    </div>
											    </div>
											    <div class="col-md-12">
												    <div class="form-group">
												    	<label for="message">Descripción del curso</label>
														<textarea class="form-control" name="xdescrip" id="message" rows="6" required><?php echo $e_des; ?></textarea>
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
 
 
 