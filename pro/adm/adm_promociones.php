<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
			?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
					<div class="container">
						<h4>Inscritos a la promoción</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<form class="form-inline" method="post" action="adm_promociones.php">
								
								<div class="form-group">
								    <label for="buscar">Buscar inscrito</label>
								    <input type="text" class="form-control" name="buscar" id="buscar" size="50">
								   
								</div>
							 <div class="form-group">
							    <button type="submit" class="btn btn-primary">Buscar</button>
						    		</div> 
							</form>
							<div class="col-md-12">
							<small id="emailHelp" class="form-text text-muted">Puedes ingresar el nombre o apellidos del inscrito</small>
								<?php 
						$xbuscar = leerParam("buscar","");
					$xbus = leerParam("buscar","");

					echo "<h3>$xbus</h3>";?>
							</div>
						</div>
					</div>		
				

				




						<table class="table table-striped">
							<thead>
								<tr>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Nombres</th>
									<th>Email</th>
									<th>Direccion</th>
									<th>Telefono</th>
									<th>Alumno Innova</th>
									<th>Custo que le gustaria</th>
									<th>Sugerencias</th>
								</tr>
							</thead>
							<tbody>
						
						<?php					
			
		if ($stmt = $mysqli->prepare("SELECT 
											`promociones`.`apellidopaterno`,
											`promociones`.`apellidomaterno`,
											`promociones`.`nombres`,
											`promociones`.`email`,
											`promociones`.`direccion`,
											`promociones`.`telefono`,
											`promociones`.`alumnoinnova`,
											`promociones`.`cursogustaria`,
											`promociones`.`sugerencias`
										FROM `u292000437_bdi`.`promociones` WHERE concat_ws(' ', `nombres`, `apellidopaterno`,`apellidomaterno`) LIKE '%$xbuscar%' ORDER BY `apellidopaterno` DESC;")) {
				//$stmt->bind_param('i', $xbus );
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($apellidopaterno, $apellidomaterno, $nombres, $email, $direccion, $telefono, $alumnoinnova,$cusogustaria,$sugerencias);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>
							<td>$apellidopaterno</td>
							<td>$apellidomaterno</td>
							<td>$nombres</td>
							<td>$email</td>
							<td>$direccion</td>
							<td>$telefono</td>
							<td>".($alumnoinnova=='y' ? 'si' : 'no')."</td>
							<td>$cusogustaria</td>
							<td>$sugerencias</td>
							
					  </tr>";
			}

			/* cerrar la sentencia */
			$stmt->close();
		}
		$mysqli->close();
?>
														
														</tbody>
													</table>
											
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
