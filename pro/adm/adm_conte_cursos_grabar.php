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
										  $xcodc  = leerParam("xcodc","");
										  $xnomc  = leerParam("xnomc","");
										  $xdeta  = leerParam("xdeta","");						  
									if ($xtipo == "INSERT"){
										$sql= "INSERT `contenido_cursos`"; 
									   $stmt = $mysqli->prepare("INSERT `contenido_cursos`
													(`id_cursos`,
													`primer_contenido_cursos`)
										VALUES(?,?)");
										$stmt->bind_param("is", $xcodc, $xdeta);
										$stmt->execute();
										 echo "<h3>Registro grabado correctamente...</h3>
									  
														<div>
															
																<a style='width: 200px;' href='adm_conte_cursos_nuevo.php?xcodc=$xcodc&xnomc=$xnomc' class='btn btn-default'>Nuevo tema</a>
																<a style='width: 200px;' href='adm_cursos.php' class='btn btn-default'>Terminar</a>
															
														</div>";
									 } 
									 if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `contenido_cursos`
												SET
												`primer_contenido_cursos` = '$xdeta'
												WHERE `id_contenido_cursos` = '$xcod' ";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
																<a style='width: 200px;' href='adm_cursos.php' class='btn btn-default'>Terminar</a>
															
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
 
 
 