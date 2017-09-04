<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){ 

		include "gmailmail.php";
?>
 

<div id="fh5co-team-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
			<br>
			<br>
			<h2>ENVIAR CORREOS</h2>


<?php


	$xuser =1002;
	$xcurso = "Prueba de correo electronicao";
	$pagom = 1999;
	$pagom_dolar = 2334; 
 	$xmoda = "viruta";
 	$xfini = "10-10-10";
 	$xlocal = "local";
 	$iddes = 1;

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
														`d`.`nom_desc` FROM `matricula` `m`, `grupos` `g`, `usuario` `u`, `descuentos` `d`
														WHERE `m`.`id_usuario`=`u`.`id_usuario`	AND `m`.`id_grupos`=`g`.`id_grupo` AND  `m`.`id_desc`=`d`.`id_desc` 
																								AND `u`.`id_usuario`= ?  AND `g`.`id_grupo`= 29 LIMIT 1")){
												// Une “$user_id” al parámetro.
												$stmt->bind_param('i', $xuser);
												$stmt->execute();   // Ejecuta la consulta preparada.
												$stmt->store_result();
												// Si el usuario existe, obtiene las variables del resultado.
												$stmt->bind_result($fech_matri, $pago ,$id_u , $nom_u, $apll_p, $apll_m, $email_user, $gmail,$id_g, $nom_g, $fech_ini ,$xmoda ,$nom_d);
												$stmt->fetch();    
						}

	$xnomcomple = $nom_u." ".$apll_p." ".$apll_m;

	echo "<br> <br><br><br><br>$fech_matri, $pago ,$id_u , $nom_u, $apll_p, $apll_m, $email_user, $gmail,$id_g, $nom_g, $fech_ini ,$xmoda ,$nom_d ";
	$valor=correoConfirmacion($email_user, $xnomcomple, $xuser , $xcurso, $pagom, $pagom_dolar, $xmoda, $xfini, $xlocal, $iddes);
	if($valor == true){
		
		echo "se envio correctamente el correo de preconfirmacion <br>";

	}else{
		echo "Error al enviar: ";	
	}

	$fech_ini = "10-14-24";
	$nom_d = "nombre de descuento";
	$nom_horario = "nombre del horario";
	$des_horario= "descripcion del horario";
	$moda= 'V';
	$valor2=correoMatricula($fech_matri ,$pagom ,$xuser, $nom_u, $apll_p, $apll_m, $email_user, $id_g, $nom_g, $fech_ini ,$moda ,$nom_d ,$gmail , $nom_horario, $des_horario);
 
	echo "$fech_matri ,$pagom ,$xuser, $nom_u, $apll_p, $apll_m, $email_user, $id_g, $nom_g, $fech_ini ,$xmoda ,$nom_d ,$gmail , $nom_horario, $des_horario <br>"; 
	if($valor2 == true){
		echo"<br>Se envio el correo CORRECTO!!.</br>  ";
	}elseif ($valor2 == false){
		echo "</br></br></br>Error al enviar: ";	
	}
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
 