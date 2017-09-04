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

 $xcod = leerParam("xcod","");
 
 if ($stmt = $mysqli->prepare("SELECT  `usuario`.`apell_p_usuario`,
										`usuario`.`apell_m_usuario`,
										`usuario`.`nom_usuario`,
										`usuario`.`email_usuario`,
										`usuario`.`naci_usuario`,
										`usuario`.`tel1_usuario`,
										`usuario`.`tel1_opera_usuario`,
										`usuario`.`direc_usuario`,
										`usuario`.`gr_academ_usuario`,
										`usuario`.`centr_estu_usuario`,
										`usuario`.`gmail_usuario`,
                                        `usuario`.`dni_usuario`
						    FROM `u292000437_bdi`.`usuario`
							WHERE `id_usuario` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result( $apellp, $apellm, $nom, $email, $dat,$tel1, $opera, $direc,$grado,$institu,$gmail, $dni);
            $stmt->fetch();    
			$stmt->close();
		}
		$mysqli->close();

?>
				
										<h3>Editar Usuario</h3>
										<form name="formulario" method="post" action="adm_user_grabar.php">
											<input type="hidden" name="tipo" value="UPDATE">
											<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
													<div class="row">
														<div class="col-md-6">
															<label for="name">Apellido Paterno</label>
															<input class="form-control" type="text" name="apell_p" value="<?php echo $apellp; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="name">Apellido Materno</label>
															<input class="form-control" type="text" name="apell_m"  value="<?php echo $apellm; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Nombres</label>
															<input class="form-control" type="text" name="username" value="<?php echo $nom; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Documento de Identidad</label>
															<input class="form-control" type="text" name="dni" value="<?php echo $dni; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="email">Email</label>
															<input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="email">Gmail</label>
															<input class="form-control" type="email" name="gmail" id="email" value="<?php echo $gmail; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="name">Direccion</label>
															<input class="form-control" type="text" name="direc" value="<?php echo $direc; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="demo-name">Fecha de nacimiento</label>
															<input class="form-control" type="date" name="date" id="date"  value="<?php echo $dat; ?>"required />
														</div>
														<div class="col-md-6">
															<label for="tel">Telefono 1</label>
															<input class="form-control" type="text" name="telephone1" id="tel" value="<?php echo $tel1; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="demo-category">Operador</label>
															<div class="select-wrapper">
																<select class="form-control" name="opera" id="demo-category">
																	<option value="<?php echo $opera; ?>">"<?php echo $opera; ?>"</option>
																	<option value="rpc">Claro(RPC)</option>
																	<option value="c">Claro</option>
																	<option value="rpm">Movistar(RPM)</option>
																	<option value="m">Movistar</option>
																	<option value="e">Entel</option>
																	<option value="b">Bitel</option>
																	<option value="o">Otro</option>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<label for="name">Grado Academico y Profesión</label>
															<input class="form-control" type="text" name="grado" value="<?php echo $grado; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Institución de Procedencia</label>
															<input class="form-control" type="text" name="institu" value="<?php echo $institu; ?>" required/>
														</div>
														<div class="col-md-6">		
														<label for="permiso">Permisos</label>	
														</div>
														<div class="col-md-6">
														    <div class="form-group">
														    	<label class="radio-inline" for="demo-priority-low">
														    		<input  type="radio" id="demo-priority-low" name="permiso" value="U" checked>Usuario
														    	</label>
																<label class="radio-inline" for="demo-priority-normal" >
																	<input  type="radio" id="demo-priority-normal" name="permiso" value="A">Administrador
																</label>
																<label class="radio-inline" for="demo-priority-high">
																	<input  type="radio" id="demo-priority-high" name="permiso" value="P">Profesor
																</label>
														    </div>
													    </div>	
														<div class="col-md-12">
												  			  <button type="submit" class="btn btn-default">Grabar</button>
											  			</div>
														
														
													</div>
													<div>
													<a style="width: 250px; float:right;"href="adm_user_newpss.php" class="button fit small">Restaurar contraseña</a>
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
 
 
 