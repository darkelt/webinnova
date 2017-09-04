<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
		
					
		$xcod = leerParam("xcod","");
		$id_user = leerParam("xid_user","");
				if ($stmt = $mysqli->prepare("SELECT FROM `u292000437_bdi`.`grupos` WHERE `id_grupo` = ? LIMIT 1;")){
					$stmt->bind_param('i', $xcod);
					$stmt->execute();   // Ejecuta la consulta preparada.
					$stmt->store_result();
					// Si el usuario existe, obtiene las variables del resultado.
					$stmt->bind_result($xnom, $xprof, $xhora, $xcurso, $xprecio, $xfechini, $xfechfin, $xdura, $xmoda, $xesta);
					$stmt->fetch();    
		}
		if ($stmt = $mysqli->prepare("SELECT `grupos`.`nom_grupo`,
												`grupos`.`id_profesor`,
												`grupos`.`id_horario`,
												`grupos`.`id_cursos`,
												`grupos`.`precio_curso_grupo`,
												`grupos`.`precio_dolar_grupo`,
												`grupos`.`fecha_ini`,
												`grupos`.`fecha_fin`,
												`grupos`.`duracion_grupo`,
												`grupos`.`modalidad_grupo`,
												`grupos`.`estado_grupo`
											FROM `u292000437_bdi`.`grupos`
											WHERE `id_grupo` = ? LIMIT 1;")){
					// Une “$user_id” al parámetro.
					$stmt->bind_param('i', $xcod);
					$stmt->execute();   // Ejecuta la consulta preparada.
					$stmt->store_result();
					// Si el usuario existe, obtiene las variables del resultado.
					$stmt->bind_result($xnom, $xprof, $xhora, $xcurso, $xprecio, $xprecio_dolar, $xfechini, $xfechfin, $xdura, $xmoda, $xesta);
					$stmt->fetch();    
		}
		if ($stmt = $mysqli->prepare("SELECT     `usuario`.`apell_p_usuario`,
												`usuario`.`apell_m_usuario`,
												`usuario`.`nom_usuario`,
												`usuario`.`email_usuario`,
												`usuario`.`naci_usuario`,
												`usuario`.`sexo_usuario`,
												`usuario`.`tel1_usuario`,
												`usuario`.`direc_usuario`,
												`usuario`.`pais_usuario`,
												`usuario`.`ciudad_usuario`,
												 `usuario`.`gmail_usuario`,
												`usuario`.`dni_usuario`
											FROM `u292000437_bdi`.`usuario` WHERE  `usuario`.`id_usuario` = ? LIMIT 1;")){
					// Une “$user_id” al parámetro.
					$stmt->bind_param('i', $id_user);
					$stmt->execute();   // Ejecuta la consulta preparada.
					$stmt->store_result();
					// Si el usuario existe, obtiene las variables del resultado.
					$stmt->bind_result($apll_p, $apll_m, $nom_u, $email_u, $naci_u, $sexo_u, $tel_u, $dire_u, $pais_u, $cuidad_u,$gmail_u,$dni_u);
					$stmt->fetch();    
		}
		
		
					
?><div class="clear"><br><br></div>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
				<?php include 'header_adm.php' ?>	
					<div class="col-md-8 col-md-offset-2">
												
								<h3 class="major">Matricula:  <?php echo "$xnom";?></h3>
								<p>Por favor verifique y actualice su información personal. Tenga en cuenta que los datos ingresados serán utilizados para su ficha personal de matrícula y posteriormente para documentos oficiales como Constancias y Certificados. </p>
								<form class="form-horizontal"  name="formulario" method="post" action="adm_user_matricula_grabar.php">
									<input type="hidden" name="tipo" value="INSERTS">
									<input type="hidden" name="confirm" value="x">
									<input type="hidden" name="user" value="<?php echo $id_user;?>">
									<input type="hidden" name="grupo" value="<?php echo $xcod; ?>">
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Apellidos y Nombres</label>
								    <div class="col-md-7">
								   	 <?php echo"<input class='form-control' name='nomcomple' readonly='yes' type='text' value='$apll_p  $apll_m, $nom_u' required/>";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Doc. de Identidad (DNI):</label>
								    <div class="col-md-7">
										<?php 
										echo"<input class='form-control' name='dni'";
											if(empty($dni_u)== false ){
											 echo "readonly='yes'  value='$dni_u'";
											}else{};
											echo"type='text' required />";
										?>
								    	
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Dirección:</label>
								    <div class="col-md-7">
								    	<?php echo"<input class='form-control' readonly='yes' type='text' value='$dire_u, $cuidad_u - $pais_u'  required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Fecha de Nacimiento:</label>
								    <div class="col-md-7">
								    <?php echo"<input class='form-control' readonly='yes' type='text' value='$naci_u' required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Sexo:</label>
								    <div class="col-md-7">
								     <?php 
								    	echo "<input class='form-control' readonly='yes' type='text' value="; 
								    	if ($sexo_u=='m'){
											echo"'Masculino' required />";
										}
										else if($sexo_u=='f'){
											echo "'Femenino' required />";
										}
									?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Email:</label>
								    <div class="col-md-7">
								     	<?php echo"<input class='form-control' name='email_user' readonly='yes' type='email' value='$email_u'required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Telefono:</label>
								    <div class="col-md-7">
								    	<?php echo"<input class='form-control' readonly='yes' type='text' value='$tel_u'required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Curso:</label>
								    <div class="col-md-7">
								    	<?php echo"<input class='form-control' name='curso' readonly='yes' type='text' value='$xnom' required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Fecha de Inicio:</label>
								    <div class="col-md-7">
								    <?php echo"<input class='form-control' name='fini' readonly='yes' type='text' value='$xfechini' required />";?>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Modalidad:</label>
								    <div class="col-md-7">

								    <?php
									    	echo '<input  class="form-control" name="moda" name="fini" readonly="yes" type="text" value='; 
												if ($xmoda == 'P'){
													echo "'Presencial' required />";
												}else {
													echo "'Virtual' required />";
													$findme   = '@gmail.com';
													$pos = strpos($email_u , $findme);
													if ($pos == false) {
												echo "</div></div><div class='form-group'>
													    <label  class='col-md-4 control-label'> Correo Gmail</label>
													    <div class='col-md-7'>
													    <input class='form-control' name='gmail'";  if(empty($gmail_u) !== true ){ echo " value='$gmail_u' readonly='yes'  ";}else{};  echo"type='text' placeholder='@gmail.com' />";

														} 
												}
									?>
								    </div>
								  </div>
								  <?php
								  	if ($xmoda == 'P'){
										echo'
								  		<div class="form-group">
												    <label  class="col-md-4 control-label">Horario Preferido:</label>
												    <div class="col-md-7">
												    	<select class="form-control" name="horario" id="horario" required>
															<option value="">Elija uno</option>
															<option value="TURNO MAÑANA ">TURNO MAÑANA de 9:00am a 12:00pm</option>
															<option value="TURNO TARDE 1">TURNO TARDE 1 de 3:00pm a 6:00pm</option>
															<option value="TURNO TARDE 2">TURNO TARDE 2 de 6:00pm a 9:00pm</option>
															<option value="TURNO SABADO Y DOMINGO">TURNO SABADO Y DOMINGO de 3:00pm a 8:00pm</option>
														</select>
												    </div>
											  	</div>';

									}
								  ?>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">País de Residencia:</label>
								   	<div class="col-md-7">
													<label class="radio-inline col-md-5" value="local"><input type="radio" name="xlocal"  value="local" onclick="if(this.checked){myFunction1()}"  required>Perú - S/.</label>
													<label class="radio-inline col-md-5" value="nolocal"><input type="radio" name="xlocal" value="nolocal"  onclick="if(this.checked){myFunction1()}" required>Otro País - $</label>
										
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Modalidad de Pago:</label>
								    <div class="col-md-7">
								    	<select class="form-control" name="total" id="mySelect" onchange="myFunction()" required>
											<option value="">Elija uno</option>
											<?php
												if ($stmt = $mysqli->prepare("
														SELECT `descuentos`.`id_desc`,
																						`descuentos`.`nom_desc`,
																						`descuentos`.`factor_desc`,
																						`descuentos`.`descrip_desc`
																					FROM `u292000437_bdi`.`descuentos` WHERE `id_grupo` = ? 
																					AND (`descuentos`.`estado` = 'A' 
																					OR `descuentos`.`estado` ='X');
															")){
														$stmt->bind_param('i', $xcod);
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($iddes, $nom ,$fdesc ,$ddesc);
														/* obtener valores */
													while ($stmt->fetch()) {
									   				    $total_dolar = $xprecio_dolar -($fdesc*$xprecio_dolar);
									   				    $total_dolar=number_format($total_dolar, 2, '.', '');
														$total= $xprecio -($fdesc*$xprecio);
														$total=number_format($total, 2, '.', '');
														echo "<option value='$total:$total_dolar:$iddes'>$nom : $ddesc</option>";
													}
											}	/* cerrar la sentencia */	
										  ?>
										</select>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Precio a Pagar: </label>
								    <div class="col-md-7">
								    	<code class="form-control alert alert-success" id="demo"></code>
								    </div>
								  </div>
								  <div class="form-group">
								    <label  class="col-md-4 control-label">Enviar OPago?</label>
								    <div class="col-md-7">
									    <select class="form-control" name="op" id="demo-category"  required>
											<option value="">----</option>
											<option value="si">Enviar Orden de Pago</option>
											<option value="no">No por el Momento</option>
										</select>
									</div>
								  </div>
								  <div class="form-group">
								    <div class="col-lg-offset-2 col-lg-10">

								    	<?php  
									if ($xprecio == 0){
										echo " <button type='submit' class='btn btn-primary'>Matricula Gratuita</button>";
									} else{
										echo "<button type='submit' class='btn btn-primary'>Pre-Matricula</button>";
									}
									?>
									<button type='reset' class='btn btn-default'>Reset</button>
								    </div>
								 </div>
							</form>
									 
						</div>
					
					</div>
				</div>
		</div>				
					<script>
				function myFunction() {
					var x = document.getElementById("mySelect").value;
					var myarr = x.split(":");
			        var myvar = myarr[0] + ":" + myarr[1] + ":" + myarr[2];
			   
				 	var precio =  myarr[0];
				 	var precio_dolar =  myarr[1];
				 	var id =  myarr[2];
				    var xlocal = document.forms[0];
				    var txt = "";
				    var i;
				    for (i = 0; i < xlocal.length; i++) {
				        if (xlocal[i].checked) {
				            txt = txt + xlocal[i].value ;
				        }
				    }
				    if( txt == "local") {

					document.getElementById("demo").innerHTML = "S/. " + precio;

				  
				    }else if (txt == "nolocal"){

				    document.getElementById("demo").innerHTML = "$. " + precio_dolar;
				   
				    }else{

				   document.getElementById("demo").innerHTML = "Escoja un Pais de Residencia";
				   }

				}
				function myFunction1() {
					
				   document.getElementById("demo").innerHTML = "Escoja una Modalidad de Pago";
				

				}
				</script>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
				<?php }
			else { 
				header('Location: ../login.php?error=2');
			} 
	} else { 

		header('Location: ../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 