<?php include 'header_pro.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>						 
	<section id="wrapper">
						<?php include 'header_adm.php' ?>
				<!-- Wrapper -->
				<div class="wrapper">
					<div class="inner">
						<section>
							<h3 class="major">Nuevo Curso</h3>
							<form method="post" action="adm_cursos_grabar.php">
								<input type=hidden name=tipo value="INSERT">
													<div class="row uniform">
														<div class="6u 12u$(xsmall)">
															<label for="name">Nombre del Curso</label>
															<input title="requiere un nombre" type="text" name="xnom"  required/>
														</div>
														<div class="6u 12u$(xsmall)">
															<label for="name">Codigo Corto del Curso</label>
															<input type="text" name="xnomcor"   required/>
														</div>
														<div class="6u 12u$(xsmall)">
															<label for="demo-category">Clase de curso</label>
															<div class="select-wrapper">
																<select name="xclascur" id="demo-category"required>
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
																  ?>
																</select>
															</div>
														</div>
														<div class="6u 12u$(xsmall)">
															<label for="name">Nombre de la imagen</label>
															<input type="text" name="xnomimg" required/>
														</div>
														<div class="12u$">
															<label for="demo-message">Descripción del curso</label>
															<textarea name="xdescrip" id="demo-message" rows="6" required></textarea>
														</div>
														<div class="4u 12u$(small)">
															<input type="radio" id="demo-priority-low" name="xestado" checked >
															<label for="demo-priority-low" value="A">Activo</label>
														</div>
														<div class="4u 12u$(small)">
															<input type="radio" id="demo-priority-normal" name="xestado">
															<label for="demo-priority-normal"value="X">Inactivo</label>
														</div>
														<div class="12u$">
															<ul class="actions">
																<li><li><input type="submit" value="Grabar" class="special" /></li>
																</li>
																<li><input type="reset" value="Reset" /></li>
															</ul>
														</div>
													</div>
												</form>						
						</section>
					</div>
				</div>
	</section>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
	  <?php }
			else { ?>
		<section id="wrapper">
						<header>
							<div class="inner">
								<h3 class="error" > <span>No Tiene los permisos para acceder a esta página.</span> Please <a href="../login.php">login</a>.</h3>
								
							</div>
						</header>
		</section>
        <?php } 
			
			
			} else { ?>
		<section id="wrapper">
						<header>
							<div class="inner">
								<h3 class="error"> <span>No está autorizado para acceder a esta página.</span> Please <a href="../login.php">login</a>.</h3>
								
							</div>
						</header>
		</section>
        <?php } 
 include 'footer_adm.php';?>	