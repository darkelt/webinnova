<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

						<h3>Nuevo Curso</h3>
						<form method="post" action="adm_cursos_grabar.php">
						  <input type=hidden name=tipo value="INSERT">
						  <div class="row">
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Nombre del Curso</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xnom"  required/>
							    </div>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Codigo Corto del Curso</label>
									<input class="form-control" type="text" name="xnomcor"   required/>
							    </div>
						    </div>
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="demo-category">Clase de curso</label>
									<select class="form-control" name="xclascur" id="demo-category"required>
										<option value="">Elija uno</option>
										<?php
											if ($stmt = $mysqli->prepare("
													SELECT `clase_cursos`.`id_clase_cursos`,
														`clase_cursos`.`nom_corto_clase_cursos`
													FROM `u292000437_bdi`.`clase_cursos`")) {
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
									<input class="form-control" type="text" name="xnomimg" required/>
							    </div>
						    </div>
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="demo-message">Descripción del curso</label>
									<textarea class="form-control" name="xdescrip" id="demo-message" rows="6" required></textarea>
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
 