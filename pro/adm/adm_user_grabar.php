<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
				<!-- Wrapper -->
			
									<?php
											
										  $xtipo = leerParam("tipo","");
										  $xcod  = leerParam("xcod","");
										  $apellp  = leerParam("apell_p","");
										  $apellm = leerParam("apell_m","");
										  $nom   = leerParam("username","");
										  $sex  = leerParam("sexo","");
										  $pais  = leerParam("country","");
										  $ciudad  = leerParam("state","");
										  $direc  = leerParam("direc","");
										  $dat  = leerParam("date","");
										  $tel1  = leerParam("telephone1","");
										  $opera = leerParam("opera","");
										  $pwd = leerParam("p","");
										  $grado = leerParam("grado","");
										  $institu = leerParam("institu","");
										  $email = leerParam("email","");
										  $permiso = leerParam("permiso","");
										  $gmail = leerParam("gmail","");
										   $dni = leerParam("dni","");

										  $xfecha = date("Y-m-d");
										  $apell_moodle = $apellp." ".$apellm;

									if ($xtipo == "INSERT"){
										$sql= "INSERT INTO `cursos`";  
									   	$stmt = $mysqli->prepare("
										 INSERT INTO `cursos`
													(`nom_cursos`,
													`nom_corto_cursos`,
													`id_clase_cursos`,
													`des_cursos`,
													`fecha_cursos`,
													`img_cursos`,
													`estado_cursos`)
										VALUES(?,?,?,?,?,?,?)");
										$stmt->bind_param("ssssssssss", $apellp, $apellm , $nom, $email, $direc, $dat, $tel1, $opera, $grado, $institu);
										$stmt->execute();
										 echo "<h3>Registro grabado correctamente...</h3>
									  
														<div>
															
																<a style='width: 200px;' href='adm_cursos_nuevo.php' class='btn btn-default'>Nuevo Curso</a>
																<a style='width: 200px;' href='adm_cursos.php' class='btn btn-default'>Terminar</a>
															
														</div>";
									} 
									if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `usuario`
													SET
													`apell_p_usuario` = '$apellp',
													`apell_m_usuario` = '$apellm',
													`nom_usuario` = '$nom',
													`email_usuario` = '$email',
													`naci_usuario` = '$dat',
													`tel1_usuario` = '$tel1',
													`tel1_opera_usuario` = '$opera',
													`direc_usuario` = '$direc',
													`permiso_usuario` = '$permiso',
													`gr_academ_usuario` = '$grado',
													`centr_estu_usuario` = '$institu',
													`gmail_usuario` = '$gmail',
													`apell_moodle` ='$apell_moodle',
													`dni_usuario` ='$dni'

													WHERE `id_usuario` = '$xcod';";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
																<a style='width: 200px;' href='adm_user.php' class='btn btn-default'>Terminar</a>
														</div>";
									}	
									$stmt->close();
									bitacora($mysqli, $sql);
									$mysqli->close();
									
									?>	
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
 
 
 