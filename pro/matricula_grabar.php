<?php include 'header.php';
if (login_check($mysqli) == true ){
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){ 
		echo'<div id="fh5co-team-section">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
						<br>
						<br>
						<h2>Matriculas</h2>';

		include 'gmailmail.php'; 
		$xtipo = leerParam("tipo","");
		$xdni  = leerParam("dni","");
		$xgmail  = leerParam("gmail",null);
		$xconfirm  = leerParam("confirm","");
		$xuser  = leerParam("user","");
		$xgrupo  = leerParam("grupo","");
		$email_user  = leerParam("email_user","");
		$xtotal  = leerParam("total","");
		$xlocal  = leerParam("xlocal","");
		list($pagom, $pagom_dolar , $iddes) = explode(":", $xtotal);
		$xfecha = date("Y-m-d H:i:s");
	 	$xnomcomple  = leerParam("nomcomple","");
	  	$xnomcomple = strtoupper($xnomcomple);
	  	$xcurso  = leerParam("curso","");
	  	$xcurso= strtoupper($xcurso);
	  	$xfini  = leerParam("fini","");
	  	$xmoda  = leerParam("moda","");
	  	$horario  = leerParam("horario","");
	  	$xmoda = strtoupper($xmoda);

		if (isset($xgmail)){
			$sql = "UPDATE `u292000437_bdi`.`usuario` SET `gmail_usuario`='$xgmail', `dni_usuario`='$xdni' WHERE `id_usuario`=$xuser;";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
		}else{
			$findme   = '@gmail.com';
			$pos = strpos($email_user, $findme);
			if ($pos == true) {
				$sql = "UPDATE `u292000437_bdi`.`usuario` SET `gmail_usuario`='$email_user' , `dni_usuario`='$xdni' WHERE `id_usuario`='$xuser';";
				$stmt = $mysqli->prepare($sql);
				$stmt->execute();
			}
		}
		if ($xtipo == "PACK_P"){



			$horario_prefe = leerParam("horario","");
			$id_pack = leerParam("id_pack","");
			$xuser = $xuser;
			if ($stmt = $mysqli->prepare("SELECT `matricula`.`id_matricula` , `matricula`.`estado_matricula` , `pack`.`nom_pack`
FROM `matricula`, `pack` WHERE `matricula`.`id_pack`= `pack`.`id_pack`  AND `pack`.`id_pack` = ? AND `matricula`.`id_usuario` = ? ;")) {
				$stmt->bind_param("ii", $id_pack, $xuser);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($id_m, $est_m, $nom);
				$stmt->fetch();
				$grup=$stmt->num_rows;																				
			}	
			if($grup == 0){


				$stmt = $mysqli->prepare("SELECT`pack`.`nom_pack`,  
												`pack`.`factor_pack`,
											    `pack`.`horas_pack`,
											    `pack`.`fecha_ini`
											FROM `u292000437_bdi`.`pack` WHERE `pack`.`id_pack` = ? AND `pack`.`estado`= 'A' ;");
				$stmt->bind_param("i", $id_pack );
				$stmt->execute();
	            $stmt->bind_result($nom_pack, $factor_pack,$horas, $fecha);
	            $stmt->fetch();
				$stmt->close();	

				if($fecha=='0001-01-01'){
					$fecha =  "Acceso inmediato";
				}
				if ($stmt = $mysqli->prepare("SELECT  `grupos`.`id_grupo`,
													`grupos`.`precio_curso_grupo`,
                                                    `grupos`.`precio_dolar_grupo`
												FROM `detalle_pack`, `pack`, `grupos` ,  `cursos`
												WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
												AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
												AND  `grupos`.`id_cursos` = `cursos`.`id_cursos`
												AND `pack`.`id_pack` =  ? ;")) {
					$stmt->bind_param('i', $id_pack);
					$stmt->execute();
					/* vincular variables a la sentencia preparada */
					$stmt->bind_result($id_grupo, $precio ,$precio_dolar);
					$c=0;
					/* obtener valores */
					while ($stmt->fetch()) {
						$id_array[$c]  = $id_grupo;
						$precio_array[$c] =  $precio;
						$precio_dolar_array[$c] =  $precio_dolar;

						$c++;
					}
					$stmt->close();
					$pagoms =0;
					$pagomd = 0;
					$arrlength = count($id_array);
					for($x = 0; $x < $arrlength; $x++) {
							
						if ($xlocal=="local"){

							$pagom = $precio_array[$x] -($factor_pack * $precio_array[$x]);
							$pagoms = $pagoms + $pagom;
							$stmt = $mysqli->prepare("INSERT INTO `matricula`
												(`confirma_matricula`,
												`fecha_matricula`,
												`pago_matricula`,
												`id_usuario`,
												`id_grupos`,
												`id_pack`,
												`horario_prefe`,
												`estado_matricula`)
								VALUES('x',?,?,?,?,?,?,'a');");
							$stmt->bind_param("sdiiis", $xfecha, $pagom, $xuser, $id_array[$x], $id_pack, $horario_prefe);
							$stmt->execute();

						}
						if ($xlocal=="nolocal"){
							$pagom_d = $precio_dolar_array[$x] -($factor_pack * $precio_dolar_array[$x]);
							$pagomd = $pagomd + $pagom_d;
							$stmt = $mysqli->prepare("INSERT INTO `matricula`
												(`confirma_matricula`,
												`fecha_matricula`,
												`pago_dolar_matricula`,
												`id_usuario`,
												`id_grupos`,
												`id_pack`,
												`horario_prefe`,
												`estado_matricula`)
								VALUES('x',?,?,?,?,?,?,'a');");
							$stmt->bind_param("sdiiis", $xfecha, $pagom_d, $xuser, $id_array[$x], $id_pack, $horario_prefe);
							$stmt->execute();
						}

					}

					if ($xlocal == "local"){
					 echo " <div class='uno'>
						 <form method='post' action='o-pago.php'>
								<table class='alt1'>
									  <tr>
										<td  colspan='2' class='op'>
										<div class='opago'><img src='../images/logo.jpg' alt='' width='200' height='100'/></div>
										<h1 ><br>ORDEN DE PAGO<br>$xnomcomple<h1><br><font size='25'>$xuser</font></td>
									  
									  <tr>
										<td ><b class='op'>CUENTA BCP:</b> 215-2269160-0-24 </td>
										<td ><b class='op'>CURSO:</b> $nom_pack</td> 
									  </tr>
									  <tr>
										<td ><b class='op'>MONTO:</b> S/. $pagoms </td>
										<td ><b class='op'>MODALIDAD:</b>$xmoda</td> 
									  </tr>
									   <tr>
										<td ><b class='op'>CODIGO DE MATRICULA: </b>$xuser</td>
										<td ><b class='op'>INICIO:</b> $fecha </td> 
									  </tr>
									  
									</table>
							
									<input type='hidden' name='pnom' value= '$xnomcomple'>
									<input type='hidden' name='puser' value='$xuser'>
									<input type='hidden' name='pcurso' value='$nom'>
									<input type='hidden' name='ppagon' value='$pagoms'>
									<input type='hidden' name='pmoda' value='$xmoda'>
									<input type='hidden' name='pfini' value='$fecha'>
									<input type='hidden' name='pfecha' value='$xfecha'>
									<input type='hidden' name='xlocal' value='$xlocal'>
									<!-- Campo que hace la llamada al script que genera la factura -->
									<input type='hidden' name='generar_factura' value='true'>
									<button class='btn btn-default' type='submit'>DESCARGAR ORDEN DE PAGO</button>
								</form>														
									<ol>
										<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
										<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.</li>
										<li>Recibirá un correo de confirmación de matricula.</li><br>
											
									</ol>	
								</div>";
					}else{

						echo "<form method='post' action='o-pago.php'>
									<table class='alt1'>
										  <tr>
											<td  colspan='2' class='op'>
											<div class='opago'><img src='../images/logo.jpg' alt='' width='200' height='100'/></div>
											<h1 ><br>ORDEN DE PAGO<br>$xnomcomple<h1><br><font size='25'>$xuser</font></td>
										  
										  <tr>
											<td ><b class='op'>ENVIO:</b> Western Union/Money G</td>
											<td ><b class='op'>CURSO:</b> $nom_pack</td> 
										  </tr>
										  <tr>
											<td ><b class='op'>MONTO:</b> $. $pagomd </td>
											<td ><b class='op'>MODALIDAD:</b> $xmoda</td> 
										  </tr>
										   <tr>
											<td ><b class='op'>CODIGO DE MATRICULA: </b>$xuser</td>
											<td ><b class='op'>INICIO:</b> $fecha </td> 
										  </tr>
										  
										</table>
								
										<input type='hidden' name='pnom' value= '$xnomcomple'>
										<input type='hidden' name='puser' value='$xuser'>
										<input type='hidden' name='pcurso' value='$nom_pack'>
										<input type='hidden' name='ppagon' value='$pagoms'>
										<input type='hidden' name='ppagon_dolar' value='$pagomd'>
										<input type='hidden' name='pmoda' value='$xmoda'>
										<input type='hidden' name='pfini' value='$fecha'>
										<input type='hidden' name='pfecha' value='$xfecha'>
										<input type='hidden' name='xlocal' value='$xlocal'>
										<!-- Campo que hace la llamada al script que genera la factura -->
										<input type='hidden' name='generar_factura' value='true'>
										<button class='btn btn-default' type='submit'>DESCARGAR ORDEN DE PAGO</button>
							</form>				
							<ol>
								<h3>Datos:</h3>
								   <b>Nombre:</b> Cynthia Lizbeth Vilca Llerena (Asesora de Capacitación) <br/>
								   <b>DNI:</b> 73076089 <br/>
								   <b>Dirección: </b> Calle Ibáñez 102, Urbanización María Isabel Cercado- Arequipa - Perú<br/>
								   <b>Teléfono:</b> 993655595 <br/>
								<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
								<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.</li>
								<li>Recibirá un correo de confirmación de matricula.</li><br>
							</ol>";


					}

					$valor=correoConfirmacion($id_pack ,$email_user, $xnomcomple, $xuser , $nom_pack, $pagoms, $pagomd, $xmoda, $fecha, $xlocal, $iddes );
					if($valor == true){
					}else{
						echo "Error al enviar: ";	
					}

				}


			}else{
				echo "<div class='uno'>
						<p>Usd. Ya esta matriculado en <b>$nom</b> 
							<ol>
								<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
								<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.</li>
								<li>Recibirá un correo de confirmación de matricula.</li>
												
							</ol>	
					</div>";	
			}



		}
		if ($xtipo == "INSERTS"){
			if ($stmt = $mysqli->prepare("SELECT `matricula`.`id_matricula` , `matricula`.`estado_matricula`
													FROM `u292000437_bdi`.`matricula`
													 WHERE `id_usuario`= ? AND `id_grupos` = ?;")) {
															$stmt->bind_param("ii",$xuser, $xgrupo);
															$stmt->execute();
															$stmt->store_result();
															$stmt->bind_result($id_m, $est_m);
															$stmt->fetch();
															$grup=$stmt->num_rows;																				
			}  
			if($grup== 0 || $est_m == 'x'){
				if ($xlocal=="local"){
				   $stmt = $mysqli->prepare("
					 INSERT INTO `u292000437_bdi`.`matricula`
									(`confirma_matricula`,
									`fecha_matricula`,
									`pago_matricula`,
									`id_usuario`,
									`id_grupos`,
									`id_desc`,
									`horario_prefe`,
									`estado_matricula`)
					VALUES(?,?,?,?,?,?,?,'a');");
					$stmt->bind_param("ssdiiis",$xconfirm, $xfecha, $pagom, $xuser, $xgrupo, $iddes, $horario);
					$stmt->execute();
					if($xgrupo == 345 || $xgrupo  == 346){

				    	$cuenta = "215-22953949002 (Ramiro Ayala)";
				    }else{
				    	$cuenta = "215-2269160-0-24";

				    }

					 echo "
						 <div class='uno'>
						 <form method='post' action='o-pago.php'>
								<table class='alt1'>
									  <tr>
										<td  colspan='2' class='op'>
										<div class='opago'><img src='../images/logo.jpg' alt='' width='200' height='100'/></div>
										<h1 ><br>ORDEN DE PAGO<br>$xnomcomple<h1><br><font size='25'>$xuser</font></td>
									  
									  <tr>
										<td ><b class='op'>CUENTA BCP:</b>".$cuenta."</td>
										<td ><b class='op'>CURSO:</b> $xcurso</td> 
									  </tr>
									  <tr>
										<td ><b class='op'>MONTO:</b> S/. $pagom </td>
										<td ><b class='op'>MODALIDAD:</b> $xmoda</td> 
									  </tr>
									   <tr>
										<td ><b class='op'>CODIGO DE MATRICULA: </b>$xuser</td>
										<td ><b class='op'>INICIO:</b> $xfini </td> 
									  </tr>
									  
									</table>
							
									<input type='hidden' name='pnom' value= '$xnomcomple'>
									<input type='hidden' name='puser' value='$xuser'>
									<input type='hidden' name='pcurso' value='$xcurso'>
									<input type='hidden' name='idgrupo' value='$xgrupo'>
									<input type='hidden' name='ppagon' value='$pagom'>
									<input type='hidden' name='pmoda' value='$xmoda'>
									<input type='hidden' name='pfini' value='$xfini'>
									<input type='hidden' name='pfecha' value='$xfecha'>
									<input type='hidden' name='xlocal' value='$xlocal'>
									<!-- Campo que hace la llamada al script que genera la factura -->
									<input type='hidden' name='generar_factura' value='true'>
									<button class='btn btn-default' type='submit'>DESCARGAR ORDEN DE PAGO</button>
								</form>														
									<ol>
												<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
												<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingcenter.com, indicando su código de matrícula y datos personales.</li>
												<li>Si Ud elige el dcto <b>corporativo</b>, adjuntar a voucher escaneado los codigos de las otras dos personas.</li>
												<li>Recibirá un correo de confirmación de matricula.</li><br>
											
											</ol>	
								</div>		
								";



				}
				if ($xlocal=="nolocal"){

						   		 $stmt = $mysqli->prepare("
								 INSERT INTO `u292000437_bdi`.`matricula`
												(`confirma_matricula`,
												`fecha_matricula`,
												`pago_dolar_matricula`,
												`id_usuario`,
												`id_grupos`,
												`id_desc`,
												`estado_matricula`)
								VALUES(?,?,?,?,?,?,'a');");
								$stmt->bind_param("ssdiii",$xconfirm, $xfecha, $pagom_dolar, $xuser, $xgrupo, $iddes);
								$stmt->execute();
								echo " <div class='uno'>
						 		<form method='post' action='o-pago.php'>
								<table class='alt1'>
									  <tr>
										<td  colspan='2' class='op'>
										<div class='opago'><img src='../images/logo.jpg' alt='' width='200' height='100'/></div>
										<h1 ><br>ORDEN DE PAGO<br>$xnomcomple<h1><br><font size='25'>$xuser</font></td>
									  
									  <tr>
										<td ><b class='op'>ENVIO:</b> Western Union/Money G</td>
										<td ><b class='op'>CURSO:</b> $xcurso</td> 
									  </tr>
									  <tr>
										<td ><b class='op'>MONTO:</b> $. $pagom_dolar </td>
										<td ><b class='op'>MODALIDAD:</b> $xmoda</td> 
									  </tr>
									   <tr>
										<td ><b class='op'>CODIGO DE MATRICULA: </b>$xuser</td>
										<td ><b class='op'>INICIO:</b> $xfini </td> 
									  </tr>
									  
									</table>
							
									<input type='hidden' name='pnom' value= '$xnomcomple'>
									<input type='hidden' name='puser' value='$xuser'>
									<input type='hidden' name='pcurso' value='$xcurso'>
									<input type='hidden' name='idgrupo' value='$xgrupo'>
									<input type='hidden' name='ppagon' value='$pagom'>
									<input type='hidden' name='ppagon_dolar' value='$pagom_dolar'>
									<input type='hidden' name='pmoda' value='$xmoda'>
									<input type='hidden' name='pfini' value='$xfini'>
									<input type='hidden' name='pfecha' value='$xfecha'>
									<input type='hidden' name='xlocal' value='$xlocal'>
									<!-- Campo que hace la llamada al script que genera la factura -->
									<input type='hidden' name='generar_factura' value='true'>
									<button class='btn btn-default' type='submit'>DESCARGAR ORDEN DE PAGO</button>
								</form>														
										
											<ol>
												<h3>Datos:</h3>
												   <b>Nombre:</b> Cynthia Lizbeth Vilca Llerena (Asesora de Capacitación) <br/>
												   <b>DNI:</b> 73076089 <br/>
												   <b>Dirección: </b> Calle Ibáñez 102, Urbanización María Isabel Cercado- Arequipa - Perú<br/>
												   <b>Teléfono:</b> 993655595 <br/>
												<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
												<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingcenter.com, indicando su código de matrícula y datos personales.</li>
												<li>Si Ud elige el dcto <b>corporativo</b>, adjuntar a voucher escaneado los codigos de las otras dos personas.</li>
												<li>Recibirá un correo de confirmación de matricula.</li><br>
												
											</ol>	
								</div>";
 				}						
				$valor=correoConfirmacion($xgrupo, $email_user, $xnomcomple, $xuser , $xcurso, $pagom, $pagom_dolar, $xmoda, $xfini, $xlocal, $iddes );
				if($valor == true){
				}else{
					echo "error al enviar correo electronico";	
					echo "$xgrupo, $email_user, $xnomcomple, $xuser , $xcurso, $pagom, $pagom_dolar, $xmoda, $xfini, $xlocal, $iddes";
				}	
				
			}else{
				if ($stmt = $mysqli->prepare("SELECT  `matricula`.`fecha_matricula`, `matricula`.`pago_matricula`, `matricula`.`pago_dolar_matricula` FROM `u292000437_bdi`.`matricula`
													 WHERE `id_usuario`=?;")){
					$stmt->bind_param("i",$xuser);
					$stmt->execute();   // Ejecuta la consulta preparada.
					$stmt->store_result();
					$stmt->bind_result($p_fecha ,$p_matricula , $p_matricula_dolar);
					$stmt->fetch();
						
				}	
				echo "<div class='uno'>
							<p>Usd. Ya esta matriculado en <b>$xcurso</b> en la fecha: <b> $p_fecha </b></p>
							<form method='post' action='o-pago.php'>
								<input type='hidden' name='pnom' value= '$xnomcomple'>
								<input type='hidden' name='puser' value='$xuser'>
								<input type='hidden' name='pcurso' value='$xcurso'>
								<input type='hidden' name='ppagon' value='$p_matricula'>
								<input type='hidden' name='ppagon_dolar' value='$p_matricula_dolar'>
								<input type='hidden' name='pmoda' value='$xmoda'>
								<input type='hidden' name='pfini' value='$xfini'>
								<input type='hidden' name='pfecha' value='$p_fecha'>
								<input type='hidden' name='xlocal' value='$xlocal'>
								<!-- Campo que hace la llamada al script que genera la factura -->
								<input type='hidden' name='generar_factura' value='true'>
								<button class='btn btn-default' type='submit'>DESCARGAR ORDEN DE PAGO</button>
							</form>														
							<ol>
								<b>Recuerde seguir los siguientes pasos para confirmar su matrícula:</b>
								<li>Enviar su boucher de pago escaneado al correo: cursos@innovatrainingcenter.com, indicando su código de matrícula y datos personales.</li>
								<li>Recibirá un correo de confirmación de matricula.</li>
							</ol>	
				</div>";		
			}
	/****************************************************/
			$stmt->close();
			$mysqli->close();
		}
?>	
		
			</div>
		</div>
	</div>
</div>


<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
<?php 
	}else { 
		header('Location: ../login.php?error=2');
	} 
} else { 
	header('Location: ../login.php?error=3');
} 
 include 'footer.php';?>		
 
 
 