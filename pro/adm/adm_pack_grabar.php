<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){ ?>	
<!-------------------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

									<?php
											$id_pack = leerParam("xcod","");
										  $xtipo = leerParam("tipo","");
										  $xnom_pack  = leerParam("nom_pack","");
										  $xdescrip_pack  = leerParam("descrip_pack","");
										  $xfechini  = leerParam("fechini","");
										  $xdura  = leerParam("dura","");
										  $grupos  = leerParam("grupos","");
										  $moda  = leerParam("moda","");
										  $xfdes_pack  = leerParam("fdes_pack","");
										  $xestado = leerParam("xestado","");
										  $xhora = leerParam("xhora","");
										  $xfecha = date("Y-m-d");
										
									if ($xtipo == "INSERT"){
											$sql ="INSERT INTO `grupos`";

										   	$stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`pack` (`nom_pack`, `factor_pack`, `descrip_pack`, `horas_pack`,`fecha_ini`, `estado`, `modalidad`,`id_horario`)	VALUES(?,?,?,?,?,?,?,?)");
											$stmt->bind_param("sdsssssi", $xnom_pack , $xfdes_pack, $xdescrip_pack, $xdura, $xfechini , $xestado ,$moda, $xhora );
											$stmt->execute();

											$stmt = $mysqli->prepare("SELECT MAX(`id_pack`) AS id FROM `pack`");
								           
								            $stmt->execute();
								            $stmt->store_result();
								            // Si el usuario existe, obtiene las variables del resultado.
								            $stmt->bind_result($id_pack);
								            $stmt->fetch();    


								             $N = count($grupos);
										    for($i=0; $i < $N; $i++)
										    {
											    $stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`detalle_pack` (`id_pack`, `id_grupo`) VALUES (?, ?);");
									            $stmt->bind_param("ii", $id_pack,$grupos[$i]);
									            $stmt->execute();
										    }
											 echo "<h3>Registro grabado correctamente... Con su descuento  </h3>
								  					<div>
														<a style='width: 200px;' href='adm_pack.php' class='btn btn-default'>Terminar</a>
													</div>";
									} 

									 if ($xtipo == "UPDATE"){
											$sql = "UPDATE `pack` SET `nom_pack`='$xnom_pack', 
													`descrip_pack`  = '$xdescrip_pack',
													`factor_pack`='$xfdes_pack',
													 `horas_pack`='$xdura', 
													 `fecha_ini`='$xfechini', 
													 `estado`='$xestado',
													 `id_horario`='$xhora'
													 WHERE `id_pack`='$id_pack';";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
																<a href='adm_pack.php' class='btn btn-default'>Terminar</a>
															
														</div>";
											
											 
										 }
										 else if($xtipo == "x"){

											$xcod  = leerParam("xcod","");
											$sql = "UPDATE `pack` 
															SET
															`estado` = 'X'
															WHERE `id_pack`='$id_pack';";

													$stmt = $mysqli->prepare($sql);
													$stmt->execute();
												header('Location: adm_pack.php');	

										} else{

											echo "No se envio tipo de evento ";

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
 
 
 