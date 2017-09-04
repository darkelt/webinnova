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
												<h4>Descripcion de Horario</h4>
												<a href="adm_horario_nuevo.php" class="btn btn-primary" role="button">Nuevo horario</a>
											</div>
												
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Id</th>
																<th>Nombre</th>
																<th>Description</th>
																<th>Acciones</th>
															</tr>
														</thead>
														<tbody>
													
													<?php					
			
		if ($stmt = $mysqli->prepare("SELECT * FROM u292000437_bdi.horario;")) {
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$nom,$des);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>
							<td>$id</td>														
							<td>$nom</td>
							<td>$des</td>
							<td><a href='adm_horario_editar.php?xcod=$id' class='btn btn-default'>Editar</a></td>
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
 
 
 