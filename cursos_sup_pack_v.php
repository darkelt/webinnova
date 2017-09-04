 <?php 
include 'header.php';
 	
?>	
		<aside>
			<img src="images/packv.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>Pack Virtuales</h2>
					</div>
															
<?php							
	if ($stmt = $mysqli->prepare("SELECT distinct `pack`.`id_pack`,
				`pack`.`nom_pack`,
				`pack`.`horas_pack`,
				 `pack`.`factor_pack`
			FROM `pack`, `grupos`, `detalle_pack` 
			WHERE `detalle_pack`.`id_pack` = `pack`.`id_pack`
			AND `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
			AND`pack`.`estado`= 'A'  
			AND `pack`.`modalidad` = 'V';")) {
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xid, $xnom  , $xhoras , $factor);
			/* obtener valores */
			$c = 0;
			while ($stmt->fetch()) {
				$array_id[$c] = $xid;
				$array_nom[$c] = $xnom;
				$array_horas[$c] = $xhoras;
				$array_factor[$c] = $factor;
				$c++ ;
			}
			$stmt->close();
	}
		$n =0;
	    $N = count($array_id);
	    for($i=0; $i < $N; $i++){
	    	$img = str_replace(' ', '', $array_nom[$i]);
 			$img = str_replace(':', '', $img);
 			$img= $img."_V.jpg";
 			
 			if(($n%3) == 0){
				echo "</div><div class='row'>";
			}
		 	echo "<div class='col-md-4 fh5co-staff '>
						<a  href='cursos_acti_pack_v.php?xcod=$array_id[$i]&xnom=$array_nom[$i]'><img src='images/pack/$img' alt='$img' class='img-responsive'></a>
						<table>
							<tr><b>$array_nom[$i]</b></tr>
							<tr>
								<td><a class='curso-icons' href='#'><i class='icon-list22'></i></a></td>
								<td class='ajustar'>";
 			if ($stmt = $mysqli->prepare("SELECT 
											    `grupos`.`nom_grupo`,
											    `cursos`.`nom_cursos`,
											    `grupos`.`localidad`,
											    `grupos`.`modalidad_grupo`,
											    `grupos`.`precio_curso_grupo`
											FROM `detalle_pack`, `pack`, `grupos` ,  `cursos`
											WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
											AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
											AND  `grupos`.`id_cursos` = `cursos`.`id_cursos`
											AND `pack`.`id_pack` = ? ;")) {
			$stmt->bind_param('i', $array_id[$i]);
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result( $xnom_g,  $xnom_c, $local, $xmoda,$xprecio);
			$totalimp = 0;
			$resta = 0;
			$totalimp = 0;
			$xprecio_t = 0;
			while ($stmt->fetch()) {
					$xnom_c = ucwords(strtolower($xnom_c));
					echo "<dd>- $xnom_c</dd>";
					$xprecio_t =  $xprecio_t + $xprecio;
					$total = $xprecio - ($xprecio*$array_factor[$i]);
					$totalimp = $totalimp + $total;
					
			}
			$resta = $xprecio_t - $totalimp;
			echo "</td>
							</tr>
					<tr>
					<td><a class='curso-icons' href='#'><i class='icon-write'></i></a></td>
					<td><b>Modalidad:</b>" ;
														if($xmoda=='P'){
															echo " Presencial";
														}
														else if($xmoda=='V'){
															echo " Virtual";
														}
													echo"</td>
				</tr>
				<tr>
					<td><a class='curso-icons' href='#'><i class='icon-credit-card'></i></a></td>
					<td><b>Inversion:</b><s><small class='text-danger'> S/.$xprecio_t</small></s> <big>S/.$totalimp</big> <br><i>*<small>Ahorra  S/.$resta </small></i></td>
				</tr>
				<tr>
					<td  colspan='2'>
					<a class='btn btn-primary' href='login.php'> Pre-Matriculate</a>
					<a class='btn' href='cursos_acti_pack_v.php?xcod=$array_id[$i]&xnom=$array_nom[$i]'> Mas detalles</a>
					</td>
				</tr>
			</table>

			<hr size='18px' color='black' />
		</div>";	
 		}
 		$n ++;
 	}
 	$url="cursos_sup_pack_v.php";
	$_SESSION["xurl"]=$url;	
	?>	
		</div>
	</div>
</div>
<?php include 'footer.php';?>		