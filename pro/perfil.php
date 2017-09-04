 <?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					?>

		<!-- end:fh5co-header -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
			   	<li style="background-image: url(../images/perfil.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">Perfil de Usuario</h2>
			   					<p class="fh5co-lead">Desarrollando con <i class="icon-heart2"></i> la nueva enseñanza <a href="#" target="_blank">InnovaTrainingCenter</a></p>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-work-section">
			<div class="container">
				
<?php
			
		   $id_user = $_SESSION['user_id'];
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
														<a href="perfil_editar.php" class="btn btn-primary">Editar</a>
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
																						AND `m`.`id_usuario`= ?; ")) {		
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
										<div class="col-md-6">
											<h4>Cambiar Contraseña</h4>
											<a href="#" class="btn btn-default">cambiar</a>
										</div>
									</div>
										
		</div>
	</div>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
	<?php }
			else { 
				header('Location: ../login.php?error=2');
			} 
	} else { 

		header('Location: ../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 