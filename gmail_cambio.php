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

			if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
										    `usuario`.`email_usuario`,
										    `usuario`.`gmail_usuario`
										FROM `u292000437_bdi`.`usuario`;")){
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$email,$gmail);
				/* obtener valores */
				$c= 0;
					while ($stmt->fetch()) {
					
									$xid[$c] = $id;
									$xemail[$c] = $email;
									$xgmail[$c] = $gmail;
									$c++;
										
					}
			}


			$arrlength = count($xid);
			for($x = 0; $x < $arrlength; $x++) {

				$id = $xid[$x];
				$email=$xemail[$x];
				$gmail=$xgmail[$x];

				echo "$id --_> Gmail = $gmail ---> ";
				$findme   = '@';
				$pos = strpos($gmail, $findme);
				if ($pos == true) {
				 /*		$sql = "UPDATE `u292000437_bdi`.`usuario` SET `gmail_usuario`='$email'  WHERE `id_usuario`='$id';";
						$stmt = $mysqli->prepare($sql);
						$stmt->execute();

					echo 'registro actualizado <br>'; */

					echo" $pos --->";
					 $pos = $pos + 10;
					echo substr($gmail, 0, $pos);
					$dato =substr($gmail, 0, $pos);
					$sql = "UPDATE `u292000437_bdi`.`usuario` SET `gmail_usuario`='$dato'  WHERE `id_usuario`='$id';";
						$stmt = $mysqli->prepare($sql);
						$stmt->execute();

					echo 'registro actualizado';
					echo "<br>";
				}
				else{

					echo" No tiene Regustrado un gamail -- <br>";

				}
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
 
 
 