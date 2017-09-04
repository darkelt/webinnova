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
     window.location.href = "adm_pack_grabar.php?tipo=x&xcod="+id; //página web a la que te redirecciona si confirmas la eliminación
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
						<a href="adm_pack_nuevo.php" class="btn btn-primary" role="button">Nuevo Pack</a>
					</div>	
												
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Id</th>														</th>
								<th>Nombre</th>
								<th>Grupo</th>
								<th>Localidad</th>
								<th>Fecha Ini</th>
								<th>Modali</th>
								<th>Acciones</th>
						</thead>
						<tbody>
													
<?php

	if ($stmt = $mysqli->prepare("SELECT `pack`.`id_pack`,
										    `pack`.`nom_pack`,
										    `pack`.`factor_pack`,
										    `pack`.`horas_pack`,
										    `pack`.`fecha_ini`,
										    `pack`.`estado`
										FROM `pack` WHERE `pack`.`estado` = 'A';")) {
			$stmt->execute();
				/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xid,$xnom, $factor,$horas ,$fecha_ini , $estado);
				/* obtener valores */
			$i = 0;	
			while ($stmt->fetch()) {
				$array_id[$i] = $xid ; 
				$array_xnom[$i] = $xnom ; 
				$array_factor[$i] = $factor ; 
				$array_horas[$i] = $horas ; 
				$array_fecha_ini[$i] = $fecha_ini ;
				$array_estado[$i] = $estado ;
				$i++;
			}
	}	


	$cont = count($array_id);
	for($i = 0 ; $i < $cont; $i++ ){
				echo "<tr>
								<td>$array_id[$i]</td>	
								<td width='200'>$array_xnom[$i]</td>
								<td><table class='table table-bordered'>
					";
			if ($stmt = $mysqli->prepare("SELECT
									`grupos`.`nom_grupo`,
									`grupos`.`localidad`,
									`detalle_pack`.`id_grupo`,
									`grupos`.`modalidad_grupo`,
									`grupos`.`precio_curso_grupo`
								FROM `detalle_pack`, `pack`, `grupos` 
								WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
								AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo` 
								AND `pack`.`id_pack`= ?;")) {
				$stmt->bind_param('i', $array_id[$i]);
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($xnom_g,$xloca, $id_g, $moda, $precio_curso_grupo);
				/* obtener valores */
				$temp = "";
			while ($stmt->fetch()) {
				$soles	= $precio_curso_grupo - ($precio_curso_grupo*$array_factor[$i]);
				echo " 
						<tr >
					      <td colspan='4'>$xnom_g </td>
					    </tr>
					    <tr>
					      <td>$id_g</td>
					      <td>S./ $precio_curso_grupo</td>
					      <td>$moda </td>
					      <td>$array_factor[$i] -> S/. $soles</td>
					    </tr>
				";
			}

			/* cerrar la sentencia */
			$stmt->close();
		}
		echo "	</table></td><td>$xloca</td>
								<td>$array_fecha_ini[$i]</td>
								<td>$array_estado[$i] -  $moda </td>
								<td><a href='adm_pack_editar.php?xcod=$array_id[$i]' class='btn btn-default'>Editar</a><br><a href='javascript:preguntar($array_id[$i])' class='btn btn-danger btn-xs'>Quitar</a></td>
						</tr>
					";		

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
 
 
 												