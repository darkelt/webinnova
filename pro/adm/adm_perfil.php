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
			
		   $id_user = leerParam("xcodid","");
			if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
												`usuario`.`apell_p_usuario`,
												`usuario`.`apell_m_usuario`,
												`usuario`.`nom_usuario`,
												`usuario`.`email_usuario`,
												`usuario`.`naci_usuario`,
												`usuario`.`sexo_usuario`,
												`usuario`.`tel1_usuario`,
												`usuario`.`tel1_opera_usuario`,
												`usuario`.`direc_usuario`,
												`usuario`.`pais_usuario`,
												`usuario`.`ciudad_usuario`,
												`usuario`.`permiso_usuario`,
												`usuario`.`gr_academ_usuario`,
												`usuario`.`centr_estu_usuario`,
												`usuario`.`gmail_usuario`,
												`usuario`.`dni_usuario`
											FROM `u292000437_bdi`.`usuario` WHERE `id_usuario` = ? LIMIT 1;")){
						$stmt->bind_param('i', $id_user);
						$stmt->execute();   // Ejecuta la consulta preparada.
						$stmt->store_result();
						// Si el usuario existe, obtiene las variables del resultado.
						$stmt->bind_result($id, $apellp, $apellm, $nom, $email,$naci, $sex, $tel1, $opera, $direc, $pais , $ciudad, $permiso, $grado, $centro ,$gmail, $dni);
						$stmt->fetch();    
			}			
			/* cerrar la sentencia */
			$apellp = strtoupper($apellp);
			$letra =substr($apellp,0,1);
			$temp = strlen($apellp);
			$temp = $id*$temp;
			$temp = $letra.$temp;
			$passw = substr($temp, 0,5);	
