<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
			
		 function array_envia($ar) { 
		    $tmp = serialize($ar); 
		    $tmp = urlencode($tmp); // Si no quieres que salga esa URL tan larga simplemente ponle comentarios a esta linea 
		    return $tmp; 
		  } 

		$id_pack = leerParam("xcod","");
		$ciudad = leerParam("ciudad","");
		$ciudad =strtoupper($ciudad);	


		$stmt = $mysqli->prepare("SELECT  	`pack`.`nom_pack`,
												`pack`.`factor_pack`,
											    `pack`.`descrip_pack`,
											    `pack`.`horas_pack`,
											    `pack`.`fecha_ini`
											FROM `u292000437_bdi`.`pack` WHERE `pack`.`id_pack` = ? AND `pack`.`estado`= 'A' ;");
		$stmt->bind_param("i", $id_pack );
		$stmt->execute();
        $stmt->bind_result($nom , $factor_pack, $des ,$horas, $fecha);
        $stmt->fetch();

		$stmt->close();					
		if ($stmt = $mysqli->prepare("SELECT `cursos`.`nom_cursos`,
											`grupos`.`id_grupo`,
											`grupos`.`nom_grupo`,
											`grupos`.`precio_curso_grupo`,
											`grupos`.`precio_dolar_grupo`,
											`grupos`.`duracion_grupo`,
											`grupos`.`modalidad_grupo`,
											`grupos`.`estado_grupo`
										FROM `detalle_pack`, `pack`, `grupos` ,  `cursos`
										WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
										AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
										AND  `grupos`.`id_cursos` = `cursos`.`id_cursos`
										AND `pack`.`id_pack` = ? ;")) {
			$stmt->bind_param('i', $id_pack);
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($nom_c,$xid, $xnom,  $xprecio, $xprecio_dolar, $xdura, $xmoda, $xesta);
			$c= 0;
			/* obtener valores */
			while ($stmt->fetch()) {
				$xid_array[$c] = $xid;
				$xnom_array[$c] = $nom_c;
				$xprecio_array[$c] = $xprecio;
				$xprecio_dolar_array[$c] = $xprecio_dolar;
				$xdura_array[$c] = $xdura;
				$xmoda[$c] = $xmoda;												
				$c++;

			}

		}
		$id_user =  leerParam("user","");
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
		if ($tel_u== null){

			header('Location: perfil_editar.php?xcod='.$nom);

		}	
					
?>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
								<br><br>
							<?php

								$arrlength = count($xprecio_array);
								$resultado = 0;
								$resultado_dolar = 0;
								for($x = 0; $x < $arrlength; $x++) {
									
									
									$total[$x]= $xprecio_array[$x] -($factor_pack*$xprecio_array[$x]);
									$pagom_array[$x]=number_format($total[$x], 2, '.', '');
									
									$resultado=$resultado + $total[$x]; 	

								}	
								
								$resultado = number_format( $resultado, 2, '.', '');
								$resultado_dolar = number_format( $resultado_dolar, 2, '.', '');
								
							?>


										<h3 class="major">MATRICULA:  <?php echo "$nom";?></h3>
										<p>Por favor verifique y actualice su información personal. Tenga en cuenta que los datos ingresados serán utilizados para su ficha personal de matrícula y posteriormente para documentos oficiales como Constancias y Certificados.  <a href="perfil_editar.php?url=<?php ?>" class="btn btn-default">Editar Perfil de Usuario</a></p>
										
										<form class="form-horizontal" name="formulario" method="post" action="adm_user_matricula_grabar.php">
											<input type="hidden" name="tipo" value="PACK_P">
											<input type="hidden" name="user" value="<?php echo $id_user; ?>">
											<input type="hidden" name="id_pack" value="<?php echo $id_pack; ?>">
											<div class="form-group">
											    <label  class="col-md-4 control-label">Apellidos y Nombres</label>
											    <div class="col-md-7">
											   	 <?php echo"<input class='form-control' name='nomcomple' readonly='yes' type='text' value='$nom_u $apll_p  $apll_m ' required/>";?>
											    </div>
											  </div>
												<div class="form-group">
											  		  <label  class="col-md-4 control-label">Doc. de Identidad (DNI):</label>
											    	<div class="col-md-7">
													<?php 
													echo"<input class='form-control' name='dni'";
														if(empty($dni_u)== false ){
														 echo "readonly='yes'  value='$dni_u'";
														}
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
												    	<?php if (isset($tel_u)){ echo"<input class='form-control' readonly='yes' type='text' value='$tel_u'required />"; }else{echo"<input class='form-control' readonly='yes' type='text' required />";} ?>
												    </div>
												</div>
												<div class="form-group">
												    <label  class="col-md-4 control-label">Pack:</label>
												    <div class="col-md-7">
												    	<?php echo"<input class='form-control' name='curso' readonly='yes' type='text' value='$nom' required />";?>
												    </div>
												</div>
												<div class="form-group">
												    <label  class="col-md-4 control-label">Curso:</label>
												    <div class="col-md-7">
												    <?php echo"<ul>";
												    		$arrlength = count($xnom_array);
														  for($x = 0; $x < $arrlength; $x++) {
															echo "<li>";
															echo $xnom_array[$x];
															echo "</li>";
															}
															echo "</ul>";
												    ?>
												    </div>
												</div>
												<div class="form-group">
												    <label  class="col-md-4 control-label">Modalidad:</label>
												    <div class="col-md-7">

												     <?php $xmoda = 'P';
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
												<div class="form-group">
												    <label  class="col-md-4 control-label">Localidad: </label>
												   	<div class="col-md-7">
																	<label class="radio-inline col-md-5" value="local"><input type="radio" name="xlocal"  value="local" onclick="if(this.checked){myFunction1()}" checked  required><?php echo $ciudad; ?></label>
														
												    </div>
												</div>
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
											  	</div>
												<div class="form-group">
												    <label  class="col-md-4 control-label">Modalidad de Pago:</label>
												    <div class="col-md-7">
												    	<select class="form-control" name="total" id="mySelect" onchange="myFunction()" required>
															<option value="">Elija uno</option>
															<?php echo "<option value='$resultado:$resultado_dolar:00'>DESCUENTO PROMOCIONAL PACK</option>"; ?>
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
														<button type='submit' class='btn btn-primary'>Pre-Matricula</button>
													
														<button type='reset' class='btn btn-default'>Reset</button>
												    </div>
												 </div>
										</form>
										<div class="form-group">
								    <label  class="col-md-12">Instrucciones de Pre-Matricula</label>
								</div>
								<div class="form-group">
								    <div class="col-md-12">
								    	<ol>
													<li>Realizar Pre-Matricula.</li>
													<li>Depositar en el Banco BCP - Cuenta Corriente 215-2269160-0-24 (deposito, transferencia, agente BCP)</li>
													<li>Escanear el voucher al correo cursos@innovatrainingperu.com junto con su CODIGO DE PRE MATRICULA</li>
													<li>Recibirá un correo de confirmación de matrícula con su usuario y contraseña para la plataforma virtual.</li>
													
										</ol>
								    </div>
							    </div>
								 
								  
								 	
										 
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

							 mySelect.options[0].selected=true;
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
 
 
 