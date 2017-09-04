<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
		
		$id_user = $_SESSION['user_id'];
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

			header('Location: perfil_editar.php');

		}
?>

		<!-- end:fh5co-header -->
		<aside>
			<img src="../images/sorteo.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
			<br>
			<div  class="container">
				<div class="row">
					<iframe src="https://docs.google.com/a/innovatrainingperu.com/forms/d/e/1FAIpQLSeXp0pTgwYisYoxdNFS5p3R2nmMXu1QCULJ99KcIPhIinh5lg/viewform?embedded=true" width="100%" height="1000" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
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