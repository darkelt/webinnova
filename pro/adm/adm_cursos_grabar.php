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
										  $xtipo = leerParam("tipo","");
										  $xcod  = leerParam("xcod","");
										  $xnom  = leerParam("xnom","");
										  $xnomcor  = leerParam("xnomcor","");
										  $xclascur  = leerParam("xclascur","");
										  $xnomimg  = leerParam("xnomimg","");
										  $xdescrip = leerParam("xdescrip","");
										  $xestado = leerParam("xestado","");

										  $xfecha = date("Y-m-d");
										  
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
										$stmt->bind_param("ssissss", $xnom, $xnomcor, $xclascur, $xdescrip, $xfecha, $xnomimg,$xestado);
										$stmt->execute();
										 echo "<h3>Registro grabado correctamente...</h3>
									  
														<div>
															
																<a style='width: 200px;' href='adm_cursos_nuevo.php' class='btn btn-default'>Nuevo Curso</a>
																<a style='width: 200px;' href='adm_cursos.php' class='btn btn-default'>Terminar</a>
															
														</div>";
									} 
									if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `cursos`
												SET
												`nom_cursos` = '$xnom' ,
												`nom_corto_cursos` = '$xnomcor',
												`id_clase_cursos` =  '$xclascur',
												`des_cursos` = '$xdescrip',
												`fecha_cursos` = '$xfecha',
												`img_cursos` = '$xnomimg',
												`estado_cursos` = '$xestado'
												WHERE `id_cursos` = '$xcod' ";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
															
																<a style='width: 200px;' href='adm_cursos_nuevo.php' class='btn btn-default'>Nuevo Curso</a>
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
 
 
 