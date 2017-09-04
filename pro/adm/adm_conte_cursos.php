<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
	$xnomc = leerParam("xnom","");
	$xcodc = leerParam("xcod","");				?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
	<div class="container">
					<?php include 'header_adm.php' ?> 
						<div class="row">			
								<div class="container">
												<h4><?php echo"$xnomc"; ?></h4>
												<?php echo "<a href='adm_conte_cursos_nuevo.php?xnomc=$xnomc&xcodc=$xcodc' class='btn btn-primary' role='button'>Nuevo Tema</a>"; ?>
								</div>	
											
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Itm</th>														</th>
																<th>Description</th>
																<th>Acciones</th>
															</tr>
														</thead>
														<tbody>
													
													<?php	

			
		if ($stmt = $mysqli->prepare("
				SELECT `contenido_cursos`.`id_contenido_cursos`,
						`contenido_cursos`.`primer_contenido_cursos`
						FROM `u292000437_bdi`.`contenido_cursos`
						WHERE `contenido_cursos`.`id_cursos` = ?;")) {
				$stmt->bind_param('i', $xcodc);
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$des);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>
							<td>$id</td>														
							<td>$des</td>
							<td><a href='adm_conte_cursos_editar.php?xcod=$id' class='btn btn-default'>Editar</a></td>
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
