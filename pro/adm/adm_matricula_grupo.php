<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){

									$xcod = leerParam("xcod","");
									$xnom = leerParam("xnom","");
									
									$xbuscar = leerParam("buscar","");
									if($xbuscar == 'NGRUPO' ){
									
										$datos  = leerParam("xgrupo","");
										list($xcod, $xnom) = explode(":", $datos);
									}
									
					?>		

<!-------------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
					<div class="container">
						<h4>MATRICULADOS <?php echo $xnom; ?></h4>
						<?php echo "<a href='../reporteexcel.php?xcod=$xcod' class='btn btn-primary'>Generar Reporte Excel</a>"; ?>
						<a href="adm_matricula.php" class="btn btn-default" role="button">Atras Matricula</a>
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Id U</th>	
								<th>Confirmar</th>
								<th>Soles</th>
								<th>Dolares</th>
								<th>Usuario</th>
								<th>Email </th>
								<th>Gmail</th>
								<th>Passwd</th>
								<th>Descuento</th>
								<th>Nro Oper</th>
								<th>Estado - numero</th>
								
							</tr>	
						</thead>
						<tbody>
					
					<?php					
									
									
								
									$cont = 1;
								if ($stmt = $mysqli->prepare("SELECT	`m`.`id_matricula`,
																	`m`.`confirma_matricula`,
																	`m`.`fecha_matricula`,
																	`m`.`pago_matricula`,
																	`m`.`pago_dolar_matricula`,
																	`m`.`id_usuario`,
																	`u`.`nom_usuario`,
																	`u`.`apell_p_usuario`,
																	`u`.`apell_m_usuario`,
																	`u`.`email_usuario`,
																	`u`.`gmail_usuario`,
																	`m`.`id_desc`,
																	`m`.`estado_matricula`,
																	`m`.`operacion_matricula`,
                                                                    `m`.`fecha_conf_matricula`
															FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`
															WHERE  `m`.`id_usuario`=`u`.`id_usuario` AND `m`.`id_grupos`=`g`.`id_grupo` AND `id_grupos`= ? AND `confirma_matricula` = 'M' AND `estado_matricula` = 'a' ORDER BY `fecha_conf_matricula` ;")) {
										$stmt->bind_param('i', $xcod);
										$stmt->execute();
										/* vincular variables a la sentencia preparada */
										$stmt->bind_result($xid,$confir, $xfehora, $xprecio , $xprecio_dolar , $xiduser, $xuser, $xuser_p , $xuser_m, $email, $gmail, $xdes, $xesta , $opera, $fech_conf);
										/* obtener valores */										
									while ($stmt->fetch()) {
										
										$xuser_p = strtoupper($xuser_p);
										$letra =substr($xuser_p,0,1);
										$temp = strlen($xuser_p);
										$temp = $xiduser*$temp;
										$temp = $letra.$temp;
										$passw = substr($temp, 0,5);
										echo "<tr>
										
												<td><a href='adm_perfil.php?xcodid=$xiduser'>$xiduser</a></td>														
												<td>$confir</td>
												<td>S/. $xprecio</td>
												<td>$ $xprecio_dolar</td>
												<td><a href='adm_perfil.php?xcodid=$xiduser'>$xuser $xuser_p $xuser_m</a></td>
												<td>$email</td>
												<td>$gmail</td>
												<td>$passw</td>
												<td>$xdes</td>
												<td>$opera</td>
												<td>$fech_conf - $cont</td>
										  </tr>";

										  $cont ++;
									}

									/* cerrar la sentencia */
									
								}
								
						?>
																				
							</tbody>
						</table>
						<form method="post" action="adm_matricula_grupo.php">
							<input type=hidden name=buscar value="NGRUPO">
							  <div class="row">
							    <div class="col-md-12">
								    <div class="form-group">
								    	<select class="form-control" name="xgrupo" id="demo-category"required>
											<option value="">Elije Grupo</option>
											<?php
												if ($stmt = $mysqli->prepare("
														SELECT `grupos`.`id_grupo`,
																									`grupos`.`nom_grupo`,
																							    `grupos`.`localidad`,
																							    `grupos`.`modalidad_grupo`
																								FROM `u292000437_bdi`.`grupos`  
																								WHERE `grupos`.`estado_grupo`= 'A'
																								OR `grupos`.`estado_grupo`= 'F'  
																								ORDER BY `localidad`,`id_grupo` ;")) {
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id,$nom,$local,$moda);
														/* obtener valores */
													while ($stmt->fetch()) {
														echo "<option value='$id:$nom'>$id - $nom - $local /$moda</option>";
															
													}

													/* cerrar la sentencia */
													$stmt->close();
												}
												$mysqli->close();
												$xbuscar = "";
										  ?>
										</select>
								    </div>
								</div>
						    <div class="col-md-12">
							    <button type="submit" class="btn btn-default">Buscar</button>
						    </div>
						  </div>
						</form>	
						
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
 
 
 