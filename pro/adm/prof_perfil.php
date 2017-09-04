<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'P' OR $_SESSION['permiso'] == 'A'){
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
			
?>
									
									<h2>  <?php echo "$nom  $apellp  $apellm ";?>	</h2>
									<div class="row">
										<div class="6u 12u$(medium)">
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
														
													</ul>
											</blockquote>
										</div>
										<div class="6u 12u$(medium)">
										<h4>Datos Academicos</h4>
											<blockquote>
													<ul>
														<li><b>Grado Académico : </b><?php echo "$grado";?></li>
														<li><b>Centro de Estudios : </b><?php echo "$centro";?></li>
													</ul>
											</blockquote>
										</div>
										<div class="6u 12u$(medium)">
										<h4>Cursos Matriculados</h4>
											<blockquote>
													<ul>
														<?php 
														if ($stmt = $mysqli->prepare("SELECT `m`.`id_grupos`,`g`.`nom_grupo`
																						FROM `matricula` `m`, `grupos` `g`  
																						WHERE `m`.`id_grupos` = `g`.`id_grupo`
																						AND  `m`.`confirma_matricula` = 'M'
																						AND  `m`.`estado_matricula`= 'a'
																						AND `m`.`id_usuario`= ?;  ")) {		
																				$stmt->bind_param("i",$id_user);
																				$stmt->execute();
																				$stmt->bind_result($id_m, $nom_g);
																				while ($stmt->fetch()) {
																							echo "<li>$nom_g</li>";
																				}																			
														}
														
														?>
													</ul>
											</blockquote>
										</div>
									    	<a href="prof_matricula_grupo.php" class="btn btn-default">Atrás</a>
										</div>
									</div>
										
								</div>
							</div>

					</section>
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

 