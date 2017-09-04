<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'P' OR $_SESSION['permiso'] == 'A'){



									$xcod = leerParam("xcod","");
									$xnom = leerParam("xnom","");
									$id_user = $_SESSION['user_id'];
									$xbuscar = leerParam("buscar","");
									if($xbuscar == 'NGRUPO' ){
									
										$datos  = leerParam("xgrupo","");
										list($xcod, $xnom) = explode(":", $datos);
									}
									
					?>							
						<div class="clear"><br><br></div>
						<div id="fh5co-team-section">
										<div class="container">
											<?php include 'header_adm.php' ?>
																		<h4>MATRICULADOS <?php echo $xnom; ?></h4>
																		
																	
																			
																			<table>
																				<thead>
																					<tr>
																						<th>Id U</th>	
																						<th>Confirmar</th>
																						<th>Usuario</th>
																						<th>Email </th>
																						<th>Gmail</th>
																						<th>Pais</th>
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
																	`u`.`pais_usuario`,
																	`u`.`ciudad_usuario`,
																	`d`.`nom_desc`,
																	`m`.`estado_matricula`,
																	`m`.`operacion_matricula`
															FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
															WHERE  `m`.`id_usuario`=`u`.`id_usuario` AND `m`.`id_grupos`=`g`.`id_grupo` AND `m`.`id_desc`=`d`.`id_desc` AND `id_grupos`= ? AND `confirma_matricula` = 'M';")) {
										$stmt->bind_param('i', $xcod);
										$stmt->execute();
										/* vincular variables a la sentencia preparada */
										$stmt->bind_result($xid,$confir, $xfehora, $xprecio , $xprecio_dolar , $xiduser, $xuser, $xuser_p , $xuser_m, $email, $gmail, $pais, $ciudad ,$xdes, $xesta , $opera);
										/* obtener valores */										
									while ($stmt->fetch()) {
										
										$xuser_p = strtoupper($xuser_p);
										$letra =substr($xuser_p,0,1);
										$temp = strlen($xuser_p);
										$temp = $xiduser*$temp;
										$temp = $letra.$temp;
										$passw = substr($temp, 0,5);
										echo "<tr>
										
												<td><a href='prof_perfil.php?xcodid=$xiduser'>$xiduser</a></td>														
												<td>$confir</td>
												<td><a href='prof_perfil.php?xcodid=$xiduser'>$xuser $xuser_p $xuser_m</a></td>
												<td>$email</td>
												<td>$gmail</td>
												<td>$pais - $ciudad</td>
												<td>$xesta - $cont</td>
										  </tr>";

										  $cont ++;
									}

									/* cerrar la sentencia */
									
								}
								
						?>
																				
							</tbody>
						</table>
						<form method="post" action="prof_matricula_grupo.php">
							<input type=hidden name=buscar value="NGRUPO">
												<div class="row">
												<div class="col-md-6">
														<div class="col-md-12">
															<label for="name">Tus grupos Asignados</label>
															<select class="form-control"  name="xgrupo" id="demo-category"required>
															<option value="">Elije Grupo</option>
															<?php
																if ($stmt = $mysqli->prepare("
																		SELECT `grupos`.`id_grupo`,
																				`grupos`.`nom_grupo`
																			FROM `u292000437_bdi`.`grupos` WHERE `estado_grupo`='A' AND `id_profesor`= ? ;")) {
																		$stmt->bind_param('i', $id_user);
																		$stmt->execute();
																		/* vincular variables a la sentencia preparada */
																		$stmt->bind_result($id,$nom);
																		/* obtener valores */
																	while ($stmt->fetch()) {
																		echo "<option value='$id:$nom'>$nom</option>";
																			
																	}

																	/* cerrar la sentencia */
																	$stmt->close();
																}
																$mysqli->close();
																$xbuscar = "";
														  ?>
														</select>
													</div>


												<div class="col-md-12">
												    <button type="submit" class="btn btn-default">Buscar</button>
											    </div>
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

 