<?php include 'header_pro.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					?>
	<!-- Wrapper -->
					<!-- Wrapper -->
					<section id="wrapper">
							<header>
								<div class="inner">
									<h2>Perfil</h2>
									<p>Solidez en el saber, Destreza en el hacer e Integridad en el ser.</p>
								</div>
							</header>

						<!-- Content -->
							<div class="wrapper">
								<div class="inner">
<?php
			
		   $id_user = $_SESSION['user_id'];
			if ($stmt = $mysqli->prepare("SELECT * FROM `u292000437_bdi`.`usuario` WHERE `id_usuario` = ? LIMIT 1;")){
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
														<li><b>Fecha de Naciemiento : </b><?php echo "$naci";?></li>
														<li><b>Sexo : </b><?php if ($sex=='m'){echo "Masculino";} else if ($sex=='f'){echo "Femenino";} else {echo"otros";}?></li>
														<li><b>Teléfono : </b><?php echo "$tel1";?></li>
														<li><b>Dirección : </b><?php echo "$direc";?></li>
														<li><b>País : </b><?php echo "$pais";?></li>
														<li><b>Ciudad : </b><?php echo "$ciudad";?></li>
														<a href="perfil_editar.php" class="button special small">Editar</a>
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
										<div class="6u 12u$(medium)">
											<h4>Cambiar Contraseña</h4>
											<a href="perfil_pass.php" class="button small">cambiar</a>
										</div>
									</div>
										
								</div>
							</div>

					</section>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
	  <?php $stmt->close();

			$mysqli->close();}
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
 include 'footer_pro.php';?>	