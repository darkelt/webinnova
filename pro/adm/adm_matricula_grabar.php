<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
		include '../gmailmail.php'; 
		$xtipo = leerParam("tipo","");
		$xop = leerParam("op","");
										 
		if ($xtipo == "VALIDAR"){
		  	$xcod  = leerParam("xcod","");
		  	$xnom  = leerParam("xnom","");
		  	$xnopera  = leerParam("nopera","");
	      	$xfecha = date("Y-m-d H:i:s");
													
			$sql = "UPDATE `u292000437_bdi`.`matricula`SET
					`confirma_matricula` = 'M',
					`operacion_matricula` ='$xnopera',
					`fecha_conf_matricula`= '$xfecha'
					WHERE `id_matricula` = $xcod;";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();

			if ($stmt = $mysqli->prepare("SELECT `m`.`fecha_matricula`,
												`m`.`pago_matricula`,
												`m`.`id_usuario`,
												`u`.`nom_usuario`,
												`u`.`apell_p_usuario`,
												`u`.`apell_m_usuario`,
												`u`.`email_usuario`,
												`u`.`gmail_usuario`,
												`m`.`id_grupos`,
												`g`.`nom_grupo`,
												`g`.`fecha_ini`,
												`g`.`modalidad_grupo`,
                                                `h`.`nom_horario`,
												`h`.`desscripcion`,
                                                `c`.`id_cursos`
                                                FROM `matricula` `m`, `grupos` `g`, `usuario` `u` , `horario` `h` , `cursos` `c` 
												WHERE `m`.`id_usuario`=`u`.`id_usuario`
												AND  `m`.`id_grupos`=`g`.`id_grupo`
                                                AND  `g`.`id_cursos`=`c`.`id_cursos`	
                                                AND  `g`.`id_horario` = `h`.`id_horario` 
												AND `m`.`id_matricula`=? LIMIT 1;")){
				// Une “$user_id” al parámetro.
				$stmt->bind_param('i', $xcod);
				$stmt->execute();   // Ejecuta la consulta preparada.
				$stmt->store_result();
				// Si el usuario existe, obtiene las variables del resultado.
				$stmt->bind_result($fech_matri,$pago,$id_u,$nom_u, $apll_p, $apll_m, $email_u, $gmail,$id_g, $nom_g, $fech_ini ,$moda ,$nom_horario, $des_horario, $id_cursos);
				$stmt->fetch();    
			}
			if($moda == 'V'){
				if ($stmt = $mysqli->prepare("SELECT `idmatricula_moodle` FROM `u292000437_bdi`.`matricula_moodle` WHERE `matricula_moodle`.`id_usuario` = ? AND `matricula_moodle`.`id_cursos` = ? ;;")) {
					$stmt->bind_param("ii",$id_u, $id_cursos);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($id_m);
					$stmt->fetch();
					$existe_matricula=$stmt->num_rows;																				
				}  
				if ($existe_matricula==0){
					if ($stmt = $mysqli->prepare("SELECT `u`.`pass_moodle`  FROM  `usuario` `u` WHERE `u`.`id_usuario`= ? ")){
						// Une “$user_id” al parámetro.
						$stmt->bind_param('i', $id_u);
						$stmt->execute();   // Ejecuta la consulta preparada.
						$stmt->store_result();
						// Si el usuario existe, obtiene las variables del resultado.
						$stmt->bind_result($pass_moodle);
						$stmt->fetch();    
					}
					if($pass_moodle == null){
						$apll_p = strtoupper($apll_p);
						$letra =substr($apll_p,0,1);
						$temp = strlen($apll_p);
						$temp = $id_u*$temp;
						$temp = $letra.$temp;
						$pass = substr($temp, 0,5);
						$pass_moodle = hash('sha1', $pass);
						$sql = "UPDATE `u292000437_bdi`.`usuario` SET `pass_moodle`='$pass_moodle' WHERE `id_usuario`='$id_u';";
						$stmt = $mysqli->prepare($sql);
						$stmt->execute();
					}
					$stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`matricula_moodle` (`id_grupos`, `id_usuario`, `email_usuario`, `id_matricula`, `id_cursos`) VALUES (?,?,?,?,?);");
					$stmt->bind_param("iisii",$id_g, $id_u, $email_u, $xcod, $id_cursos);
					$stmt->execute();
				}else{
					echo " <br><br><br><br><br><div class='alert alert-danger'><h1>Este Usuario tiene una matricula en el curso $id_cursos </h1></div>";
				}
			}
			if($xop == 'si'){
				$valor2=correoMatricula($fech_matri,$pago,$id_u,$nom_u, $apll_p, $apll_m, $email_u, $id_g, $nom_g, $fech_ini ,$moda ,$nom_d,$gmail , $nom_horario, $des_horario);
				if($valor2 == true){	
					$stmt->close();
					$mysqli->close();
					echo"<br><br><br><br><br><br><br><br><br><br>Se envio el correo CORRECTO!!.</br> <a href='adm_matricula.php' class='btn btn-default'>Matriculas</a> ";
				}elseif ($valor2 == false){
					echo "</br></br></br>Error al enviar: " . $mail­>ErrorInfo;	
				}
			}else{
				echo"<br><br><br><br><br><br><br><br><br><br>No se Envio Correo de Confirmacion de Matricula</br> <a href='adm_matricula.php' class='btn btn-default'>Matriculas</a> ";
			}
		}
		if($xtipo == "x"){
			$xcod  = leerParam("xcod","");
			$sql = "UPDATE `u292000437_bdi`.`matricula`SET `estado_matricula` = 'x' WHERE `id_matricula` = $xcod;";
			$stmt = $mysqli->prepare($sql);
			$stmt->execute();
			bitacora($mysqli, $sql);
			header('Location: adm_matricula.php');	
		}else{
			echo "No se envio tipo de evento ";
		}	
							
 	}else { 
		header('Location: ../../login.php?error=2');
	} 
}else{ 
	header('Location: ../../login.php?error=3');
} 
 include 'footer.php';?>		
 