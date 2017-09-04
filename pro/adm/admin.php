<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">			
	<div class="container">
					<?php include 'header_adm.php' ?>
						<div class="row">
								<div class="container">
												<h4>Descripcion de Cursos</h4>
												<a href="adm_cursos_nuevo.php" class="btn btn-primary" role="button">Nuevo Curso</a>
								</div>			

											<!-- table puro -->
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Name</th>														</th>
																<th>Description</th>
																<th>Acciones</th>
															</tr>
														</thead>
														<tbody>
													
													<?php					
			$xcodid = leerParam("xcod","");
			$cont= 2;
		if ($stmt = $mysqli->prepare("
				SELECT `cursos`.`id_cursos`,
						`cursos`.`nom_cursos`,
						`cursos`.`nom_corto_cursos`,
						`cursos`.`des_cursos`,
						`cursos`.`img_cursos`
				FROM u292000437_bdi.cursos")) {
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$nom, $nomcorto, $des, $img);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>
							<td>$nom</td>														
							<td>$des</td>
							<td><a href='adm_cursos_editar.php?xcod=$id' class='btn btn-default'>Editar</a></td>
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
 
 
 