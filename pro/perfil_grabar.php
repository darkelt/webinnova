<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
<?php
	 $xtipo = leerParam("tipo","");
	$id_user = $_SESSION['user_id'];
	$apellp = $_POST['apell_p'];
	$apellm = $_POST['apell_m']; 
	$nom = $_POST['username'];
	$email = $_POST['email'];
	$sex = $_POST['sexo'];
	$pais = $_POST['country'];
	$ciudad = $_POST['state'];
	$direc = $_POST['direc'];
	$dat = $_POST['date'];
	$tel1 = $_POST['telephone1'];
	$opera = $_POST['opera'];
	$grado  = $_POST['grado'];
	$institu  = $_POST['institu'];			
	$dni  = $_POST['dni'];	
	$xcod = leerParam("xcod","");
	$findme   = '@gmail.com';
	$pos = strpos($email , $findme);

	if ($pos == false) {
		$gmail  = $_POST['gmail'];	
	}else{
	$gmail  = $email;
	}		

			$apell_moodle = $apellp." ".$apellm;
			/* cerrar la sentencia */
			
	
											if ($xtipo == "XUPDATE"){
											
												
												$sql = "UPDATE `u292000437_bdi`.`usuario`
													SET
													`apell_p_usuario` = '$apellp',
													`apell_m_usuario` = '$apellm',
													`nom_usuario` = '$nom',
													`email_usuario` = '$email',
													`sexo_usuario` = '$sex',
													`pais_usuario` = '$pais',
													`ciudad_usuario` = '$ciudad',
													`direc_usuario` = '$direc',
													`naci_usuario` = '$dat',
													`tel1_usuario` = '$tel1',
													`tel1_opera_usuario` = '$opera',
													`gr_academ_usuario` = '$grado',
													`centr_estu_usuario` = '$institu',
													`gmail_usuario` = '$gmail',
														`dni_usuario` = '$dni',
														`apell_moodle` ='$apell_moodle'
													WHERE `id_usuario` = '$id_user';";
													
												$stmt = $mysqli->prepare($sql);

												// execute the query
												if($stmt->execute()){

														if(!$xcod==null){
																if (strlen($xcod) > 6){
																	header('Location: matricula_pack.php?xnom='.$xcod);

																}else{
																	header('Location: matricula.php?xcod='.$xcod);

																}
																

														}else{

															if(isset($_SESSION["xurl"])){

																header('Location: '.$_SESSION["xurl"]);

															}else{
																echo " Registro Actualizado correctamente...
										  
														<div>
																<a href='perfil.php' class='btn btn-default'>Perfil</a>
															</div>";

															}
															
														}

														

												}else{
													
													echo "Error updating record: " . $conn->error;
												}
											}

									 $stmt->close();
		
										$mysqli->close();

		
?>								
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
 
 
 