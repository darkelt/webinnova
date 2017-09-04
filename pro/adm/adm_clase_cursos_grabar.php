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
											
										$sql= "INSERT INTO `clase_cursos`";
									   $stmt = $mysqli->prepare("
												 INSERT INTO `clase_cursos`
															(`nom_clase_cursos`,
															`nom_corto_clase_cursos`,
															`des_clase_cursos`,
															`img_clase_cursos`)
												VALUES(?,?,?,?)");
												$stmt->bind_param("ssss", $xnom, $xnomcor, $xdescrip,$xnomimg);
												$stmt->execute();
												 echo "<h3>Registro grabado correctamente...</h3>
														<div>
															<a style='width: 200px;' href='adm_clase_cursos_nuevo.php' class='btn btn-default'>Nuevo Clase</a>
															<a style='width: 200px;' href='adm_clase_cursos.php' class='btn btn-default'>Terminar</a>
														</div>";
									 } 
									 if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `clase_cursos`
												SET
												`nom_clase_cursos` = '$xnom' ,
												`nom_corto_clase_cursos` = '$xnomcor',
												`des_clase_cursos` = '$xdescrip',												
												`img_clase_cursos` = '$xnomimg'												
												WHERE `id_clase_cursos` = '$xcod' ";

												$stmt = $mysqli->prepare($sql);
												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
														<div>
															<a  href='adm_clase_cursos_nuevo.php' class='btn btn-default'>Nuevo Clase</a>
															<a  href='adm_clase_cursos.php' class='btn btn-default'>Terminar</a>
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
 
 
 