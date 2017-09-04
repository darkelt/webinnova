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
										  $xprof  = leerParam("xprof","");
										  $xhora  = leerParam("xhora","");
										  $xcurso  = leerParam("xcurso","");
										  $xprecio  = leerParam("xprecio","");
										  $xprecio_dolar  = leerParam("xprecio_dolar","");
										  $tc  = leerParam("tc","");
										  $xfechini  = leerParam("xfechini","");
										  $xfechfin  = leerParam("xfechfin","");
										  $xdura  = leerParam("xdura","");
										  $xmoda = leerParam("xmoda","");
										  $xestado = leerParam("xestado","");
										  $ciudad = leerParam("state","");

										  $xfecha = date("Y-m-d");
										  echo "$xnom, $xprof, $xhora, $xcurso, $xprecio, $xfechini, $xfechfin, $xdura, $xmoda, $xestado";
									if ($xtipo == "INSERT"){
											$sql ="INSERT INTO `grupos`";
										   	$stmt = $mysqli->prepare("INSERT INTO `grupos`
														(`nom_grupo`,
														`id_profesor`,
														`id_horario`,
														`id_cursos`,
														`precio_curso_grupo`,
											   			`precio_dolar_grupo`,
											    		`tipo_cambio_grupo`,
														`fecha_ini`,
														`fecha_fin`,
														`duracion_grupo`,
														`localidad`,
														`modalidad_grupo`,
														`estado_grupo`)	
											VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
											$stmt->bind_param("siiidddssssss",$xnom, $xprof, $xhora, $xcurso, $xprecio, $xprecio_dolar, $tc, $xfechini, $xfechfin, $xdura,  $ciudad, $xmoda, $xestado);
											$stmt->execute();

											$stmt = $mysqli->prepare("SELECT MAX(`id_grupo`) AS id FROM `grupos`");
								           
								            $stmt->execute();
								            $stmt->store_result();
								            // Si el usuario existe, obtiene las variables del resultado.
								            $stmt->bind_result($id_grupo);
								            $stmt->fetch();    


											$stmt = $mysqli->prepare("
								            INSERT INTO `descuentos`
								                                (`nom_desc`,
								                                `factor_desc`,
								                                `descrip_desc`,
								                                `id_grupo`,
								                                `estado`
								                                )
								                        VALUES('Precio Regular','0','Inversión al público en general',?,'A')");
								            $stmt->bind_param("i", $id_grupo);
								            $stmt->execute();


											 echo "<h3>Registro grabado correctamente... Con su descuento  </h3>
									  
														<div>
																<a style='width: 200px;' href='adm_grupos.php' class='btn btn-default'>Terminar</a>
															
														</div>";
									} 
									 if ($xtipo == "UPDATE"){
											
												
											$sql = "UPDATE `grupos`
													SET
													`nom_grupo` = '$xnom',
													`id_profesor` = '$xprof',
													`id_horario` = '$xhora',
													`id_cursos` = '$xcurso',
													`precio_curso_grupo` = '$xprecio',
													`precio_dolar_grupo` = '$xprecio_dolar',
													`tipo_cambio_grupo` = '$tc',
													`fecha_ini` = '$xfechini',
													`fecha_fin` = '$xfechfin',
													`localidad` = '$ciudad',
													`duracion_grupo` = '$xdura',
													`modalidad_grupo` = '$xmoda',
													`estado_grupo` = '$xestado'
													WHERE `id_grupo` = '$xcod' ; ";

												$stmt = $mysqli->prepare($sql);

												// execute the query
												$stmt->execute();

												echo " Registro Actualizado correctamente...
										  
														<div>
																<a href='adm_grupos.php' class='btn btn-default'>Terminar</a>
															
														</div>";
											
											 
										 }
										 else if($xtipo == "x"){

											$xcod  = leerParam("xcod","");
											$sql = "UPDATE `grupos`
															SET
															`estado_grupo`  = 'x'
															WHERE `id_grupo` = $xcod;";

													$stmt = $mysqli->prepare($sql);
													$stmt->execute();
													header('Location: adm_grupos.php');	

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
 
 
 