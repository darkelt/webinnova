<?php include 'header.php';
		$ciudad = leerParam("state",null);
				
?>	
<script language="javascript">
	var s_a = new Array();
	s_a[180] = "Arequipa|Ayacucho|Cusco|Ica|Puno|Lima|Mexico-Chiapas";
	function populateStates(stateElementId) {

	    var stateElement = document.getElementById(stateElementId);

	    stateElement.length = 0; // Fixed by Julian Woods
	    stateElement.options[0] = new Option('Selecciona Ciudad', '');
	    stateElement.selectedIndex = 0;

	    var state_arr = s_a[180].split("|");

	    for (var i = 0; i < state_arr.length; i++) {
	        stateElement.options[stateElement.length] = new Option(state_arr[i], state_arr[i]);
	    }
	}


</script>

		<aside>
			<img src="images/packp.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
							<div class="col-md-12  text-center fh5co-heading">
								<h2>Escoger una Localidad</h2>
							</div>
							<form method="post" action="cursos_sup_pack_p.php">
								<input type=hidden name=buscar value="NGRUPO">
								  <div class="row">
								   	
									<div class="col-md-4 col-md-offset-4  ">
										<div class="select-wrapper">
											 <select class="form-control" name="state" id="state"></select>
											
										</div>
									</div>
								    <div class="col-md-4">
									    <button type="submit" class="btn btn-default">Buscar</button>
								    </div>
							  	</div>
							</form>
															
<?php	

if(isset($ciudad)) {?>

				<br>	
			<h3>PACK PRESENCIALES: <?php echo strtoupper($ciudad);?></h3>
					
	


<?php							
	if ($stmt = $mysqli->prepare("SELECT distinct `pack`.`id_pack`,
									    `pack`.`nom_pack`,
									    `pack`.`horas_pack`,
									     `pack`.`factor_pack`
									FROM `pack`, `grupos`, `detalle_pack` 
									WHERE `detalle_pack`.`id_pack` = `pack`.`id_pack`
									AND `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
									AND `grupos`.`localidad` = ?
									AND`pack`.`estado`= 'A' ;")) {
			$stmt->bind_param('s', $ciudad);
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
 			$img= $img."_P.jpg";

 			if(($n%3) == 0){
				echo "</div><div class='row'>";
			}
		 	echo "<div class='col-md-4 fh5co-staff '>
						<a  href='cursos_acti_pack_p.php?xcod=$array_id[$i]&xnom=$array_nom[$i]&ciudad=$ciudad'><img src='images/pack/$img' alt='$img' class='img-responsive'></a>
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
											    `grupos`.`precio_curso_grupo`,
											    `grupos`.`precio_dolar_grupo`
											FROM `detalle_pack`, `pack`, `grupos` ,  `cursos`
											WHERE`detalle_pack`.`id_pack` = `pack`.`id_pack` 
											AND  `detalle_pack`.`id_grupo` = `grupos`.`id_grupo`
											AND  `grupos`.`id_cursos` = `cursos`.`id_cursos`
											AND `pack`.`id_pack` = ? ;")) {
			$stmt->bind_param('i', $array_id[$i]);
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result( $xnom_g,  $xnom_c, $local, $xmoda,$xprecio,$xpreciod);
			$totalimp = 0;
			$resta = 0;
			$totalimp = 0;
			$xprecio_t = 0;
			while ($stmt->fetch()) {
					$xnom_c = ucwords(strtolower($xnom_c));
					echo "<dd>- $xnom_c</dd>";

					$xprecio_td =  $xprecio_td + $xpreciod;
					$totald = $xpreciod - ($xpreciod*$array_factor[$i]);
					$totalimpd = $totalimpd + $totald;
					


					$xprecio_t =  $xprecio_t + $xprecio;
					$total = $xprecio - ($xprecio*$array_factor[$i]);
					$totalimp = $totalimp + $total;
					
			}
			$restad = $xprecio_td - $totalimpd;
			$resta = $xprecio_t - $totalimp;
			$url="cursos_acti_pro.php?xcod=".$nom;
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
					<td><b>Inversion Soles:</b><s><small class='text-danger'> S/.$xprecio_t</small></s> <big>S/.$totalimp</big> <br><i>*<small>Ahorra  S/.$resta </small></i></td>
					
				</tr>
				<tr>
					<td><a class='curso-icons' href='#'><i class='icon-credit-card'></i></a></td>
						<td><b>Inversion Dolares:</b><s><small class='text-danger'>$.$xprecio_td</small></s> <big>$.$totalimpd</big> <br><i>*<small>Ahorra  $.$restad </small></i></td>
					
				</tr>

				<tr>
					<td  colspan='2'>
					<a class='btn btn-primary' href='login.php'> Pre-Matriculate</a>
					<a class='btn' href='cursos_acti_pack_p.php?xcod=$array_id[$i]&xnom=$array_nom[$i]&ciudad=$ciudad'> Mas detalles</a>
					</td>
				</tr>
			</table>

			<hr size='18px' color='black' />
		</div>";	
 		}
 		$n ++;
 	}
 	$url="cursos_sup_pack_p.php";
	$_SESSION["xurl"]=$url;	


 }
	?>	
		</div>
	</div>
</div>
<script language="javascript">
			 populateStates("state");
		</script>
<?php include 'footer.php';?>		