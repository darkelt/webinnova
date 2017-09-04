<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){ 

?>
 

<div id="fh5co-team-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<br>
			<br>
			<h2>Matriculas</h2>


<?php
			$c =0;
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
																	`d`.`nom_desc`,
																	`m`.`estado_matricula`,
																	`m`.`operacion_matricula`
															FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
															WHERE  `m`.`id_usuario`=`u`.`id_usuario` AND `m`.`id_grupos`=`g`.`id_grupo` AND `m`.`id_desc`=`d`.`id_desc` AND `id_grupos`= '48' AND `confirma_matricula` = 'M' AND `estado_matricula` = 'a';")) {
										$stmt->execute();
										/* vincular variables a la sentencia preparada */
										$stmt->bind_result($xid,$confir, $xfehora, $xprecio , $xprecio_dolar , $xiduser, $xuser, $xuser_p , $xuser_m, $email, $gmail, $xdes, $xesta , $opera);
										/* obtener valores */										
									while ($stmt->fetch()) {

										$codm[$c] = $xid;
										$iduserss[$c] = $xiduser;
										$emailuser[$c] = $email;
										$array_apll_p[$c] = $xuser_p;

										$c++;
									}


									/* cerrar la sentencia */
									
					}



								
				$arrlength = count($codm);
				for($x = 0; $x < $arrlength; $x++) {

								$idm = $codm[$x] ;
								$iduser = $iduserss[$x];
								$emailu = $emailuser[$x];
								$apll_p = $array_apll_p[$x] ;
						if ($stmt = $mysqli->prepare("SELECT `u`.`pass_moodle`  FROM  `usuario` `u` WHERE `u`.`id_usuario`= ?")){
									// Une “$user_id” al parámetro.
									$stmt->bind_param('i', $iduser);
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
							$temp = $iduser*$temp;
							$temp = $letra.$temp;
							$pass = substr($temp, 0,5);
							$pass_moodle = hash('sha1', $pass);
							$sql = "UPDATE `u292000437_bdi`.`usuario` SET `pass_moodle`='$pass_moodle' WHERE `id_usuario`='$iduser';";
							$stmt = $mysqli->prepare($sql);
							$stmt->execute();
							echo "se cambio de contrseña a $iduser  - ";  
						}

					   	$stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`matricula_moodle` (`id_grupos`, `id_usuario`, `email_usuario`, `id_matricula`) VALUES ('48',?,?,?);");
						$stmt->bind_param("isi", $iduser, $emailu, $idm);
						$stmt->execute();	
						echo " - $iduser se matriculo a 40 <br>";	
				}








		$mysqli->close();


?>	
		
			</div>
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
 
 
 