?>
									
									<h2>  <?php echo "$nom  $apellp  $apellm ";?>	</h2>
									<div class="row">
										<div class="col-md-6">
										<h4>Datos Generales</h4>
											<blockquote>
													<ul>
														<li><b>Código : </b><?php echo "$id";?></li>
														<li><b>Documento de identidad (DNI) : </b><?php echo "$dni";?></li>
														<li><b>Email  : </b><?php echo "$email";?></li>
														<li><b>Fecha de Nacimiento : </b><?php echo "$naci";?></li>
														<li><b>Sexo : </b><?php if ($sex=='m'){echo "Masculino";} else if ($sex=='f'){echo "Femenino";} else {echo"otros";}?></li>
														<li><b>Teléfono : </b><?php echo "$tel1 $opera";?></li>
														<li><b>Dirección : </b><?php echo "$direc";?></li>
														<li><b>País : </b><?php echo "$pais";?></li>
														<li><b>Ciudad : </b><?php echo "$ciudad";?></li>
														<li><b>Password por defecto : </b><?php echo "$passw";?></li>
														
													</ul>
											</blockquote>
										</div>
										<div class="col-md-6">
										<h4>Datos Academicos</h4>
											<blockquote>
													<ul>
														<li><b>Grado Académico : </b><?php echo "$grado";?></li>
														<li><b>Centro de Estudios : </b><?php echo "$centro";?></li>
													</ul>
											</blockquote>
										</div>
										<div class="col-md-6">
										<h4>Cursos Matriculados</h4>
											<blockquote>
													<ul>
														<?php 
														if ($stmt = $mysqli->prepare("SELECT `m`.`id_grupos`,`g`.`nom_grupo`
																						FROM `matricula` `m`, `grupos` `g`  
																						WHERE `m`.`id_grupos` = `g`.`id_grupo`
																						AND  `m`.`confirma_matricula` = 'M'
																						AND  `m`.`estado_matricula`= 'a'
																						AND `m`.`id_usuario`= ? ;  ")) {		
																				$stmt->bind_param("i",$id_user);
																				$stmt->execute();
																				$stmt->bind_result($id_m, $nom_g);
																				while ($stmt->fetch()) {
																							echo "<li>$id_m - $nom_g</li>";
																				}																			
														}
														
														?>
													</ul>
											</blockquote>
										</div>				
									</div>
									<div class="row">
										<div class="col-md-6">
											<form method="post" action="adm_user_matricula.php">
												<input class="form-control" type="hidden" name="xid_user" value="<?php echo $id;?>">
															<label for="demo-category">MATRICULA GRUPO</label>
															<select class="form-control" name="xcod" id="demo-category" required>
																<option value="">Elija uno</option>
																<?php
																if ($stmt = $mysqli->prepare("SELECT `grupos`.`id_grupo`,
																									`grupos`.`nom_grupo`,
																							    `grupos`.`localidad`,
																							    `grupos`.`modalidad_grupo`
																								FROM `u292000437_bdi`.`grupos`  
																								WHERE `grupos`.`estado_grupo`= 'A'
																								OR `grupos`.`estado_grupo`= 'F'  
																								ORDER BY `localidad`,`id_grupo` ;")) {
																		$stmt->execute();
																		/* vincular variables a la sentencia preparada */
																		$stmt->bind_result($id_g,$nom_g, $localidad, $moda);
																		/* obtener valores */
																	while ($stmt->fetch()) {
																		echo "<option value=$id_g>$id_g - $nom_g  - $localidad /$moda</option>";
																	}
																	/* cerrar la sentencia */
																	
																}
																$stmt->close();
														  ?>
														</select>
														<button type="submit" class="btn btn-default">Matricular GRUPO</button>
											</form>
										</div>
										<div class="col-md-6">
											<form method="post" action="adm_user_matricula_pack_v.php">
												<input class="form-control" type="hidden" name="user" value="<?php echo $id;?>">
															<label for="demo-category">MATRICULA PACK VIRTUAL</label>
															<select class="form-control" name="xcod" id="demo-category" required>
																<option value="">Elija uno</option>
																<?php
																if ($stmt = $mysqli->prepare("SELECT `pack`.`id_pack`,
																									    `pack`.`nom_pack`
																									FROM `u292000437_bdi`.`pack` 
																									WHERE `modalidad` = 'V'
																									AND `estado`='A';")) {
																	$stmt->execute();
																		/* vincular variables a la sentencia preparada */
																		$stmt->bind_result($id_pack ,$nom_pack);
																		/* obtener valores */
																	while ($stmt->fetch()) {
																		echo "<option value=$id_pack>$nom_pack</option>";
																	}
																	/* cerrar la sentencia */
																	
																}
																$stmt->close();
														  ?>
														</select>
														<button type="submit" class="btn btn-default">Matricular PACK VIRTUAL</button>
											</form>
										</div>
										<br>
										<div class="col-md-6">
											<form method="post" action="adm_user_matricula_pack_p.php">
												<input class="form-control" type="hidden" name="user" value="<?php echo $id;?>">
															<label for="demo-category">MATRICULA PACK PRESENCIAL</label>
															<select class="form-control" name="xcod" id="demo-category" required>
																<option value="">Elija uno</option>
																<?php
																if ($stmt = $mysqli->prepare("SELECT `pack`.`id_pack`,
																							    `pack`.`nom_pack`
																							FROM `u292000437_bdi`.`pack` WHERE `modalidad` = 'P' AND `estado`='A';
																							")) {
																		$stmt->execute();
																		/* vincular variables a la sentencia preparada */
																		$stmt->bind_result($id_pack,$nom_pack);
																		/* obtener valores */
																		$i = 0;	
																	while ($stmt->fetch()) {
																		$array_id_pack[$i] = $id_pack ; 
																		$array_nom_pack[$i] = $nom_pack; 

																		$i++;
																		
																	}
																}
																$cont = count($array_id_pack);
																	for($i = 0 ; $i < $cont; $i++ ){
																			echo "<option value=$array_id_pack[$i]>$array_id_pack[$i] - $array_nom_pack[$i] - ";
																			if ($stmt = $mysqli->prepare("SELECT
																									`grupos`.`nom_grupo`,
																									`grupos`.`localidad`,
																									`detalle_pack`.`id_grupo`,
																									`grupos`.`modalidad_grupo`,
																									`grupos`.`precio_curso_grupo`
																								FROM `detalle_pack`, `pack`, `grupos` 
																								WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
																								AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo` 
																								AND `pack`.`id_pack`= ?;")) {
																				$stmt->bind_param('i', $array_id_pack[$i]);
																				$stmt->execute();
																				/* vincular variables a la sentencia preparada */
																				$stmt->bind_result($xnom_g,$xloca, $id_g, $moda, $precio_curso_grupo);
																				/* obtener valores */
																				while ($stmt->fetch()) {
																				}

																				echo"$xloca </option>";
																			/* cerrar la sentencia */
																			$stmt->close();
																		}
																	}



																$stmt->close();
														  ?>
														</select>
														<button type="submit" class="btn btn-default">MATRICULA PACK PRESENCIAL</button>
											</form>
										</div>

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

 