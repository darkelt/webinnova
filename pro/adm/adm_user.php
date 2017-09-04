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
						<h4>Descripcion de Usuarios</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<form class="form-inline" method="post" action="adm_user.php">
								
								<div class="form-group">
								    <label for="buscar">Buscar usuario</label>
								    <input type="text" class="form-control" name="buscar" id="buscar" size="50">
								   
								</div>
							 <div class="form-group">
							    <button type="submit" class="btn btn-primary">Buscar</button>
						    		</div> 
							</form>
							<div class="col-md-12">
							<small id="emailHelp" class="form-text text-muted">Puedes ingresar el nombre o apellidos de usuasio, caso contrario utiliza el ID</small>
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
									<th>ID</th>
									<th>Apellidos y Nombres</th>														</th>
									<th>Email</th>
									<th>Fecha de Nac</th>
									<th>Telefono</th>
									<th>Operador</th>
									<th>Permiso</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
						
						<?php					
			
		if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
											`usuario`.`apell_p_usuario`,
											`usuario`.`apell_m_usuario`,
											`usuario`.`nom_usuario`,
											`usuario`.`email_usuario`,
											`usuario`.`naci_usuario`,
											`usuario`.`tel1_usuario`,
											`usuario`.`tel1_opera_usuario`,
											`usuario`.`permiso_usuario`	
										FROM `u292000437_bdi`.`usuario` WHERE concat_ws(' ', `nom_usuario`, `apell_p_usuario`,`apell_m_usuario`) LIKE '%$xbuscar%' OR `id_usuario`= ? ORDER BY `id_usuario` DESC LIMIT 70;")) {
				$stmt->bind_param('i', $xbus );
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id, $apellp, $apellm, $nom, $email, $dat, $tel1, $opera,$permiso);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>
							<td><a href='adm_perfil.php?xcodid=$id'>$id</a></td>														
							<td><a href='adm_perfil.php?xcodid=$id'>$nom $apellp $apellm </a></td>
							<td>$email</td>
							<td>$dat</td>
							<td>$tel1</td>
							<td>$opera</td>
							<td>$permiso</td>
							<td><a href='adm_user_editar.php?xcod=$id' class='btn btn-default'>Editar</a></td>
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
