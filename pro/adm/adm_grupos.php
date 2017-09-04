<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<script language="Javascript">
function preguntar(id){
   eliminar=confirm("¿Deseas eliminar este registro?");
   if (eliminar)
   //Redireccionamos si das a aceptar
     window.location.href = "adm_grupos_grabar.php?tipo=x&xcod="+id; //página web a la que te redirecciona si confirmas la eliminación
else
  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
    alert('No se ha podido eliminar el registro...')
}
</script>

<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

												<div class="container">
													<h4>Descripcion de Grupos</h4>
													<a href="adm_grupos_nuevo.php" class="btn btn-primary" role="button">Nuevo Grupo</a>
													<a href="adm_grupos_img.php" class="btn btn-primary" role="button">Subir Imagen Grupos</a>
												</div>	
												
													<table class="table table-hover">
														<thead>
															<tr>
																<th>Id</th>														</th>
																<th>Nombre de Grupo</th>
																<th>Profesor</th>
																<th>Horario</th>
																<th>Curso</th>
																<th>Precio S/.</th>
																<th>Precio $</th>
																<th>TC</th>
																<th>Fecha de Ini</th>
																<th>Fecha de Fin</th>
																<th>Duracion </th>
																<th>Modalidad</th>
																<th>Acciones</th>	
															</tr>
														</thead>
														<tbody>
													
													<?php					
			
		if ($stmt = $mysqli->prepare("SELECT `grupos`.`id_grupo`,
										    `grupos`.`nom_grupo`,
										    `grupos`.`id_profesor`,
										    `grupos`.`id_horario`,
										    `grupos`.`id_cursos`,
										    `grupos`.`precio_curso_grupo`,
										    `grupos`.`precio_dolar_grupo`,
										    `grupos`.`tipo_cambio_grupo`,
										    `grupos`.`fecha_ini`,
										    `grupos`.`fecha_fin`,
										    `grupos`.`duracion_grupo`,
										    `grupos`.`modalidad_grupo`,
										    `grupos`.`estado_grupo`,
										    `grupos`.`localidad`
										FROM `u292000437_bdi`.`grupos` WHERE `grupos`.`estado_grupo`='A' ORDER BY `localidad` ASC ,`id_cursos` ASC ,  `id_horario` ASC   ;")) {
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($xid,$xnom, $xprof, $xhora, $xcurso, $xprecio, $xprecio_dolar, $tc, $xfechini, $xfechfin, $xdura, $xmoda, $xesta, $local);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "

						<tr>
							<td>$xid</td>														
							<td>$xnom</td>
							<td>$xprof</td>
							<td>$xhora - $local</td>
							<td>$xcurso</td>
							<td>$xprecio</td>
							<td>$xprecio_dolar</td>
							<td>$tc</td>
							<td>$xfechini</td>
							<td>$xfechfin</td>
							<td>$xdura</td>
							<td>$xmoda</td>
							<td><a href='adm_grupos_editar.php?xcod=$xid' class='btn btn-default'>Editar</a><a href='javascript:preguntar($xid)' class='btn btn-danger btn-xs'>Quitar</a></td>
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
 
 
 												