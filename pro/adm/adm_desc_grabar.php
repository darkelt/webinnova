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
										  $xfdes  = leerParam("xfdes","");
										  $date_ini  = leerParam("date_ini","");
										  $date_fin = leerParam("date_fin","");
										  if($date_ini == ""){
										  	$date_ini = null;
										  	$date_fin =  null;
										  } 
										  echo"        $date_ini        ------------   $date_fin ";
										   $temp = leerParam("xgrupo","");
										   if ($temp != null) {
											    list($tc, $xprecio_dolar,$xprecio,$idgrup) = explode(":", $temp);
											}
																					
										   
										  $xdescrip  = leerParam("xdescrip","");
										  $xestado = leerParam("xestado","");
										 

									if ($xtipo == "INSERT"){
										$sql= "INSERT INTO `descuentos`"; 
									  	 $stmt = $mysqli->prepare("
											INSERT INTO `descuentos`
													(`nom_desc`,
													`factor_desc`,
													`descrip_desc`,
													`id_grupo`,
													`estado`,
													`fecha_ini_desc`,
    												`fecha_fin_desc`
													)
											VALUES(?,?,?,?,?,?,?)");
										$stmt->bind_param("sdsisss", $xnom, $xfdes, $xdescrip,$idgrup,$xestado, $date_ini,$date_fin );
										$stmt->execute();



											
										 echo "<h3>Registro grabado correctamente...</h3>
									  
														<div>
															
																<a style='width: 200px;' href='adm_desc_nuevo.php' class='btn btn-default'>Nuevo Descuento</a>
																<a style='width: 200px;' href='adm_desc.php' class='btn btn-default'>Terminar</a>
															
														</div>";
									} 
									if ($xtipo == "UPDATE"){
											
											if ($date_ini == null){
												$sql = "UPDATE `descuentos` 
												SET `nom_desc`='$xnom',
													 `factor_desc`='$xfdes', 
													`descrip_desc`='$xdescrip', 
													`id_grupo` = '$idgrup' ,
														`estado`='$xestado',
														`fecha_ini_desc`= null,
														`fecha_fin_desc`= null
												WHERE `id_desc`='$xcod' ;";

											}else{
												$sql = "UPDATE `descuentos` 
												SET `nom_desc`='$xnom',
													 `factor_desc`='$xfdes', 
													`descrip_desc`='$xdescrip', 
													`id_grupo` = '$idgrup' ,
														`estado`='$xestado',
														`fecha_ini_desc`='$date_ini',
														`fecha_fin_desc`='$date_fin'
												WHERE `id_desc`='$xcod' ;";
											}
												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
															
																<a style='width: 200px;' href='adm_desc_nuevo.php' class='btn btn-default'>Nuevo Descuento</a>
																<a style='width: 200px;' href='adm_desc.php' class='btn btn-default'>Terminar</a>
															
														</div> ";
												
											
											 
									 }
									 if ($xtipo == "del"){
											
												
											$sql = "UPDATE `descuentos` 
											SET `estado`='E'
											WHERE `id_desc`='$xcod' ;";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Eliminado correctamente...
										  
														<div>
															
																<a style='width: 200px;' href='adm_desc_nuevo.php' class='btn btn-default'>Nuevo Descuento</a>
																<a style='width: 200px;' href='adm_desc.php' class='btn btn-default'>Terminar</a>
															
														</div> ";
												
											
											 
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
 
 
 