 <?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					?>

		<!-- end:fh5co-header -->
<div class="clear"><br><br></div>

		<div id="fh5co-work-section">
			<div class="container">
				<div class="row">
<?php
			
		   $id_user = $_SESSION['user_id'];
		   $xcod = leerParam("xcod","");
			if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
												`usuario`.`apell_p_usuario`,
												`usuario`.`apell_m_usuario`,
												`usuario`.`nom_usuario`,
												`usuario`.`email_usuario`,
												`usuario`.`naci_usuario`,
												`usuario`.`sexo_usuario`,
												`usuario`.`tel1_usuario`,
												`usuario`.`tel1_opera_usuario`,
												`usuario`.`direc_usuario`,
												`usuario`.`pais_usuario`,
												`usuario`.`ciudad_usuario`,
												`usuario`.`permiso_usuario`,
												`usuario`.`gr_academ_usuario`,
												`usuario`.`centr_estu_usuario`,
												`usuario`.`gmail_usuario`,
												`usuario`.`dni_usuario`
											FROM `u292000437_bdi`.`usuario` WHERE `id_usuario` = ? LIMIT 1;")){
						$stmt->bind_param('i', $id_user);
						$stmt->execute();   // Ejecuta la consulta preparada.
						$stmt->store_result();
						// Si el usuario existe, obtiene las variables del resultado.
						$stmt->bind_result($id, $apellp, $apellm, $nom, $email,$naci, $sex, $tel1, $opera, $direc, $pais , $ciudad, $permiso, $grado, $centro ,$gmail, $dni);
						$stmt->fetch();    
			}			
			/* cerrar la sentencia */
			
?>
								
												<h2 class="major text-center"><?php if(!$xcod==null){ echo"Solo un Paso Más: ";}?>Actualiza tus Datos</h2>
												<form method="post" action="perfil_grabar.php">
												<input type="hidden" name="tipo" value="XUPDATE">
												<?php if(!$xcod==null){ echo"<input type='hidden' name='xcod' value='$xcod'>";}?>
												
													<div class="row">
														<div class="col-md-6">
															<label for="name">Apellido Paterno</label>
															<input class="form-control" type="text" name="apell_p"  value="<?php echo $apellp; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Apellido Materno</label>
															<input class="form-control" type="text" name="apell_m"   value="<?php echo $apellm; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Nombres</label>
															<input class="form-control" type="text" name="username" value="<?php echo $nom; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="name">Documento de Identidad (DNI)</label>
															<input class="form-control" type="text" name="dni" id="dni" value="<?php echo $dni; ?>" required/>
															
														</div>
														<div class="col-md-6">
															<label for="email">Email</label>
															<input class="form-control" type="email" name="email" id="email" readonly="yes" value="<?php echo $email; ?>" required/>
															
														</div>
														<div class="col-md-6">
															<label for="password">Contraseña</label>
															<input class="form-control" type="password" name="password" value="************" readonly="yes" />
														</div>
														<div class="col-md-12">		
														<label for="sexo">Sexo</label>
															<div class="row">
														<?php
														if ($sex=='m'){
														echo'<div class="col-md-10">
														    	<label class="radio-inline" for="demo-priority-low">
														    	<input type="radio" id="demo-priority-low" name="sexo" value="m" checked >Masculino</label>
																<label class="radio-inline" for="demo-priority-normal" >
																<input type="radio" id="demo-priority-normal" name="sexo" value="f" >Femenino</label>
																<label class="radio-inline" for="demo-priority-high" >
																<input type="radio" id="demo-priority-high" name="sexo" value="o" >Otros</label>
														    </div></div></div>';
														}elseif($sex=='f'){
														echo'<div class="col-md-10">
														    	<label class="radio-inline" for="demo-priority-low">
														    	<input type="radio" id="demo-priority-low" name="sexo" value="m" >Masculino</label>
																<label class="radio-inline" for="demo-priority-normal" >
																<input type="radio" id="demo-priority-normal" name="sexo" value="f" checked>Femenino</label>
																<label class="radio-inline" for="demo-priority-high" >
																<input type="radio" id="demo-priority-high" name="sexo" value="o" >Otros</label>
														    </div></div></div>';
														}elseif($sex=='o'){
														echo'<div class="col-md-10">
														    	<label class="radio-inline" for="demo-priority-low">
														    	<input type="radio" id="demo-priority-low" name="sexo" value="m" >Masculino</label>
																<label class="radio-inline" for="demo-priority-normal" >
																<input type="radio" id="demo-priority-normal" name="sexo" value="f" >Femenino</label>
																<label class="radio-inline" for="demo-priority-high" >
																<input type="radio" id="demo-priority-high" name="sexo" value="o" checked>Otros</label>
														    </div></div></div>';	
														}
														?>
														<div class="col-md-6">
															<label for="demo-category">Pais</label>
															<div class="select-wrapper">																
																<select  class="form-control" id="country" name="country" required></select>
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<label for="demo-category">Ciudad</label>
															<div class="select-wrapper">
																 <select  class="form-control" name="state" id="state" required></select>
															</div>
														</div>	
														<div class="col-md-6">
															<label for="name">Direccion</label>
															<input class="form-control" type="text" name="direc" value="<?php echo $direc; ?>" required/>
														</div>
														<div class="col-md-6">
															<label for="demo-name">Fecha de nacimiento</label>
															<input class="form-control" type="date" name="date" id="date"  value="<?php echo $naci; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="tel">Telefono 1</label>
															<input class="form-control" type="text" name="telephone1" id="tel" value="<?php echo $tel1; ?>" required  />
														</div>
														<div class="col-md-6">
															<label for="demo-category">Operador</label>
															<div class="select-wrapper">
																<select  class="form-control" name="opera" id="demo-category">
																	<option value="<?php echo $opera; ?>"><?php echo $opera; ?></option>
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
															<input class="form-control" type="text" name="grado" value="<?php echo $grado; ?>" required />
														</div>
														<div class="col-md-6">
															<label for="name">Institución de Procedencia</label>
															<input class="form-control" type="text" name="institu" value="<?php echo $centro; ?>" required  />
														</div>
														<?php
														$findme   = '@gmail.com';
														$pos = strpos($email , $findme);
														if ($pos == false) {
														echo"<div class='col-md-6'>
													    		<label>Correo Gmail</label>
													    			
													    				<input class='form-control' name='gmail'";  if(empty($gmail_u) !== true ){ echo " value='$gmail' readonly='yes'  ";}else{};  echo"type='text' placeholder='@gmail.com' />
													    			
													    	</div>";
														}
														?>

														<div class="col-md-12">
															<br>
														    <button type="submit" class="btn btn-default">Siguiente</button>
														    
													    </div>
													</div>
												</form>	
											
					<script language="javascript">
						populateCountries("country", "state");
					</script>
			</div>					
		</div>
	</div>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
	<?php }
			else { 
				header('Location: ../login.php?error=2');
			} 
	} else { 

		header('Location: ../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 