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
										  $xnomimg  = leerParam("xnomimg","");
										  $xdescrip = leerParam("xdescrip","");
										  $xfecha = date("Y-m-d");
										  
									if ($xtipo == "INSERT"){
										$sql= "INSERT INTO `horario`"; 
									   	$stmt = $mysqli->prepare("INSERT INTO `horario`(`nom_horario`,`desscripcion`)
												VALUES(?,?)");
												$stmt->bind_param("ss", $xnom,$xdescrip);
												$stmt->execute();
												 echo "<h3>Registro grabado correctamente...</h3>
														<div>
															<a style='width: 200px;' href='adm_horario_nuevo.php' class='btn btn-default'>Nuevo horario</a>
															<a style='width: 200px;' href='adm_horario.php' class='btn btn-default'>Terminar</a>
														</div>";
									} 
									if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `horario`
													SET
												`nom_horario` = '$xnom' ,
												`desscripcion` = '$xdescrip'
												WHERE `id_horario` = '$xcod' ";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
															<a style='width: 200px;' href='adm_horario_nuevo.php' class='btn btn-default'>Nuevo horario</a>
															<a style='width: 200px;' href='adm_horario.php' class='btn btn-default'>Terminar</a>
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
 
 
 